import { CurrencyAmount, ETHER, TOMO, JSBI } from '@luaswap/sdk'
import { MIN_ETH, MIN_TOMO } from '../constants'

/**
 * Given some token amount, return the max that can be spent of it
 * @param currencyAmount to return max of
 */
export function maxAmountSpend(currencyAmount?: CurrencyAmount): CurrencyAmount | undefined {
  if (!currencyAmount) return undefined
  if (currencyAmount.currency === ETHER) {
    if (JSBI.greaterThan(currencyAmount.raw, MIN_ETH)) {
      return CurrencyAmount.ether(JSBI.subtract(currencyAmount.raw, MIN_ETH))
    } else {
      return CurrencyAmount.ether(JSBI.BigInt(0))
    }
  } else if (currencyAmount.currency === TOMO) {
    if (JSBI.greaterThan(currencyAmount.raw, MIN_TOMO)) {
      return CurrencyAmount.tomo(JSBI.subtract(currencyAmount.raw, MIN_TOMO))
    } else {
      return CurrencyAmount.tomo(JSBI.BigInt(0))
    }
  }
  return currencyAmount
}
