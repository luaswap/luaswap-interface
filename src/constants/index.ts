import { ChainId, JSBI, Percent, Token, WETH } from '@luaswap/sdk'
import { AbstractConnector } from '@web3-react/abstract-connector'

import { injected, walletconnect, walletlink } from '../connectors' // remove portis, fortmatic
export const FACTORY_ADDRESS = '0x28c79368257CD71A122409330ad2bEBA7277a396'
// TODO: Need to change to luaswap's Router address
export const ROUTER_ADDRESS = '0x1d5C6F1607A171Ad52EFB270121331b3039dD83e'
// Tomo router address testnet: 0x6f7425954a609bc4f585A13664c414D543B676d8
export const TOMO_ROUTER_ADDRESS = '0x0b792a01Fd3E8b3e23aaaA28561c3E774A82AA7b'

export const ZERO_ADDRESS = '0x0000000000000000000000000000000000000000'

// a list of tokens by chain
type ChainTokenList = {
  readonly [chainId in ChainId]: Token[]
}

// Base Token on TomoChain NetWork
// TESTNET
export const TUSDT = new Token(
  ChainId.TOMOCHAIN_TESTNET,
  '0xc7ecCc9da22aBAAf9cfe311BFD9a55437eA05c2c',
  6,
  'USDT',
  'Tether USD'
)
export const TBTC = new Token(
  ChainId.TOMOCHAIN_TESTNET,
  '0x11c2cAF973db997b8a9b5689b33962E1AedEA968',
  8,
  'BTC',
  'Wrapped BTC'
)
// MAINNET
export const MLUA = new Token(
  ChainId.TOMOCHAIN_MAINNET,
  '0x7262fa193e9590b2e075c3c16170f3f2f32f5c74',
  18,
  'LUA',
  'LuaToken'
)
export const MBTC = new Token(
  ChainId.TOMOCHAIN_MAINNET,
  '0xAE44807D8A9CE4B30146437474Ed6fAAAFa1B809',
  8,
  'BTC',
  'Wrapped BTC'
)
export const METH = new Token(
  ChainId.TOMOCHAIN_MAINNET,
  '0x2EAA73Bd0db20c64f53fEbeA7b5F5E5Bccc7fb8b',
  18,
  'ETH',
  'Wrapped ETH'
)
export const MUSDT = new Token(
  ChainId.TOMOCHAIN_MAINNET,
  '0x381B31409e4D220919B2cFF012ED94d70135A59e',
  6,
  'USDT',
  'Wrapped Tether USD'
)
// Base Token on ETH NetWork
export const USDC = new Token(ChainId.MAINNET, '0xA0b86991c6218b36c1d19D4a2e9Eb0cE3606eB48', 6, 'USDC', 'USD//C')
export const USDT = new Token(ChainId.MAINNET, '0xdAC17F958D2ee523a2206206994597C13D831ec7', 6, 'USDT', 'Tether USD')
export const WBTC = new Token(ChainId.MAINNET, '0x2260FAC5E5542a773Aa44fBCfeDf7C193bc2C599', 18, 'WBTC', 'Wrapped BTC')
export const TOMOE = new Token(ChainId.MAINNET, '0x05D3606d5c81EB9b7B18530995eC9B29da05FaBa', 18, 'TOMOE', 'TomoChain')
export const LUA = new Token(ChainId.MAINNET, '0xB1f66997A5760428D3a87D68b90BfE0aE64121cC', 18, 'LUA', 'LuaToken')

// TODO this is only approximate, it's actually based on blocks
export const PROPOSAL_LENGTH_IN_DAYS = 7

export const GOVERNANCE_ADDRESS = '0x5e4be8Bc9637f0EAA1A755019e06A68ce081D58F'

const UNI_ADDRESS = '0x1f9840a85d5aF5bf1D1762F925BDADdC4201F984'
export const UNI: { [chainId in ChainId]: Token } = {
  [ChainId.MAINNET]: new Token(ChainId.MAINNET, UNI_ADDRESS, 18, 'UNI', 'Uniswap'),
  [ChainId.RINKEBY]: new Token(ChainId.RINKEBY, UNI_ADDRESS, 18, 'UNI', 'Uniswap'),
  [ChainId.ROPSTEN]: new Token(ChainId.ROPSTEN, UNI_ADDRESS, 18, 'UNI', 'Uniswap'),
  [ChainId.GÖRLI]: new Token(ChainId.GÖRLI, UNI_ADDRESS, 18, 'UNI', 'Uniswap'),
  [ChainId.KOVAN]: new Token(ChainId.KOVAN, UNI_ADDRESS, 18, 'UNI', 'Uniswap'),
  [ChainId.TOMOCHAIN_MAINNET]: new Token(ChainId.TOMOCHAIN_MAINNET, UNI_ADDRESS, 18, 'UNI', 'Uniswap'),
  [ChainId.TOMOCHAIN_DEVNET]: new Token(ChainId.TOMOCHAIN_DEVNET, UNI_ADDRESS, 18, 'UNI', 'Uniswap'),
  [ChainId.TOMOCHAIN_TESTNET]: new Token(ChainId.TOMOCHAIN_TESTNET, UNI_ADDRESS, 18, 'UNI', 'Uniswap')
}

// TODO: specify merkle distributor for mainnet
export const MERKLE_DISTRIBUTOR_ADDRESS: { [chainId in ChainId]?: string } = {
  [ChainId.MAINNET]: '0x090D4613473dEE047c3f2706764f49E0821D256e'
}

const WETH_ONLY: ChainTokenList = {
  [ChainId.MAINNET]: [WETH[ChainId.MAINNET]],
  [ChainId.ROPSTEN]: [WETH[ChainId.ROPSTEN]],
  [ChainId.RINKEBY]: [WETH[ChainId.RINKEBY]],
  [ChainId.GÖRLI]: [WETH[ChainId.GÖRLI]],
  [ChainId.KOVAN]: [WETH[ChainId.KOVAN]],
  [ChainId.TOMOCHAIN_DEVNET]: [WETH[ChainId.TOMOCHAIN_DEVNET]],
  [ChainId.TOMOCHAIN_TESTNET]: [WETH[ChainId.TOMOCHAIN_TESTNET]],
  [ChainId.TOMOCHAIN_MAINNET]: [WETH[ChainId.TOMOCHAIN_MAINNET]]
}

// used to construct intermediary pairs for trading
export const BASES_TO_CHECK_TRADES_AGAINST: ChainTokenList = {
  ...WETH_ONLY,
  [ChainId.MAINNET]: [...WETH_ONLY[ChainId.MAINNET], LUA, USDC, USDT, TOMOE],
  [ChainId.TOMOCHAIN_TESTNET]: [...WETH_ONLY[ChainId.TOMOCHAIN_TESTNET], TBTC, TUSDT],
  [ChainId.TOMOCHAIN_MAINNET]: [...WETH_ONLY[ChainId.TOMOCHAIN_MAINNET], MLUA]
}

/**
 * Some tokens can only be swapped via certain pairs, so we override the list of bases that are considered for these
 * tokens.
 */
export const CUSTOM_BASES: { [chainId in ChainId]?: { [tokenAddress: string]: Token[] } } = {
  [ChainId.MAINNET]: {},
  [ChainId.TOMOCHAIN_TESTNET]: {},
  [ChainId.TOMOCHAIN_MAINNET]: {}
}

// used for display in the default list when adding liquidity
export const SUGGESTED_BASES: ChainTokenList = {
  ...WETH_ONLY,
  [ChainId.MAINNET]: [LUA, USDC, USDT, TOMOE],
  [ChainId.TOMOCHAIN_TESTNET]: [TUSDT, TBTC],
  [ChainId.TOMOCHAIN_MAINNET]: [MLUA, MUSDT, MBTC]
}

// used to construct the list of all pairs we consider by default in the frontend
export const BASES_TO_TRACK_LIQUIDITY_FOR: ChainTokenList = {
  ...WETH_ONLY,
  [ChainId.MAINNET]: [...WETH_ONLY[ChainId.MAINNET], LUA, USDC, USDT, TOMOE],
  [ChainId.TOMOCHAIN_TESTNET]: [...WETH_ONLY[ChainId.TOMOCHAIN_TESTNET], TUSDT, TBTC],
  [ChainId.TOMOCHAIN_MAINNET]: [...WETH_ONLY[ChainId.TOMOCHAIN_MAINNET], MLUA, MUSDT, MBTC]
}

export const PINNED_PAIRS: { readonly [chainId in ChainId]?: [Token, Token][] } = {
  [ChainId.MAINNET]: [[USDC, USDT]],
  [ChainId.TOMOCHAIN_TESTNET]: [[TUSDT, TBTC]],
  [ChainId.TOMOCHAIN_MAINNET]: [[MLUA, MUSDT]]
}

export interface WalletInfo {
  connector?: AbstractConnector
  name: string
  iconName: string
  description: string
  href: string | null
  color: string
  primary?: true
  mobile?: true
  mobileOnly?: true
}

export const SUPPORTED_WALLETS: { [key: string]: WalletInfo } = {
  INJECTED: {
    connector: injected,
    name: 'Injected',
    iconName: 'arrow-right.svg',
    description: 'Injected web3 provider.',
    href: null,
    color: '#010101',
    primary: true
  },
  METAMASK: {
    connector: injected,
    name: 'MetaMask',
    iconName: 'metamask.png',
    description: 'Easy-to-use browser extension.',
    href: null,
    color: '#E8831D'
  },
  WALLET_CONNECT: {
    connector: walletconnect,
    name: 'WalletConnect',
    iconName: 'walletConnectIcon.svg',
    description: 'Connect to Trust Wallet, Rainbow Wallet and more...',
    href: null,
    color: '#4196FC',
    mobile: true
  },
  WALLET_LINK: {
    connector: walletlink,
    name: 'Coinbase Wallet',
    iconName: 'coinbaseWalletIcon.svg',
    description: 'Use Coinbase Wallet app on mobile device',
    href: null,
    color: '#315CF5'
  },
  COINBASE_LINK: {
    name: 'Open in Coinbase Wallet',
    iconName: 'coinbaseWalletIcon.svg',
    description: 'Open in Coinbase Wallet app.',
    href: 'https://go.cb-w.com/mtUDhEZPy1',
    color: '#315CF5',
    mobile: true,
    mobileOnly: true
  }
}

export const NETWORK_SCAN: { [chainId in ChainId]: string } = {
  1: 'View Etherscan',
  3: 'View Etherscan',
  4: 'View Etherscan',
  5: 'View Etherscan',
  42: 'View Etherscan',
  88: 'View TomoScan',
  89: 'View TomoScan',
  99: 'View TomoScan'
}

export const TokenTextSupport: { [chainId in ChainId]: string } = {
  1: 'ETH',
  3: 'ETH',
  4: 'ETH',
  5: 'ETH',
  42: 'ETH',
  88: 'TOMO',
  89: 'TOMO',
  99: 'TOMO'
}

export const NetworkContextName = 'NETWORK'

// default allowed slippage, in bips
export const INITIAL_ALLOWED_SLIPPAGE = 50
// 20 minutes, denominated in seconds
export const DEFAULT_DEADLINE_FROM_NOW = 60 * 20

export const BIG_INT_ZERO = JSBI.BigInt(0)

// one basis point
export const ONE_BIPS = new Percent(JSBI.BigInt(1), JSBI.BigInt(10000))
export const BIPS_BASE = JSBI.BigInt(10000)
// used for warning states
export const ALLOWED_PRICE_IMPACT_LOW: Percent = new Percent(JSBI.BigInt(100), BIPS_BASE) // 1%
export const ALLOWED_PRICE_IMPACT_MEDIUM: Percent = new Percent(JSBI.BigInt(300), BIPS_BASE) // 3%
export const ALLOWED_PRICE_IMPACT_HIGH: Percent = new Percent(JSBI.BigInt(500), BIPS_BASE) // 5%
// if the price slippage exceeds this number, force the user to type 'confirm' to execute
export const PRICE_IMPACT_WITHOUT_FEE_CONFIRM_MIN: Percent = new Percent(JSBI.BigInt(1000), BIPS_BASE) // 10%
// for non expert mode disable swaps above this
export const BLOCKED_PRICE_IMPACT_NON_EXPERT: Percent = new Percent(JSBI.BigInt(1500), BIPS_BASE) // 15%

// used to ensure the user doesn't send so much ETH so they end up with <.01
export const MIN_ETH: JSBI = JSBI.exponentiate(JSBI.BigInt(10), JSBI.BigInt(16)) // .01 ETH
export const MIN_TOMO: JSBI = JSBI.exponentiate(JSBI.BigInt(0), JSBI.BigInt(16)) // .01 ETH
export const BETTER_TRADE_LINK_THRESHOLD = new Percent(JSBI.BigInt(75), JSBI.BigInt(10000))

export const STAKING_POOLS = [
  {
    key: 'lua-xlua',
    name: 'LUA - xLUA',
    description: 'Deposit LUA-xLUA LUA-V1 LP to earn xLUA',
    longSymbol: 'LUA-xLUA LUA-V1 LP',
    shortSymbol: 'LUA-xLUA',
    token: 'LUA',
    token2: 'xLUA',
    icon: 'https://luaswap.org/favicon.png',
    icon2: 'https://luaswap.org/favicon.png'
  },
  {
    key: 'xlua-tomo',
    name: 'xLUA - TOMO',
    description: 'Deposit xLUA-TOMO LUA-V1 LP to earn TOMO',
    longSymbol: 'xLUA-TOMO LUA-V1 LP',
    shortSymbol: 'xLUA-TOMO',
    token: 'xLUA',
    token2: 'TOMO',
    icon: 'https://luaswap.org/favicon.png',
    icon2: 'https://wallet.tomochain.com/public/imgs/tomoiconwhite.png'
  }
]

type TokenIconProps = {
  [index: string]: string
}
export const TOKEN_ICONS: TokenIconProps = {
  LUA: 'https://luaswap.org/favicon.png',
  'LUA-V1': 'https://luaswap.org/favicon.png',
  USDC: 'https://s2.coinmarketcap.com/static/img/coins/128x128/3408.png',
  TOMOE: 'https://wallet.tomochain.com/public/imgs/tomoiconwhite.png',
  ETH: 'https://s2.coinmarketcap.com/static/img/coins/128x128/1027.png',
  USDT: 'https://s2.coinmarketcap.com/static/img/coins/128x128/825.png',
  FRONT: 'https://s2.coinmarketcap.com/static/img/coins/128x128/5893.png',
  SUSHI: 'https://s2.coinmarketcap.com/static/img/coins/128x128/6758.png',
  SRM: 'https://s2.coinmarketcap.com/static/img/coins/128x128/6187.png',
  'FTX Token': 'https://s2.coinmarketcap.com/static/img/coins/128x128/4195.png',
  KAI:
    'https://raw.githubusercontent.com/trustwallet/assets/master/blockchains/ethereum/assets/0xD9Ec3ff1f8be459Bb9369b4E79e9Ebcf7141C093/logo.png',
  OM: 'https://s2.coinmarketcap.com/static/img/coins/128x128/6536.png',
  WBTC: 'https://s2.coinmarketcap.com/static/img/coins/128x128/1.png',
  UNI: 'https://s2.coinmarketcap.com/static/img/coins/128x128/7083.png',
  DAI: 'https://s2.coinmarketcap.com/static/img/coins/64x64/4943.png',
  BAT: 'https://s2.coinmarketcap.com/static/img/coins/64x64/1697.png',
  RAMP: 'https://s2.coinmarketcap.com/static/img/coins/128x128/7463.png'
}
