import React from 'react'
import styled from 'styled-components'

const CardBox: React.FC = ({ children }) => <StyledCard>{children}</StyledCard>

const StyledCard = styled.div`
  background: ${props => props.theme.bg1};
  border-radius: 12px;
  overflow: hidden;
  display: flex;
  flex: 1;
  flex-direction: column;
`

export default CardBox
