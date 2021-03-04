import { useEffect, useState } from 'react'
import { useWeb3React } from '@web3-react/core'
import useSushi from './useSushi'
import { getLuaCirculatingSupply } from '../../sushi/utils'
import BigNumber from 'bignumber.js'
// import debounce from 'debounce'

const CACHE = {
  time: parseInt(localStorage.getItem('CACHE_useLuaCirculatingSupply_time') || '0'),
  old: 2 * 60 * 1000,
  value: new BigNumber(localStorage.getItem('CACHE_useLuaCirculatingSupply_value') || '0')
}

const useLuaCirculatingSupply = () => {
  const {chainId} = useWeb3React()
  const sushi = useSushi()
  const [newReward, setNewRewad] = useState<BigNumber>(CACHE.value)

  useEffect(() => {
    async function fetchData() {
      const v = await getLuaCirculatingSupply(sushi, chainId)
      CACHE.time = new Date().getTime()
      CACHE.value = v

      localStorage.setItem('CACHE_useLuaCirculatingSupply_time', CACHE.time.toString())
      localStorage.setItem('CACHE_useLuaCirculatingSupply_value', CACHE.value.toString())

      setNewRewad(v)
    }
    if (sushi && CACHE.time + CACHE.old <= new Date().getTime()) {
      fetchData()
    }
  }, [sushi, setNewRewad])

  return newReward
}

export default useLuaCirculatingSupply
