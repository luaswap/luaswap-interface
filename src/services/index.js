import axios from 'axios'
import config, { API_URL } from '../config'
export const requestStakingPools = (callback, chainId) => {
  let apiUrl
  if (chainId) {
    apiUrl = API_URL[chainId]
  } else {
    apiUrl = config.apiTOMO
  }
  return axios.get(`${apiUrl}/makerData`).then(({ data }) => {
    if (data && data.length > 0) {
      if (typeof callback === 'function') {
        return callback(data)
      }

      return data
    }
  })
}
