import React, { Component } from 'react';

class SignIn extends Component {
    state = {
        username: '',
        password: '',
        error: ''
    };

    handleInputChange = e => {
        const { name, value } = e.target;
        this.setState({
            [name]: value
        });
    };

    handleSubmit = e => {
        e.preventDefault();
        const { username, password } = this.state;
        if (username === 'admin' && password === 'password') {
            // Code à exécuter lorsque la connexion réussit
            console.log('Connexion réussie');
        } else {
            // Code à exécuter lorsque la connexion échoue
            this.setState({
                error: 'Nom d\'utilisateur ou mot de passe incorrect'
            });
        }
    };

    render() {
        const { username, password, error } = this.state;
        return (
            <form onSubmit={this.handleSubmit}>
                <label>
                    Nom d'utilisateur :
                    <input
                        type="text"
                        name="username"
                        value={username}
                        onChange={this.handleInputChange}
                    />
                </label>
                <label>
                    Mot de passe :
                    <input
                        type="password"
                        name="password"
                        value={password}
                        onChange={this.handleInputChange}
                    />
                </label>
                <button type="submit">Se connecter</button>
                {error && <div>{error}</div>}
            </form>
        );
    }
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




