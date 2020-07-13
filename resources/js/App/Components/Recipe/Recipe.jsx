import React, {useState, useEffect} from 'react'
import Medaillon from '../../../Profile/Components/Medaillon.jsx';



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
        setRecipe(recipe); 
        console.log(recipe);
        
      }

      // const authorUrl = recipe.id;
      // console.log(authorUrl)

     if(!recipe) {
         return <p>loading</p>
     }
    
    return (

      <>
        <div className="recipe">
          <div className="recipe__container1">
            <div className="recipe__imagey">
        <img src={`/images/uploads/${recipe.image_url}`} alt="some picture of food"  />
        </div>
        <p className="recipe__description">{recipe.description}</p>
            <label className="recipe__ingredients">Ingredients</label>
            <ul>
              { recipe.ingredients.map((ingredient, index) => {
                return <li key={index}> {ingredient.pivot.amount}  {ingredient.name} </li>})}
            </ul>
            </div>
            <div className="recipe__container2">
              <div className="recipe__medallion">
                <Medaillon user={recipe.users[0]} />
                </div>
            <h1 className="recipe__name">{recipe.title}</h1>

            <p>by <a href={`/profile/${recipe.user_id}`} className="recipeAuthor"><strong>{recipe.users[0].first_name} {recipe.users[0].surname}</strong></a></p>
                        
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