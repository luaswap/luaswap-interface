import axios from 'axios'
import BigNumber from 'bignumber.js'
import { Contract } from '@ethersproject/contracts'

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
