import React, {useState} from 'react'
import Medaillon from "./Medaillon.jsx";

const SearchUsersBar = () => {
  const [searchValue, setSearchValue] = useState('');
  const [searchResult, setSearchResult] = useState([]);


  const handleInputChange = (event) => {
    setSearchValue(event.target.value);
  }

  const handleKeyPress = (event) => {
    if (event.key === "Enter") takeUsers();
  }

  const takeUsers = async () => {

    console.log('takeUsers');

    if(!searchValue) return;
    const response = await fetch('/search/all', {
      method: 'POST',
      body: JSON.stringify({searchValue: searchValue }),
      headers: {
        'Accept':       'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    const recipes = await response.json();
    console.log('data', recipes);
    setSearchResult(recipes);
  }

  console.log(searchValue);
  return (
    <div className="searchUserBar" >
      <h5 className="searchUserBar__header">FIND OTHERS</h5>

      <div className="searchUserBar__box" onKeyUp={handleKeyPress}>
        <label className="searchUserBar__label" htmlFor="searchbar">
          <input
            id="searchbar"
            className="searchUserBar__input"
            type="text"
            onChange={handleInputChange}
            placeholder="search for chef"
          />
        </label>
      </div>



      {
        (searchResult.length != 0)
        ?
        (
          //the wierd name of className is here becouse i am catching it from the nedaillon style sheet
          <div className="followContainer__medaillonAllContainer">
            {/* <h5 className="followContainer__header">ALL GOOD CHEFS</h5> */}
            <div className="followContainer__allBox followContainer__hide followContainer__hidefire">
              {searchResult.map((user, key) => {
                return (
                  <div key={key} className="followContainer__medaillonwithname">
                    <div className="followContainer__medaillonBox">
                      <a href={`/profile/${user.id}`}>
                        <Medaillon 
                        user={user}
                        follow_style="to_follow"
                        />
                      </a>
                    </div>
                    <p>{user.first_name}</p>
                  </div>

                )
              })}
            </div>
          </div>
        )
        :null
      }



    </div>

  )
}
// onKeyUp={handleKeyPress} IN className="searchBar"
// onChange={handleInputChange} IN className="searchBar__input"
export default SearchUsersBar
