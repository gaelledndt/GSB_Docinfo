import React from 'react';
import "../../assets/styles/allergenic/allergenic.css";

function Allergenic() {
    const allergies = ['Peanuts', 'Shellfish', 'Pollens'];
    return (
        <div>
            <h1>Vos allergies:</h1>
            <table>
                <thead>
                <tr>
                    <th>Les allergies</th>
                </tr>
                </thead>
                <tbody>
                {allergies.map((allergy, index) => (
                    <tr key={index}>
                        <td>{allergy}</td>
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
}

export default Allergenic;