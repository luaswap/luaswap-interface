import React from 'react'
import styled from 'styled-components'
import { useActiveWeb3React } from '../../hooks'
import { IsTomoChain } from '../../utils'
import Container from '../../components/Container'
import Spacer from '../../components/Spacer'
import Balances from './components/Balances'
// import CustomCountDown from './components/CustomCountDown'
// import Icon_Tip from '../../assets/images/pro-tip-icon.svg'
import { START_REWARD_AT_BLOCK } from '../../sushi/lib/constants'
// import { EARN_LUA_REWARD, TIME_EARN_LUA_REWARD } from '../../constants/lists'
import FarmCards from './components/FarmCards'
import TotalLockValue from './components/TotalLockValue'
import NoticeModal from '../../components/NoticeModal'

export default function Farms() {
  const block = 99999999999
  const launchBlock = START_REWARD_AT_BLOCK
  const { chainId } = useActiveWeb3React()
  const IsTomo = IsTomoChain(chainId)
  return (
    <>
      <Container>
        <div style={{ fontWeight: 'bold', fontSize: 22, color: '#ffffff', textAlign: 'center' }}>
          LuaSwap Currently Has{' '}
          <span style={{ color: '#4caf50', fontSize: 30 }}>
            $<TotalLockValue />
          </span>{' '}
          Of Total Locked Value
        </div>

        {block >= launchBlock && (
          <>
            <Spacer size="lg" />
            <Balances />
            <Spacer size="md" />
            <div style={{ textAlign: 'center' }}>
              <ReadMore href="https://medium.com/luaswap/introducing-luaswap-org-7e6ff38beefc" target="__blank">
                {' '}
                👉&nbsp;&nbsp;Read The Announcement&nbsp;&nbsp;👈
              </ReadMore>
              <div style={{ color: 'rgb(255,255,255,0.6)', textAlign: 'center', marginTop: 5 }}>
                Do not complain if you don't
              </div>
            </div>
            <Spacer size="lg" />
          </>
        )}
        <div style={{ color: '#fa4c4c', textAlign: 'center' }}>This project is in beta. Use at your own risk.</div>
        <Spacer size="lg" />
        <div
          style={{
            border: '1px solid #2C3030'
          }}
        ></div>
      </Container>
      <Box className="mt-4">
        <StyledHeading>SELECT YOUR FIELDS</StyledHeading>
        <StyledParagraph>Earn LUA tokens by staking LUA-V1 LP token</StyledParagraph>
        {/* <SpacerRes>
                <Spacer size="sm" />
            </SpacerRes>
            <StyledInfo>
                <img src={Icon_Tip} alt="Pro Tip"/>
                <div>
				<b>Pro Tip</b>: Stake to any pool and earn <b>{EARN_LUA_REWARD} LUA</b> rewards until <a href="https://etherscan.io/block/countdown/11232600" target="_blank" style={{color: '#ffffff'}}>{TIME_EARN_LUA_REWARD}</a>
                </div>
            </StyledInfo> */}
        <Spacer size="lg" />
        <FarmCards />
      </Box>
      {IsTomo ? <NoticeModal /> : ''}
    </>
  )
}

// const StyledInfo = styled.h3`
//   color: ${({ theme }) => theme.white};
//   font-size: 16px;
//   font-weight: 400;
//   margin: 0;
//   padding: 0;
//   text-align: center;
//   display: flex;
//   align-items: start;
//   justify-content: center;
//   > img{
//     width: 20px;
//     margin-right: 3px;
//   }
//   b {
//     color: ${({ theme }) => theme.primary1};
//   }
// `
const StyledHeading = styled.h2`
  color: ${({ theme }) => theme.white};
  text-transform: uppercase;
  text-align: center;
  margin-bottom: 0;
  margin-top: 0;
`
const StyledParagraph = styled.p`
  text-align: center;
  margin-top: 10px;
`

const ReadMore = styled.a`
  text-decoration: none;
  font-weight: bold;
  color: #ffffff;
  display: inline-block;
  padding: 5px 20px;
  border-radius: 5px;
  border: 1px solid #00ff8970;
  background: #00ff890d;
  font-size: 14px;
  margin-top: 10px;
`

const Box = styled.div`
  &.mt-4 {
    margin-top: 40px;
    @media (max-width: 767px) {
      margin-top: 30px;
    }
  }
`
// const SpacerRes = styled.div`
//     .sc-iCoHVE {
//         @media (max-width: 1024px) {
//             display: none;
//         }
//     }
//     .d-lg-none {
//         @media (min-width: 1025px) {
//             display: none;
//         }
//     }
// `
