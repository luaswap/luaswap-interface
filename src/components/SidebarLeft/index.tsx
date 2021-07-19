import React, { useMemo, useRef, useState } from 'react'
import { useLocation } from 'react-router-dom'
import { useDispatch } from 'react-redux'
import styled from 'styled-components'
import { Flex, Text } from 'rebass'

import { useWindowSize } from '../../hooks/useWindowSize'
import { useIsNavOpen } from '../../state/user/hooks'
import { AppDispatch } from '../../state'
import { setNavMobile } from '../../state/user/actions'

import { SvgProps } from '../Svg/types'
import config, { socials } from './config'
import useLuaPrice from '../../hooks/farms/useLuaPrice'
import * as IconModule from '../Svg'
import Row from '../Row'
import { ArrowDropDownIcon, ArrowDropUpIcon } from '../Svg'
import MenuLink from './MenuLink'
import LuaPrice from './LuaPrice'
import { useOnClickOutside } from '../../hooks/useOnClickOutside'

const HeaderRow = styled(Row)<{ screen: number; isOpen: boolean }>`
  width: 240px;
  position: fixed;
  padding-top: 73px;
  top: 0;
  left: 0;
  height: 100vh;
  z-index: 10;
  background-color: ${props => props.theme.bg1};
  flex-direction: column;
  justify-content: space-between;
  transform: ${({ screen, isOpen }) => (screen < 768 && !isOpen ? 'translateX(-240px)' : 'translateX(0px)')};
  transition: all 0.2s ease 0s, width 0.2s cubic-bezier(0.4, 0, 0.2, 1) 0s;
`
const ListItems = styled.div`
  width: 100%;
`
const MenuText = styled(Text)`
  color: ${({ theme }) => theme.text2};
`
const Item = styled.div``
const SubMenu = styled.div``
const StyleActive = styled.div<{ isActive: boolean }>`
  display: block;
  color: ${({ theme }) => theme.text2};
  text-decoration: none;
  flex-grow: 1;
  background-color: ${({ isActive, theme }) => (isActive ? `${theme.bg4}` : 'none')};
  :hover {
    background-color: ${({ theme }) => theme.bg4};
  }
  a {
    text-decoration: none;
    padding: 15px;
    display: block;
  }
`
const ParentHover = styled(Flex)`
  padding: 5px 15px;
  :hover {
    background-color: ${({ theme }) => theme.bg4};
  }
`
const ParentLabel = styled.div`
  padding: 10px 0;
  flex-grow: 1;
  color: ${({ theme }) => theme.text2};
`
const SocialEntry = styled.div``
const MobileOverlay = styled.div`
  position: fixed;
  top: 0;
  bottom: 0;
  width: 100%;
  background-color: ${({ theme }) => theme.bg4};
  opacity: 0.7;
  z-index: 2;
`
export default function SidebarLeft() {
  const location = useLocation()
  const isNavOpen = useIsNavOpen()
  const node = useRef<HTMLDivElement>()

  const dispatch = useDispatch<AppDispatch>()
  const [isOpen, setIsOpen] = useState(false)
  const Icons = (IconModule as unknown) as { [key: string]: React.FC<SvgProps> }
  const [checkActive, setCheckActive] = useState<Array<string>>([])
  const { width } = useWindowSize()
  const luaPrice = useLuaPrice()

  // use for Mobile
  useOnClickOutside(node, () => dispatch(setNavMobile({ isNavOpen: false })))

  const formatLuaPrice = useMemo(() => {
    if (luaPrice) {
      return luaPrice.div(10 ** 8).toNumber()
    }
    return 0
  }, [luaPrice])

  const handleClick = () => {
    if (width !== undefined && width < 768) {
      dispatch(setNavMobile({ isNavOpen: !isNavOpen }))
    }
  }
  return (
    <>
      <HeaderRow screen={width ? width : 0} isOpen={isNavOpen} ref={node as any}>
        <ListItems style={{ overflow: 'hidden auto' }}>
          {config.map(entry => {
            const Icon = Icons[entry.icon]
            if (entry.items !== undefined) {
              return (
                <Item key={entry.key}>
                  <ParentHover
                    onClick={() => {
                      if (!checkActive.includes(entry.key)) {
                        setCheckActive([...checkActive, entry.key])
                      } else {
                        const index = checkActive.indexOf(entry.key)
                        const newArrayActive = checkActive.slice()
                        newArrayActive.splice(index, 1)
                        setCheckActive(newArrayActive)
                      }
                      setIsOpen(!isOpen)
                    }}
                    width="100%"
                    justifyContent="space-between"
                    style={{ cursor: 'pointer' }}
                  >
                    <Icon width="24px" mr="8px" color="#C3C5CB" />
                    <ParentLabel>{entry.label}</ParentLabel>
                    {isOpen ? <ArrowDropUpIcon color="#C3C5CB" /> : <ArrowDropDownIcon color="#C3C5CB" />}
                  </ParentHover>
                  {checkActive.includes(entry.key) && (
                    <SubMenu style={{ backgroundColor: '#2e3131' }}>
                      {entry.items.map(item => (
                        <StyleActive key={item.href} isActive={item.href === location.pathname}>
                          <MenuLink href={item.href} onClick={handleClick}>
                            <MenuText fontSize="14px" pl="20px">
                              {item.label}
                            </MenuText>
                          </MenuLink>
                        </StyleActive>
                      ))}
                    </SubMenu>
                  )}
                </Item>
              )
            }
            return (
              <Item key={entry.href}>
                <StyleActive isActive={entry.href === location.pathname}>
                  <MenuLink href={entry.href}>
                    <Flex>
                      <Icon width="24px" mr="8px" color="#C3C5CB" />
                      <MenuText>{entry.label}</MenuText>
                    </Flex>
                  </MenuLink>
                </StyleActive>
              </Item>
            )
          })}
        </ListItems>
        <ListItems style={{ padding: '20px 15px', borderTop: '1px solid #565A69' }}>
          <Flex justifyContent="space-between" alignItems="center">
            <LuaPrice luaPriceUsd={formatLuaPrice} />
            <SocialEntry>
              {socials.map(social => {
                const SocialIcon = Icons[social.icon]
                return (
                  <MenuLink key={social.label} href={social.href}>
                    <SocialIcon width="24px" height="24px" mr="8px" color="#C3C5CB" />
                  </MenuLink>
                )
              })}
            </SocialEntry>
          </Flex>
        </ListItems>
      </HeaderRow>
      {width && width < 768 && isNavOpen && <MobileOverlay />}
    </>
  )
}
