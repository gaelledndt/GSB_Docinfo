import React from 'react';
import '../../assets/styles/navbar/navbar.css';
import Button from "./Button"
import {Link} from "react-router-dom";



function Navbar({ user, setUser }) {
    return (
        <nav className="navbar">
            <div className="navbar-title">GSB - Votre domaine de santé</div>
            {
                user.length !== 0 &&
            <ul className="navbar-links">
                <li><Link to="/dashboard">Accueil</Link></li>
                <li><Link to="#">Vos informations</Link></li>
                <li><Link to="#">À propos</Link></li>
                <li><Link to="#">Mention légale</Link></li>
            </ul>
            }
            {
                user.length !== 0 ?
                    <Button label="Déconnexion" onClick={() => setUser([])} />
                    :
                    <Link to={'/'}>Connexion</Link>
            }
            {/*<Button label="Connexion" onClick={() => console.log("Connexion en cours...")} />*/}
        </nav>
    );
}

export default Navbar;
