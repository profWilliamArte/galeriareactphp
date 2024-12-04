import { useEffect, useState } from "react";
import { Link } from "react-router-dom";


const Tipoevento = ({categoria}) => {
    const API=`http://localhost/galeria/back/api/tipoevento/getTipoeventoporCategoria.php?categoria=${categoria}`;
    const [datos, setDatos] = useState([])
    const getDatos = async () =>{
        try {
          const response = await fetch(API);
          const data = await response.json();
          //console.log(data)
          setDatos(data);
        } catch (error) {
          console.error(error)
        }
      };
      useEffect(()=>{
        getDatos();
      },[]);
  return (
    <>
        {datos && datos.map((item) => (
             <li key={item.id}><Link to={`/galerias/${item.nombre}`} href="#">{item.nombre}</Link></li>
         ))}
    </>
  )
}

export default Tipoevento