import React, {useState} from "react";
import Navbar from "./components/Navbar/Navbar";
import SignIn from "./pages/Auth/SignIn/SignIn";
import Dashboard from "./pages/Dashboard/Dashboard";
import Allergenic from "./pages/Allergenic/Allergenic";
import {BrowserRouter, Route, Routes} from "react-router-dom";

const App = () => {
    const [user, setUser] = useState([]);
    console.log('user.allergenic ==>', user?.allergenic)
    return (
        <BrowserRouter>
            <Navbar user={user} setUser={setUser} />
            {
                user.length === 0 ?
                    <Routes>

                    <Route path={'/'} element={<SignIn setUser={setUser}/>}/>
                    </Routes>
                        :
                    <Routes>
                        <Route path={'/dashboard'} element={<Dashboard user={user}/>}/>
                        <Route path={'/allergenic'} element={<Allergenic allergenic={user?.allergenic}/>}/>
                    </Routes>

            }


        </BrowserRouter>
    )
}
export default App;
