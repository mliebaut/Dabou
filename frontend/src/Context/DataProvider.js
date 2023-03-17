import React from 'react';
import ContextData from './ContextData';

const DataProvider = (props) => {
    return (
        <ContextData.Provider value = {{
            credentials: "",
            userData: {},
            setCredentials: () => {},
            setUserData: () => {}
        }}>
            {props.children}
        </ContextData.Provider>
    )
}

export default DataProvider;