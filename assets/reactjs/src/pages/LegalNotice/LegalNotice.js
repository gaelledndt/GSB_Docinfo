import React from 'react';
import '../../assets/styles/legalnotice/legalnotice.css';

function LegalNotice() {
    return (
        <div>
            <h1>Mention légal</h1>
            <div className={"mention"}>
                <p className={"alert-warning"}>Attention fictif !!</p>
                <p>
                    Le présent site internet est édité par [nom de l'entreprise], société [forme juridique de
                    l'entreprise]
                    au capital de [montant du capital social] euros, immatriculée au Registre du Commerce et des
                    Sociétés de
                    [ville où est situé le RCS] sous le numéro [numéro RCS].
                </p>
                <p>
                    Siège social :
                </p>
                <p>
                    Téléphone : 06060708
                </p>
                <p>
                    Email : patron@outlook.com
                </p>
                <p>
                    Le directeur de la publication est [nom et prénom du directeur de la publication], en qualité de
                    [fonction au sein de l'entreprise].

                    Le présent site internet est hébergé par [nom de l'hébergeur], [adresse de l'hébergeur], [numéro de
                    téléphone de l'hébergeur].

                    Le contenu du site internet est la propriété exclusive de [nom de l'entreprise]. Toute reproduction
                    ou
                    représentation, intégrale ou partielle, est soumise à l'autorisation préalable de [nom de
                    l'entreprise].

                    Les informations recueillies sur le site internet font l'objet d'un traitement informatique destiné
                    à
                    [objet du traitement]. Les destinataires des données sont [liste des destinataires].
                </p>
                <p>
                    Conformément à la loi Informatique et Libertés du 6 janvier 1978 modifiée, vous disposez d'un droit
                    d'accès, de
                    rectification et de suppression des données vous concernant. Vous pouvez exercer ces droits en vous
                    adressant à [adresse e-mail ou postale de contact].

                    Le présent site internet utilise des cookies pour améliorer votre expérience de navigation. En
                    poursuivant votre navigation sur ce site, vous acceptez l'utilisation de cookies. Vous pouvez
                    toutefois
                    les désactiver en paramétrant votre navigateur.

                    Le présent site internet peut contenir des liens vers d'autres sites internet. [Nom de l'entreprise]
                    ne
                    saurait être responsable du contenu de ces sites ni des pratiques de ces sites en matière de
                    protection
                    des données à caractère personnel.

                    Ce site internet est régi par le droit français. Tout litige résultant de l'utilisation du site
                    internet
                    sera soumis à la compétence exclusive des tribunaux français.
                </p>
            </div>
        </div>
    )
}


export default LegalNotice;