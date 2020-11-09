import { useState, useEffect } from 'react'
import { Contract } from '@ethersproject/contracts'
import { abi as IUniswapV2PairABI } from '@uniswap/v2-core/build/IUniswapV2Pair.json'
import ERC20_ABI from '../constants/abis/erc20.json'

import {
  getFarmingStaked,
  getFarmingPools,
  getFarmingLpAmount,
  getFarmingTokenAmount,
  getPendingReward,
} from '../utils/farmingPool'
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
      const stakedPromises = pools.map(pool => getFarmingStaked(farmingContract, pool.pid, account))
      const userStakeds = await Promise.all(stakedPromises)

      // user pending reward
      const pendingRewardPromies = pools.map(pool => getPendingReward(farmingContract, pool.pid, account))
      const pendingRewards = await Promise.all(pendingRewardPromies)

      // total lp token staked in farming pool
      const poolBalancePromises = pools.map(pool => {
        const lpContract = library
          ? getContract(pool.lpAddresses[1], IUniswapV2PairABI, library, account ? account : undefined)
          : null

        return getFarmingLpAmount(lpContract)
      })
      const poolStakeds = await Promise.all(poolBalancePromises)

      for (let index = 0; index < pools.length; index++) {
        // token0, token1 amount relative lp tokens staked in farming pool
        const pool = pools[index]
        const tokenContract = library
          ? getContract(pool.tokenAddresses[1], ERC20_ABI, library, account ? account : undefined)
          : null
        const tokenContract2 = library
          ? getContract(pool.token2Addresses[1], ERC20_ABI, library, account ? account : undefined)
          : null

        const [tokenAmount, token2Amount] = await Promise.all([
          getFarmingTokenAmount(tokenContract, pool.lpAddresses[1]),
          getFarmingTokenAmount(tokenContract2, pool.lpAddresses[1])
        ])

        pool.tokenAmount = tokenAmount
        pool.token2Amount = token2Amount
        pool.userStaked = userStakeds[index]
        pool.totalStaked = poolStakeds[index]
        pool.pendingReward = pendingRewards[index]

        poolsWithStaked = [...poolsWithStaked, pool]
      }

      setFarmingPools(poolsWithStaked)
    }

    if (pools.length > 0) fetchData()
  }, [farmingContract, pools, account, library, pools.length])

  return farmingPools
}
