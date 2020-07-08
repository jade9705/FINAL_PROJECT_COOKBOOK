import React, { Component } from 'react'
import ProfileSideBar from "./Components/ProfileSideBar.jsx";
import ProfileCookBook from "./Components/ProfileCookBook.jsx";
import FavouriteMeal from "./Components/FavouriteMeal.jsx";

export default class Profile extends Component {
  state = {
    user: {}
  }

  componentDidMount = () => {
    this.catchUser();
  }

  catchUser = async () => {
    const response = await fetch('/users/current'); //apiendpoint of current user
    const user = await response.json();
    console.log('ahoj', user);
    this.setState({
      user: user,
    });
  }

  render() {
    return (
      <div className="profilePage">
        <div className="leftSide">
          <ProfileCookBook user={this.state.user}/>
          <FavouriteMeal />
        </div>
        <ProfileSideBar />
      </div>
    )
  }
}
