import { Currency, JSBI, TokenAmount, TOMO } from '@luaswap/sdk'
import BigNumber from 'bignumber.js'
import React, { useCallback, useEffect, useState } from 'react'
import { useHistory } from 'react-router-dom'
import { Plus } from 'react-feather'
import { Text } from 'rebass'
import styled from 'styled-components'
import { Link } from 'react-router-dom'
// import
import { FACTORY_ADDRESS } from '../../constants'
import { getNativeToken } from '../../utils'
import { ButtonDropdownLight } from '../../components/Button'
import { LightCard } from '../../components/Card'
import { AutoColumn, ColumnCenter } from '../../components/Column'
import CurrencyLogo from '../../components/CurrencyLogo'
import { CreatePairTitle } from '../../components/NavigationTabs'
import { MinimalPositionCard } from '../../components/PositionCard'
import Row from '../../components/Row'
import CurrencySearchModal from '../../components/SearchModal/CurrencySearchModal'
import { ButtonPrimary } from '../../components/Button'
import { PairState, usePair } from '../../data/Reserves'
import { useActiveWeb3React } from '../../hooks'
import { usePairAdder } from '../../state/user/hooks'
import { useTokenBalance } from '../../state/wallet/hooks'
import { wrappedCurrency } from '../../utils/wrappedCurrency'
import { getContract } from '../../utils'
import TRC21_ABI from '../../constants/abis/trc21.json'
import V2_FACTORY_ABI from '../../constants/abis/factory.json'
import { StyledInternalLink } from '../../theme'
import { currencyId } from '../../utils/currencyId'
import AppBody from '../AppBody'
import { Dots } from '../Pool/styleds'
import NoticeTomoBridge from '../../components/NoticeGeneral/bridge'

const StyledLink = styled(Link)`
  color: #fff;
  text-decoration: none;
  padding: 10px 25px;
  margin-top: 10px;
  margin-bottom: 20px;
  border-radius: 10px;
  background-color: ${({ theme }) => theme.primary1};
`
enum Fields {
  TOKEN0 = 0,
  TOKEN1 = 1
}

export default function CreatePair() {
  const { library, chainId, account } = useActiveWeb3React()
  const NATIVE_TOKEN = getNativeToken(chainId)
  const [showSearch, setShowSearch] = useState<boolean>(false)
  const [activeField, setActiveField] = useState<number>(Fields.TOKEN1)

  const [currency0, setCurrency0] = useState<Currency | null>(NATIVE_TOKEN)
  const [currency1, setCurrency1] = useState<Currency | null>(null)

  const [pairState, pair] = usePair(currency0 ?? undefined, currency1 ?? undefined)
  const addPair = usePairAdder()
  useEffect(() => {
    if (pair) {
      addPair(pair)
    }
  }, [pair, addPair])
  const validPairNoLiquidity: boolean =
    pairState === PairState.NOT_EXISTS ||
    Boolean(
      pairState === PairState.EXISTS &&
        pair &&
        JSBI.equal(pair.reserve0.raw, JSBI.BigInt(0)) &&
        JSBI.equal(pair.reserve1.raw, JSBI.BigInt(0))
    )
  const position: TokenAmount | undefined = useTokenBalance(account ?? undefined, pair?.liquidityToken)
  const hasPosition = Boolean(position && JSBI.greaterThan(position.raw, JSBI.BigInt(0)))

  const handleCurrencySelect = useCallback(
    (currency: Currency) => {
      if (activeField === Fields.TOKEN0) {
        setCurrency0(currency)
      } else {
        setCurrency1(currency)
      }
    },
    [activeField]
  )

  const handleSearchDismiss = useCallback(() => {
    setShowSearch(false)
  }, [setShowSearch])
  const history = useHistory()
  async function onCreate() {
    let args: Array<string | string[] | number>, isTrc21A: boolean, isTrc21B: boolean
    if (currency0 === TOMO) {
      isTrc21A = false
    } else {
      try {
        const currencyAContract = getContract(
          // @ts-ignore
          wrappedCurrency(currency0, chainId)?.address ?? '',
          TRC21_ABI,
          // @ts-ignore
          library,
          account
        )
        await currencyAContract.minFee()
        // @ts-ignore
        await currencyAContract.estimateFee(new BigNumber(1000).multipliedBy(10 ** currency0?.decimals).toString(10))
        isTrc21A = true
      } catch {
        isTrc21A = false
      }
    }

    if (currency1 === TOMO) {
      isTrc21B = false
    } else {
      try {
        const currencyBContract = getContract(
          // @ts-ignore
          wrappedCurrency(currency1, chainId)?.address ?? '',
          TRC21_ABI,
          // @ts-ignore
          library,
          account
        )
        await currencyBContract.minFee()
        // @ts-ignore
        await currencyBContract.estimateFee(new BigNumber(1000).multipliedBy(10 ** currency1?.decimals).toString(10))
        isTrc21B = true
      } catch {
        isTrc21B = false
      }
    }
    // @ts-ignore
    const factoryContract = getContract(FACTORY_ADDRESS, V2_FACTORY_ABI, library, account, false)
    args = [
      // @ts-ignore
      wrappedCurrency(currency0, chainId)?.address ?? '',
      // @ts-ignore
      wrappedCurrency(currency1, chainId)?.address ?? '',
      // @ts-ignore
      isTrc21A,
      // @ts-ignore
      isTrc21B
    ]
    await factoryContract
      .createPairTRC21(...args)
      // @ts-ignore
      .then(result => {
        console.log('Pair has been created')
      })
      // @ts-ignore
      .catch(error => {
        console.log(error)
      })
    // @ts-ignore
    factoryContract.once('PairCreated', function(token0, token1) {
      history.push(`/add/${token0}/${token1}`)
    })
  }

  const prerequisiteMessage = (
    <LightCard padding="45px 10px">
      <Text textAlign="center">
        {!account ? 'Connect to a wallet to find pools' : 'Select a token to check your liquidity.'}
      </Text>
    </LightCard>
  )

  return (
    <>
      <NoticeTomoBridge />
      <AppBody>
        <CreatePairTitle />
        <AutoColumn gap="md" style={{ padding: '1rem' }}>
          <ButtonDropdownLight
            onClick={() => {
              setShowSearch(true)
              setActiveField(Fields.TOKEN0)
            }}
          >
            {currency0 ? (
              <Row>
                <CurrencyLogo currency={currency0} />
                <Text fontWeight={500} fontSize={20} marginLeft={'12px'}>
                  {currency0.symbol}
                </Text>
              </Row>
            ) : (
              <Text fontWeight={500} fontSize={20} marginLeft={'12px'}>
                Select a Token
              </Text>
            )}
          </ButtonDropdownLight>

          <ColumnCenter>
            <Plus size="16" color="#888D9B" />
          </ColumnCenter>

          <ButtonDropdownLight
            onClick={() => {
              setShowSearch(true)
              setActiveField(Fields.TOKEN1)
            }}
          >
            {currency1 ? (
              <Row>
                <CurrencyLogo currency={currency1} />
                <Text fontWeight={500} fontSize={20} marginLeft={'12px'}>
                  {currency1.symbol}
                </Text>
              </Row>
            ) : (
              <Text fontWeight={500} fontSize={20} marginLeft={'12px'}>
                Select a Token
              </Text>
            )}
          </ButtonDropdownLight>

          {hasPosition && (
            <ColumnCenter
              style={{ justifyItems: 'center', backgroundColor: '', padding: '12px 0px', borderRadius: '12px' }}
            >
              <Text textAlign="center" fontWeight={500}>
                Pool Found!
              </Text>
              <StyledInternalLink to={`/pool`}>
                <Text textAlign="center">Manage this pool.</Text>
              </StyledInternalLink>
            </ColumnCenter>
          )}

          {currency0 && currency1 ? (
            pairState === PairState.EXISTS ? (
              hasPosition && pair ? (
                <MinimalPositionCard pair={pair} border="1px solid #CED0D9" />
              ) : (
                <LightCard padding="45px 10px">
                  <AutoColumn gap="sm" justify="center">
                    <Text color="#AF7C31" textAlign="center" fontSize="13px">
                      Pair already exist, you can add liquidity to this pair.
                    </Text>
                    <StyledLink to={`/add/${currencyId(currency0)}/${currencyId(currency1)}`}>
                      <Text textAlign="center">Add liquidity</Text>
                    </StyledLink>
                  </AutoColumn>
                </LightCard>
              )
            ) : validPairNoLiquidity ? (
              <ButtonPrimary style={{ margin: '20px 0 0 0' }} onClick={onCreate}>
                <Text fontWeight={500} fontSize={20}>
                  Create Pair
                </Text>
              </ButtonPrimary>
            ) : // <LightCard padding="45px 10px">
            //   <AutoColumn gap="sm" justify="center">
            //     <Text textAlign="center">No pool found.</Text>
            //     <StyledInternalLink to={`/add/${currencyId(currency0)}/${currencyId(currency1)}`}>
            //       Create pool.
            //     </StyledInternalLink>
            //   </AutoColumn>
            // </LightCard>
            pairState === PairState.INVALID ? (
              <LightCard padding="45px 10px">
                <AutoColumn gap="sm" justify="center">
                  <Text textAlign="center" fontWeight={500}>
                    Invalid pair.
                  </Text>
                </AutoColumn>
              </LightCard>
            ) : pairState === PairState.LOADING ? (
              <LightCard padding="45px 10px">
                <AutoColumn gap="sm" justify="center">
                  <Text textAlign="center">
                    Loading
                    <Dots />
                  </Text>
                </AutoColumn>
              </LightCard>
            ) : null
          ) : (
            prerequisiteMessage
          )}
        </AutoColumn>

        <CurrencySearchModal
          isOpen={showSearch}
          onCurrencySelect={handleCurrencySelect}
          onDismiss={handleSearchDismiss}
          showCommonBases
          selectedCurrency={(activeField === Fields.TOKEN0 ? currency1 : currency0) ?? undefined}
        />
      </AppBody>
    </>
  )
}
