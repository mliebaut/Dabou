import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';

import './verifyAccount.css';

const VerifyAccount = () => {
    let {id} = useParams();
    const [responseType, setResponseType] = useState("");
    const [showPasswordForm, setShowPasswordForm] = useState(false);
    const [password, setPassword] = useState("");
    const [verifPassword, setVerifPassword] = useState("");
    const [email, setEmail] = useState("");
    const [passwordError, setPasswordError] = useState("");

    useEffect(() => {
        axios.post(`http://backend-dabou/backend/verify-account`, {verifyToken : id}).catch(error => {
            setResponseType("error");
            setShowPasswordForm(false);
        }).then(response => {
            setResponseType(response?.code || "no response");
            if(response?.code === 200)
            {
                setShowPasswordForm(true);
                setEmail(response?.email);
            }
            else
                setShowPasswordForm(false);
        });
    }, [responseType, id]);

    const onSubmitForm = (e) => {
        e.preventDefault();

        if(password.length === 0 || verifPassword.length === 0)
        {
            setPasswordError("Les mots de passes ne doivent pas être vide");
            return;
        }

        if(password !== verifPassword)
        {
            setPasswordError("Les mots de passe doivent être identiques");
            return;
        }

        setPasswordError("");
        const params = {
            headers : {
                "content-type" : "application/json; charset=UTF-8"
            },
            body: {
                email :email, 
                password: password
            },
            method: "POST"
        }

        fetch(`http://backend-dabou/backend/update-login`, params)
        .then(res=>console.log(res))
        .catch(error => console.error(error))
    }

    return (
        <>
            <h1>Page Verification de compte: {id}</h1>
            <span>{responseType}</span>

            {
                <form className='pwd-form' onSubmit={(e) => onSubmitForm(e)}>
                    {
                        passwordError === "" ? '' : (
                            <span className='pwd-form-error'>
                                {passwordError}
                            </span>
                        )
                    }
                    <div className='pwd-form-row'>
                        <label htmlFor='pwd' className='pwd-form-label'>Nouveau mot de passe</label>
                        <input type="password" name="pwd" className='pwd-form-input' value={password} onChange={(e) => setPassword(e.target.value)} />
                    </div>
                    <div className='pwd-form-row'>
                        <label htmlFor='pwd-verif' className='pwd-form-label'>Vérification mot de passe</label>
                        <input type="password" name="pwd-verif" className='pwd-form-input' value={verifPassword} onChange={(e) => setVerifPassword(e.target.value)} />
                    </div>
                    <button type="submit" className='pwd-form-submit'>Valider</button>
                </form>
            }
        </>
    );
}

export default VerifyAccount;