import { useCallback, useEffect, useState } from 'react'
import BigNumber from 'bignumber.js'
import { useWeb3React } from '@web3-react/core'
import { getEarned, getMasterChefContract, getFarms, checkPoolActive } from '../../sushi/utils'
import useSushi from './useSushi'

// import axios from 'axios'

const useAllEarnings = () => {
  const [balances, setBalance] = useState([] as Array<BigNumber>)
  // const { account }: { account: string | null } = useWallet()
  const { account } = useWeb3React()
  const sushi = useSushi()
  const farms = getFarms(sushi)
  const masterChefContract = getMasterChefContract(sushi)
  const block = 0 //useBlock()

  const fetchAllBalances = useCallback(async () => {
    // const balances: Array<BigNumber> = await Promise.all(
    //   farms.map(({ pid }: { pid: number }) =>
    //     getEarned(masterChefContract, pid, account),
    //   ),
    // )
    // setBalance(balances)

    const data: Array<BigNumber> = await Promise.all(
      farms.map(
        ({ pid }: any) =>
          new Promise(async resolve => {
            if (await checkPoolActive(pid)) {
              resolve(await getEarned(masterChefContract, pid, account))
            } else {
              resolve('0')
            }
          })
      )
    )
    setBalance(data)
  }, [account, masterChefContract, sushi])

  useEffect(() => {
    if (account && masterChefContract && sushi) {
      fetchAllBalances()
    }
  }, [account, block, masterChefContract, setBalance, sushi])

  return balances
}

export default useAllEarnings
