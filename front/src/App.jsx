import { BrowserRouter, Route, Routes } from "react-router-dom"
import Header from "./components/Header"
import Footer from "./components/Footer"
import Inicio from "./pages/Inicio"
import Galeria from "./pages/Galeria"
import Loultimo from "./pages/Loultimo"
import Creagaleria from "./pages/(back)/Creagaleria"


const App = () => {
  return (
    <div className="app">

  
   <BrowserRouter>
    <Header/>
    <main>
      <Routes>
        <Route path="/" element={<Inicio/>}/>
        <Route path="/inicio" element={<Inicio/>}/>
        <Route path="/loultimo" element={<Loultimo/>}/>
        <Route path="/galerias/:tipo" element={<Galeria/>}/>

        <Route path="/creargaleria" element={<Creagaleria autor={1}/>}/>
        <Route path="*" element={<Inicio/>}/>
      </Routes>
    </main>
    <Footer/>
   </BrowserRouter>
   </div>
  )
}

export default App