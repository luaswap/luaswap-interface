import { ChainId, Currency, CurrencyAmount, ETHER, TOMO, Token, TokenAmount, WETH } from '@luaswap/sdk'

export function wrappedCurrency(currency: Currency | undefined, chainId: ChainId | undefined): Token | undefined {
  return chainId && (currency === ETHER || currency === TOMO ) ? WETH[chainId] : currency instanceof Token ? currency : undefined
}

export function wrappedCurrencyAmount(
  currencyAmount: CurrencyAmount | undefined,
  chainId: ChainId | undefined
): TokenAmount | undefined {
  const token = currencyAmount && chainId ? wrappedCurrency(currencyAmount.currency, chainId) : undefined
  return token && currencyAmount ? new TokenAmount(token, currencyAmount.raw) : undefined
}

export function unwrappedToken(token: Token): Currency {

  if (token.equals(WETH[token.chainId]) && token.chainId === 1){
    return ETHER
  }else if(token.equals(WETH[token.chainId]) && (token.chainId === 88 || token.chainId === 89 || token.chainId === 99) ){
    return TOMO
  }
  return token
}
