import Web3 from 'web3'
import { provider } from 'web3-core'
import { Contract } from 'web3-eth-contract'
// @ts-ignore
import { AbiItem } from 'web3-utils'
import ERC20ABI from '../constants/abi/ERC20.json'
import config, { RPC_URL } from '../config'
import { ChainId } from '@luaswap/sdk'

export const getContract = (provider: any, address: string) => {
  const web3 = new Web3((provider as any) || config.rpc)
  const contract = new web3.eth.Contract((ERC20ABI.abi as unknown) as AbiItem, address)
  return contract
}

export const getAllowance = async (
  lpContract: Contract,
  masterChefContract: Contract,
  account: string
): Promise<string> => {
  try {
    const allowance = await lpContract.methods.allowance(account, masterChefContract.options.address).call()
    return allowance
  } catch (e) {
    return '0'
  }
}

export const getAllowanceStaking = async (
  contract: Contract,
  owner: string,
  spender: string,
  chainId: ChainId | undefined
): Promise<string> => {
  try {
    let contract2
    if (chainId === 88) {
      contract2 = getContract(RPC_URL[chainId], (contract as any)._address)
    } else {
      contract2 = contract
    }

    const allowance = await contract2.methods.allowance(owner, spender).call()
    return allowance
  } catch (e) {
    return '0'
  }
}

export const getBalance = async (provider: provider, tokenAddress: string, userAddress: string): Promise<string> => {
  const lpContract = getContract(provider, tokenAddress)
  try {
    const balance: string = await lpContract.methods.balanceOf(userAddress).call()
    return balance
  } catch (e) {
    return '0'
  }
}
