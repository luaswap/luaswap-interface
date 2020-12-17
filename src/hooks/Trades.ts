import { Currency, CurrencyAmount, Pair, Token, Trade } from '@luaswap/sdk'
import flatMap from 'lodash.flatmap'
import { useMemo } from 'react'

import { BASES_TO_CHECK_TRADES_AGAINST, CROSS_BASES_TO_CHECK_TRADES_AGAINST, CUSTOM_BASES } from '../constants'
import { PairState, usePairs } from '../data/Reserves'
import { wrappedCurrency } from '../utils/wrappedCurrency'

import { useActiveWeb3React } from './index'
import { useSelectedTokenList } from '../state/lists/hooks'
import { isTokenOnList } from '../utils/index'
import { useCurrency } from './Tokens'

function useAllCommonPairs(currencyA?: Currency, currencyB?: Currency, protocol = 'luaswap'): Pair[] {
  const { chainId } = useActiveWeb3React()

  const bases: Token[] = chainId
    ? protocol === 'luaswap'
      ? BASES_TO_CHECK_TRADES_AGAINST[chainId]
      : CROSS_BASES_TO_CHECK_TRADES_AGAINST[chainId]
    : []

  const [tokenA, tokenB] = chainId
    ? [wrappedCurrency(currencyA, chainId), wrappedCurrency(currencyB, chainId)]
    : [undefined, undefined]

  const basePairs: [Token, Token][] = useMemo(
    () =>
      flatMap(bases, (base): [Token, Token][] => bases.map(otherBase => [base, otherBase])).filter(
        ([t0, t1]) => t0.address !== t1.address
      ),
    [bases]
  )

  const allPairCombinations: [Token, Token][] = useMemo(
    () =>
      tokenA && tokenB
        ? [
            // the direct pair
            [tokenA, tokenB],
            // token A against all bases
            ...bases.map((base): [Token, Token] => [tokenA, base]),
            // token B against all bases
            ...bases.map((base): [Token, Token] => [tokenB, base]),
            // each base against all bases
            ...basePairs
          ]
            .filter((tokens): tokens is [Token, Token] => Boolean(tokens[0] && tokens[1]))
            .filter(([t0, t1]) => t0.address !== t1.address)
            .filter(([tokenA, tokenB]) => {
              if (!chainId) return true
              const customBases = CUSTOM_BASES[chainId]
              if (!customBases) return true

              const customBasesA: Token[] | undefined = customBases[tokenA.address]
              const customBasesB: Token[] | undefined = customBases[tokenB.address]

              if (!customBasesA && !customBasesB) return true

              if (customBasesA && !customBasesA.find(base => tokenB.equals(base))) return false
              if (customBasesB && !customBasesB.find(base => tokenA.equals(base))) return false

              return true
            })
        : [],
    [tokenA, tokenB, bases, basePairs, chainId]
  )

  const allPairs = usePairs(allPairCombinations, protocol)

  // only pass along valid pairs, non-duplicated pairs
  return useMemo(
    () =>
      Object.values(
        allPairs
          // filter out invalid pairs
          .filter((result): result is [PairState.EXISTS, Pair] => Boolean(result[0] === PairState.EXISTS && result[1]))
          // filter out duplicated pairs
          .reduce<{ [pairAddress: string]: Pair }>((memo, [, curr]) => {
            memo[curr.liquidityToken.address] = memo[curr.liquidityToken.address] ?? curr
            return memo
          }, {})
      ),
    [allPairs]
  )
}

/**
 * Returns the best trade for the exact amount of tokens in to the given token out
 */
export function useTradeExactIn(currencyAmountIn?: CurrencyAmount, currencyOut?: Currency): Trade | null {
  const options = { maxHops: 2, maxNumResults: 1 }
  const crossBases = [
    useCurrency('0xdAC17F958D2ee523a2206206994597C13D831ec7'),
    useCurrency('0xA0b86991c6218b36c1d19D4a2e9Eb0cE3606eB48'),
    useCurrency('0xC02aaA39b223FE8D0A0e5C4F27eAD9083C756Cc2')
  ]
  const luaswapAllowedPairs = useAllCommonPairs(currencyAmountIn?.currency, currencyOut, 'luaswap')
  const uniswapAllowedPairs = useAllCommonPairs(currencyAmountIn?.currency, currencyOut, 'uniswap')
  const luaswapDefaultTokenList = useSelectedTokenList()

  return useMemo(() => {
    if (currencyAmountIn && currencyOut) {
      const isTokenInOnLuaswap = isTokenOnList(luaswapDefaultTokenList, currencyAmountIn?.currency)
      const isTokenOutOnLuaswap = isTokenOnList(luaswapDefaultTokenList, currencyOut)

      const isTokenInOnCrossBase = !!crossBases.find(
        //@ts-ignore
        base => base?.address === currencyAmountIn?.currency.address || currencyAmountIn?.currency.symbol === 'ETH'
      )

      const isTokenOutOnCrossBase = !!crossBases.find(
        //@ts-ignore
        base => base?.address === currencyOut.address || currencyOut.symbol === 'ETH'
      )

      // swap on luaswap
      if (isTokenInOnLuaswap && isTokenOutOnLuaswap && luaswapAllowedPairs.length > 0) {
        console.log('===============swap on luaswap===============')
        return Trade.bestTradeExactIn(luaswapAllowedPairs, currencyAmountIn, currencyOut, options)[0] ?? null
      }

      // swap on uniswap
      if (
        ((!isTokenInOnLuaswap && !isTokenOutOnLuaswap) ||
          (isTokenInOnCrossBase && !isTokenOutOnLuaswap) ||
          (!isTokenInOnLuaswap && isTokenOutOnCrossBase)) &&
        uniswapAllowedPairs.length > 0
      ) {
        console.log('===============swap on uniswap===============')
        return Trade.bestTradeExactIn(uniswapAllowedPairs, currencyAmountIn, currencyOut, options)[0] ?? null
      }

      // cross swap on luaswap => uniswap
      if (
        isTokenInOnLuaswap &&
        !isTokenOutOnLuaswap &&
        luaswapAllowedPairs.length > 0 &&
        uniswapAllowedPairs.length > 0
      ) {
        console.log('===============cross swap on luaswap => uniswap===============')
        const crossTradesOnLuaswap = crossBases.map(base => {
          //@ts-ignore
          return Trade.bestTradeExactIn(luaswapAllowedPairs, currencyAmountIn, base, options)[0]
        })

        const crossTradesOnUniswap = crossTradesOnLuaswap.map(trade => {
          //@ts-ignore
          return trade ? Trade.bestTradeExactIn(uniswapAllowedPairs, trade.outputAmount, currencyOut, options)[0] : null
        })

        let bestTradeOnUniswap: Trade | null

        crossTradesOnUniswap.forEach(trade => {
          if (!bestTradeOnUniswap) {
            bestTradeOnUniswap = trade
          } else {
            bestTradeOnUniswap =
              trade && bestTradeOnUniswap.outputAmount.greaterThan(trade.outputAmount) ? trade : bestTradeOnUniswap
          }
        })

        const bestTradeOnLuaswap = crossTradesOnLuaswap.find(
          trade => trade && bestTradeOnUniswap && trade.route.output.symbol === bestTradeOnUniswap.route.input.symbol
        )

        const crossPairs =
          //@ts-ignore
          bestTradeOnLuaswap && bestTradeOnUniswap
            ? [...bestTradeOnLuaswap?.route.pairs, ...bestTradeOnUniswap?.route.pairs]
            : []

        return crossPairs.length > 0
          ? Trade.bestTradeExactIn(crossPairs, currencyAmountIn, currencyOut, { maxHops: 4, maxNumResults: 1 })[0]
          : null
      }

      // cross swap on uniswap => luaswap
      if (
        !isTokenInOnLuaswap &&
        isTokenOutOnLuaswap &&
        luaswapAllowedPairs.length > 0 &&
        uniswapAllowedPairs.length > 0
      ) {
        console.log('===============cross swap on uniswap => luaswap===============')
        const crossTradesOnUniswap = crossBases.map(base => {
          //@ts-ignore
          return Trade.bestTradeExactIn(uniswapAllowedPairs, currencyAmountIn, base, options)[0]
        })

        const crossTradesOnLuaswap = crossTradesOnUniswap.map(trade => {
          return trade ? Trade.bestTradeExactIn(luaswapAllowedPairs, trade.outputAmount, currencyOut, options)[0] : null
        })

        let bestTradeOnLuaswap: Trade | null

        crossTradesOnLuaswap.forEach(trade => {
          if (!bestTradeOnLuaswap) {
            bestTradeOnLuaswap = trade
          } else {
            bestTradeOnLuaswap =
              trade && bestTradeOnLuaswap.outputAmount.greaterThan(trade.outputAmount) ? trade : bestTradeOnLuaswap
          }
        })

        const bestTradeOnUniswap = crossTradesOnUniswap.find(
          trade => trade && bestTradeOnLuaswap && trade.route.output.symbol === bestTradeOnLuaswap.route.input.symbol
        )

        const crossPairs =
          //@ts-ignore
          bestTradeOnLuaswap && bestTradeOnUniswap
            ? [...bestTradeOnLuaswap?.route.pairs, ...bestTradeOnUniswap?.route.pairs]
            : []
        return crossPairs.length > 0
          ? Trade.bestTradeExactIn(crossPairs, currencyAmountIn, currencyOut, { maxHops: 4, maxNumResults: 1 })[0]
          : null
      }
    }
    return null
  }, [luaswapAllowedPairs, currencyAmountIn, currencyOut])
}

/**
 * Returns the best trade for the token in to the exact amount of token out
 */
export function useTradeExactOut(currencyIn?: Currency, currencyAmountOut?: CurrencyAmount): Trade | null {
  // const allowedPairs = useAllCommonPairs(currencyIn, currencyAmountOut?.currency, protocol)
  const options = { maxHops: 2, maxNumResults: 1 }
  const crossBases = [
    useCurrency('0xdAC17F958D2ee523a2206206994597C13D831ec7'),
    useCurrency('0xA0b86991c6218b36c1d19D4a2e9Eb0cE3606eB48'),
    useCurrency('0xC02aaA39b223FE8D0A0e5C4F27eAD9083C756Cc2')
  ]
  const luaswapAllowedPairs = useAllCommonPairs(currencyIn, currencyAmountOut?.currency, 'luaswap')
  const uniswapAllowedPairs = useAllCommonPairs(currencyIn, currencyAmountOut?.currency, 'uniswap')
  const luaswapDefaultTokenList = useSelectedTokenList()

  return useMemo(() => {
    if (currencyIn && currencyAmountOut) {
      const isTokenInOnLuaswap = isTokenOnList(luaswapDefaultTokenList, currencyIn)
      const isTokenOutOnLuaswap = isTokenOnList(luaswapDefaultTokenList, currencyAmountOut?.currency)

      const isTokenInOnCrossBase = !!crossBases.find(
        //@ts-ignore
        base => base?.address === currencyIn.address || currencyIn.symbol === 'ETH'
      )

      const isTokenOutOnCrossBase = !!crossBases.find(
        //@ts-ignore
        base => base?.address === currencyAmountOut.currency.address || currencyAmountOut.currency.symbol === 'ETH'
      )

      // swap on luaswap
      if (isTokenInOnLuaswap && isTokenOutOnLuaswap && luaswapAllowedPairs.length > 0) {
        console.log('===============swap on luaswap===============')
        return Trade.bestTradeExactOut(luaswapAllowedPairs, currencyIn, currencyAmountOut, options)[0] ?? null
      }

      // swap on uniswap
      if (
        ((!isTokenInOnLuaswap && !isTokenOutOnLuaswap) ||
          (isTokenInOnCrossBase && !isTokenOutOnLuaswap) ||
          (!isTokenInOnLuaswap && isTokenOutOnCrossBase)) &&
        uniswapAllowedPairs.length > 0
      ) {
        console.log('===============swap on uniswap===============')
        return Trade.bestTradeExactOut(uniswapAllowedPairs, currencyIn, currencyAmountOut, options)[0] ?? null
      }

      // cross swap on luaswap => uniswap
      if (
        isTokenInOnLuaswap &&
        !isTokenOutOnLuaswap &&
        luaswapAllowedPairs.length > 0 &&
        uniswapAllowedPairs.length > 0
      ) {
        console.log('===============cross swap on luaswap => uniswap===============')

        const crossTradesOnUniswap = crossBases.map(base => {
          //@ts-ignore
          return Trade.bestTradeExactOut(uniswapAllowedPairs, base, currencyAmountOut, options)[0] ?? null
        })

        const crossTradesOnLuaswap = crossTradesOnUniswap.map(trade => {
          //@ts-ignore
          return Trade.bestTradeExactOut(luaswapAllowedPairs, currencyIn, trade.inputAmount, options)[0] ?? null
        })

        let bestTradeOnLuaswap: Trade

        crossTradesOnLuaswap.forEach(trade => {
          if (!bestTradeOnLuaswap) {
            bestTradeOnLuaswap = trade
          } else {
            bestTradeOnLuaswap = bestTradeOnLuaswap.inputAmount.lessThan(trade.inputAmount) ? trade : bestTradeOnLuaswap
          }
        })

        const bestTradeOnUniswap = crossTradesOnUniswap.find(
          trade => trade && bestTradeOnLuaswap && trade.route.input.symbol === bestTradeOnLuaswap.route.output.symbol
        )

        const crossPairs =
          //@ts-ignore
          bestTradeOnLuaswap && bestTradeOnUniswap
            ? [...bestTradeOnLuaswap?.route.pairs, ...bestTradeOnUniswap.route.pairs]
            : []

        return crossPairs.length
          ? Trade.bestTradeExactOut(crossPairs, currencyIn, currencyAmountOut, { maxHops: 4, maxNumResults: 1 })[0]
          : null
      }

      // cross swap on uniswap => luaswap
      if (
        !isTokenInOnLuaswap &&
        isTokenOutOnLuaswap &&
        luaswapAllowedPairs.length > 0 &&
        uniswapAllowedPairs.length > 0
      ) {
        console.log('===============cross swap on uniswap => luaswap===============')
        const crossTradesOnLuaswap = crossBases.map(base => {
          //@ts-ignore
          return Trade.bestTradeExactOut(luaswapAllowedPairs, base, currencyAmountOut, options)[0]
        })

        const crossTradesOnUniswap = crossTradesOnLuaswap.map(trade => {
          //@ts-ignore
          return Trade.bestTradeExactOut(uniswapAllowedPairs, currencyIn, trade.inputAmount, options)[0]
        })

        let bestTradeOnUniswap: Trade

        crossTradesOnUniswap.forEach(trade => {
          if (!bestTradeOnUniswap) {
            bestTradeOnUniswap = trade
          } else {
            bestTradeOnUniswap = bestTradeOnUniswap.inputAmount.lessThan(trade.inputAmount) ? trade : bestTradeOnUniswap
          }
        })

        const bestTradeOnLuaswap = crossTradesOnLuaswap.find(
          trade => trade && trade.route.input.symbol === bestTradeOnUniswap.route.output.symbol
        )

        const crossPairs =
          //@ts-ignore
          bestTradeOnLuaswap && bestTradeOnUniswap
            ? [...bestTradeOnLuaswap?.route.pairs, ...bestTradeOnUniswap.route.pairs]
            : []
        return crossPairs.length > 0
          ? Trade.bestTradeExactOut(crossPairs, currencyIn, currencyAmountOut, { maxHops: 4, maxNumResults: 1 })[0]
          : null
      }
    }
    return null
  }, [luaswapAllowedPairs, currencyIn, currencyAmountOut])
}
