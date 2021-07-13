import BigNumber from 'bignumber.js'
import React, { useCallback, useEffect, useState } from 'react'
import { useWeb3React } from '@web3-react/core'
import styled from 'styled-components'
import Button from '../../../components/ButtonSushi'
import CardBox from '../../../components/CardBox'
import CardContent from '../../../components/CardContent'
import IconButton from '../../../components/IconButton'
import { AddIcon } from '../../../components/icons'
import Label from '../../../components/Label'
import useAllowance from '../../../hooks/farms/useAllowance'
import useApprove from '../../../hooks/farms/useApprove'
import useModal from '../../../hooks/farms/useModal'
import useStake from '../../../hooks/farms/useStake'
import useStakedBalance from '../../../hooks/farms/useStakedBalance'
import useTokenBalance from '../../../hooks/farms/useTokenBalance'
import useUnstake from '../../../hooks/farms/useUnstake'
import { getBalanceNumber } from '../../../sushi/format/formatBalance'
import DepositModal from './DepositModal'
import WithdrawModal from './WithdrawModal'
import { getLPTokenStaked } from '../../../sushi/utils'
import useSushi from '../../../hooks/farms/useSushi'
import useBlock from '../../../hooks/farms/useBlock'
import useStakedValue from '../../../hooks/farms/useStakedValue'
import usePoolActive from '../../../hooks/farms/usePoolActive'

interface StakeProps {
  lpContract: any
  pid: number
  tokenName: string
  tokenSymbol: string
  token2Symbol: string
}

const Stake: React.FC<StakeProps> = ({ lpContract, pid, tokenName, tokenSymbol, token2Symbol }) => {
  const { chainId } = useWeb3React()
  const [requestedApproval, setRequestedApproval] = useState(false)

  const allowance = useAllowance(lpContract)
  const { onApprove } = useApprove(lpContract)

  const tokenBalance = useTokenBalance(lpContract.options.address)
  const stakedBalance = useStakedBalance(pid)
  const poolActive = usePoolActive(pid)

  const [totalStake, setTotalStake] = useState<BigNumber>()
  const sushi = useSushi()
  const block = useBlock()
  const stakedValue = useStakedValue(pid)

  useEffect(() => {
    async function fetchData() {
      const data = await getLPTokenStaked(sushi, lpContract, chainId)
      setTotalStake(data)
    }
    if (sushi && lpContract) {
      fetchData()
    }
  }, [sushi, setTotalStake, lpContract, block])

  const { onStake } = useStake(pid)
  const { onUnstake } = useUnstake(pid)

  const [onPresentDeposit] = useModal(<DepositModal max={tokenBalance} onConfirm={onStake} tokenName={tokenName} />)
  const [onPresentWithdraw] = useModal(
    <WithdrawModal max={stakedBalance} onConfirm={onUnstake} tokenName={tokenName} />
  )

  const handleApprove = useCallback(async () => {
    try {
      setRequestedApproval(true)
      const txHash = await onApprove()
      // user rejected tx or didn't go thru
      if (!txHash) {
        setRequestedApproval(false)
      }
    } catch (e) {
      console.log(e)
    }
  }, [onApprove, setRequestedApproval])

  let shareOfPool = 0

  if (totalStake && stakedBalance) {
    shareOfPool = stakedBalance.div(totalStake).toNumber()
  }

  let totalToken = 0
  let totalToken2 = 0

  if (stakedValue && stakedValue.tokenAmount && stakedValue.token2Amount && shareOfPool) {
    totalToken = (stakedValue.tokenAmount as any) * shareOfPool
    totalToken2 = (stakedValue.token2Amount as any) * shareOfPool
  }

  return (
    <CardBox>
      <CardContent>
        <StyledCardContentInner>
          <StyledCardHeader>
            {/* <CardIcon><img src={Luas} alt="LUA Reward"/></CardIcon> */}
            <StyledValue>
              <Label text={`Tokens Staked`} />
              <br />
              <ValueStyled>{new BigNumber(getBalanceNumber(stakedBalance)).toFormat(6)}</ValueStyled>
              <br />
              <StyledContent>
                <div>
                  {new BigNumber(totalToken).toFormat(6)}
                  <span style={{ fontSize: 10 }}> {tokenSymbol}</span>
                </div>
                <div>
                  {new BigNumber(totalToken2).toFormat(6)}
                  <span style={{ fontSize: 10 }}> {token2Symbol}</span>
                </div>
              </StyledContent>
            </StyledValue>
          </StyledCardHeader>
          {totalStake && stakedBalance && (
            <div style={{ marginTop: 10 }}>
              <span style={{ color: '#4caf50' }}>
                Share of Pool: <span style={{ fontSize: 18 }}>{(shareOfPool * 100).toFixed(5)}%</span>
              </span>
            </div>
          )}
          <StyledCardActions>
            {!allowance.toNumber() ? (
              <Button
                disabled={requestedApproval}
                onClick={handleApprove}
                text={requestedApproval ? 'Approving' : `Approve ${tokenName}`}
              />
            ) : (
              <>
                <Button disabled={!poolActive} text={'Stake'} onClick={onPresentDeposit} />
                <StyledActionSpacer />
                <StyleButtonWrap>
                  <span className="tooltip-unstake">UnStake</span>
                  <IconButton disabled={stakedBalance.eq(new BigNumber(0))} onClick={onPresentWithdraw}>
                    <AddIcon />
                  </IconButton>
                </StyleButtonWrap>
              </>
            )}
          </StyledCardActions>
        </StyledCardContentInner>
      </CardContent>
    </CardBox>
  )
}

const StyledCardHeader = styled.div`
  align-items: center;
  display: flex;
  flex-direction: column;
`
const StyledValue = styled.div`
  text-align: center;
  span {
    color: ${props => props.theme.white};
  }
`

const ValueStyled = styled.div`
  font-family: 'Nunito Sans', sans-serif;
  color: #ffffff;
  font-size: 32px;
  font-weight: 700;
`
const StyledCardActions = styled.div`
  display: flex;
  justify-content: center;
  margin-top: ${props => props.theme.spacing[6]}px;
  width: 100%;
`

const StyledActionSpacer = styled.div`
  height: ${props => props.theme.spacing[4]}px;
  width: ${props => props.theme.spacing[4]}px;
`

const StyledCardContentInner = styled.div`
  align-items: center;
  display: flex;
  flex: 1;
  flex-direction: column;
  justify-content: space-between;
`
const StyleButtonWrap = styled.div`
  position: relative;

  border: 1px solid ${props => props.theme.text2};
  border-radius: 12px;
  > .tooltip-unstake {
    position: absolute;
    font-size: 14px;
    font-weight: bold;
    top: -30px;
    left: -14px;
    color: ${props => props.theme.text2};
    padding: 3px 10px;
    border-radius: 12px;
    background-color: ${props => props.theme.bg2};
    display: none;
    :after {
      content: '';
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: ${props => props.theme.bg2} transparent transparent transparent;
    }
  }
  &:hover {
    > .tooltip-unstake {
      display: block;
    }
  }
`
const StyledContent = styled.span`
  color: ${props => props.theme.white};
  font-weight: bold;
  display: block;
  @media (max-width: 767px) {
    font-size: 14px;
  }
`

export default Stake
