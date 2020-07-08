import React from 'react';
import ReactDOM from 'react-dom';
import App from './App/Components/App.jsx';
import Recipe from './App/Components/Recipe/Recipe.jsx';
import Profile from './Profile/Profile.jsx';



//homepage and searchbar
if(document.getElementById('app')){
    ReactDOM.render(<App />, document.getElementById('app'));
}

//rendered recipe page
if(document.getElementById('recipe')){
    ReactDOM.render(<Recipe />, document.getElementById('recipe'));
}


//rendered profile page
if(document.getElementById('profile')){
    ReactDOM.render(<Profile />, document.getElementById('profile'));
}