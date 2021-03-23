import { useState, useEffect } from 'react'
import { Contract } from '@ethersproject/contracts'
import { abi as IUniswapV2PairABI } from '@uniswap/v2-core/build/IUniswapV2Pair.json'

import { getUserStaked, getFarmingPools, getTotalStaked, getPendingReward } from '../utils/farmingPool'
import { useFarmingContract } from './useContract'
import { useActiveWeb3React } from './index'
import { getContract, IsTomoChain } from '../utils/index'

export function useFarmingPool() {
  const [farmingPools, setFarmingPools] = useState([])
  const { chainId } = useActiveWeb3React()
  useEffect(() => {
    let isCancelled = false

    async function fetchData() {
      let pools

      if (!isCancelled) {
        pools = await getFarmingPools(chainId)
      }

      !isCancelled && setFarmingPools(pools)
    }

    fetchData()

    return () => {
      isCancelled = true
    }
  }, [])

  return {
    farmingPools
  }
}

export function useFarmingStaked(pools: any[]) {
  const { library, account, chainId } = useActiveWeb3React()
  const farmingContract: Contract | null = useFarmingContract()
  const [userFarmingPoolsMap, setUserFarmingPoolsMap] = useState({})
  const IsTomo = IsTomoChain(chainId)
  const ID = chainId && IsTomo ? chainId : 1

  useEffect(() => {
    let isCancelled = false

    async function fetchData() {
      const poolsMap: { [key: string]: any } = {}

      // user lp token staked in all farming pools
      let userStakeds: any[]
      if (!isCancelled) {
        const stakedPromises = pools.map(pool => getUserStaked(farmingContract, pool.pid, account))
        userStakeds = await Promise.all(stakedPromises)
      }

      // filter only user farming pools
      const userFarmingPools = pools
        .map((pool, idx) => {
          pool.userStaked = userStakeds[idx]
          return pool
        })
        .filter(pool => +pool.userStaked > 0)

      // total lp token staked in user farming pools
      let poolStakeds
      if (!isCancelled) {
        const poolBalancePromises = userFarmingPools.map(pool => {
          const lpContract = library
            ? getContract(pool.lpAddresses[ID], IUniswapV2PairABI, library, account ? account : undefined)
            : null

          return getTotalStaked(lpContract, chainId)
        })
        poolStakeds = await Promise.all(poolBalancePromises)
      }

      // user pending reward
      let pendingRewards
      if (!isCancelled) {
        const pendingRewardPromies = userFarmingPools.map(pool => getPendingReward(farmingContract, pool.pid, account))
        pendingRewards = await Promise.all(pendingRewardPromies)
      }
      for (let index = 0; index < userFarmingPools.length; index++) {
        const pool = userFarmingPools[index]        
        pool.totalStaked = poolStakeds ? poolStakeds[index] : '0'
        pool.pendingReward = pendingRewards ? pendingRewards[index] : '0'
        poolsMap[pool.lpAddresses[ID].toLowerCase()] = pool
      }

      !isCancelled && setUserFarmingPoolsMap(poolsMap)
    }

    if (account && pools.length > 0) fetchData()

    return () => {
      isCancelled = true
    }
  }, [pools, account, chainId])

  return userFarmingPoolsMap
}
