import React from 'react'
import styled from 'styled-components'
import Modal from '../Modal'
import { TYPE } from '../../theme'
import Spacer from '../Spacer'
import { RowBetween } from '../Row'

const ContentWrapper = styled.div`
  width: 100%;
  padding: 20px;
`
export default function NoticeModal() {
  return (
    <Modal isOpen={true} maxHeight={30} minHeight={30}>
      <ContentWrapper>
        <RowBetween>
          <TYPE.largeHeader color={'#ecb34b'}>Notice</TYPE.largeHeader>
        </RowBetween>
        <Spacer size="md" />
        <RowBetween>
          <TYPE.body color={'#ecb34b'}>
            LuaSwap Farming and LuaSafe features are not available, at the moment, on TomoChain network. They will be
            activated in February 2021. The same swap features are now available on the TomoChain version. Anyone can
            start trading, create and provide liquidity for any token pair on LuaSwap
          </TYPE.body>
        </RowBetween>
      </ContentWrapper>
    </Modal>
  )
}
