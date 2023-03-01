import React from 'react';
import { Link } from 'react-router-dom'

const NotFound = () => {
    return (
        <div className="not-found">
           <p>Error 404, page non trouvé</p>
            <Link to={'/'}>Retourner à la page d'accueil</Link>
        </div>
    );
}

export default NotFound;