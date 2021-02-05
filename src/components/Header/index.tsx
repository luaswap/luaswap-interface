import { ChainId } from '@luaswap/sdk'
import React, { useState } from 'react'
import { Text } from 'rebass'
import { NavLink } from 'react-router-dom'
import { darken } from 'polished'
import { useTranslation } from 'react-i18next'

import styled from 'styled-components'
import { ReactComponent as MenuIcon } from '../../assets/images/menu.svg'
import { ApplicationModal } from '../../state/application/actions'
import { useModalOpen, useToggleModal } from '../../state/application/hooks'
import { useWindowSize } from '../../hooks/useWindowSize'

import Logo from '../../assets/images/logo.png'
import { useActiveWeb3React } from '../../hooks'
import { IsTomoChain, getTextNativeToken } from '../../utils'
import { useETHBalances } from '../../state/wallet/hooks'
import { ExternalLink } from '../../theme'

import { YellowCard } from '../Card'
import Settings from '../Settings'
import Menu from '../Menu'

import Row, { RowFixed } from '../Row'
import Web3Status from '../Web3Status'
import ClaimModal from '../claim/ClaimModal'

import Modal from '../Modal'
import UniBalanceContent from './UniBalanceContent'
// import { MouseoverTooltip } from '../Tooltip'

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

const HeaderElementWrap = styled.div`
  display: flex;
  align-items: center;
`

const HeaderRow = styled(RowFixed)`
  ${({ theme }) => theme.mediaWidth.upToMedium`
   width: 100%;
  `};
`

const HeaderLinks = styled(Row)`
  justify-content: center;
  ${({ theme }) => theme.mediaWidth.upToMedium`
    padding: 1rem 0 1rem 1rem;
    justify-content: flex-end;
`};
`
const StyleNavBox = styled.ul`
  display: flex;
  padding-left: 0;
  margin: 0;
`
const StyleNavList = styled.li`
  list-style: none;
  padding: 15px 0;
  position: relative;
  :hover > ul {
    display: block;
  }
`
const StyleNavSub = styled.ul`
  position: absolute;
  top: 50px;
  background-color: ${({ theme }) => theme.bg3};
  padding: 0 5px;
  border-radius: 8px;
  display: none;
  margin: 0;
  > li {
    padding: 10px 0;
    a {
      font-size: 15px;
    }
  }
  ${({ theme }) => theme.mediaWidth.upToMedium`
    left: -130px;
    top: 0px;
    > li {
      padding: 0;
    }
  `}
`

const StyleNavMobile = styled.ul`
  position: absolute;
  top: 5em;
  background-color: ${({ theme }) => theme.bg3};
  padding: 0 5px;
  border-radius: 8px;
  a {
    padding: 10px;
  }
  > li {
    padding: 0px;
  }
`
const StyleText = styled(Text)`
  padding-left: 10px;
  cursor: pointer;
  ${({ theme }) => theme.mediaWidth.upToMedium`
    padding: 10px;
    margin: 0 12px!important;
  `}
`
const StyledMenuButton = styled.button`
  width: 50px;
  border: none;
  background-color: transparent;
  margin: 0;
  padding: 0;
  height: 35px;
  background-color: ${({ theme }) => theme.bg3};

  padding: 0.15rem 0.5rem;
  border-radius: 0.5rem;

  :hover,
  :focus {
    cursor: pointer;
    outline: none;
    background-color: ${({ theme }) => theme.bg4};
  }

  svg {
    margin-top: 2px;
  }
`

const StyledMenuIcon = styled(MenuIcon)`
  path {
    stroke: ${({ theme }) => theme.text1};
  }
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
    color: #c3a56e a {
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

const activeClassName = 'ACTIVE'

const StyledNavLink = styled(NavLink).attrs({
  activeClassName
})`
  ${({ theme }) => theme.flexRowNoWrap}
  align-items: left;
  border-radius: 3rem;
  outline: none;
  cursor: pointer;
  text-decoration: none;
  color: ${({ theme }) => theme.text2};
  font-size: 1rem;
  width: fit-content;
  margin: 0 12px;
  font-weight: 500;

  &.${activeClassName} {
    border-radius: 12px;
    font-weight: 600;
    color: ${({ theme }) => theme.text1};
  }

  :hover,
  :focus {
    color: ${({ theme }) => darken(0.1, theme.text1)};
  }
`

const StyledExternalLink = styled(ExternalLink).attrs({
  activeClassName
})<{ isActive?: boolean }>`
  ${({ theme }) => theme.flexRowNoWrap}
  align-items: left;
  border-radius: 3rem;
  outline: none;
  cursor: pointer;
  text-decoration: none;
  color: ${({ theme }) => theme.text2};
  font-size: 1rem;
  width: fit-content;
  margin: 0 12px;
  font-weight: 500;

  &.${activeClassName} {
    border-radius: 12px;
    font-weight: 600;
    color: ${({ theme }) => theme.text1};
  }

  :hover,
  :focus {
    color: ${({ theme }) => darken(0.1, theme.text1)};
  }
  // ${({ theme }) => theme.mediaWidth.upToExtraSmall`
  //     display: none;
  // `}
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
  const IsTomo = IsTomoChain(chainId)
  const { t } = useTranslation()
  const userEthBalance = useETHBalances(account ? [account] : [])?.[account ?? '']

  const [showUniBalanceModal, setShowUniBalanceModal] = useState(false)

  const { width } = useWindowSize()
  const open = useModalOpen(ApplicationModal.MENULEFT)
  const toggle = useToggleModal(ApplicationModal.MENULEFT)

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
        <HeaderLinks>
          <StyleNavBox>
            <StyleNavList>
              <StyledNavLink id={`swap-nav-link`} to={'/swap'}>
                {t('swap')}
              </StyledNavLink>
            </StyleNavList>
            <StyleNavList>
              <StyledNavLink
                id={`pool-nav-link`}
                to={'/pool'}
                isActive={(match, { pathname }) =>
                  Boolean(match) ||
                  pathname.startsWith('/add') ||
                  pathname.startsWith('/remove') ||
                  pathname.startsWith('/create') ||
                  pathname.startsWith('/find')
                }
              >
                {t('pool')}
              </StyledNavLink>
            </StyleNavList>
          </StyleNavBox>
          {width && width < 767 ? (
            <>
              <StyledMenuButton onClick={toggle}>
                <StyledMenuIcon />
              </StyledMenuButton>
              {open && (
                <StyleNavMobile>
                  {!IsTomo ? (
                    <>
                      <StyleNavList>
                        <StyledNavLink id={`swap-nav-link`} to={'/farming'}>
                          Farming
                        </StyledNavLink>
                      </StyleNavList>
                      <StyleNavList>
                        <StyledNavLink id="pool-nav-link" to="/lua-safe">
                          {t('LuaSafe')}
                        </StyledNavLink>
                      </StyleNavList>
                    </>
                  ) : (
                    ''
                  )}
                  <StyleNavList>
                    <StyleText>
                      Charts <span style={{ fontSize: '11px' }}>↗</span>
                    </StyleText>
                    <StyleNavSub>
                      <StyleNavList>
                        <StyledExternalLink id={`stake-nav-link`} href={'https://info.luaswap.org/home'}>
                          Ethereum
                        </StyledExternalLink>
                      </StyleNavList>
                      <StyleNavList>
                        <StyledExternalLink id={`stake-nav-link`} href={'https://info.luaswap.org/tomochain/home'}>
                          TomoChain
                        </StyledExternalLink>
                      </StyleNavList>
                    </StyleNavSub>
                  </StyleNavList>
                </StyleNavMobile>
              )}
            </>
          ) : (
            <StyleNavBox>
              {!IsTomo ? (
                <>
                  <StyleNavList>
                    <StyledNavLink id={`swap-nav-link`} to={'/farming'}>
                      Farming
                    </StyledNavLink>
                  </StyleNavList>
                  <StyleNavList>
                    <StyledNavLink id="pool-nav-link" to="/lua-safe">
                      {t('LuaSafe')}
                    </StyledNavLink>
                  </StyleNavList>
                </>
              ) : (
                ''
              )}
              <StyleNavList>
                <StyleText>
                  Charts <span style={{ fontSize: '11px' }}>↗</span>
                </StyleText>
                <StyleNavSub>
                  <StyleNavList>
                    <StyledExternalLink id={`stake-nav-link`} href={'https://info.luaswap.org/home'}>
                      Ethereum
                    </StyledExternalLink>
                  </StyleNavList>
                  <StyleNavList>
                    <StyledExternalLink id={`stake-nav-link`} href={'https://info.luaswap.org/tomochain/home'}>
                      TomoChain
                    </StyledExternalLink>
                  </StyleNavList>
                </StyleNavSub>
              </StyleNavList>
            </StyleNavBox>
          )}
        </HeaderLinks>
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
        <HeaderElementWrap>
          <Settings />
          <Menu />
        </HeaderElementWrap>
      </HeaderControls>
    </HeaderFrame>
  )
}
