import React, { useState, useEffect } from 'react'
import styled from 'styled-components'
import { Flex, Box } from 'rebass'
import BigNumber from 'bignumber.js'
import Label from '../../components/Label'
import Value from '../../components/Value'
import { getBalanceNumber } from '../../sushi/format/formatBalance'
import useSushi from '../../hooks/farms/useSushi'
import useTokenBalance from '../../hooks/farms/useTokenBalance'
import { getSushiAddress, getXSushiSupply } from '../../sushi/utils'
import useLeave from '../../hooks/farms/useLeave'
import useModal from '../../hooks/farms/useModal'
import WithdrawModal from '../Farm/components/WithdrawModal'
import Button from '../../components/ButtonSushi'

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
const CardInsight = styled(Flex)`
  justify-content: space-between;
  align-items: center;
  width: 100%;
  border: 0px solid #e6dcd5;
  border-radius: 8px;
  box-sizing: border-box;
  background: transparent;
  color: #9e9e9e;
  font-size: 13px;
  text-align: center;
  line-height: 25px;
`

const UnstakeXLua: React.FC<UnstakeXLuaProps> = ({ xLuaAddress }) => {
  const sushi = useSushi()
  const myXLua = useTokenBalance(xLuaAddress)
  const totalLuaInSafe = useTokenBalance(getSushiAddress(sushi), xLuaAddress)
  const [totalSupplyXLua, setTotalSupplyXLua] = useState<BigNumber>(new BigNumber(0))
  const [pendingTx, setPendingTx] = useState(false)
  const trackingAPYBalanceXLua = useTokenBalance(xLuaAddress, '0xdEad000000000000000000000000000000000000')

  useEffect(() => {
    async function fetchTotalSupplyXLua() {
      const supply = await getXSushiSupply(sushi)
      setTotalSupplyXLua(supply)
    }
    if (sushi) {
      fetchTotalSupplyXLua()
    }
  }, [sushi, setTotalSupplyXLua])

  const xLuaToLua = myXLua.multipliedBy(totalLuaInSafe).dividedBy(totalSupplyXLua)
  const trackingReward = trackingAPYBalanceXLua
    .multipliedBy(totalLuaInSafe)
    .dividedBy(totalSupplyXLua)
    .minus(10 * 10 ** 18)

  const { onLeave } = useLeave()
  const tokenName = 'xLUA'
  const oneDay = 1000 * 60 * 60 * 24 // hours*minutes*seconds*milliseconds
  const initStakeAt = new Date(1603904400000)
  const toDay = new Date() // Today
  const differenceMs = Math.abs(toDay.getTime() - initStakeAt.getTime())
  const totalStakedDay = Math.round(differenceMs / oneDay)

  const [onPresentLeave] = useModal(<WithdrawModal max={myXLua} onConfirm={onLeave} tokenName={tokenName} />)

  return (
    <Card p={[3, 4]}>
      <CardHeader mb={[4, 5]}>
        <Box mb={[3, 4]}>
          <Label text={'YOUR xLUA'} />
        </Box>
        <Value value={getBalanceNumber(myXLua)} />
        <Label text={`~ ${xLuaToLua.div(10 ** 18).toFixed(2)} LUA`} />
      </CardHeader>
      <CardActions mb={[3, 4]}>
        <Button
          disabled={!myXLua.toNumber() || pendingTx}
          text={pendingTx ? 'pending Withdraw' : 'Withdraw'}
          onClick={async () => {
            setPendingTx(true)
            await onPresentLeave()
            setPendingTx(false)
          }}
        />
      </CardActions>
      <CardInsight>
        <span>{'APY'}</span>
        <span style={{ fontWeight: 'bold', color: '#4caf50' }}>
          {trackingReward
            ? `${parseFloat(
                trackingReward
                  .div(totalStakedDay)
                  .div(10 * 10 ** 18)
                  .times(100)
                  .times(365)
                  .toFixed(2)
              ).toLocaleString('en-US')}%`
            : '~'}
        </span>
      </CardInsight>
      <CardInsight>
        <span>{'Withdrawal fee'}</span>
        <span style={{ fontWeight: 'bold', color: '#4caf50' }}>{'0.5%'}</span>
      </CardInsight>
    </Card>
  )
}

interface UnstakeXLuaProps {
  xLuaAddress: string
}

export default UnstakeXLua
