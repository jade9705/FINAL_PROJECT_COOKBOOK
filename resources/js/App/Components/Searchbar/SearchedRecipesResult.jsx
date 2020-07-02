import React, {useState, useEffect} from 'react'
import RecipeBox from "../recipeBox/RecipeBox.jsx";

export default function SearchedRecipesResult({searchResult}) {

  let content = null;
  if(searchResult && searchResult.length > 0){
    content = (
      <>
        <h3>What would you like to eat?</h3>
        {
          searchResult.map((recipe, index) => {
            {/* here should be recipeBox component */}
            <RecipeBox
              recipe={recipe}
              key={index}
            />
          })
        }
      </>
    )
  } if (searchResult == null ) {
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
