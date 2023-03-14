import React, {useState} from 'react';
import {login} from '../../../services/api/auth/authServices';
import medical from '../../../assets/styles/medical.png';

const SignIn = () => {
    const [user, setUser] = useState([]);
    const [authForm, setAuthForm] = useState({
        username: 'client@medecin.fr',
        password: 'client',
    });
    const [error, setError] = useState(false);

    const handleInputChange = e => {
        const {name, value} = e.target;
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
        <div className="signin-container">
            <form className="signin-form" onSubmit={async (e) => await handleSubmit(e)}>
                <label className="signin-label">
                    Email :
                    <input
                        className="signin-input"
                        type="text"
                        name="username"
                        value={authForm.username}
                        onChange={(e) => handleInputChange(e)}
                    />
                </label>
                <label className="signin-label">
                    Mot de passe :
                    <input
                        className="signin-input"
                        type="password"
                        name="password"
                        value={authForm.password}
                        onChange={(e) => handleInputChange(e)}
                    />
                </label>
                <button className="signin-button" type="submit">Se connecter</button>
                {error !== false && <div className="signin-error">{error}</div>}
            </form>
            <div className="signin-background" style={{backgroundImage: `url(${medical})`}}/>
        </div>
    );
};

export default SignIn;
