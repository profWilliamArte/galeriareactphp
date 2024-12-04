import { useParams } from "react-router-dom";


const Galeria = () => {
    const tipoevento = useParams();
    console.log(tipoevento)
  return (
    
    <h3 className="text-center py-4">Galerias de {tipoevento.tipo}</h3>
  )
}

export default Galeria