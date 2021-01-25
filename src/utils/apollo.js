import { client, clientTomo, healthClient, healthClientTomo, blockClient, blockClientTomo } from '../apollo/client'

export const getClient = () => {
  if (sessionStorage.getItem('chosenNetwork') === 'TOMO') {
    return clientTomo
  }
  return client
}

export const getHealthClient = () => {
  if (sessionStorage.getItem('chosenNetwork') === 'TOMO') {
    return healthClientTomo
  }
  return healthClient
}

export const getBlockClient = () => {
  if (sessionStorage.getItem('chosenNetwork') === 'TOMO') {
    return blockClientTomo
  }
  return blockClient
}
