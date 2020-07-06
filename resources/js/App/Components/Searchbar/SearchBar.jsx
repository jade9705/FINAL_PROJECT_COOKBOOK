import React, {useState, useEffect} from 'react'

const SearchBar = ({
  handleKeyPress,
  handleInputChange
}) => {


  return (
    <div className="searchBar" onKeyUp={handleKeyPress}>
      <label htmlFor="searchbar">
        <input
          id="searchbar"
          className="searchBar__input"
          type="text"
          onChange={handleInputChange}
          placeholder="Search by name of recipe"
        />
      </label>
    </div>
  )
}

export default SearchBar

