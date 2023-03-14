import React from 'react';
import '../../assets/styles/navbar/navbar.css';
import Button from "./Button"

function Navbar() {
    return (
        <nav className="navbar">
            <div className="navbar-title">GSB - Votre domaine de santé</div>
            <ul className="navbar-links">
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Vos informations</a></li>
                <li><a href="#">À propos</a></li>
                {/*<li><a href="#">Contact</a></li>*/}
            </ul>
            <Button label="Connexion" onClick={() => console.log("Connexion en cours...")} />
        </nav>
    );
}

export default Navbar;
