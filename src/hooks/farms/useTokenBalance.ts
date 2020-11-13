import { useCallback, useEffect, useState } from 'react'

import BigNumber from 'bignumber.js'
import { useWeb3React } from '@web3-react/core'

import { getBalance } from '../../sushi/format/erc20'
import useBlock from './useBlock'


const useTokenBalance = (tokenAddress: string) => {
  const [balance, setBalance] = useState(new BigNumber(0))
  const { account, library: ethereum } = useWeb3React()
  const block = useBlock()
  const fetchBalance = useCallback(async () => {
    // @ts-ignore
    const balance = await getBalance(ethereum.provider as provider, tokenAddress, account)
    setBalance(new BigNumber(balance))
  }, [account, ethereum, tokenAddress])

  useEffect(() => {
    if (account) {
      fetchBalance()
    }
  }, [account, ethereum, setBalance, block, tokenAddress])

  return balance
}

export default useTokenBalance
