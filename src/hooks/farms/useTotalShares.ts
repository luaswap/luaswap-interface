import { useCallback, useEffect, useState } from 'react'

import BigNumber from 'bignumber.js'
import { useWeb3React } from '@web3-react/core'
import { provider } from 'web3-core'

import { getBalance } from '../../utils/erc20'
import useBlock from './useBlock'

const useTotalShares = (tokenAddress: string, account: string) => {
  const [balance, setBalance] = useState(new BigNumber(0))
  const { library: ethereum } = useWeb3React()
  const block = useBlock()

  const fetchBalance = useCallback(async () => {
    const e_provider = ethereum && ethereum.provider ? ethereum.provider : null
    const balance = await getBalance(e_provider as provider, tokenAddress, account)
    setBalance(new BigNumber(balance))
  }, [account, ethereum, tokenAddress])

  useEffect(() => {
    if (account) {
      fetchBalance()
    }
  }, [account, ethereum, setBalance, block, tokenAddress])

  return balance
}

export default useTotalShares
