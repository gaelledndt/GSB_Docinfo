import React from 'react';
import '../../assets/styles/navbar/navbar.css';

const Navbar = () => {
    return (
        <nav>
            <h1 className="logo">GSB</h1>
            <ul className="nav-links">
                <li><a href="#">Accueil</a></li>
                <li><a href="#">À propos</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    );
}

export default Navbar;
