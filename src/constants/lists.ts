// the LuaSwap Default token list lives here
const COMMIT_HASH = '17f9db1df3ec79aa2372f66b4c794d41710bb55b'

export const DEFAULT_TOKEN_LIST_URL =
  'https://raw.githubusercontent.com/tomochain/luaswap-token-list/' +
  COMMIT_HASH +
  '/build/luaswap-default.tokenlist.json'

export const DEFAULT_LIST_OF_LISTS: string[] = [DEFAULT_TOKEN_LIST_URL]
