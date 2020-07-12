import React, {useEffect, useState} from 'react'
import RecipeBox from "../../App/Components/recipeBox/RecipeBox.jsx";

const ProfileCookBook = ({user}) => {
  const [recipes, setRecipes] = useState([]);
  const [clickedAllrecipes, setClickedAllrecipes] = useState(false);

  useEffect(() => {
    fetchNewestRecipes()
  },[user])

  const fetchNewestRecipes = async (event) => {
    event ? event.preventDefault() : null;
    const response = await fetch('/api/search/newestrecipes', {
        method: 'POST',
        body: JSON.stringify({ user_id: user.id }),
        headers: {
          'Accept':       'application/json',
          'Content-Type': 'application/json',
        }
      });
    const newestRecipes = await response.json();
    setRecipes(newestRecipes);
    setClickedAllrecipes(false);
  }

  const fetchAllUserRecipes = async (event) => {
    event.preventDefault();
    console.log(`/api/cookbook/${user.id}`);
    const response = await fetch(`/api/cookbook/${user.id}`);
    const allUsersRecipes = await response.json();
    console.log(allUsersRecipes);

    setRecipes(allUsersRecipes);
    setClickedAllrecipes(true);
  }

  let content = null;
  if(recipes){
    content = (
      recipes.map((recipe, index) => {
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
      <div className='profileCookBook__buttons'>
        {
          clickedAllrecipes ? <a href="" onClick={ fetchNewestRecipes } >view newest</a> : <a href="" onClick={ fetchAllUserRecipes } >view all</a>
        }
        
        <a href="http://localhost:3000/create">add new</a>
      </div>
      <div className='profileCookBook__recipeContainer'>
        {content}
      </div>
    </div>
  )
}

export default ProfileCookBook
