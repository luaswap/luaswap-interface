import { ConnectorUpdate } from '@web3-react/types'
import { AbstractConnector } from '@web3-react/abstract-connector'
import invariant from 'tiny-invariant'

import TomoWalletConnectProvider from './TomoWeb3Provider'

export const URI_AVAILABLE = 'URI_AVAILABLE'

export class UserRejectedRequestError extends Error {
  public constructor() {
    super()
    this.name = this.constructor.name
    this.message = 'The user rejected the request.'
  }
}

interface WalletConnectConnectorArguments {
  rpc: { [chainId: number]: string }
  bridge?: string
  qrcode?: boolean
  pollingInterval?: number
  chainId: number
}

export class TomoWalletConnectConnector extends AbstractConnector {
  private readonly rpc: { [chainId: number]: string }
  private readonly bridge?: string
  private readonly qrcode?: boolean
  private readonly pollingInterval?: number

  public walletConnectProvider?: any
  public chainId: number

  constructor({ rpc, bridge, qrcode, pollingInterval, chainId }: WalletConnectConnectorArguments) {
    invariant(Object.keys(rpc).length === 1, '@walletconnect/web3-provider is broken with >1 chainId, please use 1')
    super({ supportedChainIds: Object.keys(rpc).map(k => Number(k)) })

    this.rpc = rpc
    this.bridge = bridge
    this.qrcode = qrcode
    this.pollingInterval = pollingInterval
    this.chainId = chainId

    this.handleChainChanged = this.handleChainChanged.bind(this)
    this.handleAccountsChanged = this.handleAccountsChanged.bind(this)
    this.handleDisconnect = this.handleDisconnect.bind(this)
  }

  private handleChainChanged(chainId: number | string): void {
    // this.emitUpdate({ chainId })
  }

  private handleAccountsChanged(accounts: string[]): void {
    this.emitUpdate({ account: accounts[0] })
  }

  private handleDisconnect(): void {
    this.emitDeactivate()
    // we have to do this because of a @walletconnect/web3-provider bug
    if (this.walletConnectProvider) {
      this.walletConnectProvider.stop()
      this.walletConnectProvider.removeListener('chainChanged', this.handleChainChanged)
      this.walletConnectProvider.removeListener('accountsChanged', this.handleAccountsChanged)
      this.walletConnectProvider = undefined
    }

    this.emitDeactivate()
  }

  public async activate(): Promise<ConnectorUpdate> {
    if (!this.walletConnectProvider) {
      this.walletConnectProvider = new TomoWalletConnectProvider({
        bridge: this.bridge,
        rpc: this.rpc,
        qrcode: this.qrcode,
        pollingInterval: this.pollingInterval,
        chainId: this.chainId
      })
    }

    // ensure that the uri is going to be available, and emit an event if there's a new uri
    if (!this.walletConnectProvider.wc.connected) {
      await this.walletConnectProvider.wc.createSession({ chainId: Number(Object.keys(this.rpc)[0]) })
      this.emit(URI_AVAILABLE, this.walletConnectProvider.wc.uri)
    }

    const account = await this.walletConnectProvider
      .enable()
      .then((accounts: string[]): string => accounts[0])
      .catch((error: Error): void => {
        // TODO ideally this would be a better check
        if (error.message === 'User closed modal') {
          throw new UserRejectedRequestError()
        }

        throw error
      })

    this.walletConnectProvider.on('disconnect', this.handleDisconnect)
    this.walletConnectProvider.on('chainChanged', this.handleChainChanged)
    this.walletConnectProvider.on('accountsChanged', this.handleAccountsChanged)

    return { provider: this.walletConnectProvider, account }
  }

  public async getProvider(): Promise<any> {
    return this.walletConnectProvider
  }

  public async getChainId(): Promise<number | string> {
    const chainId = await this.walletConnectProvider.web3.eth.getChainId()
    return chainId.toString()
  }

  public async getAccount(): Promise<null | string> {
    return this.walletConnectProvider.send('eth_accounts').then((accounts: string[]): string => accounts[0])
  }

  public deactivate() {
    if (this.walletConnectProvider) {
      this.walletConnectProvider.stop()
      this.walletConnectProvider.removeListener('disconnect', this.handleDisconnect)
      this.walletConnectProvider.removeListener('chainChanged', this.handleChainChanged)
      this.walletConnectProvider.removeListener('accountsChanged', this.handleAccountsChanged)
    }
  }

  public async close() {
    await this.walletConnectProvider?.close()
  }
}
