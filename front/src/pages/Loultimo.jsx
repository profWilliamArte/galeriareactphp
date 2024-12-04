import { useEffect, useState } from 'react';
const ruta="../src/assets/imgeventos/"
const API = 'http://localhost/galeria/back/api/eventos/geteventosloultimo.php';
const Loultimo = () => {
    const [datos, setDatos] = useState([]);


    const getDatos = async () => {
        try {
            const response = await fetch(API);
            const data = await response.json();
            setDatos(data);
        } catch (error) {
            console.error(error);
        }
    };

    useEffect(() => {
        getDatos();

    }, []);




    return (
        <>
            <div className="page-title dark-background aos-init aos-animate" data-aos="fade" style={{ backgroundImage: 'url(assets/img/page-title-bg.webp)' }}>
                <div className="container position-relative">
                    <h1>Ultimas Galerias</h1>
                    <nav className="breadcrumbs">
                        <ol>
                            <li><a href="index.html">Inicio</a></li>
                            <li className="current">Cumpleaños</li>
                        </ol>
                    </nav>
                </div>
            </div>


            <section id="blog-posts-2" className="blog-posts-2 section">
                <div className="container">
                    <div className="row gy-4">
                        {datos.map((item) => (


                            <div key={item.id} className="col-lg-3">
                                <article className="position-relative h-100">
                                    <div className="post-img position-relative overflow-hidden">
                                        <img src={ruta+item.imagen} className="img-fluid" alt=""  />
                                    </div>
                                    <div className="meta d-flex align-items-end">
                                        <span className="post-date"><span>12</span>December</span>
                                        <div className="d-flex align-items-center">
                                            <i className="bi bi-person" /> <span className="ps-2">{item.autor_nombre}</span>
                                        </div>
                                     
                                    </div>
                                    <div className="post-content d-flex flex-column">     
                                        <p>{item.categoria_nombre} / {item.tipo_evento_nombre}</p>
                                      
                                        <h3 className="post-title">{item.lugar}</h3>
                                        <a href="blog-details.html" className="readmore stretched-link"><i className="bi bi-arrow-right" /></a>
                                        <a href="blog-details.html" className="readmore stretched-link"><span>Read More</span><i className="bi bi-arrow-right" /></a>
                                    </div>
                                </article>
                            </div>
                        ))}
                    </div>
                </div>
            </section>
        </>
    )
}

export default Loultimo