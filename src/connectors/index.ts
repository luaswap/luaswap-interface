import { Web3Provider } from '@ethersproject/providers'
import { InjectedConnector } from '@web3-react/injected-connector'
import { WalletConnectConnector } from '@web3-react/walletconnect-connector'
import { WalletLinkConnector } from '@web3-react/walletlink-connector'
import { PortisConnector } from '@web3-react/portis-connector'

import { FortmaticConnector } from './Fortmatic'
import { NetworkConnector } from './NetworkConnector'
import { TomoWalletConnectConnector } from './TomoWalletConnect'

const NETWORK_URL = process.env.REACT_APP_NETWORK_URL
const TOMO_NETWORK_URL = process.env.REACT_APP_TOMO_NETWORK_URL
const FORMATIC_KEY = process.env.REACT_APP_FORTMATIC_KEY
const PORTIS_ID = process.env.REACT_APP_PORTIS_ID

export const NETWORK_CHAIN_ID: number = parseInt(process.env.REACT_APP_CHAIN_ID ?? '1')
export const TOMO_NETWORK_CHAIN_ID: number = parseInt(process.env.REACT_APP_TOMO_CHAIN_ID ?? '89')

if (typeof NETWORK_URL === 'undefined' || typeof TOMO_NETWORK_URL === 'undefined') {
  throw new Error(`REACT_APP_NETWORK_URL and REACT_APP_TOMO_NETWORK_URL must be a defined environment variable`)
}

export const network = new NetworkConnector({
  urls: { [NETWORK_CHAIN_ID]: NETWORK_URL }
})

let networkLibrary: Web3Provider | undefined
export function getNetworkLibrary(): Web3Provider {
  return (networkLibrary = networkLibrary ?? new Web3Provider(network.provider as any))
}

export const tomoNetwork = new NetworkConnector({
  urls: { [TOMO_NETWORK_CHAIN_ID]: TOMO_NETWORK_URL }
})

let tomoNetworkLibrary: Web3Provider | undefined
export function getTomoNetworkLibrary(): Web3Provider {
  return (tomoNetworkLibrary = tomoNetworkLibrary ?? new Web3Provider(tomoNetwork.provider as any))
}

export const injected = new InjectedConnector({
  supportedChainIds: [1, 3, 4, 5, 42, 88, 89, 99]
})

// mainnet only
export const walletconnect = new WalletConnectConnector({
  rpc: { 1: NETWORK_URL },
  bridge: 'https://bridge.walletconnect.org',
  qrcode: true,
  pollingInterval: 15000
})

// tomo mainnet only
export const tomoWalletconnect = new TomoWalletConnectConnector({
  rpc: { [TOMO_NETWORK_CHAIN_ID]: TOMO_NETWORK_URL },
  bridge: 'https://bridge.walletconnect.org',
  qrcode: true,
  pollingInterval: 15000,
  chainId: TOMO_NETWORK_CHAIN_ID
})

// mainnet only
export const fortmatic = new FortmaticConnector({
  apiKey: FORMATIC_KEY ?? '',
  chainId: 1
})

// mainnet only
export const portis = new PortisConnector({
  dAppId: PORTIS_ID ?? '',
  networks: [1]
})

// mainnet only
export const walletlink = new WalletLinkConnector({
  url: NETWORK_URL,
  appName: 'LuaSwap',
  appLogoUrl: 'https://raw.githubusercontent.com/tomochain/luaswap-interface/master/public/images/512x512_App_Icon.png'
})
