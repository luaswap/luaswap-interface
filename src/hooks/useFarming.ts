import { useState, useEffect } from 'react'
import { Contract } from '@ethersproject/contracts'
import { abi as IUniswapV2PairABI } from '@uniswap/v2-core/build/IUniswapV2Pair.json'

import { getUserStaked, getFarmingPools, getTotalStaked, getPendingReward } from '../utils/farmingPool'
import { useFarmingContract } from './useContract'
import { useActiveWeb3React } from './index'
import { getContract } from '../utils/index'

export function useFarmingPool() {
  const [farmingPools, setFarmingPools] = useState([])

  useEffect(() => {
    async function fetchData() {
      const result = await getFarmingPools()

      setFarmingPools(result)
    }

    fetchData()
  }, [farmingPools.length])

  return {
    farmingPools
  }
}

export function useFarmingStaked(pools: any[]) {
  const { library, account } = useActiveWeb3React()
  const farmingContract: Contract | null = useFarmingContract()

  const initFarmingPool: any[] = []
  const [farmingPools, setFarmingPools] = useState(initFarmingPool)

  useEffect(() => {
    async function fetchData() {
      let poolsWithStaked: any[] = []

      // user lp token staked in farming pool
      const stakedPromises = pools.map(pool => getUserStaked(farmingContract, pool.pid, account))
      const userStakeds = await Promise.all(stakedPromises)

      // user pending reward
      const pendingRewardPromies = pools.map(pool => getPendingReward(farmingContract, pool.pid, account))
      const pendingRewards = await Promise.all(pendingRewardPromies)

      // total lp token staked in farming pool
      const poolBalancePromises = pools.map(pool => {
        const lpContract = library
          ? getContract(pool.lpAddresses[1], IUniswapV2PairABI, library, account ? account : undefined)
          : null

        return getTotalStaked(lpContract)
      })
      const poolStakeds = await Promise.all(poolBalancePromises)

      for (let index = 0; index < pools.length; index++) {
        const pool = pools[index]

        pool.userStaked = userStakeds[index]
        pool.totalStaked = poolStakeds[index]
        pool.pendingReward = pendingRewards[index]

        poolsWithStaked = [...poolsWithStaked, pool]
      }

      poolsWithStaked = poolsWithStaked.filter(pool => Number(pool.userStaked) > 0)

      setFarmingPools(poolsWithStaked)
    }

    if (pools.length > 0) fetchData()
  }, [farmingContract, pools, account, library, pools.length])

  return farmingPools
}
