import React, {useState, useEffect} from 'react'
import Medaillon from '../../../Profile/Components/Medaillon.jsx';
import RecipeImage from './RecipeImage.jsx';



export default function Recipe() {
    const [recipe, setRecipe] = useState(null);
    const [user, setUser] = useState(null);

    useEffect(() => {

        const url = window.location.href;
        const id =  url.substring(url.lastIndexOf("/") + 1);
        console.log(id);
        findRecipe(id);
    }, []);

    const findRecipe = async (id) => {
        
        const response = await fetch(`/api/recipe/${id}`, {
          method: 'GET',
          headers: {
            'Accept':       'application/json',
            'Content-Type': 'application/json',
          }
        })
        const recipe = await response.json();  
        console.log(recipe);
        setRecipe(recipe); 
        
      }

      // const authorUrl = recipe.id;
      // console.log(authorUrl)

     if(!recipe) {
         return (
           <div className="spinner-position">
            <div className="d-flex justify-content-center">
                <div className="spinner-border text-success spinner-border m-5"  role="status">
                  <span className="sr-only">Loading...</span>
                </div>
            </div>
          </div>
         )
     }
    
    return (

      <>
        <div className="recipe">
          <div className="recipe__hiddenName">
            <h1 className="recipe__hiddenTitle">{recipe.title}</h1>
            <p className="recipe__hiddenAuthor">by <a href={`/profile/${recipe.user_id}`} className="recipeAuthor"><strong>{recipe.user.first_name} {recipe.user.surname}</strong></a></p>

            </div>
          <div className="recipe__container1">
            <div className="recipe__imagey">

              <RecipeImage recipe={recipe}/>

            </div>
            <p className="recipe__description">{recipe.description}</p>

            <div className="recipe__ingredients-box">
              <label className="recipe__ingredients">Ingredients</label>
              <ul>
                { recipe.ingredients.map((ingredient, index) => {
                  return <li key={index}> {ingredient.pivot.amount}  {ingredient.name} </li>})}
              </ul> 
            </div>

          </div>

          <div className="recipe__container2">
              <div className="recipe__flexbox">
            <div className="recipe__medallion">
            <a href={`/profile/${recipe.user_id}`} className="recipeAuthor"><Medaillon user={recipe.user} /></a>
                </div>
            <h1 className="recipe__name">  {recipe.title}</h1>
            </div>
                
            <p>by <a href={`/profile/${recipe.user_id}`} className="recipeAuthor"><strong>{recipe.user.first_name} {recipe.user.surname}</strong></a></p>
                        
            <label className="recipe__method">Method  </label>
            <ol>
              { recipe.steps.map((step, index) => {
                 return <li className="recipe__methodlist"key={index}>{step.instruction}</li>})}
                    
            </ol> 
         </div>
         <div className="recipe__hiddenName">
         <label className="recipe__method">Method  </label>
            <ol>
              { recipe.steps.map((step, index) => {
                 return <li className="recipe__methodlist"key={index}>{step.instruction}</li>})}
                    
            </ol> 
         </div>
                
        </div>
          
      </>
        
    )

}