import React, {useState, useEffect} from 'react'

const RecipeImage = ({recipe}) => {
    return (
        <>
            {recipe ? <div className={`recipe__imagey`} style={{backgroundImage: `url("http://localhost:3000/images/uploads/${recipe.image_url}")`}}></div> : null}
        </>
    )
}

export default RecipeImage