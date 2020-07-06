import React from 'react';
import ReactDOM from 'react-dom';
import App from './App/Components/App.jsx';
import Recipe from './App/Components/Recipe/Recipe.jsx';



//homepage and searchbar
if(document.getElementById('app')){
    ReactDOM.render(<App />, document.getElementById('app'));
}

//rendered recipe page
if(document.getElementById('recipe')){
    ReactDOM.render(<Recipe />, document.getElementById('recipe'));
}