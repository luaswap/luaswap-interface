import React, { useState, useEffect } from 'react'
import styled from 'styled-components'
import { withRouter } from 'react-router-dom'
import { AutoColumn } from '../../components/Column'
import { SwapPoolTabs } from '../../components/NavigationTabs'
import logoSrc from '../../assets/images/logo.png'
import { reduceFractionDigit } from '../../utils'
import List from './List'
import Details from './Details'
import Loader from '../../components/Loader'
import { requestStakingPools } from '../../services'
import useSushi from '../../hooks/useSushi'
import BigNumber from 'bignumber.js'
import { getXSushiSupply } from '../../sushi/utils'
import { getBalanceNumber } from '../../utils/formatBalance'

const PageWrapper = styled(AutoColumn)`
  max-width: 900px;
  width: 100%;
`

const Header = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 50px;
`

const HeaderImg = styled.img`
  width: 150px;
  height: 150px;
  margin-bottom: 10px;
`

const HeaderTitle = styled.div`
  margin-bottom: 20px;
  color: lightgray;
  font-size: 16px;
`

const HeaderSubTitle = styled.div`
  color: white;
  font-size: 22px;
  font-weight: bold;
`

const TotalSupplyText = styled.span`
  color: #4caf50;
  font-size: 30px;
`

const LoaderContainer = styled.div`
  display: flex;
  justify-content: center;
  align-items: center;
`

const SafePage = ({ location }: SafePageProps) => {
  const [poolKey, setPoolKey] = useState('')
  const [pools, setPools] = useState<PoolItemProps[]>([])
  const [totalSupply, setTotalSupply] = useState<BigNumber>()
  const sushi = useSushi()

  useEffect(() => {
    requestStakingPools((data: any) => setPools(data))
  }, [])

  useEffect(() => {
    if (location && location.search) {
      const searchParams: any = new URLSearchParams(location.search)

      setPoolKey(searchParams.get('pool'))
    } else {
      setPoolKey('')
    }
  }, [location])

  useEffect(() => {
    const fetchTotalSupply = async () => {
      const supply = await getXSushiSupply(sushi)
      setTotalSupply(supply)
    }
    if (sushi) {
      fetchTotalSupply()
    }
  }, [sushi])

  return (
    <>
      <PageWrapper>
        <SwapPoolTabs active="lua-safe" />
        <Header>
          <HeaderImg src={logoSrc} />
          <HeaderTitle>{'Welcome to the LuaSafe, stake LUA to earn tokens!'}</HeaderTitle>
          <HeaderSubTitle>
            {`LuaSafe Currently Has `}
            <TotalSupplyText>{reduceFractionDigit(getBalanceNumber(new BigNumber(totalSupply)), 2)}</TotalSupplyText>
            {` LUA Staked`}
          </HeaderSubTitle>
        </Header>
        {poolKey ? (
          <Details />
        ) : pools.length > 0 && Object.keys(pools[0]).length > 0 ? (
          <List items={pools} />
        ) : (
          <LoaderContainer>
            <Loader size="40px" />
          </LoaderContainer>
        )}
      </PageWrapper>
    </>
  )
}

interface SafePageProps {
  history: any
  location: any
}

interface PoolItemProps {
  lpAddresses: string
  lpBalance: number
  token0Addresses: string
  token0Balance: number
  token0Symbol: keyof PoolItemProps
  token1Addresses: string
  token1Balance: number
  token1Symbol: keyof PoolItemProps
}

export default withRouter(SafePage)
