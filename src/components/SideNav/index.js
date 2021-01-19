import React, { useState, useEffect, useRef } from 'react'
import styled from 'styled-components'
import { AutoColumn } from '../Column'
import Title from '../Title'
import { BasicLink } from '../Link'
import { useMedia } from 'react-use'
import { transparentize } from 'polished'
import { withRouter } from 'react-router-dom'
import { TrendingUp, List, PieChart, Disc } from 'react-feather'
import Link, { ButtonLink } from '../Link'
import { useSessionStart } from '../../contexts/Application'
import { useDarkModeManager } from '../../contexts/LocalStorage'
import Toggle from '../Toggle'
import menu from '../../assets/menu.svg'
import { TYPE } from '../../theme'
import { Box, Flex } from 'rebass'

const Wrapper = styled.div`
  height: ${({ isMobile }) => (isMobile ? 'initial' : '100vh')};
  background-color: ${({ theme }) => transparentize(0.4, theme.bg1)};
  color: ${({ theme }) => theme.text1};
  padding: 0.5rem 0.5rem 0.5rem 0.75rem;
  position: sticky;
  top: 0px;
  z-index: 10000;
  box-sizing: border-box;
  /* background-color: #1b1c22; */
  background: linear-gradient(193.68deg, #1b1c22 0.68%, #000000 100.48%);
  color: ${({ theme }) => theme.bg2};

  @media screen and (max-width: 800px) {
    grid-template-columns: 1fr;
    position: relative;
  }

  @media screen and (max-width: 600px) {
    padding: 1rem;
  }
`

const Option = styled.div`
  font-weight: 500;
  font-size: 14px;
  opacity: ${({ activeText }) => (activeText ? 1 : 0.6)};
  color: ${({ theme }) => theme.white};
  display: flex;
  :hover {
    opacity: 1;
  }
`

const DesktopWrapper = styled.div`
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100vh;
`

const MobileWrapper = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
`

const HeaderText = styled.div`
  margin-right: 0.75rem;
  padding-bottom: 10px;
  font-size: 0.825rem;
  font-weight: 500;
  display: inline-box;
  display: -webkit-inline-box;
  opacity: 0.8;
  :hover {
    opacity: 1;
  }
  a {
    color: ${({ theme }) => theme.white};
  }
`

const Polling = styled.div`
  position: fixed;
  display: flex;
  left: 0;
  bottom: 0;
  padding: 1rem;
  color: white;
  opacity: 0.4;
  transition: opacity 0.25s ease;
  :hover {
    opacity: 1;
  }
`
const PollingDot = styled.div`
  width: 8px;
  height: 8px;
  min-height: 8px;
  min-width: 8px;
  margin-right: 0.5rem;
  margin-top: 3px;
  border-radius: 50%;
  background-color: ${({ theme }) => theme.green1};
`

const MenuMobileButton = styled.span`
  display: inline-block;
  padding: 15px;
  margin-right: 5px;
  cursor: pointer;
  background: url(${menu}) no-repeat center center;
`

const MenuMobileWrapper = styled.div`
  display: block;
  position: absolute;
  right: 15px;
  top: 100%;
  padding: 10px 30px 20px;
  background: #000;
  border-bottom-right-radius: 10px;
  border-bottom-left-radius: 10px;
  display: ${props => props.hide && 'none'};
`

function MenuContent({ history, toggleMenu }) {
  return (
    <>
      <AutoColumn gap="1.25rem" style={{ marginTop: '1rem' }}>
        <BasicLink to="/info">
          <Option
            activeText={history.location.pathname === '/info' ?? undefined}
            onClick={toggleMenu ? () => toggleMenu(false) : null}
          >
            <TrendingUp size={20} style={{ marginRight: '.75rem' }} />
            Overview
          </Option>
        </BasicLink>
        <BasicLink to="/tokens">
          <Option
            activeText={
              (history.location.pathname.split('/')[1] === 'tokens' ||
                history.location.pathname.split('/')[1] === 'token') ??
              undefined
            }
            onClick={toggleMenu ? () => toggleMenu(false) : null}
          >
            <Disc size={20} style={{ marginRight: '.75rem' }} />
            Tokens
          </Option>
        </BasicLink>
        <BasicLink to="/pairs">
          <Option
            activeText={
              (history.location.pathname.split('/')[1] === 'pairs' ||
                history.location.pathname.split('/')[1] === 'pair') ??
              undefined
            }
            onClick={toggleMenu ? () => toggleMenu(false) : null}
          >
            <PieChart size={20} style={{ marginRight: '.75rem' }} />
            Pairs
          </Option>
        </BasicLink>

        <BasicLink to="/accounts">
          <Option
            activeText={
              (history.location.pathname.split('/')[1] === 'accounts' ||
                history.location.pathname.split('/')[1] === 'account') ??
              undefined
            }
            onClick={toggleMenu ? () => toggleMenu(false) : null}
          >
            <List size={20} style={{ marginRight: '.75rem' }} />
            Accounts
          </Option>
        </BasicLink>
      </AutoColumn>
    </>
  )
}

function SideNav({ history }) {
  const below1080 = useMedia('(max-width: 1080px)')

  const below1180 = useMedia('(max-width: 1180px)')

  const seconds = useSessionStart()

  const [isDark, toggleDarkMode] = useDarkModeManager()

  const [showMobileMenu, setShowMobileMenu] = useState(false)

  function toggleMobileMenu(status) {
    setShowMobileMenu(status)
  }

  // refs to detect clicks outside modal
  const menuMobileButtonRef = useRef()
  const MenuMobileWrapperRef = useRef()

  const handleClick = e => {
    if (
      !(MenuMobileWrapperRef.current && MenuMobileWrapperRef.current.contains(e.target)) &&
      !(menuMobileButtonRef.current && menuMobileButtonRef.current.contains(e.target))
    ) {
      toggleMobileMenu(false)
    }
  }

  useEffect(() => {
    document.addEventListener('click', handleClick)
    return () => {
      document.removeEventListener('click', handleClick)
    }
  })

  return (
    <Wrapper isMobile={below1080}>
      {!below1080 ? (
        <DesktopWrapper>
          <AutoColumn gap="1rem" style={{ marginLeft: '.75rem', marginTop: '1.5rem' }}>
            {/* <Title /> */}
            {!below1080 && <MenuContent history={history} />}
          </AutoColumn>
          <AutoColumn gap="0.5rem" style={{ marginLeft: '.75rem', marginBottom: '4rem' }}>
            {/* <HeaderText>
              <ButtonLink href="https://luaswap.org/#/" target="_blank">
                Farm
              </ButtonLink>
            </HeaderText>
            <HeaderText>
              <ButtonLink href="https://app.luaswap.org/#/swap" target="_blank">
                Swap
              </ButtonLink>
            </HeaderText> */}
            <Flex flexDirection="column">
              <HeaderText>
                <Link href="https://board.luaswap.org/homepage" target="_blank">
                  board.luaswap.org
                </Link>
              </HeaderText>
              <HeaderText>
                <Link href="https://twitter.com/LuaSwap" target="_blank">
                  Twitter
                </Link>
              </HeaderText>
            </Flex>
            {/* <Toggle
              isActive={isDark}
              toggle={toggleDarkMode}
              labels={[
                <i key="toggle-item__1" className="fa fa-moon-o" />,
                <i key="toggle-item__2" className="fa fa-sun-o" />
              ]}
            /> */}
          </AutoColumn>
          {!below1180 && (
            <Polling style={{ marginLeft: '.5rem' }}>
              <PollingDot />
              <a href="/" style={{ color: 'white' }}>
                <TYPE.small color={'white'}>
                  Updated {!!seconds ? seconds + 's' : '-'} ago <br />
                </TYPE.small>
              </a>
            </Polling>
          )}
        </DesktopWrapper>
      ) : (
        <MobileWrapper>
          {/* <Title /> */}
          <MenuMobileButton
            onClick={() => {
              if (!showMobileMenu) toggleMobileMenu(true)
            }}
            ref={menuMobileButtonRef}
          />
          <MenuMobileWrapper hide={!showMobileMenu} ref={MenuMobileWrapperRef}>
            <AutoColumn gap="1.25rem">
              <MenuContent history={history} toggleMenu={toggleMobileMenu} />
            </AutoColumn>
          </MenuMobileWrapper>
        </MobileWrapper>
      )}
    </Wrapper>
  )
}

export default withRouter(SideNav)
