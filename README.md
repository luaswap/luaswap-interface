# LuaSwap Interface

[![Lint](https://github.com/tomochain/luaswap-interface/workflows/Lint/badge.svg)](https://github.com/tomochain/luaswap-interface/actions?query=workflow%3ALint)
<!-- [![Tests](https://github.com/tomochain/tomochain-interface/workflows/Tests/badge.svg)](https://github.com/tomochain/luaswap-interface/actions?query=workflow%3ATests) -->
[![Styled With Prettier](https://img.shields.io/badge/code_style-prettier-ff69b4.svg)](https://prettier.io/)

An open source interface for LuaSwap -- a protocol for decentralized exchange of Ethereum tokens.

- Website: [luaswap.org](https://luaswap.org/)
- Interface: [app.luaswap.org](https://app.luaswap.org)
- Docs: [luaswap.org/docs/](https://luaswap.org/docs/)
- Twitter: [@LuaSwap](https://twitter.com/LuaSwap)

## Accessing the LuaSwap Interface

To access the LuaSwap Interface, use an IPFS gateway link from the
[latest release](https://github.com/tomochain/luaswap-interface/releases), 
or visit [app.luaswap.org](https://app.luaswap.org).

## Development

### Install Dependencies

```bash
yarn
```

### Run

```bash
yarn start
```

### Configuring the environment (optional)

To have the interface default to a different network when a wallet is not connected:

1. Make a copy of `.env` named `.env.local`
2. Change `REACT_APP_NETWORK_ID` to `"{YOUR_NETWORK_ID}"`
3. Change `REACT_APP_NETWORK_URL` to e.g. `"https://{YOUR_NETWORK_ID}.infura.io/v3/{YOUR_INFURA_KEY}"` 

Note that the interface only works on testnets where both 
[LuaSwap V1](https://luaswap.org/docs/smart-contracts/factory/) and 
[multicall](https://github.com/makerdao/multicall) are deployed.
The interface will not work on other networks.

## Contributions

**Please open all pull requests against the `master` branch.** 
CI checks will run against all PRs.

## Accessing LuaSwap Interface

The LuaSwap Interface supports swapping against, and migrating or removing liquidity.