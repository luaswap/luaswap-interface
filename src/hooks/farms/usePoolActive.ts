import { useCallback, useEffect, useState } from 'react'

import { checkPoolActive } from '../../sushi/utils'
// import debounce from 'debounce'

const usePoolActive = (pid: number) => {
  const [active, setActive] = useState(true)
  const getData = useCallback(async () => {
    setActive(await checkPoolActive(pid))
  }, [])

  useEffect(() => {
    getData()
  }, [])

  return active
}

export default usePoolActive
