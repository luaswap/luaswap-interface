import { useCallback, useEffect, useState } from 'react'

import BigNumber from 'bignumber.js'
import { useWeb3React } from '@web3-react/core'

import { getEarned, getMasterChefContract } from '../../sushi/utils'
import useSushi from './useSushi'
import useBlock from './useBlock'

const useEarnings = (pid: number) => {
  const [balance, setBalance] = useState(new BigNumber(0))

  const { account } = useWeb3React()
  const sushi = useSushi()
  const masterChefContract = getMasterChefContract(sushi)
  const block = useBlock()
  const fetchBalance = useCallback(async () => {
    const balance = await getEarned(masterChefContract, pid, account)
    setBalance(new BigNumber(balance))
  }, [account, masterChefContract, sushi])

  useEffect(() => {
    if (account && masterChefContract && sushi) {
      fetchBalance()
    }
  }, [account, block, masterChefContract, setBalance, sushi])

  return balance
}

export default useEarnings
