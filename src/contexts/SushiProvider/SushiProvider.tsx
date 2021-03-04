import React, { createContext, useEffect, useState } from 'react'

import { useWeb3React } from '@web3-react/core'
import config from '../../config'

import { Sushi } from '../../sushi'
import { IsTomoChain } from '../../utils'
// import styled from 'styled-components'
// import { SUPPORTED_POOL, TOMO_SUPPORTED_POOL } from '../../constants/abis/farming'
// import ImgLoader from '../../assets/images/loader.png'
import {supportedPools,tomoSupportedPools} from '../../sushi/lib/constants'

export interface SushiContext {
  sushi?: typeof Sushi
}

export const Context = createContext<SushiContext>({
  sushi: undefined
})

declare global {
  interface Window {
    sushisauce: any
  }
}

const SushiProvider: React.FC = ({ children }) => {
  const { chainId, library: ethereum } = useWeb3React()
  const IsTomo = IsTomoChain(chainId)
  const [sushi, setSushi] = useState<any>()
  // const [pools, setPools] = useState<any>()
  // @ts-ignore
  window.sushi = sushi
  // @ts-ignore
  window.eth = ethereum && ethereum.provider ? ethereum.provider : null
  
  useEffect(() => {
    const allPools = IsTomo ? tomoSupportedPools : supportedPools
    // @ts-ignore
    window.pools = allPools
    // setPools(allPools)
    if (ethereum && ethereum.provider) {
      const sushiLib = new Sushi(ethereum.provider, Number(chainId), false, {
        defaultAccount: ethereum.provider.selectedAddress,
        defaultConfirmations: 1,
        autoGasMultiplier: 1.5,
        testing: false,
        defaultGas: '6000000',
        defaultGasPrice: '1000000000000',
        accounts: [],
        ethereumNodeTimeout: 10000
      })
      setSushi(sushiLib)
      window.sushisauce = sushiLib
    } else {
        const chainId = config.chainId
        const sushiLib = new Sushi(config.rpc, chainId, false, {
          defaultAccount: '0x0000000000000000000000000000000000000000',
          defaultConfirmations: 1,
          autoGasMultiplier: 1.5,
          testing: false,
          defaultGas: '6000000',
          defaultGasPrice: '1000000000000',
          accounts: [],
          ethereumNodeTimeout: 10000
        })
        setSushi(sushiLib)
        window.sushisauce = sushiLib
      
    }
    
  }, [ethereum])

  return <Context.Provider value={{ sushi }}>{children}</Context.Provider>
}

export default SushiProvider
