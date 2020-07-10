import React, {useEffect, useState} from 'react'
import RecipeBox from "../../App/Components/recipeBox/RecipeBox.jsx";

const ProfileCookBook = ({user}) => {
  const [newestRecipes, setNewestRecipes] = useState([])

  useEffect(() => {
    fetchNewestRecipes()
  },[user])

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

  let content = null;
  if(newestRecipes){
    content = (
      newestRecipes.map((recipe, index) => {
        return <RecipeBox
                  recipe={recipe}
                  key={index}
              />
      })
    )
  }

  return (
    <div className='profileCookBook'>
      <h2 className='profileCookBook__header'>{user.first_name}'s CookBook</h2>
      <div className='profileCookBook__recipeContainer'>
        {content}
      </div>
      <div className='profileCookBook__bottoms'>
        <a href="">view all</a>
        <a href="">add new</a>
      </div>
    </div>
  )
}

export default ProfileCookBook
