import React, { useState } from 'react';

import {login} from "../../../services/api/auth/authServices";

const SignIn = () => {
    const [user, setUser] = useState([])
    const [authForm, setAuthForm] = useState({
        username: 'client@medecin.fr',
        password: 'client'
    })
    const [error, setError] = useState(false)

    const handleInputChange = e => {
        const { name, value } = e.target;
        setAuthForm({
            ...authForm,
            [name]: value
        });
    };

    const handleSubmit = async e => {
        e.preventDefault();

        if (authForm.username.length === 0 || authForm.password.length === 0) {
            setError('Champs vide')
        } else {
            await login(authForm, setUser, setError)
        }
    };
        return (
            <form onSubmit={async (e) => await handleSubmit(e)}>
                <label>
                    Email :
                    <input
                        type="text"
                        name="username"
                        value={authForm.username}
                        onChange={(e) => handleInputChange(e)}
                    />
                </label>
                <label>
                    Mot de passe :
                    <input
                        type="password"
                        name="password"
                        value={authForm.password}
                        onChange={(e) => handleInputChange(e)}
                    />
                </label>
                <button type="submit">Se connecter</button>
                {error !== false && <div>{error}</div>}
            </form>
        );
}

export default SignIn;



/*
import React from 'react'

const SignIn = () => {
    return (
        <div>SignIn</div>
    )
}
export default SignIn;
*/




