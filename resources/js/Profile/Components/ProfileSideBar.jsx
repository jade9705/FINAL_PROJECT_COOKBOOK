import React from 'react'
import UserBox from "./UserBox.jsx";
import FollowersBox from "./FollowersBox";
import ActivityBox from "./ActivityBox";

const ProfileSideBar = ({user}) => {
  return (
    <div className="profileSideBar">
      <UserBox user={user} />
      <FollowersBox />
      <ActivityBox />
    </div>
  )
}

export default ProfileSideBar
