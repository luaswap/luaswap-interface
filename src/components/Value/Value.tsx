import React, { useState, useEffect } from 'react'
import CountUp from 'react-countup'

import styled from 'styled-components'

interface ValueProps {
  value: string | number
  decimals?: number
}

const Value: React.FC<ValueProps> = ({ value, decimals }) => {
  const [start, updateStart] = useState(0)
  const [end, updateEnd] = useState(0)

  useEffect(() => {
    if (typeof value === 'number') {
      updateStart(end)
      updateEnd(value)
    }
  }, [value])

  return (
    <StyledValue>
      {typeof value == 'string' ? (
        value
      ) : (
        <CountUp
          start={start}
          end={end}
          decimals={decimals !== undefined ? decimals : end < 0 ? 4 : end > 1e5 ? 0 : 3}
          duration={1}
          separator=","
        />
      )}
    </StyledValue>
  )
}

const StyledValue = styled.div`
  font-family: 'Nunito Sans', sans-serif;
  color: ${props => props.theme.primary1};
  font-size: 32px;
  font-weight: 700;
`

export default Value
