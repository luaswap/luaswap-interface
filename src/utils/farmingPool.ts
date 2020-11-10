import axios from 'axios'
import { Contract } from '@ethersproject/contracts'

import { FARMING_ADDRESS } from '../constants/abis/farming'

export async function getFarmingPools() {
  try {
    const result = await axios.get('https://wallet.tomochain.com/api/luaswap/supportedPools')
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

export async function getTotalStaked(lpContract: Contract | null) {
  try {
    if (!lpContract) throw new Error('Farming contract is null')

    const balance = await lpContract.balanceOf(FARMING_ADDRESS)
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
