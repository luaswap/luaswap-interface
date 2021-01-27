import { ApolloClient } from 'apollo-client'
import { InMemoryCache } from 'apollo-cache-inmemory'
import { HttpLink } from 'apollo-link-http'

export const client = new ApolloClient({
  link: new HttpLink({
    uri: 'https://api.thegraph.com/subgraphs/name/phucngh/luaswap'
  }),
  cache: new InMemoryCache(),
  shouldBatch: true
})

export const clientTomo = new ApolloClient({
  link: new HttpLink({
    uri: 'https://api.luaswap.org/subgraphs/name/phucngh/Luaswap'
  }),
  cache: new InMemoryCache(),
  shouldBatch: true
})

export const healthClient = new ApolloClient({
  link: new HttpLink({
    uri: 'https://api.thegraph.com/index-node/graphql'
  }),
  cache: new InMemoryCache(),
  shouldBatch: true
})

export const healthClientTomo = new ApolloClient({
  link: new HttpLink({
    uri: 'https://api.luaswap.org/index-node/graphql'
  }),
  cache: new InMemoryCache(),
  shouldBatch: true
})

export const v1Client = new ApolloClient({
  link: new HttpLink({
    uri: 'https://api.thegraph.com/subgraphs/name/ianlapham/uniswap'
  }),
  cache: new InMemoryCache(),
  shouldBatch: true
})

export const blockClient = new ApolloClient({
  link: new HttpLink({
    uri: 'https://api.thegraph.com/subgraphs/name/blocklytics/ethereum-blocks'
  }),
  cache: new InMemoryCache()
})

export const blockClientTomo = new ApolloClient({
  link: new HttpLink({
    uri: 'https://api.luaswap.org/subgraphs/name/phucngh/ethereum-blocks'
  }),
  cache: new InMemoryCache()
})
