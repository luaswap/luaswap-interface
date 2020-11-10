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
import { SAFE_POOLS } from '../../constants'

const PageWrapper = styled(AutoColumn)`
  max-width: 900px;
  width: 100%;
`

const Header = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 30px;
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
  margin-bottom: 40px;
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
  const [pools, setPools] = useState([{}])

  const getTotalSupply = (): number => {
    return 0
  }

  useEffect(() => {
    setPools(SAFE_POOLS)
  }, [])

  useEffect(() => {
    setPools([])
    if (location && location.search) {
      const searchParams: any = new URLSearchParams(location.search)

      setPoolKey(searchParams.get('pool'))
    } else {
      setPoolKey('')
    }
  }, [location])

  return (
    <>
      <PageWrapper>
        <SwapPoolTabs active="lua-safe" />
        <Header>
          <HeaderImg src={logoSrc} />
          <HeaderTitle>{'Welcome to the LuaSafe, stake LUA to earn tokens!'}</HeaderTitle>
          <HeaderSubTitle>
            {`LuaSafe Currently Has `}
            <TotalSupplyText>{reduceFractionDigit(getTotalSupply(), 2)}</TotalSupplyText>
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
        <List />
      </PageWrapper>
    </>
  )
}

interface SafePageProps {
  history: any
  location: any
}

export default withRouter(SafePage)
