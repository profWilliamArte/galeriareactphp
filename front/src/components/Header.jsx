
import { Link } from 'react-router-dom'
import logo from '../assets/img/logogaleria.png'
import Tipoevento from './filtros/Tipoevento'
const Header = () => {
  return (
<header id="header" className="header d-flex align-items-center position-relative border-bottom">
  <div className="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
    <a href="index.html" className="logo d-flex align-items-center">
      {/* Uncomment the line below if you also wish to use an image logo */}
      <img src={logo} alt="Faleria Familiar" />
      {/* <h1 class="sitename">Galeria Familiar</h1>  */}
    </a>
    <nav id="navmenu" className="navmenu">
      <ul>
        <li><Link to="/inicio" href="index.html" className="active">Inicio</Link></li>
        <li><Link to="/loultimo" href="about.html">Lo Ultimo</Link></li>
      
        <li className="dropdown"><a href="#"><span>Familiar</span> <i className="bi bi-chevron-down toggle-dropdown" /></a>
          <ul>
            <Tipoevento categoria={1} />
          </ul>
        </li>
        <li className="dropdown"><a href="#"><span>Recreativo</span> <i className="bi bi-chevron-down toggle-dropdown" /></a>
          <ul>
            <Tipoevento categoria={2} />
          </ul>
        </li>

        <li><Link to="/categorias" href="#" className="btn btn-info p-2 me-2">Categorias</Link></li>
        <li><Link to="/tipoevento" href="#" className="btn btn-info p-2 me-2">Tipo Evento</Link></li>
        <li><Link to="/creargaleria" href="#" className="btn btn-info p-2 me-2">Crear Galeria</Link></li>

        <li><a href="#" className='btn btn-success p-3 text-white me-2'>Login</a></li>
      </ul>
      <i className="mobile-nav-toggle d-xl-none bi bi-list" />
    </nav>
  </div>
</header>

  )
}

export default Header