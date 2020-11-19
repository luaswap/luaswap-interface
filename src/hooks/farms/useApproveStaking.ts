import { useCallback } from 'react'

import useSushi from './useSushi'
import { useWeb3React } from '@web3-react/core'
import { approve, getSushiContract, getXSushiStakingContract } from '../../sushi/utils'

const useApproveStaking = () => {
  const { account } = useWeb3React()
  const sushi = useSushi()
  const lpContract = getSushiContract(sushi)
  const contract = getXSushiStakingContract(sushi)
  const handleApprove = useCallback(async () => {
    try {
      const tx = await approve(lpContract, contract, account)
      return tx
    } catch (e) {
      return false
    }
  }, [account, lpContract, contract])

  return { onApprove: handleApprove }
}

export default useApproveStaking
