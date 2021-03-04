import { useCallback } from 'react'

import useSushi from './useSushi'
import { useWeb3React } from '@web3-react/core'

import { leave, getXSushiStakingContract } from '../../sushi/utils'

const useLeave = () => {
  const { chainId, account } = useWeb3React()
  const sushi = useSushi()

  const handle = useCallback(
    async (amount: string) => {
      const txHash = await leave(getXSushiStakingContract(sushi), amount, account, chainId)
      console.log(txHash)
    },
    [account, sushi]
  )

  return { onLeave: handle }
}

export default useLeave
