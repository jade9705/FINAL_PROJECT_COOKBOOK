import React, {useState, useEffect} from 'react'
import './style.scss'


export default function Recipe(id) {

    const findRecipe = async () => {
        
        const response = await fetch(`/recipes/${id}`, {
          method: 'POST',
          body: JSON.stringify({searchValue: searchValue }),
          headers: {
            'Accept':       'application/json',
            'Content-Type': 'application/json',
          }
        })
        const recipes = await response.json();
        
      }

    return (

        <>
            <h1>{recipes}</h1>
            
        </>
        
    )

}