import { useCallback, useEffect, useState } from 'react'

import BigNumber from 'bignumber.js'
import useSushi from './useSushi'
import { useWeb3React } from '@web3-react/core'

import { getAllowanceStaking } from '../../utils/erc20'
import { getSushiContract, getXSushiStakingContract } from '../../sushi/utils'

const useAllowanceStaking = () => {
  const [allowance, setAllowance] = useState(new BigNumber(0))
  const { account } = useWeb3React()
  const sushi = useSushi()
  const lpContract = getSushiContract(sushi)
  const stakingContract = getXSushiStakingContract(sushi)

  const fetchAllowance = useCallback(async () => {
    const allowance = await getAllowanceStaking(lpContract, account as string, stakingContract.options.address)
    setAllowance(new BigNumber(allowance))
  }, [account, stakingContract, lpContract])

  useEffect(() => {
    if (account && stakingContract && lpContract) {
      fetchAllowance()
    }
    const refreshInterval = setInterval(fetchAllowance, 10000)
    return () => clearInterval(refreshInterval)
  }, [account, stakingContract, lpContract])

  return allowance
}

export default useAllowanceStaking
