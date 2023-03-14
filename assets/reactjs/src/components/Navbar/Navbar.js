import React from 'react';
import '../../assets/styles/navbar/navbar.css';

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
            <button>Connection/SignUp</button>
        </nav>
    );
}

export default Navbar;
