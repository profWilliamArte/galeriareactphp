<?php
require_once('../config/conexion.php');

$stmt = $conn->prepare("SELECT eventos.id,autor.nombre as autor, categorias.nombre as categoria, tipo_evento, lugar, descripcion,eventos.fecha FROM `eventos`
INNER JOIN autor on eventos.idautor=autor.id
INNER JOIN categorias on eventos.idcategoria=categorias.id
WHERE eventos.idestatus=1");
$stmt->execute();
$result = $stmt->get_result();

$eventos = [];
while ($row = $result->fetch_assoc()) {
    $eventos[] = $row;
}


echo json_encode($eventos);

$conn->close();
?>