const config = [
  {
    label: 'Swap',
    icon: 'TradeIcon',
    href: '/swap'
  },
  {
    label: 'Pools',
    icon: 'PoolIcon',
    href: '/pool'
  },
  {
    key: 'farms',
    label: 'Farms',
    icon: 'FarmIcon',
    href: '/farming'
  },
  {
    key: 'luasafe',
    label: 'LuaSafe',
    icon: 'ArrowRenew',
    href: '/lua-safe'
  },
  {
    label: 'Orderbook',
    icon: 'Groups',
    href: 'https://app.luaswap.org/orderbook/#/'
  },
  {
    key: 'ido',
    label: 'LuaStarter',
    icon: 'IfoIcon',
    href: 'https://app.luaswap.org/idos'
  },
  {
    key: 'info',
    label: 'Info',
    icon: 'ArrowUpIcon',
    items: [
      {
        label: 'Ethereum',
        href: 'https://info.luaswap.org/home'
      },
      {
        label: 'TomoChain',
        href: 'https://info.luaswap.org/tomochain/home'
      }
    ]
  },
  {
    key: 'more',
    label: 'More',
    icon: 'MoreIcon',
    items: [
      {
        label: 'About',
        href: 'https://luaswap.org'
      },
      {
        label: 'Code',
        href: 'https://github.com/tomochain'
      }
    ]
  }
]

export default config

export const socials = [
  {
    label: 'Telegram',
    icon: 'TelegramIcon',
    href: 'https://t.me/luaswap'
  },
  {
    label: 'Twitter',
    icon: 'TwitterIcon',
    href: 'https://twitter.com/luaswap'
  }
]

export type NetworkOption = {
  name: string
  chainId: number
  chainName: string
  nativeCurrency: {
    name: string
    symbol: string
    decimals: number
  }
}
