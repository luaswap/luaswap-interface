import React, { useState, useEffect } from 'react'
import { useHistory } from 'react-router-dom'
import { Flex, Box, Button } from 'rebass'
import styled from 'styled-components'
import { colors } from '../../theme'
import { TOKEN_ICONS } from '../../constants'
import { reduceFractionDigit } from '../../utils'

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
  const { push } = useHistory()
  const [failedIconList, setFailedIconList] = useState<string[]>([])

  const handleOpenStakingPool = (key: string | '') => {
    push({
      pathname: '/lua-safe',
      search: new URLSearchParams({
        pool: key
      }).toString()
    })
  }

  useEffect(() => {
    if (items.length > 0) {
      const missingIcons: string[] = []

      items.forEach(token => {
        if (!TOKEN_ICONS[token.token0Symbol] && !missingIcons.some(symbol => symbol === token.token0Symbol)) {
          missingIcons.push(token.token0Symbol)
        }
        if (!TOKEN_ICONS[token.token1Symbol] && !missingIcons.some(symbol => symbol === token.token1Symbol)) {
          missingIcons.push(token.token1Symbol)
        }
      })

      setFailedIconList(missingIcons)
    }
  }, [items])

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
          <StyledPoolCard
            key={poolIdx + 1}
            m={2}
            p={4}
            width={['calc(100% - 32px)', 'calc(50% - 32px)', 'calc(100% / 3 - 32px)']}
            onClick={() => handleOpenStakingPool(pool.key)}
          >
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

              <StyledTokenIcon src={TOKEN_ICONS[pool.token1Symbol]} alt={pool.token1Symbol} title={pool.token1Symbol} />
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
              <StyledAccessButton>{'Select'}</StyledAccessButton>
            </Box>
          </StyledPoolCard>
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
