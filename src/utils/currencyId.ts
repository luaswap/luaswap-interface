import { Currency, ETHER, TOMO, Token } from '@luaswap/sdk'

export function currencyId(currency: Currency): string {
  if (currency === ETHER) return 'ETH'
  if (currency === TOMO) return 'TOMO'
  if (currency instanceof Token) return currency.address
  throw new Error('invalid currency')
}
