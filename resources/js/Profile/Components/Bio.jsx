import React from 'react'

const Bio = ({user}) => {
  return (
    <div className="bio">
      <h5 className="bio__header">BIO</h5>
      <div className="bio__content">{user ? user.bio : null}</div>
    </div>
  )
}

export default Bio
