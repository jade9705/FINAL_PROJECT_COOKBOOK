import React from 'react'

const RecipeBox = ({recipe}) => {
  let content = null;

  if(recipe){
    content = (
      <div className="recipeBox" >
        <img className="recipeBox__img" src={`images/uploads/${recipe.image_url}`} alt={recipe.title} />
        <div className="recipeBox__rating"></div>
        <p className="recipeBox__title">{recipe.title}</p>
        <div className="recipeBox__description">{recipe.description}</div>
      </div>
    )
  }

  return (
    <>
    {content}
    </>
  )
}

export default RecipeBox
