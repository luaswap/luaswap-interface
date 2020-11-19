import React from 'react'
import { Flex } from 'rebass'
import styled from 'styled-components'
import PoolCard from './PoolCard'

const StyledHeading = styled.h2`
  margin-top: 0px;
  margin-bottom: 10px;
  color: #ffffff;
  text-align: center;
  text-transform: uppercase;
`

const StyledSubHeading = styled.div`
  margin-bottom: 20px;
  color: #bdbdbd;
  font-size: 16px;
  font-weight: 400;
`

const StakingList = ({ items = [] }: StakingListProps) => {
  return (
    <>
      <StyledHeading>{'Select Pair to Convert'}</StyledHeading>
      <StyledSubHeading>
        {
          'The core team will trigger distribution every Monday, generally around noon Singapore time (GMT+8) or earlier if the pair’s collected fee reaches a certain significant amount (equivalent to at least 3,000 LUA after converted). Users do not need to pay any gas fee for the distribution unless they choose to manually trigger the distribution process themselves.'
        }
      </StyledSubHeading>
      <Flex flexWrap="wrap">
        {items.map((pool, poolIdx) => (
          <PoolCard key={poolIdx + 1} pool={pool} />
        ))}
        {/* <StyledPoolCard
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
      </StyledPoolCard> */}
      </Flex>
    </>
  )
}

interface StakingListProps {
  items?: any[]
}

export default StakingList
