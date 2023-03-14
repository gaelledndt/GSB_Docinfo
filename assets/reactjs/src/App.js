import React from "react";
import Navbar from "./components/Navbar/Navbar";
import SignIn from "./pages/Auth/SignIn/SignIn";
import Dashboard from "./pages/Dashboard/Dashboard";
import Allergenic from "./pages/Allergenic/Allergenic";

const App = () => {
    return (
        <div>
        <Navbar/>
            {/*<Dashboard/>*/}
        <Allergenic/>
        {/*<SignIn/>*/}
        </div>
    )
}
export default App;
