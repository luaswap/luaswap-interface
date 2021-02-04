import React from 'react'
import { Link } from 'react-router-dom'
import styled from 'styled-components'

interface IconButtonProps {
  children?: React.ReactNode
  disabled?: boolean
  onClick?: () => void
  to?: string
}

const IconButton: React.FC<IconButtonProps> = ({ children, disabled, onClick, to }) => {
  return (
    <StyledButton disabled={disabled} onClick={onClick}>
      {!!to ? <StyledLink to={to}>{children}</StyledLink> : children}
    </StyledButton>
  )
}

interface StyledButtonProps {
  disabled?: boolean
}

const StyledButton = styled.button<StyledButtonProps>`
  align-items: center;
  background-color: ${props => props.theme.bg1};
  border: 0;
  border-radius: 28px;
  color: ${props => (!props.disabled ? props.theme.primary1 : props.theme.text2)};
  cursor: pointer;
  display: flex;
  font-weight: 700;
  height: 48px;
  justify-content: center;
  letter-spacing: 1px;
  outline: none;
  padding: 0;
  margin: 0;
  pointer-events: ${props => (!props.disabled ? undefined : 'none')};
  width: 48px;
  // position: relative;
  > .icon-unstake {
    padding: 10px 10px 10px 8px;
    height: 46px;
    width: 46px;
  }
`

const StyledLink = styled(Link)`
  align-items: center;
  color: inherit;
  display: flex;
  flex: 1;
  height: 48px;
  justify-content: center;
  margin: 0 ${props => -props.theme.spacing[4]}px;
  padding: 0 ${props => props.theme.spacing[4]}px;
  text-decoration: none;
`

export default IconButton
