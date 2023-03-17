import React from 'react';
const ContextData = React.createContext({
    credentials: "",
    userData: {},
    setCredentials: () => {},
    setUserData: () => {}
});

export default ContextData;