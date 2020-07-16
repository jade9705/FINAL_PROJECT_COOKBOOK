import React, {useState, useEffect} from 'react'
import Medaillon from "./Medaillon.jsx";
import Bio from "./Bio.jsx";

const UserBox = ({user, logged_user_id}) => {
  const [hidden, setHidden] = useState('none');
  const [selectedFile, setSelectedFile] = useState(null);
  const [bio, setBio] = useState('');
  const [editeduser, setEditeduser] = useState({});
  const [arr_of_friends, setArr_of_friends] = useState([]);
  const [follow_style, setFollow_style] = useState('')
  // console.log('props user', user);
  // console.log('state user', editeduser);

  useEffect(() => {
    setEditeduser(user);
    
    // console.log('user_follower', user.user_followers )
    if (user.user_followers) {
      setArr_of_friends(user.user_followers);
    }

    if (user.bio) {
      setBio(user.bio)
    } else {
      setBio('Write something nice about you!')
    }
  }, [user])


  useEffect(() => {
    if(arr_of_friends.find((friend) => (friend.id == logged_user_id))) {
      setFollow_style('follow_style' )
    }else {
      setFollow_style('')
    }
  }, [arr_of_friends])



    //to follo someone
    const folow = () => {
      // console.log('follow');

      const fetchData = async () => {
        const response = await fetch('/profile/update/follow', {
          method: 'POST',
          body: JSON.stringify({ profile_id: user.id }),
          headers: {
            'Accept':       'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        const data = await response.json();
        // console.log(data);  
        setArr_of_friends(data);
      }
  
      fetchData();
    }

    const unfolow = () => {
      // console.log('unffollow');

      const fetchData = async () => {
        const response = await fetch('/profile/update/unfollow', {
          method: 'POST',
          body: JSON.stringify({ profile_id: user.id }),
          headers: {
            'Accept':       'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        const data = await response.json();
  
        // console.log(data);
  
        setArr_of_friends(data);
      }
  
      fetchData();
    }


  //switched from normal mode to editing mode and vice versa
  const setToEditMode = (event) => {
    event.preventDefault();
    if (hidden === 'none') {
      setHidden('')
    } else {
      setHidden('none')
    }
  }
  //save to state new file
  const handleFileChange = (event) => {
    setSelectedFile(event.target.files[0]);
  }
  //save to state new change of bio status
  const handleBioChange = (event) => {
    setBio(event.target.value);
  }
  //on submit send request and fetch response a save it to the state editeduser
  const handleOnSubmit = (event) => {
    event.preventDefault();

    const formData = new FormData();
    formData.append('file', selectedFile);
    formData.append('bio', bio );
    formData.append('user_id', user.id );

    const fetchData = async () => {
      const response = await fetch('/profile/update', {
        method: 'POST',
        body: formData,
        headers: {
          'Accept':       'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      const data = await response.json();

      // console.log(data);

      setEditeduser(data.user);
    }

    fetchData();
    setHidden('none');
  }

  // console.log('ahoj pred rendrem', follow_style);



  return (
    <div className="userBox">

      <form  encType="multipart/form-data" onSubmit={ handleOnSubmit } >

      <h2 className="userBox__name">Chef {user.first_name} {user.surname}</h2>
      <div className="userBox__medaillon" >
      {/* use this divfor set the size of medaillon */}
      <Medaillon user={editeduser} follow_style={follow_style} />
      </div>

      {
        hidden === 'none'
        ? 
        null
        :
        ( 
          <label className="userBox__upload" htmlFor="image_url">
            UPLOAD NEW IMAGE
            <input type="file" onChange= { handleFileChange } name="image_url" id="image_url" />
          </label>
        )
      }

      <Bio user={editeduser}/>
      <textarea className="userBox__textarea userBox__hide userBox__hidefire" style={{ display: `${hidden}` }} onChange= { handleBioChange } id="bio" rows="3" cols="50" value={bio}></textarea>

      {
        ((hidden === 'none') && (logged_user_id == user.id))
        ?
          (
            //click to edit profile
            <input className="userBox__input" type="button" value="Edit profile" onClick={setToEditMode} />
          )
        :
          hidden === 'none' && (arr_of_friends.find((friend) => (friend.id == logged_user_id)))
        ?
          (
            //click to UNfollow user
            <input className={`userBox__input ${follow_style}`} type="button" value="Unfollow this bumpkin" onClick={ unfolow }/>
          )
        :
          hidden === 'none'
        ?
          (
            //click to follow user
            <input className="userBox__input" type="button" value="Follow this good chef!" onClick={ folow }/>
          )
        :
          (
            //save or return from editing mode
            <div className="userBox__save-container">
              <input className="userBox__input" type="submit" value="SAVE" />
              <input className="userBox__input" type="button" value="RETURN" onClick={setToEditMode} />
            </div>
          )
      }

      {/* Hi, I am Vit from Prague and I really love to cook something nice to everyone who say it to me. :D Of course just JOKE :D */}


      </form>
    </div>


  )
}

export default UserBox
