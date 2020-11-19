import React, { useState, useCallback } from 'react'
import styled from 'styled-components'
import { Flex, Box } from 'rebass'
import BigNumber from 'bignumber.js'
import { getBalanceNumber } from '../../sushi/format/formatBalance'
import Label from '../../components/Label'
import Value from '../../components/Value'
import Button from '../../components/ButtonSushi'
import useSushi from '../../hooks/farms/useSushi'
import useTokenBalance from '../../hooks/farms/useTokenBalance'
// import useLeave from '../../hooks/farms/useLeave'
import DepositModal from '../Farm/components/DepositModal'
import useModal from '../../hooks/farms/useModal'
import { getSushiAddress } from '../../sushi/utils'
import useAllowanceStaking from '../../hooks/farms/useAllowanceStaking'
import useApproveStaking from '../../hooks/farms/useApproveStaking'
import useEnter from '../../hooks/farms/useEnter'

interface StakeLuaProps {}

const StakeLua: React.FC<StakeLuaProps> = () => {
  const tokenName = 'LUA'
  const [requestedApproval, setRequestedApproval] = useState(false)

  const allowance = useAllowanceStaking()
  const { onApprove } = useApproveStaking()
  const sushi = useSushi()
  const tokenBalance = useTokenBalance(getSushiAddress(sushi))
  const { onEnter } = useEnter()
  // const { onLeave } = useLeave()

  const [onPresentDeposit] = useModal(<DepositModal max={tokenBalance} onConfirm={onEnter} tokenName={tokenName} />)

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

  return (
    <Card p={[3, 4]}>
      <CardHeader mb={[4, 5]}>
        <Box mb={[3, 4]}>
          <Label text={'YOUR LUA'} />
        </Box>
        <Value value={getBalanceNumber(tokenBalance)} />
        <Label text={'LUA Tokens Available'} />
      </CardHeader>
      <CardActions>
        {!allowance.toNumber() ? (
          <Button disabled={requestedApproval} onClick={handleApprove} text={`Approve LUA`} />
        ) : (
          <Button disabled={tokenBalance.eq(new BigNumber(0))} text="Stake" onClick={onPresentDeposit} />
        )}
      </CardActions>
    </Card>
  )
}

const Card = styled(Flex)`
  flex-direction: column;
  align-items: center;
  width: 100%;
  height: 100%;
  border-radius: 12px;
  background-color: #313535;
`

const CardHeader = styled(Flex)`
  flex-direction: column;
  align-items: center;
`

const CardActions = styled(Flex)`
  justify-content: center;
  width: 100%;
`
// const CardInsight = styled(Flex)`
//   justify-content: space-between;
//   align-items: center;
//   width: 100%;
//   border: 0px solid #e6dcd5;
//   border-radius: 8px;
//   box-sizing: border-box;
//   background: transparent;
//   color: #9e9e9e;
//   font-size: 13px;
//   text-align: center;
//   line-height: 25px;
// `

export default StakeLua
