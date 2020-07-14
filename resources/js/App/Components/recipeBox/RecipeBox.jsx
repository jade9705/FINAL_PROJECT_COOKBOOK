import React, {useEffect, useState} from 'react';
import AverangeRating from "../AverangeRating/AverageRating.jsx";
import FavouriteRecipeButton from "../FavouriteRecipeButton/FavouriteRecipeButton.jsx";

const RecipeBox = ({recipe}) => {
  const [averageRating, setAverageRating] = useState(0);
  // const [spinner, setSpinner] = useState(0);
  // let content = null;

  useEffect(() => {
    fetchAverageRating();
  }, [recipe])
  

  const fetchAverageRating = async () => {
    // console.log('recipe_id:', recipe.id);
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

    // console.log('právě jsem chytnul average', data);
    
    setAverageRating(data);
  }



  // console.log('spinner', spinner)
  // if (spinner == 0) {
  //   return (
  //     <>
  //       <div classNmae="d-flex justify-content-center">
  //         <div className="spinner-border text-success"  role="status">
  //           <span className="sr-only">Loading...</span>
  //         </div>
  //       </div>
  //     </>
  //   )
  // }
  
  return (
    <>
    {
      recipe
      ?
      (
        <div className="recipeBox" >
          <a  className="recipeBox__link" href={`/recipe/${recipe.id}`}>
            {/* <img className="recipeBox__img" src={`http://localhost:3000/images/uploads/${recipe.image_url}`} alt={recipe.title} /> */}
            <div className="recipeBox__img" style={{backgroundImage: `url("http://localhost:3000/images/uploads/${recipe.image_url}")`}}></div>
            <div className="recipeBox__avelikeBox">
            <AverangeRating averageRating={averageRating}/>
            <div className="recipeBox__sizeOfHeart">
              <FavouriteRecipeButton recipe={recipe} />
            </div>
            </div>
            <p className="recipeBox__title">{recipe.title}</p>
            <div className="recipeBox__description">{recipe.description}</div>
          </a>
          
        </div>
      )
      :
      (
        <div classNmae="d-flex justify-content-center">
          <div class="spinner-border text-success"  role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      )
    }
    </>
  )
}

export default RecipeBox
