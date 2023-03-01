import React from "react";
import "./Items.css"

function Items() {
    const elements = [
        {
            id: 1,
            titre: "Element 1",
            description: "Description de l'élément 1",
        },
        {
            id: 2,
            titre: "Element 2",
            description: "Description de l'élément 2",
        },
        {
            id: 3,
            titre: "Element 3",
            description: "Description de l'élément 3",
        },
    ];

    const tableauElements = elements.map((element) => (
        <table key={element.id}>
            <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{element.titre}</td>
                <td>{element.description}</td>
            </tr>
            </tbody>
        </table>
    ));

    return <div>{tableauElements}</div>;
}

export default Items;
