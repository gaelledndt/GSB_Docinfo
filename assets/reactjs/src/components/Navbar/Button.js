import React from 'react';
import '../../assets/styles/navbar/button.css';

const Button = ({ label, onClick }) => (
    <button className="button" onClick={onClick}>
        {label}
    </button>
);

export default Button;
