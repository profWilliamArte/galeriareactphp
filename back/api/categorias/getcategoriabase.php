<?php
require_once('../../config/permisos.php');
require_once('../../config/conexion.php');

$stmt = $conn->prepare("SELECT * FROM categorias");
$stmt->execute();
$result = $stmt->get_result();

$eventos = [];
while ($row = $result->fetch_assoc()) {
    $eventos[] = $row;
}


echo json_encode($eventos);

$conn->close();
?>