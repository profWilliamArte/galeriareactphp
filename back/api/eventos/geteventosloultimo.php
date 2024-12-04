<?php
require_once('../../config/permisos.php');
require_once('../../config/conexion.php');

$stmt = $conn->prepare("SELECT eventos.*, autor.nombre AS autor_nombre, categorias.nombre AS categoria_nombre, tipoevento.nombre AS tipo_evento_nombre, detalleevento.imagen
    FROM eventos
    INNER JOIN autor ON eventos.idautor = autor.id
    INNER JOIN categorias ON eventos.idcategoria = categorias.id
    INNER JOIN tipoevento ON eventos.idtipoevento = tipoevento.id
    INNER JOIN 
        (SELECT idevento, MIN(imagen) AS imagen FROM detalleevento GROUP BY idevento) AS detalleevento ON eventos.id = detalleevento.idevento;");
$stmt->execute();
$result = $stmt->get_result();

$eventos = [];
while ($row = $result->fetch_assoc()) {
    $eventos[] = $row;
}


echo json_encode($eventos);

$conn->close();
?>