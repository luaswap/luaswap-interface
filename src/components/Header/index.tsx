import { ChainId } from '@luaswap/sdk'
import React, { useState } from 'react'
import { Text } from 'rebass'

import styled from 'styled-components'
import Logo from '../../assets/images/logo.png'
import { useActiveWeb3React } from '../../hooks'
import { getTextNativeToken } from '../../utils'
import { useETHBalances } from '../../state/wallet/hooks'

import { YellowCard } from '../Card'

import { RowFixed } from '../Row'
import Web3Status from '../Web3Status'
import ClaimModal from '../claim/ClaimModal'

import Modal from '../Modal'
import UniBalanceContent from './UniBalanceContent'

const HeaderFrame = styled.div`
  display: grid;
  grid-template-columns: 1fr 120px;
  align-items: center;
  justify-content: space-between;
  align-items: center;
  flex-direction: row;
  width: 100%;
  top: 0;
  position: relative;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  padding: 1rem;
  z-index: 2;
  ${({ theme }) => theme.mediaWidth.upToMedium`
    grid-template-columns: 1fr;
    padding: 0 1rem;
    width: calc(100%);
    position: relative;
  `};

  ${({ theme }) => theme.mediaWidth.upToExtraSmall`
        padding: 0.5rem 1rem;
  `}
`

const HeaderControls = styled.div`
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-self: flex-end;

  ${({ theme }) => theme.mediaWidth.upToMedium`
    flex-direction: row;
    justify-content: space-between;
    justify-self: center;
    width: 100%;
    max-width: 960px;
    padding: 1rem;
    position: fixed;
    bottom: 0px;
    left: 0px;
    width: 100%;
    z-index: 99;
    height: 72px;
    border-radius: 12px 12px 0 0;
    background-color: ${({ theme }) => theme.bg1};
  `};
`

const HeaderElement = styled.div`
  display: flex;
  align-items: center;
  gap: 8px;

  ${({ theme }) => theme.mediaWidth.upToMedium`
   flex-direction: row-reverse;
    align-items: center;
  `};
`
const HeaderRow = styled(RowFixed)`
  ${({ theme }) => theme.mediaWidth.upToMedium`
   width: 100%;
  `};
`

const LogoText = styled.span`
  margin-left: 10px;
  font-size: 20px;
  color: #fff;
  font-weight: bold;
  ${({ theme }) => theme.mediaWidth.upToExtraSmall`
      display: none;
  `}
`

const AccountElement = styled.div<{ active: boolean }>`
  display: flex;
  flex-direction: row;
  align-items: center;
  background-color: ${({ theme, active }) => (!active ? theme.bg1 : theme.bg3)};
  border-radius: 12px;
  white-space: nowrap;
  width: 100%;
  cursor: pointer;

  :focus {
    border: 1px solid blue;
  }
  /* :hover {
    background-color: ${({ theme, active }) => (!active ? theme.bg2 : theme.bg4)};
  } */
`
const HideSmall = styled.div`
  position: relative;
  .switch-network {
    display: none;
    position: absolute;
    bottom: -82px;
    left: 0;
    border-radius: 10px;
    font-size: 13px;
    width: 200px;
    padding: 10px;
    background-color: ${({ theme }) => theme.bg1};
    color: #c3a56e;
    a {
      color: #ecb34b;
    }
  }
  :hover {
    .switch-network {
      display: block;
    }
  }
  ${({ theme }) => theme.mediaWidth.upToMedium`
    // display: none;
    .switch-network{
      bottom: 35px;
    }
  `};
`

const NetworkCard = styled(YellowCard)`
  border-radius: 12px;
  padding: 8px 12px;
  ${({ theme }) => theme.mediaWidth.upToSmall`
    margin: 0;
    margin-right: 0.5rem;
    width: initial;
    overflow: hidden;
    text-overflow: ellipsis;
    flex-shrink: 1;
  `};
`

const BalanceText = styled(Text)`
  ${({ theme }) => theme.mediaWidth.upToExtraSmall`
    display: none;
  `};
`

const Title = styled.a`
  display: flex;
  align-items: center;
  pointer-events: auto;
  justify-self: flex-start;
  margin-right: 12px;
  text-decoration: none;
  ${({ theme }) => theme.mediaWidth.upToSmall`
    justify-self: center;
  `};
  :hover {
    cursor: pointer;
  }
`

const UniIcon = styled.div`
  display: flex;
  align-items: center;
  transition: transform 0.3s ease;
  :hover {
    transform: rotate(-5deg);
  }
`

const NETWORK_LABELS: { [chainId in ChainId]?: string } = {
  [ChainId.MAINNET]: 'Ethereum',
  [ChainId.RINKEBY]: 'Rinkeby',
  [ChainId.ROPSTEN]: 'Ropsten',
  [ChainId.GÖRLI]: 'Görli',
  [ChainId.KOVAN]: 'Kovan',
  [ChainId.TOMOCHAIN_MAINNET]: 'TomoChain',
  [ChainId.TOMOCHAIN_DEVNET]: 'TomoDevnet',
  [ChainId.TOMOCHAIN_TESTNET]: 'TomoTestnet'
}

export default function Header() {
  const { account, chainId } = useActiveWeb3React()
  const NATIVE_TOKEN_TEXT = getTextNativeToken(chainId)
  const userEthBalance = useETHBalances(account ? [account] : [])?.[account ?? '']

  const [showUniBalanceModal, setShowUniBalanceModal] = useState(false)

  return (
    <HeaderFrame>
      <ClaimModal />
      <Modal isOpen={showUniBalanceModal} onDismiss={() => setShowUniBalanceModal(false)}>
        <UniBalanceContent setShowUniBalanceModal={setShowUniBalanceModal} />
      </Modal>
      <HeaderRow>
        <Title href=".">
          <UniIcon>
            <img width={'40px'} src={Logo} alt="logo" />
            <LogoText>LuaSwap</LogoText>
          </UniIcon>
        </Title>
      </HeaderRow>
      <HeaderControls>
        <HeaderElement>
          <HideSmall>
            {chainId && NETWORK_LABELS[chainId] && account && (
              <>
                <NetworkCard>{NETWORK_LABELS[chainId]}</NetworkCard>
                <div className="switch-network">
                  <a href="https://docs.tomochain.com/general/how-to-connect-to-tomochain-network/metamask">
                    Switch Networks
                  </a>{' '}
                  between Ethereum & TomoChain to access different trading pools
                </div>
              </>
            )}
          </HideSmall>
          <AccountElement active={!!account} style={{ pointerEvents: 'auto' }}>
            {account && userEthBalance ? (
              <BalanceText style={{ flexShrink: 0 }} pl="0.75rem" pr="0.5rem" fontWeight={500}>
                {userEthBalance?.toSignificant(4)} {NATIVE_TOKEN_TEXT}
              </BalanceText>
            ) : null}
            <Web3Status />
          </AccountElement>
        </HeaderElement>
      </HeaderControls>
    </HeaderFrame>
  )
}
