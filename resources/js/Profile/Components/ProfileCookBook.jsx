import React, {useEffect, useState} from 'react'

const ProfileCookBook = ({user}) => {
  const [newestRecipes, setNewestRecipes] = useState([])

  useEffect(() => {
    fetchNewestRecipes()
  }, [])

  const fetchNewestRecipes = async () => {
    const response = await fetch('/api/search/newestrecipes', {
        method: 'POST',
        body: JSON.stringify({ user_id: user.id }),
        headers: {
          'Accept':       'application/json',
          'Content-Type': 'application/json',
        }
      });
  const newestRecipes = await response.json();
  setNewestRecipes(newestRecipes);
}



  return (
    <div className='profileCookBook'>
      <h2 className='profileCookBook__header'>{user.first_name} CookBook</h2>
      <div className='recipeContainer'>

      </div>
    </div>
  )
}

export default ProfileCookBook
