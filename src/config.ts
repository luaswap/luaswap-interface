import { ChainId } from '@luaswap/sdk'
export declare enum TomoNetwork {
    TOMOCHAIN_DEVNET = 99,
    TOMOCHAIN_TESTNET = 89,
    TOMOCHAIN_MAINNET = 88
}
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

export const ROUTER_ADDRESS: { [chainId in ChainId]: string } = {
  1: '0x1d5C6F1607A171Ad52EFB270121331b3039dD83e',
  3: '',
  4: '',
  5: '',
  42: '',
  88: '0x0b792a01Fd3E8b3e23aaaA28561c3E774A82AA7b',
  89: '0x6f7425954a609bc4f585A13664c414D543B676d8',
  99: ''
}

export const FACTORY_ADDRESS: { [chainID in TomoNetwork]: string } = {
  88: '0x28c79368257CD71A122409330ad2bEBA7277a396',
  89: '0x1BA0DdCa35e152bE46e85e1EF9Db22d431dDc95e',
  99: ''
}
