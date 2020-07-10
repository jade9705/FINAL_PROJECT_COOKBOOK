import React, {useEffect, useState} from 'react'
import RecipeBox from "../../App/Components/recipeBox/RecipeBox.jsx";

const FavouriteMeal = ({user}) => {
  const [newestLiked, setNewestLiked] = useState([]);

  useEffect(() => {
    fetchNewestLiked()
  },[user])

  const fetchNewestLiked = async () => {
    const response = await fetch('/api/search/newestliked'); //fake!!!!! in future remake to post method and fetch liked recipe
    const newestLiked = await response.json();
    setNewestLiked(newestLiked);
  }

  let content = null;
  if(newestLiked){
    content = (
      newestLiked.map((recipe, index) => {
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
      <div className='favouriteMeal__recipeContainer'>
        {content}
      </div>
      <div className='favouriteMeal__buttons'>
        <a href="">view all</a>
      </div>
    </div>
  )
}

export default FavouriteMeal