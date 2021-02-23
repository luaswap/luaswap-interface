import { Contract } from '@ethersproject/contracts'
import { getAddress } from '@ethersproject/address'
import { AddressZero } from '@ethersproject/constants'
import { JsonRpcSigner, Web3Provider } from '@ethersproject/providers'
import { BigNumber } from '@ethersproject/bignumber'
import { abi as IUniswapV2Router02ABI } from '@uniswap/v2-periphery/build/IUniswapV2Router02.json'
import { ROUTER_ADDRESS, TOMO_ROUTER_ADDRESS } from '../constants'
import { ChainId, JSBI, Percent, Token, CurrencyAmount, Currency, ETHER, TOMO } from '@luaswap/sdk'
import { TokenAddressMap } from '../state/lists/hooks'
import EthereumLogo from '../assets/images/ethereum-logo.png'
import TomoLogo from '../assets/images/tomo-logo.png'

// returns the checksummed address if the address is valid, otherwise returns false
export function isAddress(value: any): string | false {
  try {
    return getAddress(value)
  } catch {
    return false
  }
}

const ETHERSCAN_PREFIXES: { [chainId in ChainId]: string } = {
  1: '',
  3: 'ropsten.',
  4: 'rinkeby.',
  5: 'goerli.',
  42: 'kovan.',
  88: 'scan.',
  89: 'scan.testnet.',
  99: 'scan.devnet.'
}
const NETWORK_DOMAIN: { [chainId in ChainId]: string } = {
  1: 'etherscan.io',
  3: 'etherscan.io',
  4: 'etherscan.io',
  5: 'etherscan.io',
  42: 'etherscan.io',
  88: 'tomochain.com',
  89: 'tomochain.com',
  99: 'tomochain.com'
}
const BLOCK_LINK: { [chainId in ChainId]: string } = {
  1: 'block',
  3: 'block',
  4: 'block',
  5: 'block',
  42: 'block',
  88: 'blocks',
  89: 'blocks',
  99: 'blocks'
}
const TOKEN: { [chainId in ChainId]: string } = {
  1: 'token',
  3: 'token',
  4: 'token',
  5: 'token',
  42: 'token',
  88: 'tokens',
  89: 'tokens',
  99: 'tokens'
}

export function getEtherscanLink(
  chainId: ChainId,
  data: string,
  type: 'transaction' | 'token' | 'address' | 'block'
): string {
  const prefix = `https://${ETHERSCAN_PREFIXES[chainId] || ETHERSCAN_PREFIXES[1]}${NETWORK_DOMAIN[chainId]}`

  const block = BLOCK_LINK[chainId]
  const token = TOKEN[chainId]

  switch (type) {
    case 'transaction': {
      return `${prefix}/tx/${data}`
    }
    case 'token': {
      return `${prefix}/${token}/${data}`
    }
    case 'block': {
      return `${prefix}/${block}/${data}`
    }
    case 'address':
    default: {
      return `${prefix}/address/${data}`
    }
  }
}

export function IsTomoChain(chainId: ChainId | undefined) {
  return chainId === 88 || chainId === 89 || chainId === 99
}

export function getNativeToken(chainId: ChainId | undefined) {
  const IsTomo = IsTomoChain(chainId)
  if (IsTomo) {
    return TOMO
  } else {
    return ETHER
  }
}

export function getTextNativeToken(chainId: ChainId | undefined) {
  const IsTomo = IsTomoChain(chainId)
  if (IsTomo) {
    return 'TOMO'
  } else {
    return 'ETH'
  }
}

export function getLogoNativeToken(chainId: ChainId | undefined) {
  const IsTomo = IsTomoChain(chainId)
  if (IsTomo) {
    return TomoLogo
  } else {
    return EthereumLogo
  }
}

// shorten the checksummed version of the input address to have 0x + 4 characters at start and end
export function shortenAddress(address: string, chars = 4): string {
  const parsed = isAddress(address)
  if (!parsed) {
    throw Error(`Invalid 'address' parameter '${address}'.`)
  }
  return `${parsed.substring(0, chars + 2)}...${parsed.substring(42 - chars)}`
}

// add 10%
export function calculateGasMargin(value: BigNumber): BigNumber {
  return value.mul(BigNumber.from(10000).add(BigNumber.from(1000))).div(BigNumber.from(10000))
}

// converts a basis points value to a sdk percent
export function basisPointsToPercent(num: number): Percent {
  return new Percent(JSBI.BigInt(num), JSBI.BigInt(10000))
}

export function calculateSlippageAmount(value: CurrencyAmount, slippage: number): [JSBI, JSBI] {
  if (slippage < 0 || slippage > 10000) {
    throw Error(`Unexpected slippage value: ${slippage}`)
  }
  return [
    JSBI.divide(JSBI.multiply(value.raw, JSBI.BigInt(10000 - slippage)), JSBI.BigInt(10000)),
    JSBI.divide(JSBI.multiply(value.raw, JSBI.BigInt(10000 + slippage)), JSBI.BigInt(10000))
  ]
}

// account is not optional
export function getSigner(library: Web3Provider, account: string): JsonRpcSigner {
  return library.getSigner(account).connectUnchecked()
}

// account is optional
export function getProviderOrSigner(library: Web3Provider, account?: string): Web3Provider | JsonRpcSigner {
  return account ? getSigner(library, account) : library
}

// account is optional
export function getContract(address: string, ABI: any, library: Web3Provider, account?: string): Contract {
  if (!isAddress(address) || address === AddressZero) {
    throw Error(`Invalid 'address' parameter '${address}'.`)
  }

  return new Contract(address, ABI, getProviderOrSigner(library, account) as any)
}

// account is optional
export function getRouterContract(_: number, library: Web3Provider, account?: string): Contract {
  return getContract(
    _ === 89 || _ === 88 || _ === 99 ? TOMO_ROUTER_ADDRESS : ROUTER_ADDRESS,
    IUniswapV2Router02ABI,
    library,
    account
  )
}

export function escapeRegExp(string: string): string {
  return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') // $& means the whole matched string
}

export function isTokenOnList(defaultTokens: TokenAddressMap, currency?: Currency): boolean {
  if (currency === ETHER || currency === TOMO) return true
  return Boolean(currency instanceof Token && defaultTokens[currency.chainId]?.[currency.address])
}

export const reduceFractionDigit = (number: string | number, digitAmount: number): string =>
  Number(number).toLocaleString(undefined, {
    minimumFractionDigits: 0,
    maximumFractionDigits: digitAmount || 0
  })
