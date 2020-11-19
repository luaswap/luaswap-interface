import React, { useState, useEffect } from 'react'
import useConvert from '../../hooks/farms/useConvert'
import useModal from '../../hooks/farms/useModal'
import ConvertModal from './ConvertModal'
import { reduceFractionDigit } from '../../utils'
import styled from 'styled-components'
import { Box, Flex } from 'rebass'
import Button from '../../components/ButtonSushi'
import { colors } from '../../theme'
import { TOKEN_ICONS } from '../../constants'
import BigNumber from 'bignumber.js'

const StyledPoolCard = styled(Box)`
  border-radius: 15px;
  background-color: #313535;
`

const StyledTokenIcon = styled.img`
  margin: 5px;
  width: 60px;
  height: 60px;
`
const StyledDefaultIcon = styled(Flex)`
  justify-content: center;
  align-items: center;
  margin: 5px !important;
  width: 60px;
  height: 60px;
  border: 1px solid #bdbdbd;
  border-radius: 50%;
  color: #bdbdbd;
  font-size: 14px;
  font-weight: 700;
`

const StyledPoolDescription = styled(Flex)`
  justify-content: space-between;
  align-items: baseline;
  margin-bottom: 10px !important;
  color: #bdbdbd;
  font-size: 13px;
`

const StyledAccessButton = styled(Button)`
  width: 100%;
  height: 48px;
  background-color: ${colors().primary1};
  border-radius: 8px;
  color: ${colors().bg2} !important;
  font-size: 16px;
  font-weight: 700;
  cursor: pointer;
`

interface PoolCardProps {
  pool: {
    token0Symbol: string
    token1Symbol: string
    token0Addresses: string
    token1Addresses: string
    token0Balance: number
    token1Balance: number
    lpBalance: number
  }
}

const PoolCard: React.FC<PoolCardProps> = ({ pool }) => {
  const { onConvert } = useConvert()
  const [onPresentConvert] = useModal(
    <ConvertModal
      onConfirm={onConvert}
      pair={`${pool.token0Symbol} - ${pool.token1Symbol}`}
      token0={pool.token0Addresses}
      token1={pool.token1Addresses}
    />
  )
  const [failedIconList, setFailedIconList] = useState<string[]>([])

  useEffect(() => {
    if (pool) {
      const newList = []
      if (!TOKEN_ICONS[pool.token0Symbol]) {
        newList.push(pool.token0Symbol)
      }
      if (!TOKEN_ICONS[pool.token1Symbol]) {
        newList.push(pool.token1Symbol)
      }

      setFailedIconList(newList)
    }
  }, [pool])

  return (
    <StyledPoolCard m={2} p={4} width={['calc(100% - 16px)', 'calc(50% - 16px)', 'calc(100% / 3 - 16px)']}>
      <Flex justifyContent="center" mb={3}>
        {failedIconList.some(token => token === pool.token0Symbol) ? (
          <StyledDefaultIcon>{pool.token0Symbol}</StyledDefaultIcon>
        ) : (
          <StyledTokenIcon
            src={TOKEN_ICONS[pool.token0Symbol]}
            title={pool.token0Symbol}
            onError={() => setFailedIconList(list => list.concat(pool.token0Symbol))}
          />
        )}
        {failedIconList.some(token => token === pool.token1Symbol) ? (
          <StyledDefaultIcon>{pool.token1Symbol}</StyledDefaultIcon>
        ) : (
          <StyledTokenIcon
            src={TOKEN_ICONS[pool.token1Symbol]}
            title={pool.token1Symbol}
            onError={() => setFailedIconList(list => list.concat(pool.token1Symbol))}
          />
        )}
      </Flex>
      <StyledPoolDescription>
        <Box>{'LP Token'}</Box>
        <Box style={{ fontWeight: 700 }}>{reduceFractionDigit(pool.lpBalance, 9)}</Box>
      </StyledPoolDescription>
      <StyledPoolDescription>
        <Box>{pool.token0Symbol}</Box>
        <Box style={{ fontWeight: 700 }}>{reduceFractionDigit(pool.token0Balance, 3)}</Box>
      </StyledPoolDescription>
      <StyledPoolDescription>
        <Box>{pool.token1Symbol}</Box>
        <Box style={{ fontWeight: 700 }}>{reduceFractionDigit(pool.token1Balance, 3)}</Box>
      </StyledPoolDescription>
      <Box mt={[3, 4]}>
        <StyledAccessButton disabled={!new BigNumber(pool.lpBalance).isGreaterThan(0)} onClick={onPresentConvert}>
          {'Convert'}
        </StyledAccessButton>
      </Box>
    </StyledPoolCard>
  )
}

export default PoolCard
