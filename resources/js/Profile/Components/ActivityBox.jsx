import React, {useState, useEffect} from 'react'

const ActivityBox = ({user}) => {
  const [activities, setActivities] = useState([]);

  useEffect(() => {
    fetchData();
  }, [user])


  const fetchData = async () => {
    if(Object.keys(user).length == 0){
      return null;
    }else{
      const response = await fetch('/profile/update/activitybox', {
        method: 'POST',
        body: JSON.stringify({ profile_id: user.id }),
        headers: {
          'Accept':       'application/json',
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      // Response is arr [num: howManyRecipes, num: howManyComments]
      const data = await response.json();
      setActivities(data);
    }
  }

  return (
    <div className="activityBox">
      <ul>
      <h5 className="activityBox__header">Activities</h5>
        {
          activities
          ?
          (
            <>
            <ul className="activityBox__ul">
              <li className="activityBox__li">recipes <span className="activityBox__number">{activities[0]}</span></li>
            </ul>
            <ul>
              <li className="activityBox__li">comments <span className="activityBox__number">{activities[1]}</span></li>
            </ul>
          </>
          )
          :
          null

        }
      </ul>
    </div>
  )
}

export default ActivityBox
