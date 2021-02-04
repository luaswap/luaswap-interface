import { useCallback } from 'react'

import useSushi from './useSushi'

import { useWeb3React } from '@web3-react/core'

import { stake, getMasterChefContract } from '../../sushi/utils'

const useStake = (pid: number) => {
  const { account } = useWeb3React()
  const sushi = useSushi()

  const handleStake = useCallback(
    async (amount: string) => {
      try {
        const txHash = await stake(getMasterChefContract(sushi), pid, amount, account)
        return txHash
      } catch (ex) {
        return ''
      }
    },
    [account, pid, sushi]
  )

  return { onStake: handleStake }
}

export default useStake
