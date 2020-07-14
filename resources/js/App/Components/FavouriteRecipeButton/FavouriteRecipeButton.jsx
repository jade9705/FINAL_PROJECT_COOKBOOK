import React, {useState, useEffect} from 'react'

const FavouriteRecipeButton = ({recipe}) => {
const [arr_of_users_that_favourite, setarr_of_users_that_favourite] = useState([]);
const [logged_user, setLogged_user] = useState(null);
const [liked_style, setLiked_style] = useState(0);

  useEffect(() => {
    whofavourite();
  }, [])

  useEffect(() => {
    if(arr_of_users_that_favourite.find((user) => (user.id == logged_user))) {
      setLiked_style(1);
    }else {
      setLiked_style(0);
    }
  }, [arr_of_users_that_favourite])

  const whofavourite = async () => {
    console.log('whofavourite');
    const response = await fetch('/recipe/update/whofavourite', {
      method: 'POST',
      body: JSON.stringify({ recipe_id: recipe.id }),
      headers: {
        'Accept':       'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    });
    const data = await response.json();
    console.log(data);
    setarr_of_users_that_favourite(data.arr_of_users_that_favourite);
    setLogged_user(data.logged_user);
  };

  const favourite = async (event) => {
    event.preventDefault();
    console.log('favourite');
    const response = await fetch('/recipe/update/favourite', {
      method: 'POST',
      body: JSON.stringify({ recipe_id: recipe.id }),
      headers: {
        'Accept':       'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    });
    const data = await response.json();
    console.log(data);
    setarr_of_users_that_favourite(data.arr_of_users_that_favourite);
  };

  console.log('hi', arr_of_users_that_favourite, logged_user, 'liked', liked_style )

  return (
    <a className="fouvourite" onClick={ favourite }>
      <svg
        className="fouvourite__svg fouvourite__svg--liked "
        enableBackground="new 0 0 128 128" version="1.1" viewBox="0 0 128 128" xmlSpace="preserve" xmlns="http://www.w3.org/2000/svg">
        <path
        d="m115.08 22.981c-10.794-10.794-28.279-10.794-39.053 0l-12.027 12.027-12.026-12.027c-5.397-5.397-12.45-8.097-19.526-8.097-7.055 0-14.131 2.7-19.528 8.097-10.794 10.794-10.794 28.28 0 39.054l51.08 51.08 51.08-51.08c5.397-5.397 8.095-12.45 8.095-19.526 0-7.055-2.697-14.131-8.095-19.528z"
        />
      </svg>
    </a>
  )
}

export default FavouriteRecipeButton
