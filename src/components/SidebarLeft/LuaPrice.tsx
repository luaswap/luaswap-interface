import React from 'react'
import styled from 'styled-components'
import { Text } from 'rebass'
import { LuaIcon } from '../Svg'

interface Props {
  luaPriceUsd?: number
}

const PriceLink = styled.a`
  display: flex;
  align-items: center;
  svg {
    transition: transform 0.3s;
  }
  :hover {
    svg {
      transform: scale(1.2);
    }
  }
`
const PriceText = styled(Text)`
  color: ${({ theme }) => theme.text2};
  padding: 0 5px;
  font-size: 14px;
`

const LuaPrice: React.FC<Props> = ({ luaPriceUsd = 0 }) => {
  return (
    <PriceLink href="https://info.luaswap.org/token/0xb1f66997a5760428d3a87d68b90bfe0ae64121cc" target="_blank">
      <LuaIcon />
      <PriceText>{`$${luaPriceUsd.toFixed(3)}`}</PriceText>
    </PriceLink>
  )
}

export default React.memo(LuaPrice)
