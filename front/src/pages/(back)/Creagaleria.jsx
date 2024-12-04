import { useEffect, useState } from 'react';

const API_CATEGORIAS = 'http://localhost/galeria/back/api/categorias/getcategoriabase.php';
const API_TIPOEVENTO = 'http://localhost/galeria/back/api/tipoevento/gettipoeventobase.php';
const API_POSTEVENTO = 'http://localhost/galeria/back/api/eventos/postevento.php';

const Creagaleria = ({ autor }) => {
    const [formData, setFormData] = useState({
        idautor: autor, // Asignar el autor directamente
        idcategoria: '',
        idtipoevento: '',
        lugar: '',
        fecha: '',
        descripcion: ''
    });

    const [categorias, setCategorias] = useState([]);
    const [tipoevento, setTipoevento] = useState([]);
    const [imagenes, setImagenes] = useState([]); // Manejar múltiples imágenes

    const getCategorias = async () => {
        try {
            const response = await fetch(API_CATEGORIAS);
            const data = await response.json();
            setCategorias(data);
        } catch (error) {
            console.error(error);
        }
    };

    const getTipoevento = async () => {
        try {
            const response = await fetch(API_TIPOEVENTO);
            const data = await response.json();
            setTipoevento(data);
        } catch (error) {
            console.error(error);
        }
    };

    useEffect(() => {
        getCategorias();
        getTipoevento();
    }, []);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const dataToSend = new FormData();
        Object.keys(formData).forEach(key => {
            dataToSend.append(key, formData[key]);
        });
        for (let i = 0; i < imagenes.length; i++) {
            dataToSend.append('imagen[]', imagenes[i]);
        }
     // Mostrar los valores de FormData en la consola
     for (let [key, value] of dataToSend.entries()) {
        console.log(`${key}:`, value);
    }
        try {
            const response = await fetch(API_POSTEVENTO, {
                method: 'POST',
                body: dataToSend,
            });
          
            const result = await response.text();
            console.log(result);
           

        } catch (error) {
            console.error('Error:', error);
        }
    };

    return (
        <div className="container mt-5 border p-5">
            <h5 className='text-center'>Subir una Galería de Fotos</h5>
            <form onSubmit={handleSubmit}>
                <div className="mb-3">
                    <label htmlFor="autor" className="form-label">Autor</label>
                    <input
                        type="text"
                        className="form-control"
                        id="autor"
                        value={formData.idautor} // Mostrar el autor pasado como prop
                        readOnly // Si el autor no debe ser editable
                    />
                </div>
                <div className="mb-3">
                    <label htmlFor="idcategoria" className="form-label">Categoría:</label>
                    <select id="idcategoria" name="idcategoria" className="form-select" onChange={handleChange} required>
                        <option value="">Seleccione una Categoría</option>
                        {categorias.map(item => (
                            <option key={item.id} value={item.id}>{item.nombre}</option>
                        ))}
                    </select>
                </div>
                <div className="mb-3">
                    <label htmlFor="idtipoevento" className="form-label">Tipo Evento:</label>
                    <select id="idtipoevento" name="idtipoevento" className="form-select" onChange={handleChange} required>
                        <option value="">Seleccione un Tipo de Evento</option>
                        {tipoevento.map(item => (
                            <option key={item.id} value={item.id}>{item.nombre}</option>
                        ))}
                    </select>
                </div>
                <div className="mb-3">
                    <label htmlFor="lugar" className="form-label">Lugar</label>
                    <input
                        type="text"
                        className="form-control"
                        id="lugar"
                        name="lugar"
                        value={formData.lugar}
                        onChange={handleChange}
                        placeholder="Introduce el lugar del evento"
                        required
                    />
                </div>
                <div className="mb-3">
                    <label htmlFor="fecha" className="form-label">Fecha</label>
                    <input
                        type="date"
                        className="form-control"
                        id="fecha"
                        name="fecha"
                        value={formData.fecha}
                        onChange={handleChange}
                        required
                    />
                </div>
                <div className="mb-3">
                    <label htmlFor="descripcion" className="form-label">Descripción</label>
                    <textarea
                        className="form-control"
                        id="descripcion"
                        name="descripcion"
                        rows="3"
                        value={formData.descripcion}
                        onChange={handleChange}
                        placeholder="Escribe una descripción"
                        required
                    ></textarea>
                </div>
                <div className="mb-3">
                    <label htmlFor="imagen" className="form-label">Selecciona imágenes</label>
                    <input
                        className="form-control"
                        type="file"
                        id="imagen"
                        accept="image/*"
                        onChange={(e) => setImagenes(Array.from(e.target.files))} // Almacenar múltiples archivos
                        multiple // Permitir selección de múltiples archivos
                        required
                    />
                </div>
                <button type="submit" className="btn btn-primary">Enviar</button>
            </form>
        </div>
    );
}

export default Creagaleria;