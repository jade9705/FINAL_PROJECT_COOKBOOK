import React, {useState, useEffect} from 'react';
import Medaillon from "./Medaillon.jsx";

const FollowersBox = ({user}) => {
  const [to_follow_arr, setTo_follow_arr] = useState([]);

  useEffect(() => {
    if(user.id){
      fetchToFollow();
    }
  }, [user])


  const fetchToFollow = async () => {
    const response = await fetch('/profile/update/tofollow', {
      method: 'POST',
      body: JSON.stringify({ profile_id: user.id }),
      headers: {
        'Accept':       'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    const data = await response.json();
    setTo_follow_arr(data);
  }

  return (
    <div className="followContainer">
      <h5 className="followContainer__header">YOU WATCH</h5>
      <div className="followContainer__medaillonContainer">
        {to_follow_arr.map((user, key) => {
          return (
            <div key={key} className="followContainer__medaillonBox">
              <a href={`/profile/${user.id}`}>
                <Medaillon 
                user={user}
                follow_style="to_follow"
                />
              </a>
            </div>
          )
        })}
        <div className="followContainer__medaillonBox followContainer__medaillonBox--all">ALL</div>

      </div>
    </div>
  )
}

export default FollowersBox
