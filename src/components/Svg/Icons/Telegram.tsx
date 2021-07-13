import React from 'react'
import Svg from '../Svg'
import { SvgProps } from '../types'

const Icon: React.FC<SvgProps> = props => {
  return (
    <Svg viewBox="-8 -8 64 64" {...props}>
      <path
        fillRule="evenodd"
        d="M0 24c0 13.255 10.745 24 24 24s24-10.745 24-24S37.255 0 24 0 0 10.745 0 24zm19.6 11l.408-6.118 11.129-10.043c.488-.433-.107-.645-.755-.252l-13.735 8.665-5.932-1.851c-1.281-.393-1.29-1.273.287-1.906l23.118-8.914c1.056-.48 2.075.254 1.672 1.87l-3.937 18.552c-.275 1.319-1.071 1.634-2.175 1.025l-5.997-4.431L20.8 34.4l-.027.026c-.322.314-.59.574-1.173.574z"
        clipRule="evenodd"
      ></path>
    </Svg>
  )
}

export default Icon
