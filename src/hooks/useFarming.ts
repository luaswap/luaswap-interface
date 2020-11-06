import { useState, useEffect } from 'react'
import { Contract } from '@ethersproject/contracts'

import { getFarmingStaked, getFarmingPools } from '../utils/farmingPool'
import { useFarmingContract } from './useContract'
import { useActiveWeb3React } from './index'

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
  const { account } = useActiveWeb3React()
  const farmingContract: Contract | null = useFarmingContract()

  const initFarmingPool: any[] = []
  const [farmingPools, setFarmingPools] = useState(initFarmingPool)

  useEffect(() => {
    async function fetchData() {
      const stakedPromises = pools.map(pool => getFarmingStaked(farmingContract, pool.pid, account))
      const stakeds = await Promise.all(stakedPromises)
      const poolsWithStaked: any[] = pools.map((pool, idx) => {
        pool.staked = stakeds[idx]
        return pool
      })

      setFarmingPools(poolsWithStaked)
    }

    if (pools.length > 0) fetchData()
  }, [farmingContract, pools, account])

  return farmingPools
}
