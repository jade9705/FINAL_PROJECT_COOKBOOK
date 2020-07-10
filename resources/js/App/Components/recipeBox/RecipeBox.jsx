import React from 'react'

const RecipeBox = ({recipe}) => {
  let content = null;

  if(recipe){
    content = (
      <div className="recipeBox" >
        <a  className="recipeBox__link" href={`/recipe/${recipe.id}`}>
          <img className="recipeBox__img" src={`http://localhost:3000/images/uploads/${recipe.image_url}`} alt={recipe.title} />
          <div className="recipeBox__rating"></div>
          <p className="recipeBox__title">{recipe.title}</p>
          <div className="recipeBox__description">{recipe.description}</div>
        </a>
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
