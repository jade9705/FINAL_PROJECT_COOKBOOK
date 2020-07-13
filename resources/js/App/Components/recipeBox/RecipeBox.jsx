import React, {useEffect, useState} from 'react';
import AverangeRating from "../AverangeRating/AverageRating.jsx";

const RecipeBox = ({recipe}) => {
  const [averageRating, setAverageRating] = useState(0);
  // let content = null;

  useEffect(() => {
    fetchAverageRating();
  }, [recipe])
  

  const fetchAverageRating = async () => {
    console.log('recipe_id:', recipe.id);
    const response = await fetch('/average', {
      method: 'POST',
      body: JSON.stringify({ recipe_id: recipe.id }),
      headers: {
        'Accept':       'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    const data = await response.json();

    console.log('právě jsem chytnul average', data);

    setAverageRating(data);
  }

  console.log('before render', averageRating);
  return (
    <>
    {
      recipe
      ?
      (
        <div className="recipeBox" >
          <a  className="recipeBox__link" href={`/recipe/${recipe.id}`}>
            <img className="recipeBox__img" src={`http://localhost:3000/images/uploads/${recipe.image_url}`} alt={recipe.title} />
            <AverangeRating averageRating={averageRating}/>
            <p className="recipeBox__title">{recipe.title}</p>
            <div className="recipeBox__description">{recipe.description}</div>
          </a>
        </div>
      )
      :
      null
    }
    </>
  )
}

export default RecipeBox
