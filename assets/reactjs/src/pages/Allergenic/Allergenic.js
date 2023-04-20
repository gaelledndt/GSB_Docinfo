import React from 'react';
import "../../assets/styles/allergenic/allergenic.css";

function Allergenic({allergenic}) {
    return (
        <div>
            <h1>Vos allergies:</h1>
            {
                allergenic?.length !== 0 ?
                    <table>
                        <thead>
                        <tr>
                            <th>Les allergies</th>
                        </tr>
                        </thead>
                        <tbody>
                        {allergenic.map((allergy, index) => (
                            <tr key={index}>
                                <td>{allergy.name}</td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                    :
                    <p>Vous n'avez aucune allergie</p>
            }

        </div>
    );
}

export default Allergenic;