import { useCallback } from 'react'

import useSushi from './useSushi'
import { useWeb3React } from '@web3-react/core'

import { makerConvert, getMakerContract } from '../../sushi/utils'

const useConvert = () => {
  const { account } = useWeb3React()
  const sushi = useSushi()
  const handle = useCallback(
    async (token0: string, token1: string) => {
      const txHash = await makerConvert(getMakerContract(sushi), token0, token1, account)
      console.log('txHash:', txHash)
    },
    [account, sushi]
  )

  return { onConvert: handle }
}

export default useConvert
