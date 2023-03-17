import './App.css';
import { BrowserRouter, Routes, Route} from "react-router-dom";
import DataProvider from './Context/DataProvider';

import Home from './Home/Home';
import VerifyAccount from './VerifyAccount/VerifyAccount';



function App() {
  return (
    <BrowserRouter>
      <DataProvider>
        <Routes>
          <Route exact path="/" element={<Home/>} />
          <Route exact path="/verify-account/:id" element={<VerifyAccount/>} />
        </Routes>
      </DataProvider>
    </BrowserRouter>
  );
}

export default App;
