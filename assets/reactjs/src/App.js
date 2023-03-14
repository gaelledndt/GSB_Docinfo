import React from "react";
import Navbar from "./components/Navbar/Navbar";
import SignIn from "./pages/Auth/SignIn/SignIn";
import Dashboard from "./pages/Dashboard/Dashboard";

const App = () => {
    return (
        <div>
        <Navbar/>
            <Dashboard/>
        {/*<SignIn/>*/}
        </div>
    )
}
export default App;
