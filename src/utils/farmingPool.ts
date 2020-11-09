import axios from 'axios'
import BigNumber from 'bignumber.js'
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

export async function getFarmingStaked(
  farmingContract: Contract | null,
  pid: string,
  account: string | null | undefined
) {
  try {
    if (!farmingContract) throw new Error('Farming contract is null')

    const { amount } = await farmingContract.userInfo(pid, account)
    const amountFormated = new BigNumber(amount.toString()).div(10 ** 18)

    return amountFormated.toNumber()
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
    const amountFormated = new BigNumber(amount.toString()).div(10 ** 18)

    return amountFormated.toNumber()
  } catch (e) {
    console.log(e)
    return 0
  }
}

export async function getFarmingLpAmount(lpContract: Contract | null) {
  try {
    if (!lpContract) throw new Error('Farming contract is null')

    const balance = await lpContract.balanceOf(FARMING_ADDRESS)
    const balanceFormated = new BigNumber(balance.toString()).div(10 ** 18)
    return balanceFormated.toNumber()
  } catch (e) {
    console.log(e)
    return 0
  }
}

export async function getFarmingTokenAmount(tokenContract: Contract | null, lpAddress: string) {
  try {
    if (!tokenContract) throw new Error('Farming contract is null')

    const amount = await tokenContract.balanceOf(lpAddress)
    const amountFormated = new BigNumber(amount.toString()).div(10 ** 18)
    return amountFormated.toNumber()
  } catch (e) {
    console.log(e)
    return 0
  }
}
