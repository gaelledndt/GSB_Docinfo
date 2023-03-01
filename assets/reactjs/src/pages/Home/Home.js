import React from 'react';
import {
    WelcomeContainer,
    WelcomeContent,
    WelcomeImg,
    WelcomeContentText,
    WelcomeContentTitle,
    WelcomeText,
    Img
} from './HomeStyle';
import PizzaImg from '../../assets/laboratory.jpg';
const Home = () => {
    return (
        <div>
            <WelcomeContainer>
                <WelcomeContent>
                    <WelcomeImg>
                        <Img src={PizzaImg} alt=" Delious Pizza"/>
                    </WelcomeImg>
                    <WelcomeContentText>
                        <WelcomeContentTitle>Bienvenue sur votre espace de santé</WelcomeContentTitle>
                        <WelcomeText>
                            Nous sommes ravis que vous ayez choisi de nous confier la gestion de vos dossiers médicaux.
                        </WelcomeText>
                        <WelcomeText>
                            Notre application vous permettra de stocker toutes vos informations médicales importantes en toute sécurité et de les consulter facilement à tout moment.
                        </WelcomeText>
                    </WelcomeContentText>
                </WelcomeContent>


            </WelcomeContainer>

        </div>
    )
}

export default Home;

