import { useCallback, useEffect, useState } from 'react'

import BigNumber from 'bignumber.js'

import { getMasterChefContract } from '../../sushi/utils'
import useSushi from './useSushi'
import axios from 'axios'
import config from '../../config'

export interface StakedValue {
  tokenAmount: BigNumber
  token2Amount: BigNumber
  totalToken2Value: BigNumber
  tokenPriceInToken2: BigNumber
  poolWeight: BigNumber
  usdValue: BigNumber
  pid: string
}

const CACHE: { time: any; old: any; value: any } = {
  time: 0,
  old: 0,
  value: []
}

const useAllStakedValue = () => {
  const [balances, setBalance] = useState(CACHE.value as Array<StakedValue>)
  const sushi = useSushi()
  // const farms = getFarms(sushi)
  const masterChefContract = getMasterChefContract(sushi)
  const block = 0 //useBlock()

  const fetchAllStakedValue = useCallback(async () => {
    // const balances: Array<StakedValue> = await Promise.all(
    //   farms.map(
    //     ({
    //       pid,
    //       lpContract,
    //       tokenContract,
    //       token2Contract
    //     }: {
    //       pid: number
    //       lpContract: Contract
    //       tokenContract: Contract
    //       token2Contract: Contract
    //     }) =>
    //       getLPValue(
    //         masterChefContract,
    //         lpContract,
    //         tokenContract,
    //         token2Contract,
    //         pid,
    //       ),
    //   ),
    // )

    const { data: balances } = await axios.get(`${config.api}/pools`)

    CACHE.time = new Date().getTime()
    CACHE.value = balances

    setBalance(balances)
  }, [masterChefContract, sushi])

  useEffect(() => {
    if (masterChefContract && sushi && CACHE.time + CACHE.old <= new Date().getTime()) {
      fetchAllStakedValue()
    }
  }, [block, masterChefContract, setBalance, sushi])

  return balances
}

export default useAllStakedValue
