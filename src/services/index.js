import axios from 'axios'

export const requestStakingPools = callback => {
  return axios.get('https://wallet.tomochain.com/api/luaswap/makerData').then(({ data }) => {
    if (data && data.length > 0) {
      if (typeof callback === 'function') {
        return callback(data)
      }

      return data
    }
  })
}
