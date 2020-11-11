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
  }, [])

  return {
    farmingPools
  }
}

export function useFarmingStaked(pools: any[]) {
  const { library, account } = useActiveWeb3React()
  const farmingContract: Contract | null = useFarmingContract()
  const [userFarmingPoolsMap, setUserFarmingPoolsMap] = useState({})

  useEffect(() => {
    async function fetchData() {
      const poolsMap: { [key: string]: any } = {}

      // user lp token staked in all farming pools
      const stakedPromises = pools.map(pool => getUserStaked(farmingContract, pool.pid, account))
      const userStakeds = await Promise.all(stakedPromises)

      // filter only user farming pools
      const userFarmingPools = pools
        .map((pool, idx) => {
          pool.userStaked = userStakeds[idx]
          return pool
        })
        .filter(pool => +pool.userStaked > 0)

      // total lp token staked in user farming pools
      const poolBalancePromises = userFarmingPools.map(pool => {
        const lpContract = library
          ? getContract(pool.lpAddresses[1], IUniswapV2PairABI, library, account ? account : undefined)
          : null

        return getTotalStaked(lpContract)
      })
      const poolStakeds = await Promise.all(poolBalancePromises)

      // user pending reward
      const pendingRewardPromies = userFarmingPools.map(pool => getPendingReward(farmingContract, pool.pid, account))
      const pendingRewards = await Promise.all(pendingRewardPromies)

      for (let index = 0; index < userFarmingPools.length; index++) {
        const pool = userFarmingPools[index]

        pool.totalStaked = poolStakeds[index]
        pool.pendingReward = pendingRewards[index]

        poolsMap[pool.lpAddresses[1]] = pool
      }

      setUserFarmingPoolsMap(poolsMap)
    }

    if (pools.length > 0) fetchData()
  })

  return userFarmingPoolsMap
}
