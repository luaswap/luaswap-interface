import React from 'react'

import { IconProps } from '../Icon'

const AddIcon: React.FC<IconProps> = ({ color, size = 24 }) => {
  return (
    <svg className="icon-unstake" height={size} viewBox="0 -10 24 24" width={size} stroke="#7A7F7F" strokeWidth="5">
      <line x1="3" y1="3" x2="48" y2="3"></line>
    </svg>
  )
}

export default AddIcon
