import { ChainId, Currency, CurrencyAmount, ETHER, TOMO, Token, TokenAmount, WETH } from '@luaswap/sdk'
import { IsTomoChain } from '.'

export function wrappedCurrency(currency: Currency | undefined, chainId: ChainId | undefined): Token | undefined {
  return chainId && (currency === ETHER || currency === TOMO)
    ? WETH[chainId]
    : currency instanceof Token
    ? currency
    : undefined
}

export function wrappedCurrencyAmount(
  currencyAmount: CurrencyAmount | undefined,
  chainId: ChainId | undefined
): TokenAmount | undefined {
  const token = currencyAmount && chainId ? wrappedCurrency(currencyAmount.currency, chainId) : undefined
  return token && currencyAmount ? new TokenAmount(token, currencyAmount.raw) : undefined
}

export function unwrappedToken(token: Token): Currency {
  const IsTomo = IsTomoChain(token.chainId)
  if (token.equals(WETH[token.chainId]) && token.chainId === 1) {
    return ETHER
  } else if (token.equals(WETH[token.chainId]) && IsTomo) {
    return TOMO
  }
  return token
}
