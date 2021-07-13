import React from 'react'
import styled from 'styled-components'

const StyledInfo = styled.div`
  max-width: 420px;
  margin: 0 auto 20px auto;
  padding: 10px;
  font-size: 13px;
  text-align: center;
`
export default function NoticeTomoBridge() {
  return (
    <>
      <StyledInfo style={{ color: '#c3a56e' }}>
        <a style={{ fontSize: '15px', color: '#ecb34b' }} href="https://bridge.tomochain.com/" target="true">
          Bring
        </a>{' '}
        any ERC20 token into the TomoChain ecosystem & integrate with LuaSwap seamlessly. Take advantage of near-zero
        gas fees & super fast trades!
      </StyledInfo>
    </>
  )
}
