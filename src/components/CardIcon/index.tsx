import React from 'react'
import styled from 'styled-components'

const Card: React.FC = ({ children }) => <StyledCard>{children}</StyledCard>

const StyledCard = styled.div`
  border-radius: 50%;
  overflow: hidden;
  display: flex;
  flex: 1;
  flex-direction: column;
`

export default Card
