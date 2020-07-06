import React, {useState, useEffect} from 'react'



export default function Recipe() {
    const [recipe, setRecipe] = useState(null);

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

     if(!recipe) {
         return <p>loading</p>
     }
    
    return (

        <>
            <div className="recipe">
                <h1 className="recipe__name">{recipe.title}</h1>
                <img src={`/images/uploads/${recipe.image_url}`} alt="some picture of food" className="recipe__img" />
                <p className="recipe__description">{recipe.description}</p>
                <label className="ingredients">Ingredients</label>
                <ul>
                  { recipe.ingredients.map((ingredient, index) => {
                            return <li key={index}>{ingredient.name} {ingredient.amount}</li>})}
                </ul>
                <label className="method">Method  </label>
                <ol>
                { recipe.steps.map((step, index) => {
                            return <li key={index}>{step.instruction}</li>})}
                       
                    </ol> 
                   
            </div>
           
        </>
        
    )

}