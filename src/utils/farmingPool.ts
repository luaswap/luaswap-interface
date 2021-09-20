import axios from 'axios'
import { Contract } from '@ethersproject/contracts'
import { ChainId } from '@luaswap/sdk'
import { IsTomoChain } from '../utils'

import { TOMO_SUPPORTED_POOL, SUPPORTED_POOL, FARMING_ADDRESS, TOMO_FARMING_ADDRESS } from '../constants/abis/farming'

export async function getFarmingPools(chainId: ChainId | undefined) {
  // const IsTomo = IsTomoChain(chainId)
  const supportedPoolUrl = chainId === 1 ? SUPPORTED_POOL : TOMO_SUPPORTED_POOL

  try {
    const result = await axios.get(supportedPoolUrl)
    return result.data
  } catch {
    return []
  }
}

export async function getUserStaked(farmingContract: Contract | null, pid: string, account: string | null | undefined) {
  try {
    if (!farmingContract) throw new Error('Farming contract is null')

    const { amount } = await farmingContract.userInfo(pid, account)

    return amount.toString()
  } catch (e) {
    console.log(e)
    return 0
  }
}

export async function getTotalStaked(lpContract: Contract | null, chainId: ChainId | undefined) {
  const IsTomo = IsTomoChain(chainId)
  const contractAddress = IsTomo ? TOMO_FARMING_ADDRESS : FARMING_ADDRESS
  try {
    if (!lpContract) throw new Error('Farming contract is null')
    const balance = await lpContract.balanceOf(contractAddress)
    return balance.toString()
  } catch (e) {
    console.log(e)
    return 0
  }
}

export async function getPendingReward(
  farmingContract: Contract | null,
  pid: string,
  account: string | null | undefined
) {
  try {
    if (!farmingContract) throw new Error('Farming contract is null')

    const amount = await farmingContract.pendingReward(pid, account)

    return amount.toString()
  } catch (e) {
    console.log(e)
    return 0
  }
}

export async function getTokensDeposited(tokenContract: Contract | null, lpAddress: string) {
  try {
    if (!tokenContract) throw new Error('Farming contract is null')

    const amount = await tokenContract.balanceOf(lpAddress)
    return amount.toString()
  } catch (e) {
    console.log(e)
    return 0
  }
}
