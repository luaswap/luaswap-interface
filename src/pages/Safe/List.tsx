import React from 'react'
import { withRouter } from 'react-router-dom'
import { Flex, Box, Button } from 'rebass'
import styled from 'styled-components'
import { colors } from '../../theme'

const StyledPoolCard = styled(Box)`
  border-radius: 15px;
  background-color: #313535;
`

const StyledTokenIcon = styled.img`
  margin: 5px;
  width: 60px;
  height: 60px;
`

const StyledPoolName = styled(Box)`
  text-align: center;
  font-size: 20px;
  font-weight: 700;
`

const StyledPoolDescription = styled(Box)`
  color: #bdbdbd;
  text-align: center;
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

const StakingList = ({ history, items = [] }: StakingListProps) => {
  const handleOpenStakingPool = (key: string | '') => {
    history.push({
      pathname: '/lua-safe',
      search: new URLSearchParams({
        pool: key
      }).toString()
    })
  }

  return (
    <Flex flexWrap="wrap">
      {items.map((pool, poolIdx) => (
        <StyledPoolCard
          key={poolIdx + 1}
          m={3}
          p={4}
          width={['calc(100% - 32px)', 'calc(50% - 32px)', 'calc(100% / 3 - 32px)']}
          onClick={() => handleOpenStakingPool(pool.key)}
        >
          <Flex justifyContent="center">
            <StyledTokenIcon src={pool.icon} />
            <StyledTokenIcon src={pool.icon2} />
          </Flex>
          <StyledPoolName mt={[2, 3]}>{pool.name}</StyledPoolName>
          <StyledPoolDescription mt={[2, 3]}>{pool.description}</StyledPoolDescription>
          <Box mt={[3, 4]}>
            <StyledAccessButton>{'Select'}</StyledAccessButton>
          </Box>
        </StyledPoolCard>
      ))}
      <StyledPoolCard
        m={3}
        p={4}
        width={['calc(100% - 32px)', 'calc(50% - 32px)', 'calc(100% / 3 - 32px)']}
        onClick={() => handleOpenStakingPool('lua-xlua')}
      >
        <Flex justifyContent="center">
          <StyledTokenIcon src="https://luaswap.org/favicon.png" />
          <StyledTokenIcon src="https://luaswap.org/favicon.png" />
        </Flex>
        <StyledPoolName mt={[2, 3]}>{'LUA - xLUA'}</StyledPoolName>
        <StyledPoolDescription mt={[2, 3]}>{'Deposit LUA to earn xLUA'}</StyledPoolDescription>
        <Box mt={[3, 4]}>
          <StyledAccessButton>{'Select'}</StyledAccessButton>
        </Box>
      </StyledPoolCard>
      <StyledPoolCard m={3} p={4} width={['calc(100% - 32px)', 'calc(50% - 32px)', 'calc(100% / 3 - 32px)']}>
        wgpwjag
      </StyledPoolCard>
      <StyledPoolCard m={3} p={4} width={['calc(100% - 32px)', 'calc(50% - 32px)', 'calc(100% / 3 - 32px)']}>
        wgpwjag
      </StyledPoolCard>
      <StyledPoolCard m={3} p={4} width={['calc(100% - 32px)', 'calc(50% - 32px)', 'calc(100% / 3 - 32px)']}>
        wgpwjag
      </StyledPoolCard>
    </Flex>
  )
}

interface StakingListProps {
  history: any
  items?: any[]
}

export default withRouter(StakingList)
