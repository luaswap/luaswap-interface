import React, { useState } from 'react'
import ModalActions from '../../components/ModalActions'
import ModalTitle from '../../components/ModalTitle'
import styled from 'styled-components'
import Button from '../../components/ButtonSushi'
import Modal from '../../components/Modal/InstantModal'
import { Box } from 'rebass'

interface ConvertModalProps {
  onConfirm: (token0: string, token1: string) => void
  pair?: string
  token0: string
  token1: string
  onDismiss?: () => void
}

const ConvertModal: React.FC<ConvertModalProps> = ({
  onConfirm,
  onDismiss = () => {},
  pair = '',
  token0 = '',
  token1 = ''
}) => {
  const [pendingTx, setPendingTx] = useState(false)
  return (
    <Modal>
      <ModalTitle
        text={
          <>
            {'Convert This Pair: '}
            <StyledPairText>{pair}</StyledPairText>
          </>
        }
      />
      <Box mb={[3, 4]}>
        <StyledNote>
          <ul>
            <li>{'This “CONVERT” button will trigger reward distribution for the selected pair.'}</li>
            <li>{'Anyone can trigger distribution at any time by selecting the “CONVERT” buttons.'}</li>
            <li>{'Users need to pay the gas fee for the distribution if they choose to do it themselves.'}</li>
          </ul>
        </StyledNote>
      </Box>
      <Box px={4}>
        <StyledNote>{`Are you sure you want to convert ${pair}?`}</StyledNote>
      </Box>
      <ModalActions>
        <Button text="Cancel" variant="secondary" onClick={onDismiss} />
        <Button
          disabled={pendingTx}
          text={pendingTx ? 'Pending Confirmation' : 'Confirm'}
          onClick={async () => {
            setPendingTx(true)
            await onConfirm(token0, token1)
            setPendingTx(false)
            onDismiss()
          }}
        />
      </ModalActions>
    </Modal>
  )
}
const StyledNote = styled.h3`
  margin: 0;
  padding: 0;
  color: #bdbdbd;
  font-size: 14px;
  font-weight: 400;
  line-height: 1.5;
`

const StyledPairText = styled.span`
  margin-left: 10px;
  color: ${props => props.theme.primary1};
`

export default ConvertModal
