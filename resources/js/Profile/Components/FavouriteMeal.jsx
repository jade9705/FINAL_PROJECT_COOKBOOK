import React, {useEffect, useState} from 'react'
import RecipeBox from "../../App/Components/recipeBox/RecipeBox.jsx";

const FavouriteMeal = ({user}) => {
  const [recipe, setRecipe] = useState([]);
  const [all, seTall] = useState(false);

  useEffect(() => {
    fetchNewestLiked()
  }, [user])

  const fetchNewestLiked = async (event) => {
    event ? event.preventDefault() : null;
    if(!user.id) return;
    const response = await fetch(`/api/favourite/newestliked/${user.id}`); 
    const newestLiked = await response.json();
    setRecipe(newestLiked);
    seTall(false);
  }

  const fetchAllUserRecipes = async (event) => {
    event.preventDefault();
    if(!user.id) return;
    const response = await fetch(`/api/favourite/allliked/${user.id}`); 
    const allrecepe = await response.json();
    setRecipe(allrecepe);
    seTall(true);
  }

  let content = null;
  if(recipe){
    content = (
      recipe.map((recipe, index) => {
        return <RecipeBox
                  recipe={recipe}
                  key={index}
              />
      })
    )
  }

  return (
    <div className='favouriteMeal'>
      <h2 className='favouriteMeal__header'>Favourite recipes</h2>
      <div className='favouriteMeal__buttons'>
        {
          all ? <a href="" onClick={ fetchNewestLiked } >view newest</a> : <a href="" onClick={ fetchAllUserRecipes } >view all</a>
        }
      </div>
      <div className='favouriteMeal__recipeContainer'>
        {content}
      </div>
    </div>
  )
}

export default FavouriteMeal