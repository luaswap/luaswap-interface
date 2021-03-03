import { useCallback, useEffect, useState } from 'react'
import BigNumber from 'bignumber.js'

import { useActiveWeb3React } from '../../hooks'
import { IsTomoChain } from '../../utils'
import useSushi from './useSushi'
import axios from 'axios'
import config from '../../config'
const useLuaPrice = () => {
  const { chainId } = useActiveWeb3React()
  const IsTomo = IsTomoChain(chainId)
  const [price, setPrice] = useState(new BigNumber(0))
  const sushi = useSushi()

  const fetchBalance = useCallback(async () => {
    const apiUrl = IsTomo ? config.apiTOMO : config.apiETH
    const { data } = await axios.get(`${apiUrl}/price/LUA`)
    const value = data.usdPrice
    setPrice(new BigNumber(value * 10 ** 8))
  }, [sushi])

  useEffect(() => {
    if (sushi) {
      fetchBalance()
    }
  }, [setPrice, sushi])

  return price
}

export default useLuaPrice
