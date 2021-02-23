import { Currency, Token, ChainId } from '@luaswap/sdk'
import { IsTomoChain, getNativeToken, getLogoNativeToken } from '../../utils'
import React, { useMemo } from 'react'
import styled from 'styled-components'
import { useActiveWeb3React } from '../../hooks'
import useHttpLocations from '../../hooks/useHttpLocations'
import { WrappedTokenInfo } from '../../state/lists/hooks'
import Logo from '../Logo'
const commit_hash = '3dda6df393721f8832dbbd0cc279d4ff8d693276'

const getTokenLogoURL = (address: string, chainId: ChainId | undefined) => {
  const IsTomo = IsTomoChain(chainId)
  if (IsTomo) {
    return `https://raw.githubusercontent.com/tomochain/luaswap-token-list/${commit_hash}/src/tokens/icons/tomochain/${address}.png`
  } else {
    return `https://raw.githubusercontent.com/trustwallet/assets/master/blockchains/ethereum/assets/${address}/logo.png`
  }
}

const StyledEthereumLogo = styled.img<{ size: string }>`
  width: ${({ size }) => size};
  height: ${({ size }) => size};
  box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.075);
  border-radius: 24px;
`

const StyledLogo = styled(Logo)<{ size: string }>`
  width: ${({ size }) => size};
  height: ${({ size }) => size};
  border-radius: ${({ size }) => size};
  box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.075);
`

export default function CurrencyLogo({
  currency,
  size = '24px',
  style
}: {
  currency?: Currency
  size?: string
  style?: React.CSSProperties
}) {
  const { chainId } = useActiveWeb3React()
  const NATIVE_TOKEN = getNativeToken(chainId)
  const NATIVE_LOGO = getLogoNativeToken(chainId)
  const uriLocations = useHttpLocations(currency instanceof WrappedTokenInfo ? currency.logoURI : undefined)

  const srcs: string[] = useMemo(() => {
    if (currency === NATIVE_TOKEN) return []

    if (currency instanceof Token) {
      if (currency instanceof WrappedTokenInfo) {
        return [...uriLocations, getTokenLogoURL(currency.address, chainId)]
      }

      return [getTokenLogoURL(currency.address, chainId)]
    }
    return []
  }, [currency, uriLocations])

  if (currency === NATIVE_TOKEN) {
    return <StyledEthereumLogo src={NATIVE_LOGO} size={size} style={style} />
  }

  return <StyledLogo size={size} srcs={srcs} alt={`${currency?.symbol ?? 'token'} logo`} style={style} />
}
