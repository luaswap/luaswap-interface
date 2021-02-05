import { useCallback } from 'react'

import useSushi from './useSushi'
import { useWeb3React } from '@web3-react/core'

import { unstake, getMasterChefContract } from '../../sushi/utils'

const useUnstake = (pid: number) => {
  const { account } = useWeb3React()
  const sushi = useSushi()
  const masterChefContract = getMasterChefContract(sushi)

  const handleUnstake = useCallback(
    async (amount: string) => {
      const txHash = await unstake(masterChefContract, pid, amount, account)
      console.log(txHash)
    },
    [account, pid, sushi]
  )

  return { onUnstake: handleUnstake }
}

export default useUnstake
