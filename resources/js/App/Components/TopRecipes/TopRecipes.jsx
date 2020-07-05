import React from 'react'
import RecipeBox from "../recipeBox/RecipeBox.jsx";

const TopRecipes = ({topRecipe}) => {

  // console.log('hi', topRecipe);
  let content = null;
  if(topRecipe){
    content = (
      <>
        {
          topRecipe.map((recipe, index) => {
            return <RecipeBox
                      recipe={recipe}
                      key={index}
                  />
          })
        }
      </>
    )
  } else if (topRecipe == null ) {
      content = null
  } else {
    content = (
      <h3>Sorry, no results TopRecipes.jsx...</h3>
    )
  }

  return (
    <div className="topRecipesContainer">
      {content}
    </div>
  )
}

export default TopRecipes
