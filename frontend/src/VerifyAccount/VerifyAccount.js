import React from 'react';
import { useParams } from 'react-router-dom';

const VerifyAccount = () => {

    let {id} = useParams();

    return (
        <h1>Page Verification de compte: {id}</h1>
    );
}

export default VerifyAccount;