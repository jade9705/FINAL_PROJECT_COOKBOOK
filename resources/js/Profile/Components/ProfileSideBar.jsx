import React from 'react'
import UserBox from "./UserBox.jsx";
import FollowersBox from "./FollowersBox";
import ActivityBox from "./ActivityBox";

const ProfileSideBar = ({user, logged_user_id}) => {
  return (
    <div className="profileSideBar">
      <UserBox user={user} logged_user_id={logged_user_id} />
      <FollowersBox />
      <ActivityBox />
    </div>
  )
}

export default ProfileSideBar
