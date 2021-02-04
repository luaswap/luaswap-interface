import React, { useState, useEffect } from 'react'
import styled from 'styled-components'
import { withRouter } from 'react-router-dom'
import { useActiveWeb3React } from '../../hooks'
import { IsTomoChain } from '../../utils'
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
import { getXSushiSupply, getXLuaAddress } from '../../sushi/utils'
import { getBalanceNumber } from '../../utils/formatBalance'
import { Flex, Box } from 'rebass'
import UnstakeXLua from './UnstakeXLua'
import StakeLua from './StakeLua'
import NoticeModal from '../../components/NoticeModal'

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

const FarmContainer = styled(Flex)`
  flex-direction: column;
  align-items: center;
  @media (max-width: 768px) {
    width: 100%;
  }
`

const CardGrid = styled(Flex)`
  width: 900px;
  justify-content: space-between;
  align-items: stretch;
  @media (max-width: 768px) {
    width: 100%;
    flex-flow: column nowrap;
    align-items: center;
  }
`

const CardContainer = styled(Flex)`
  flex-direction: column;
  align-items: center;
  width: calc(50% - 20px);
  margin: 10px !important;
  @media (max-width: 768px) {
    width: 80%;
  }
`

const InfoBox = styled(Box)`
  font-size: 16px;
  text-align: center;
  font-weight: 400;
  color: #fabc44;
  opacity: 0.7;
`

const SafePage: React.FC<SafePageProps> = ({ location }) => {
  const { chainId } = useActiveWeb3React()
  const IsTomo = IsTomoChain(chainId)
  const [poolKey, setPoolKey] = useState('')
  const [pools, setPools] = useState<PoolItemProps[]>([])
  const [totalSupply, setTotalSupply] = useState<BigNumber>(new BigNumber(0))
  const sushi = useSushi()
  const xLuaAddress = getXLuaAddress(sushi)

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
        <FarmContainer mb={[3, 4]}>
          <CardGrid>
            <CardContainer>
              <UnstakeXLua xLuaAddress={xLuaAddress} />
            </CardContainer>
            <CardContainer>
              <StakeLua />
            </CardContainer>
          </CardGrid>
        </FarmContainer>
        <InfoBox>
          {
            'Users who stake LUA in LuaSafe will receive xLUA LP tokens which represent their proportion of LUA staked. Stakers will need to withdraw their xLUA LP tokens in order to receive their LUA reward.'
          }
        </InfoBox>
        <Box width="100%" my={[4, 5]}>
          <div style={{ border: '1px solid #2C3030' }} />
        </Box>
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
      {IsTomo ? <NoticeModal /> : ''}
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
