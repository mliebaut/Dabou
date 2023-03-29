import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';

const VerifyAccount = () => {
    let {id} = useParams();
    const [responseType, setResponseType] = useState("");

    useEffect(() => {
        axios.put(`http://localhost:3000/verify-account`, {verifyToken : id}).then(response => {
            setResponseType(response.code || "no response");
        });
    }, [responseType]);

    return (
        <>
            <h1>Page Verification de compte: {id}</h1>
            <span>{responseType}</span>
        </>
    );
}

export default VerifyAccount;