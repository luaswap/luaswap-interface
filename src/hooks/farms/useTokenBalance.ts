import { useCallback, useEffect, useState } from 'react'

import BigNumber from 'bignumber.js'
// import { useWallet } from 'use-wallet'
import { useWeb3React } from '@web3-react/core'
// import { provider } from 'web3-core'

import { getBalance } from '../../sushi/format/erc20'
import useBlock from './useBlock'


const useTokenBalance = (tokenAddress: string) => {
  const [balance, setBalance] = useState(new BigNumber(0))
  // const { account, ethereum }: { account: string | null; ethereum: provider } = useWallet()
  const { account, library: ethereum } = useWeb3React()
  const block = useBlock()
  // console.log(ethereum.provider)
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
