import React from 'react'
import RecipeBox from "../recipeBox/RecipeBox.jsx";

const TopRecipes = ({TopRecipe}) => {

  let content = null;
  if(TopRecipe && TopRecipe.length > 0){
    content = (
      <>
        <h3>What would you like to eat?</h3>
        {
          TopRecipe.map((recipe, index) => {
            {/* here should be recipeBox component */}
            <RecipeBox
              recipe={recipe}
              key={index}
            />
          })
        }
      </>
    )
  } if (TopRecipe == null ) {
      content = null
  } else {
    content = (
      <h3>Sorry, no results...</h3>
    )
  }


  return (
    <div className="resultContainer">
      <h1>ahoj tady result</h1>
      {content}
      <RecipeBox />
    </div>
  )
}

export default TopRecipes
