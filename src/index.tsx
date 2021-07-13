import { createWeb3ReactRoot, Web3ReactProvider } from '@web3-react/core'
import 'inter-ui'
import React, { StrictMode } from 'react'
import { isMobile } from 'react-device-detect'
import ReactDOM from 'react-dom'
import ReactGA from 'react-ga'
import { Provider } from 'react-redux'
import { HashRouter } from 'react-router-dom'
// import styled from 'styled-components'
import { NetworkContextName } from './constants'
import './i18n'
import App from './pages/App'
import store from './state'
// import ImgLoader from './assets/images/loader.png'
import ApplicationUpdater from './state/application/updater'
import ListsUpdater from './state/lists/updater'
import MulticallUpdater from './state/multicall/updater'
import TransactionUpdater from './state/transactions/updater'
import UserUpdater from './state/user/updater'
import ThemeProvider, { FixedGlobalStyle, ThemedGlobalStyle } from './theme'
import getLibrary from './utils/getLibrary'
// import { IsTomoChain } from './utils'

import SushiProvider from './contexts/SushiProvider'
// import TransactionProvider from './contexts/Transactions'
import FarmsProvider from './contexts/Farms'
import ModalsProvider from './contexts/Modals'

// import { TOMO_SUPPORTED_POOL, SUPPORTED_POOL } from './constants/abis/farming'

const Web3ProviderNetwork = createWeb3ReactRoot(NetworkContextName)

if ('ethereum' in window) {
  ;(window.ethereum as any).autoRefreshOnNetworkChange = false
}

const GOOGLE_ANALYTICS_ID: string | undefined = process.env.REACT_APP_GOOGLE_ANALYTICS_ID
if (typeof GOOGLE_ANALYTICS_ID === 'string') {
  ReactGA.initialize(GOOGLE_ANALYTICS_ID)
  ReactGA.set({
    customBrowserType: !isMobile ? 'desktop' : 'web3' in window || 'ethereum' in window ? 'mobileWeb3' : 'mobileRegular'
  })
} else {
  ReactGA.initialize('test', { testMode: true, debug: true })
}

window.addEventListener('error', error => {
  ReactGA.exception({
    description: `${error.message} @ ${error.filename}:${error.lineno}:${error.colno}`,
    fatal: true
  })
})

function Updaters() {
  return (
    <>
      <ListsUpdater />
      <UserUpdater />
      <ApplicationUpdater />
      <TransactionUpdater />
      <MulticallUpdater />
    </>
  )
}
// const StyleLoader = styled.div`
//   position: relative;
//   width: 100%;
//   height: 100vh;
//   img {
//     animation: spin 2s linear infinite;
//     position: absolute;
//     top: 50%;
//     left: 50%;
//     transform: translate(-50%, -50%);
//   }
//   @keyframes spin {
//     0% {
//       transform: rotate(0deg);
//     }
//     100% {
//       transform: rotate(360deg);
//     }
//   }
// `
// function Loading() {
//   return (
//     <>
//       <StyleLoader>
//         <img src={ImgLoader} alt="Loading" />
//       </StyleLoader>
//     </>
//   )
// }

// function PoolsData({ children }: { children: React.ReactNode }) {
//   const [pools, setPools] = useState([])
//   const { chainId } = useWeb3React()
//   const IsTomo = IsTomoChain(chainId)
//   const supportedPoolsUrl = IsTomo ? TOMO_SUPPORTED_POOL : SUPPORTED_POOL
//   useEffect(() => {
//     async function poolSupport() {
//       let response
//       try {
//         response = await fetch(supportedPoolsUrl)
//         const data = await response.json()
//         //@ts-ignore
//         window.pools = data
//         //@ts-ignore
//         setPools(data)
//       } catch (error) {
//         console.debug(error)
//         //@ts-ignore
//         window.pools = []
//       }
//     }

//     poolSupport()
//   }, [IsTomo])

//   return pools.length > 0 ? <>{children}</> : <Loading />
// }

ReactDOM.render(
  <StrictMode>
    <FixedGlobalStyle />
    <Web3ReactProvider getLibrary={getLibrary}>
      <Web3ProviderNetwork getLibrary={getLibrary}>
        <Provider store={store}>
          <Updaters />
          <ThemeProvider>
            <ThemedGlobalStyle />
            {/* <PoolsData> */}
            <SushiProvider>
              {/* <TransactionProvider> */}
              <FarmsProvider>
                <HashRouter>
                  <ModalsProvider>
                    <App />
                  </ModalsProvider>
                </HashRouter>
              </FarmsProvider>
              {/* </TransactionProvider> */}
            </SushiProvider>
            {/* </PoolsData> */}
          </ThemeProvider>
        </Provider>
      </Web3ProviderNetwork>
    </Web3ReactProvider>
  </StrictMode>,
  document.getElementById('root')
)
