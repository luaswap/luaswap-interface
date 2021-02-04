import React, { useState } from 'react'

import useSushi from '../../hooks/farms/useSushi'

import { getFarms } from '../../sushi/utils'

import Context from './context'

const Farms: React.FC = ({ children }) => {
  const [unharvested] = useState(0)

  const sushi = useSushi()
  // const { account } = useWallet()

  const farms = getFarms(sushi)
  return (
    <Context.Provider
      value={{
        farms,
        unharvested
      }}
    >
      {children}
    </Context.Provider>
  )
}

export default Farms
