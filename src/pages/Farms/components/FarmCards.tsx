import BigNumber from 'bignumber.js'
import React, { useEffect, useState } from 'react'
import { useWeb3React } from '@web3-react/core'
import Countdown, { CountdownRenderProps } from 'react-countdown'
import styled, { keyframes } from 'styled-components'

import Button from '../../../components/ButtonSushi'
// import Card from '../../components/Card'
import CardContent from '../../../components/CardContent'
import CardIcon from '../../../components/CardIcon'
import Loader from '../../../components/Loader'
import Spacer from '../../../components/Spacer'
import { Farm } from '../../../contexts/Farms'
import useAllStakedValue from '../../../hooks/farms/useAllStakedValue'
import useFarms from '../../../hooks/farms/useFarms'
import useLuaPrice from '../../../hooks/farms/useLuaPrice'
import usePoolActive from '../../../hooks/farms/usePoolActive'
import useSushi from '../../../hooks/farms/useSushi'
// import { useBlockNumber } from '../../../state/application/hooks'
import { START_NEW_POOL_AT } from '../../../sushi/lib/constants'
import { NUMBER_BLOCKS_PER_YEAR } from '../../../config'
import { getNewRewardPerBlock } from '../../../sushi/utils'
// import { bnToDec } from '../../sushi/ultils'
import { getBalanceNumber } from '../../../sushi/format/formatBalance'
import { IsTomoChain } from '../../../utils'

interface FarmWithStakedValue extends Farm {
  tokenAmount: BigNumber
  token2Amount: BigNumber
  totalToken2Value: BigNumber
  tokenPriceInToken2: BigNumber
  usdValue: BigNumber
  poolWeight: BigNumber
  luaPrice: BigNumber
}

const FarmCards: React.FC = () => {
  const [farms] = useFarms()
  const stakedValue = useAllStakedValue()
  const luaPrice = useLuaPrice()

  const rows = farms.reduce<FarmWithStakedValue[][]>(
    (farmRows, farm, i) => {
      const farmWithStakedValue: FarmWithStakedValue = {
        ...farm,
        tokenAmount: (stakedValue[i] || {}).tokenAmount || new BigNumber(0),
        token2Amount: (stakedValue[i] || {}).token2Amount || new BigNumber(0),
        totalToken2Value: (stakedValue[i] || {}).totalToken2Value || new BigNumber(0),
        tokenPriceInToken2: (stakedValue[i] || {}).tokenPriceInToken2 || new BigNumber(0),
        poolWeight: (stakedValue[i] || {}).poolWeight || new BigNumber(0),
        usdValue: (stakedValue[i] || {}).usdValue || new BigNumber(0),
        luaPrice
      }
      const newFarmRows = [...farmRows]
      if (newFarmRows[newFarmRows.length - 1].length === 3) {
        newFarmRows.push([farmWithStakedValue])
      } else {
        newFarmRows[newFarmRows.length - 1].push(farmWithStakedValue)
      }
      return newFarmRows
    },
    [[]]
  )

  return (
    <StyledCards>
      {!!rows[0].length ? (
        rows.map((farmRow, i) => (
          <StyledRow key={i}>
            {farmRow.map((farm, j) => (
              <React.Fragment key={j}>
                <FarmCard farm={farm} />
                {(j === 0 || j === 1) && <StyledSpacer />}
              </React.Fragment>
            ))}
          </StyledRow>
        ))
      ) : (
        <StyledLoadingWrapper>
          <Loader text="Cooking the rice ..." />
        </StyledLoadingWrapper>
      )}
    </StyledCards>
  )
}

interface FarmCardProps {
  farm: FarmWithStakedValue
}

const FarmCard: React.FC<FarmCardProps> = ({ farm }) => {
  const { chainId } = useWeb3React()
  const IsTomo = IsTomoChain(chainId)
  const ID = IsTomo ? 88 : 1
  const poolActive = usePoolActive(farm.pid)

  const sushi = useSushi()
  // const block = useBlockNumber()
  const [newReward, setNewRewad] = useState<BigNumber>()
  useEffect(() => {
    async function fetchData() {
      const supply = await getNewRewardPerBlock(sushi, farm.pid + 1, chainId)
      setNewRewad(supply)
    }
    if (sushi && poolActive) {
      fetchData()
    }
  }, [sushi, setNewRewad, poolActive])

  const renderer = (countdownProps: CountdownRenderProps) => {
    let { days, hours, minutes, seconds } = countdownProps
    const paddedSeconds = seconds < 10 ? `0${seconds}` : seconds
    const paddedMinutes = minutes < 10 ? `0${minutes}` : minutes
    hours = days * 24 + hours
    const paddedHours = hours < 10 ? `0${hours}` : hours
    return (
      <span style={{ width: '100%' }}>
        {paddedHours}:{paddedMinutes}:{paddedSeconds}
      </span>
    )
  }

  const startTime = START_NEW_POOL_AT
  return (
    <StyledCardWrapper>
      {farm.tokenSymbol === 'LUA' && <StyledCardAccent />}
      <CardWrap>
        <CardContent>
          <StyledContent>
            <StyledTopIcon>
              {farm.isHot && <StyledHotIcon>NO REWARD</StyledHotIcon>}
              {farm.isNew && <StyledNewIcon>THIS WEEK</StyledNewIcon>}
            </StyledTopIcon>
            <div style={{ display: 'flex' }}>
              <CardIcon>
                <img src={farm.icon} alt="" height="60" />
              </CardIcon>
              <span>&nbsp;&nbsp;</span>
              <CardIcon>
                <img src={farm.icon2} alt="" height="60" />
              </CardIcon>
            </div>
            <StyledTitle>{farm.name}</StyledTitle>
            <StyledDetails>
              <StyledDetail>{farm.description}</StyledDetail>
            </StyledDetails>
            <Spacer />
            <Button disabled={!poolActive} text={poolActive ? 'Select' : undefined} to={`/farming/${farm.id}`}>
              {!poolActive && <Countdown date={new Date(startTime * 1000)} renderer={renderer} />}
            </Button>
            {/* <Button disabled={(block && block < 34466888) ? true : false} text={(block && block > 34466888) ? 'Select' : 'Disable'} to={(block && block > 34466888) ? `/farming/${farm.id}` : ''}>
              {!poolActive && <Countdown date={new Date(startTime * 1000)} renderer={renderer} />}
            </Button> */}
            <br />
            {!IsTomo ? (
              <StyledInsight>
                <span>Total Locked Value</span>
                <span>
                  {farm.usdValue && (
                    <>
                      <b>{parseFloat(farm.usdValue.toFixed(0)).toLocaleString('en-US')} USD</b>
                    </>
                  )}
                </span>
              </StyledInsight>
            ) : (
              ''
            )}
            {!farm.isHot && (
              <>
                <StyledInsight>
                  <span>Reward</span>
                  <span>
                    {newReward && (
                      <>
                        <b>{getBalanceNumber(newReward).toFixed(3)} LUA</b> / block
                      </>
                    )}
                    {!newReward && '~'}
                  </span>
                </StyledInsight>
                <StyledInsight>
                  <span>APY</span>
                  <span style={{ fontWeight: 'bold', color: '#4caf50' }}>
                    {newReward && farm.poolWeight && farm.luaPrice && farm.usdValue
                      ? `${parseFloat(
                          farm.luaPrice
                            .times(NUMBER_BLOCKS_PER_YEAR[ID])
                            .times(newReward.div(10 ** 18))
                            .div(farm.usdValue)
                            .div(10 ** 8)
                            .times(100)
                            .toFixed(2)
                        ).toLocaleString('en-US')}%`
                      : '~'}
                  </span>
                </StyledInsight>
              </>
            )}
          </StyledContent>
        </CardContent>
      </CardWrap>
    </StyledCardWrapper>
  )
}

const CardWrap = styled.div`
  background-color: ${props => props.theme.bg1};
`
const RainbowLight = keyframes`
  
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
`

const StyledCardAccent = styled.div`
  background: linear-gradient(
    45deg,
    rgba(255, 0, 0, 1) 0%,
    rgba(255, 154, 0, 1) 10%,
    rgba(208, 222, 33, 1) 20%,
    rgba(79, 220, 74, 1) 30%,
    rgba(63, 218, 216, 1) 40%,
    rgba(47, 201, 226, 1) 50%,
    rgba(28, 127, 238, 1) 60%,
    rgba(95, 21, 242, 1) 70%,
    rgba(186, 12, 248, 1) 80%,
    rgba(251, 7, 217, 1) 90%,
    rgba(255, 0, 0, 1) 100%
  );
  background-size: 300% 300%;
  animation: ${RainbowLight} 2s linear infinite;
  border-radius: 12px;
  filter: blur(6px);
  position: absolute;
  top: -2px;
  right: -2px;
  bottom: -2px;
  left: -2px;
  z-index: -1;
`

const StyledCards = styled.div`
  width: 900px;
  margin: 0 auto;
  @media (max-width: 768px) {
    width: 100%;
  }
`

const StyledLoadingWrapper = styled.div`
  align-items: center;
  display: flex;
  flex: 1;
  justify-content: center;
`

const StyledRow = styled.div`
  display: flex;
  margin-bottom: ${props => props.theme.spacing[4]}px;
  flex-flow: row wrap;
  @media (max-width: 768px) {
    width: 100%;
    flex-flow: column nowrap;
    align-items: center;
  }
`

const StyledCardWrapper = styled.div`
  display: flex;
  width: calc((900px - ${props => props.theme.spacing[4]}px * 2) / 3);
  position: relative;
  overflow: hidden;
  border-radius: 12px;
`

const StyledTitle = styled.h4`
  color: ${props => props.theme.white};
  font-size: 20px;
  font-weight: 700;
  margin: ${props => props.theme.spacing[2]}px 0 0;
  padding: 0;
`

const StyledContent = styled.div`
  align-items: center;
  display: flex;
  flex-direction: column;
`
const StyledTopIcon = styled.div`
  // position: relative;
`

const StyledHotIcon = styled.div`
  position: absolute;
  background-color: gray;
  padding: 8px 40px 8px;
  top: 12px;
  left: -40px;
  font-weight: bold;
  -webkit-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  transform: rotate(-45deg);
  color: #fff;
  font-size: 9px;
`
const StyledNewIcon = styled.div`
  position: absolute;
  padding: 8px 40px 8px;
  top: 12px;
  left: -40px;
  background-color: ${props => props.theme.primary1};
  font-weight: bold;
  -webkit-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  transform: rotate(-45deg);
  color: #fff;
  font-size: 9px;
`

const StyledSpacer = styled.div`
  height: ${props => props.theme.spacing[4]}px;
  width: ${props => props.theme.spacing[4]}px;
`

const StyledDetails = styled.div`
  margin-top: ${props => props.theme.spacing[2]}px;
  text-align: center;
`

const StyledDetail = styled.div`
  color: ${props => props.theme.text2};
  font-size: 14px;
`

const StyledInsight = styled.div`
  display: flex;
  justify-content: space-between;
  box-sizing: border-box;
  border-radius: 8px;
  background: transparent;
  color: #9e9e9e;
  width: 100%;
  line-height: 25px;
  font-size: 13px;
  border: 0px solid #e6dcd5;
  text-align: center;
`

export default FarmCards
