import React from 'react'

const Medaillon = ({user, follow_style}) => {
  // console.log(user);
  return (
    <>
      {user ? <div className={`medaillon__img ${follow_style}`} style={{backgroundImage: `url("http://localhost:3000/images/uploads/user/${user.image_url}")`}}></div> : null}
    </>
  )
}

export default Medaillon
