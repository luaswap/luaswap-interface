import { useEffect, useState } from 'react'

import BigNumber from 'bignumber.js'
import { useWeb3React } from '@web3-react/core'
import { provider } from 'web3-core'
import { getBalance } from '../../sushi/format/erc20'
import useBlock from './useBlock'

const useTokenBalance = (tokenAddress: string, account?: string) => {
  const [balance, setBalance] = useState(new BigNumber(0))
  const { account: defaultAccount, library: ethereum } = useWeb3React()
  const block = useBlock()

  const fetchBalance = async (_ethereum: any, _address: string, _account: string) => {
    const balance = await getBalance(_ethereum.provider as provider, _address, _account)
    setBalance(new BigNumber(balance))
  }

  useEffect(() => {
    if (ethereum) {
      if (account) {
        fetchBalance(ethereum, tokenAddress, account)
      } else if (defaultAccount) {
        fetchBalance(ethereum, tokenAddress, defaultAccount)
      }
    }
  }, [account, defaultAccount, ethereum, block, tokenAddress])

  return balance
}

export default useTokenBalance
