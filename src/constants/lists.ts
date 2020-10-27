// the Uniswap Default token list lives here
const COMMIT_HASH = 'c42ce8340241467404a2124c1714d77b48d33ac0'

export const DEFAULT_TOKEN_LIST_URL =
  'https://raw.githubusercontent.com/tomochain/luaswap-token-list/' +
  COMMIT_HASH +
  '/build/luaswap-default.tokenlist.json'

export const DEFAULT_LIST_OF_LISTS: string[] = [
  DEFAULT_TOKEN_LIST_URL
  //'tokens.uniswap.eth'
  // 't2crtokens.eth', // kleros
  // 'tokens.1inch.eth', // 1inch
  // 'synths.snx.eth',
  // 'tokenlist.dharma.eth',
  // 'defi.cmc.eth',
  // 'erc20.cmc.eth',
  // 'stablecoin.cmc.eth',
  // 'tokenlist.zerion.eth',
  // 'tokenlist.aave.eth',
  // 'https://www.coingecko.com/tokens_list/uniswap/defi_100/v_0_0_0.json',
  // 'https://app.tryroll.com/tokens.json',
  // 'https://raw.githubusercontent.com/compound-finance/token-list/master/compound.tokenlist.json',
  // 'https://defiprime.com/defiprime.tokenlist.json',
  // 'https://umaproject.org/uma.tokenlist.json'
]
