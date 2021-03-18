import { ChainId } from '@luaswap/sdk'

export default {
  rpc: 'https://wallet.tomochain.com/api/luaswap/rpc',
  rpcTomochain: 'https://rpc.tomochain.com',
  chainId: 1,
  apiETH: 'https://wallet.tomochain.com/api/luaswap',
  apiTOMO: 'https://wallet.tomochain.com/api/luaswap/tomochain'
}

export const RPC_URL: { [chainId in ChainId]: string } = {
  1: 'https://wallet.tomochain.com/api/luaswap/rpc',
  3: '',
  4: '',
  5: '',
  42: '',
  88: 'https://rpc.tomochain.com',
  89: 'https://rpc.testnet.tomochain.com',
  99: ''
}

export const API_URL: { [chainId in ChainId]: string } = {
  1: 'https://wallet.tomochain.com/api/luaswap',
  3: '',
  4: '',
  5: '',
  42: '',
  88: 'https://wallet.tomochain.com/api/luaswap/tomochain',
  89: '',
  99: ''
}

export const LUA_CONTRACT: { [chainId in ChainId]: string } = {
  1: '0xB1f66997A5760428D3a87D68b90BfE0aE64121cC',
  3: '',
  4: '',
  5: '',
  42: '',
  88: '0x7262fa193e9590B2E075c3C16170f3f2f32F5C74',
  89: '0x4C314bAC596a4a93BB80823D99c0C2E27F8Df70c',
  99: ''
}
