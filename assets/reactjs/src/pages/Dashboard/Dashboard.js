import React, { useState } from 'react';
import '../../assets/styles/dashboard/dashboard.css';
import {Link} from "react-router-dom";

function Dashboard() {
    const CustomLink = ({ to, children }) => {
        return (
            <Link to={to} className="custom-link">
                {children}
            </Link>
        );
    };
    const [data, setData] = useState([
        {
            title: 'Vos tests',
            link: '/test',
            color: '#3498db'
        },
        {
            title: 'Vos allergies',
            link: '/allergenic',
            color: '#2ecc71'
        },
        {
            title: 'Vos prescriptions',
            link: '/prescription',
            color: '#f1c40f'
        },
        {
            title: 'Votre status médical',
            link: '/medicalstatus',
            color: '#e67e22'
        },
        {
            title: 'Paramètres',
            link: '/parameter',
            color: '#e74c3c'

        },
        {
            title: 'En savoir +',
            color: '#8a817c'

        }
    ]);

    return (
        <div>
            <h1>Tableau de bord</h1>
            <div style={{ display: 'flex', flexWrap: 'wrap'}}>
                {data.map((item, index) => (
                    <div className='card' key={index} style={{ width: '25%', padding: '10px' }}>
                        <CustomLink to={item.link}>
                            <div style={{ backgroundColor: item.color, height: '150px', borderRadius: '10px', display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                                <h2 style={{ color: '#fff' }}>{item.title}</h2>
                            </div>
                        </CustomLink>
                    </div>
                ))}
            </div>
        </div>
    );
}

export default Dashboard;