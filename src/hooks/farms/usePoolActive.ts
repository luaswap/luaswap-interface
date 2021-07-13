import { useWeb3React } from '@web3-react/core'
import { useCallback, useEffect, useState } from 'react'

import { checkPoolActive } from '../../sushi/utils'
// import debounce from 'debounce'

const usePoolActive = (pid: number) => {
  const { chainId } = useWeb3React()
  const [active, setActive] = useState(true)
  const getData = useCallback(async () => {
    setActive(await checkPoolActive(pid, chainId))
  }, [])

  useEffect(() => {
    getData()
  }, [])

  return active
}

export default usePoolActive
