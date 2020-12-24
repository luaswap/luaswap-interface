import { Trade } from '@luaswap/sdk'
import React, { Fragment, memo, useContext } from 'react'
import { ChevronRight } from 'react-feather'
import { Flex } from 'rebass'
import styled, { ThemeContext } from 'styled-components'
import { TYPE } from '../../theme'
import CurrencyLogo from '../CurrencyLogo'
import { useToken } from '../../hooks/Tokens'

const Path = styled.div`
  display: inline-block;
  position: relative;
  margin: 0 3px 0 10px;
`

const ProtocolIcon = styled.div`
  position: absolute;
  top: 42%;
  left: -5px;
  transform: translateY(-50%);
`

interface ProtocolProps {
  type: string
}

function Protocol({ type }: ProtocolProps) {
  const luaToken = useToken('0xB1f66997A5760428D3a87D68b90BfE0aE64121cC')
  const uniToken = useToken('0x1f9840a85d5aF5bf1D1762F925BDADdC4201F984')
  const sushiToken = useToken('0x6B3595068778DD592e39A122f4f5a5cF09C90fE2')

  switch (true) {
    case type === 'uniswap':
      //@ts-ignore
      return <CurrencyLogo currency={uniToken} size="0.65rem" />
    case type === 'sushiswap':
      //@ts-ignore
      return <CurrencyLogo currency={sushiToken} size="0.65rem" />
    default:
      //@ts-ignore
      return <CurrencyLogo currency={luaToken} size="0.65rem" />
  }
}

export default memo(function SwapRoute({ trade }: { trade: Trade }) {
  const theme = useContext(ThemeContext)
  return (
    <Flex
      px="1rem"
      py="0.5rem"
      my="0.5rem"
      style={{ border: `1px solid ${theme.bg3}`, borderRadius: '1rem' }}
      flexWrap="wrap"
      width="100%"
      justifyContent="space-evenly"
      alignItems="center"
    >
      {trade.route.path.map((token, i, path) => {
        const isLastItem: boolean = i === path.length - 1
        return (
          <Fragment key={i}>
            <Flex my="0.5rem" alignItems="center" style={{ flexShrink: 0 }}>
              <CurrencyLogo currency={token} size="1.5rem" />
              <TYPE.black fontSize={14} color={theme.text1} ml="0.5rem">
                {token.symbol}
              </TYPE.black>
            </Flex>
            {isLastItem ? null : (
              <Path>
                {trade.route.pairs[i] && (
                  <ProtocolIcon>
                    <Protocol type={trade.route.pairs[i].protocol} />
                  </ProtocolIcon>
                )}
                <ChevronRight color={theme.text2} />
              </Path>
            )}
          </Fragment>
        )
      })}
    </Flex>
  )
})
