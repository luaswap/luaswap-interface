import React from 'react'
import styled, { keyframes } from 'styled-components'

export interface ModalProps {
  onDismiss?: () => void
}

const Modal: React.FC = ({ children }) => {
  return (
    <StyledResponsiveWrapper>
      <StyledModal>{children}</StyledModal>
    </StyledResponsiveWrapper>
  )
}

const mobileKeyframes = keyframes`
  0% {
    transform: translateY(0%);
  }
  100% {
    transform: translateY(-100%);
  }
`

const StyledResponsiveWrapper = styled.div`
  align-items: center;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  position: relative;
  width: 100%;
  max-width: 512px;
  @media (max-width: 400px) {
    flex: 1;
    position: absolute;
    top: 100%;
    right: 0;
    left: 0;
    height: 100%;
    // max-height: calc(100% - ${props => props.theme.spacing[4]}px);
    animation: ${mobileKeyframes} 0.3s forwards ease-out;
  }
`

const StyledModal = styled.div`
  padding: 0 20px;
  background: ${props => props.theme.bg1};
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  position: relative;
  width: 100%;
  height: 100%;
`

export default Modal
