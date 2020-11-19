import { useCallback } from 'react'

import useSushi from './useSushi'
import { useWeb3React } from '@web3-react/core'

import { enter, getXSushiStakingContract } from '../../sushi/utils'

const useEnter = () => {
  const { account } = useWeb3React()
  const sushi = useSushi()

  const handle = useCallback(
    async (amount: string) => {
      const txHash = await enter(getXSushiStakingContract(sushi), amount, account)
      console.log(txHash)
    },
    [account, sushi]
  )

  return { onEnter: handle }
}

export default useEnter
