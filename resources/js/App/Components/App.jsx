import React from 'react';
import HomeSearch from "./HomeSearch";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";

export default class App extends React.Component {

    render() {
        return (
            <>
            {/* <Router>
                <div className="app">
                <Switch>
                    <Route exact path="/" component={Components/HomeSearch} />
                    <Route path="/recipes/{id}" component={Recipe} />
                </Switch>
                </div>
            </Router> */}
           
            <HomeSearch />
            </>
        )
    }
}