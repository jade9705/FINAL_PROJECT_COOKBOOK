import React, { Component } from 'react'
import ProfileSideBar from "./Components/ProfileSideBar.jsx";
import ProfileCookBook from "./Components/ProfileCookBook.jsx";
import FavouriteMeal from "./Components/FavouriteMeal.jsx";


export default class Profile extends Component {
  state = {
    user: {},
    logged_user_id: null,
  }

  componentDidMount = () => {
    this.catchUser();
  }

  catchUser = async () => {
    const response = await fetch('/users/getprofile', {
      method: 'POST',
      body: JSON.stringify({ profile_id: profile_id }),
      headers: {
        'Accept':       'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')

      }
    });
    const data = await response.json();
    // console.log('potom co sto chytil', data);
    this.setState({
      user: data.user,
      logged_user_id: data.logged_user_id
    });
  }

  render() {
    return (
      <div className="profilePage">
        <div className="profilePage__leftSide">
          <ProfileCookBook user={this.state.user} logged_user_id={this.state.logged_user_id}/>
          <FavouriteMeal user={this.state.user} logged_user_id={this.state.logged_user_id}/>
        </div>
        <ProfileSideBar user={this.state.user} logged_user_id={this.state.logged_user_id}/>
      </div>
    )
  }
}
