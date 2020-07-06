import React, {useState, useEffect} from 'react'
import SearchBar from "./Searchbar/SearchBar.jsx";
import SearchedRecipesResult from "./Searchbar/SearchedRecipesResult";
import TopRecipes from "./TopRecipes/TopRecipes.jsx";

const HomeSearch = () => {
  const [searchValue, setSearchValue] = useState('');
  const [searchResult, setSearchResult] = useState(null);
  const [topRecipe, setTopRecipe] = useState(null);

  // here shoud be fetch function takeRecipe with POST method of searchValue that take data from allrecipes endpoint 
  //In endpoint i need data about reating too for the stars

  const takeRecipes = async () => {
    if(!searchValue) return;
    const response = await fetch('/api/search/recipes', {
      method: 'POST',
      body: JSON.stringify({searchValue: searchValue }),
      headers: {
        'Accept':       'application/json',
        'Content-Type': 'application/json',
      }
    })
    const recipes = await response.json();
    setSearchResult(recipes);
  }

  //here should be useEfect to fetch toprecept from some endpoint 
  useEffect(() => {
    const takeTopRecipes = async () => {
      const response = await fetch('api/toprecipes'); //warning! this endpoint return only recipes orderBy name!!!!
      const topRecipes = await response.json();
      setTopRecipe(topRecipes);
    }

    takeTopRecipes();
  }, [])

  // save current value to searchValue
  const handleInputChange = (e) => {
    setSearchValue(e.target.value);
  }

  // when you press enter it start searching 
  const handleKeyPress = (e) => {
    if (e.key === "Enter") takeRecipes();
  }

  
  return (
    <div className="homeSearch">
    <h1 className="homeSearch__header1">CookBook</h1>
    <SearchBar
      handleKeyPress={handleKeyPress}
      handleInputChange={handleInputChange}
    />
    <SearchedRecipesResult
      searchResult={searchResult}
    />
    <h3 className="homeSearch__header2">Top Rated This Week</h3>
    <TopRecipes 
      topRecipe={topRecipe}
    />
    </div>
  )
}

export default HomeSearch
