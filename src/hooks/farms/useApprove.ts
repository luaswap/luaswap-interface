import { useCallback } from 'react'

import useSushi from './useSushi'
import { useWeb3React } from '@web3-react/core'
import { Contract } from 'web3-eth-contract'

import { approve, getMasterChefContract } from '../../sushi/utils'

const useApprove = (lpContract: Contract) => {
  const { account } = useWeb3React()
  const sushi = useSushi()
  const masterChefContract = getMasterChefContract(sushi)

  const handleApprove = useCallback(async () => {
    try {
      const tx = await approve(lpContract, masterChefContract, account)
      return tx
    } catch (e) {
      return false
    }
  }, [account, lpContract, masterChefContract])

  return { onApprove: handleApprove }
}

export default useApprove
