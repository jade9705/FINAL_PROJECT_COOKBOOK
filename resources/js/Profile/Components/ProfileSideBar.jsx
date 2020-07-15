import React from 'react'
import UserBox from "./UserBox.jsx";
import FollowersBox from "./FollowersBox";
import ActivityBox from "./ActivityBox";
import SearchUsersBar from "./SearchUsersBar.jsx";

const ProfileSideBar = ({user, logged_user_id}) => {
  return (
    <div className="profileSideBar">
      <UserBox user={user} logged_user_id={logged_user_id} />
      <FollowersBox user={user} />
      <SearchUsersBar />
      <ActivityBox user={user}/>
    </div>
  )
}

export default ProfileSideBar
