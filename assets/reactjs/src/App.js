import React, {useState} from "react";
import Navbar from "./components/Navbar/Navbar";
import SignIn from "./pages/Auth/SignIn/SignIn";
import Dashboard from "./pages/Dashboard/Dashboard";
import LegalNotice from "./pages/LegalNotice/LegalNotice";
import Allergenic from "./pages/Allergenic/Allergenic";
import Test from "./pages/Test/Test.js"
import MedicalStatus from "./pages/MedicalStatus/MedicalStatus";
import Parameter from "./pages/Parameters/Parameters";
import Prescription from "./pages/Prescription/Prescription";
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
                        <Route path={'/legalnotice'} element={<LegalNotice/>}/>
                        <Route path={'/allergenic'} element={<Allergenic allergenic={user?.allergenic}/>}/>
                        <Route path={'/test'} element={<Test/>}/>
                        <Route path={'/medicalstatus'} element={<MedicalStatus/>}/>
                        <Route path={'/parameter'} element={<Parameter/>}/>
                        <Route path={'/prescription'} element={<Prescription/>}/>
                    </Routes>

            }


        </BrowserRouter>
    )
}
export default App;
