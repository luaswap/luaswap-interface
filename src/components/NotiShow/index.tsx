import React, { useState } from 'react'
import avtNotiIcon from '../../assets/images/avt-noti.png'

export default function NotiShow() {
  const [showNoti, setShowNoti] = useState(true)
  return (
    <>
      {showNoti && (
        <div
          style={{
            width: '350px',
            height: '110px',
            background: 'white',
            position: 'fixed',
            bottom: '40px',
            right: '20px',
            borderRadius: '10px',
            padding: '15px',
            display: 'flex'
          }}
        >
          <div
            style={{
              display: 'flex',
              flexDirection: 'column',
              justifyContent: 'center',
              paddingRight: '15px'
            }}
          >
            <img
              alt="Noti"
              src={avtNotiIcon}
              style={{
                width: '50px',
                height: '50px',
                borderRadius: '4px'
              }}
            />
          </div>
          <div>
            <div
              style={{
                fontWeight: 'bold',
                fontSize: '16px',
                color: 'black'
              }}
            >
              Debonair Cat NFTs
            </div>

            <div
              style={{
                fontSize: '13px',
                color: 'black'
              }}
            >
              Debonair Cat NFTs will be claimable on{' '}
              <a
                style={{ textDecoration: 'none', color: '#1ca9d9', fontWeight: 'bold' }}
                href="https://tezuka.io/"
                target="__blank"
              >
                Tezuka
              </a>{' '}
              for all{' '}
              <a
                style={{ textDecoration: 'none', color: '#1ca9d9', fontWeight: 'bold' }}
                href="https://docs.google.com/spreadsheets/u/3/d/1FHW8VUrLln6Xbk27CQ5kNeEslVMEpPcEaMCNKxJu_N0/edit?usp=sharing"
                target="__blank"
              >
                whitelisted winners
              </a>{' '}
              and{' '}
              <a
                style={{ textDecoration: 'none', color: '#1ca9d9', fontWeight: 'bold' }}
                href="https://docs.google.com/spreadsheets/d/183x1nfiWeCdxF_D75yuuLxDd8qLMMZQeeY76h9SISx4/edit#gid=0"
                target="__blank"
              >
                eligible LUA stakers
              </a>
              . Hurry up!
            </div>
          </div>
          <div
            style={{
              position: 'absolute',
              top: '10px',
              right: '10px',
              width: '20px',
              height: '20px',
              display: 'flex',
              justifyContent: 'center',
              alignItems: 'center',
              fontSize: '18px',
              cursor: 'pointer',
              color: 'black'
            }}
            onClick={() => setShowNoti(false)}
          >
            x
          </div>
        </div>
      )}
    </>
  )
}
