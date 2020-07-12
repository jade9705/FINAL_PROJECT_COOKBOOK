import React, {useState, useEffect} from 'react'
import Medaillon from "./Medaillon.jsx";
import Bio from "./Bio.jsx";

const UserBox = ({user}) => {
  const [hidden, setHidden] = useState('none');
  const [selectedFile, setSelectedFile] = useState(null);
  const [bio, setBio] = useState('');
  const [editeduser, setEditeduser] = useState({})
  // console.log('props user', user);
  // console.log('state user', editeduser);

  useEffect(() => {
    setEditeduser(user);
  }, [user])

  useEffect(() => {
    if (user.bio == null) {
      setBio('Write something nice about you!')
    } else {
      setBio(user.bio)
    }
    }, [user])

  const setToEditMode = (event) => {
    event.preventDefault();
    if (hidden === 'none') {
      setHidden('')
    } else {
      setHidden('none')
    }
  }

  const handleFileChange = (event) => {
    setSelectedFile(event.target.files[0]);
  }

  const handleBioChange = (event) => {
    setBio(event.target.value);
  }

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

  // console.log('ahoj pred rendrem', bio);
  return (
    <div className="userBox">

      <form  encType="multipart/form-data" onSubmit={ handleOnSubmit } >
       
      <h2 className="userBox__name">Cooker {user.first_name} {user.surname}</h2>
      <div className="userBox__medaillon">
      {/* use this divfor set the size of medaillon */}
      <Medaillon user={editeduser}/>
      </div>

      {
        hidden === 'none'
        ? 
        null
        :
        ( 
          <label className="userBox__upload" htmlFor="image_url">
            <p>UPLOAD NEW IMAGE</p>
            <input type="file" onChange= { handleFileChange } name="image_url" id="image_url" />
          </label>
        )
      }

      <Bio user={editeduser}/>
      <textarea className="userBox__textarea" style={{ display: `${hidden}` }} onChange= { handleBioChange } id="bio" rows="3" cols="50" value={bio}></textarea>

      {
        hidden === 'none'
        ?
          (
            <>
            <input className="userBox__input" type="button" value="Edit profile" onClick={setToEditMode} />
            </>
          )
        :
          (
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
