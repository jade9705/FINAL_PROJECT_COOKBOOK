import React from 'react'

const RecipeBox = ({recipe, key}) => {
  return (
    <div className="recipeBox"  key={key}>
      <div className="recipeBox__img"></div>
      <div className="recipeBox__rating"></div> 
      <p className="recipeBox__name">Name of recipe</p>
      <div className="recipeBox__description">this is some description...</div>
    </div>
  )
}

export default RecipeBox
