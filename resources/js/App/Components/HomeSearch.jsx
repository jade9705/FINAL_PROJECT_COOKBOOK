import React, {useState, useEffect} from 'react'
import SearchBar from "./Searchbar/SearchBar.jsx";
import SearchedRecipesResult from "./Searchbar/SearchedRecipesResult";
import TopRecipes from "./TopRecipes/TopRecipes.jsx";

const HomeSearch = () => {
  const [searchValue, setSearchValue] = useState('');
  const [searchResult, setSearchResult] = useState(null);
  const [topRecepi, setTopRecepi] = useState(null);

  // here shoud be fetch function takeRecipe with POST method of searchValue that take data from allrecipes endpoint 
  //In endpoint i need data about reating too for the stars

  const takeRecipes = async () => {
    // if(!searchValue) return;
    // const response = await fetch(``); //take endpoint here somehow
    // const recipes = await response.json();
    // console.log(recipes);
    // setSearchResult(recipes);
    console.log(searchValue);
  }

  //here should be useEfect to fetch toprecept from some endpoint 
  useEffect(() => {

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
    <div>
    <h1>CookBook</h1>
    <SearchBar
      handleKeyPress={handleKeyPress}
      handleInputChange={handleInputChange}
    />
    <h3>Top Rated This Week</h3>
    {/* here should be component TopRatedRecipe */}
    <TopRecipes 
      topRecepi={topRecepi}
    />


    {/* here should be component SearchedRecipesResult */}
    <SearchedRecipesResult
      searchResult={searchResult}
    />
    </div>
  )
}

export default HomeSearch
