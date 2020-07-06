import React, {useState, useEffect} from 'react'
import RecipeBox from "../recipeBox/RecipeBox.jsx";

export default function SearchedRecipesResult({searchResult}) {
  let content = null;

  if (searchResult === null) {
    content = null;
  } else if (searchResult.length > 0) {
    content = (
          // <div className="resultContainer">
    //   {content}
    // </div>
      <div className="resultContainer">
        <h3 className="resultContainer__header">This is the best results for you</h3>
        <div className="resultContainer__recipeBoxContainer">  
          {
            searchResult.map((recipe, index) => {
              return <RecipeBox
                        recipe={recipe}
                        key={index}
                    />
            })
          }
        </div>
      </div>
    )
  } else {
    content = (
      <div className="resultContainer">
        <h3 className="resultContainer__header">Sorry, no results...</h3>
      </div>
      )
  }

  return (
    <>
    { content }
    </>
  )
}
