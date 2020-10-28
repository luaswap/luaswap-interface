// the LuaSwap Default token list lives here
const COMMIT_HASH = 'c42ce8340241467404a2124c1714d77b48d33ac0'

export const DEFAULT_TOKEN_LIST_URL =
  'https://raw.githubusercontent.com/tomochain/luaswap-token-list/' +
  COMMIT_HASH +
  '/build/luaswap-default.tokenlist.json'

export const DEFAULT_LIST_OF_LISTS: string[] = [DEFAULT_TOKEN_LIST_URL]
