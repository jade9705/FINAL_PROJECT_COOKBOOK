import React from 'react'
import UserBox from "./UserBox.jsx";
import FollowersBox from "./FollowersBox";
import ActivityBox from "./ActivityBox";

const ProfileSideBar = () => {
  return (
    <div className="ProfileSideBar">
      <h2>Cooker Profile</h2>
      <UserBox />
      <FollowersBox />
      <ActivityBox />


    </div>
  )
}

export default ProfileSideBar
