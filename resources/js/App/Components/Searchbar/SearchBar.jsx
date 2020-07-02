import React, {useState, useEffect} from 'react'
import './style.scss'

const SearchBar = ({
  handleKeyPress,
  handleInputChange
}) => {


  return (
    <div className="searchBar" onKeyUp={handleKeyPress}>
      <label for="searchbar">
        <input
          id="searchbar"
          className="searchBar__input"
          type="text"
          onChange={handleInputChange}
          placeholder="Search by recipe name"
        />
      </label>
    </div>
  )
}

export default SearchBar

