const config = [
  {
    label: 'Home',
    icon: 'HomeIcon',
    href: 'http://localhost:3001/#/',
  },
  {
    key: 'trade',
    label: 'Trade',
    icon: 'TradeIcon',
    items: [
      {
        label: 'Swap',
        href: '/swap',
      },
      {
        label: 'Liquidity',
        href: '/pool',
      },
      {
        label: 'OrderBook',
        href: 'https://app.luaswap.org/orderbook/#/',
      }
    ]
  },
  {
    key: 'farms',
    label: 'Farms',
    icon: 'FarmIcon',
    href: 'http://localhost:3001/#/farms',
  },
  {
    key: 'ido',
    label: 'IDO',
    icon: 'IfoIcon',
    href: 'http://localhost:3001/#/idos',
  },
  {
    key:'info',
    label: 'Info',
    icon: 'ArrowUpIcon',
    items: [
      {
        label: 'Ethereum',
        href: 'https://info.luaswap.org/home',
      },
      {
        label: 'TomoChain',
        href: 'https://info.luaswap.org/tomochain/home',
      }
    ]
  },
  {
    key:'more',
    label: 'More',
    icon: 'MoreIcon',
    items: [
      {
        label: 'About',
        href: 'https://luaswap.org',
      },
      {
        label: 'Code',
        href: 'https://github.com/tomochain',
      }
    ]
  }
]

export default config

export const socials = [
  {
    label: "Telegram",
    icon: "TelegramIcon",
    href: "https://t.me/luaswap"
  },
  {
    label: "Twitter",
    icon: "TwitterIcon",
    href: "https://twitter.com/luaswap",
  },
];

export type NetworkOption = {
  name: string,
  chainId: number,
  chainName: string
  nativeCurrency: {
    name: string,
    symbol: string,
    decimals: number,
  }
}
