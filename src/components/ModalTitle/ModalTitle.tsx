import React from 'react'
import styled from 'styled-components'

interface ModalTitleProps {
  text?: string | React.ReactNode
}

const ModalTitle: React.FC<ModalTitleProps> = ({ text }) => <StyledModalTitle>{text}</StyledModalTitle>

const StyledModalTitle = styled.div`
  align-items: center;
  color: ${props => props.theme.text2};
  display: flex;
  font-size: 20px;
  font-weight: 700;
  height: 72px;
  justify-content: center;
`

export default ModalTitle
