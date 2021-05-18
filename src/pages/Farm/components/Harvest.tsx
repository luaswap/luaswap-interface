import React, { useState } from 'react'
import styled from 'styled-components'
import Button from '../../../components/ButtonSushi'
import CardBox from '../../../components/CardBox'
import CardContent from '../../../components/CardContent'
import Label from '../../../components/Label'
import Value from '../../../components/Value'
import useEarnings from '../../../hooks/farms/useEarnings'
import useReward from '../../../hooks/farms/useReward'
import { getBalanceNumber } from '../../../sushi/format/formatBalance'
// import Lua from '../../../assets/img/lua-icon.svg'

interface HarvestProps {
  pid: number
}

const Harvest: React.FC<HarvestProps> = ({ pid }) => {
  const earnings = useEarnings(pid)
  const [pendingTx, setPendingTx] = useState(false)
  const { onReward } = useReward(pid)

  return (
    <CardBox>
      <CardContent>
        <StyledCardContentInner>
          <StyledCardHeader>
            {/* <CardIcon><img src={Lua} alt="LUA Reward"/></CardIcon> */}
            <StyledValue>
              <Label text="LUA Reward" />
              <br />
              <Value value={getBalanceNumber(earnings)} />
              <br />
              {/* <div style={{ fontSize: 13, color: 'rgb(255,152,0,0.7)' }}>
                During the first 8 weeks since launch, <b>25% of your earned LUA</b> is available to{' '}
                <b>unlock immediately</b>
              </div> */}
              {/* {!IsTomo ? (
                <div style={{ marginTop: 10, fontSize: 13, color: 'rgb(255,152,0,0.7)' }}>
                  Beginning January 18, 2021, the remaining <b>75% will be unlocked</b> linearly every block{' '}
                  <b>over 1 year</b>.
                </div>
                ) : ''
              } */}
            </StyledValue>
          </StyledCardHeader>
          <StyledCardActions>
            <Button
              disabled={!earnings.toNumber() || pendingTx}
              text={pendingTx ? 'Collecting LUA' : 'Harvest'}
              onClick={async () => {
                setPendingTx(true)
                await onReward()
                setPendingTx(false)
              }}
            />
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
const StyledCardActions = styled.div`
  display: flex;
  justify-content: center;
  margin-top: ${props => props.theme.spacing[6]}px;
  width: 100%;
`

const StyledCardContentInner = styled.div`
  align-items: center;
  display: flex;
  flex: 1;
  flex-direction: column;
  justify-content: space-between;
`

export default Harvest
