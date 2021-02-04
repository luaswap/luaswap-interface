import { useCallback } from 'react'

import useSushi from './useSushi'

import { useWeb3React } from '@web3-react/core'

import { harvest, getMasterChefContract } from '../../sushi/utils'

const useReward = (pid: number) => {
  const { account } = useWeb3React()
  const sushi = useSushi()

  const masterChefContract = getMasterChefContract(sushi)

  const handleReward = useCallback(async () => {
    try {
      const txHash = await harvest(masterChefContract, pid, account)
      return txHash
    } catch (ex) {
      console.error(ex)
      return ''
    }
  }, [account, pid, sushi])

  return { onReward: handleReward }
}

export default useReward
