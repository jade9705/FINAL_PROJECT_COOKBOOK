import React, {useState, useEffect} from 'react';
import Medaillon from "./Medaillon.jsx";

const FollowersBox = ({user}) => {
  const [to_follow_arr, setTo_follow_arr] = useState([]);
  const [all_follow_arr, setAll_follow_arr] = useState([]);

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


  const allfollow = async (event) => {
    event.preventDefault();
    const response = await fetch('/profile/update/allfollow', {
      method: 'POST',
      body: JSON.stringify({ profile_id: user.id }),
      headers: {
        'Accept':       'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    const data = await response.json();
    console.log(data);
    setAll_follow_arr(data);
  }

  const back = (event) => {
    event.preventDefault();
    setAll_follow_arr([]);

  }



  // console.log(all_follow_arr.length == 0);
  return (
    <div className="followContainer">
      <h5 className="followContainer__header">{user.first_name} WATCH</h5>
      <div className="followContainer__medaillonContainer">
        {
          to_follow_arr.map((user, key) => {
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
          })
        }
        {
        (all_follow_arr.length == 0)
        ?
        (
          <div className="followContainer__medaillonBox followContainer__medaillonBox--all" onClick= { allfollow } >ALL</div>
        )
        :
        (
        <div className="followContainer__medaillonBox followContainer__medaillonBox--all" onClick= { back } >BACK</div>
        )
      }


      </div>

      {
        (all_follow_arr.length != 0)
        ?
        (
          <div className="followContainer__medaillonAllContainer">
            <h5 className="followContainer__header">ALL GOOD CHEFS</h5>
            <div className="followContainer__allBox followContainer__hide followContainer__hidefire">
              {to_follow_arr.map((user, key) => {
                return (
                  <div key={key} className="followContainer__medaillonwithname">
                    <div className="followContainer__medaillonBox">
                      <a href={`/profile/${user.id}`}>
                        <Medaillon 
                        user={user}
                        follow_style="to_follow"
                        />
                      </a>
                    </div>
                    <p>{user.first_name}</p>
                  </div>

                )
              })}
            </div>
          </div>
        )
        :null
      }

    </div>
  )
}

export default FollowersBox
