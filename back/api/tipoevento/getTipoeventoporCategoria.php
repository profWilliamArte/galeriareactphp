<?php
require_once('../../config/permisos.php');
require_once('../../config/conexion.php');


if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    $stmt = $conn->prepare("SELECT * FROM `tipoevento` WHERE idcategoria = ?");
    $stmt->bind_param("i", $categoria); 
    $stmt->execute();
    $result = $stmt->get_result();
    $eventos = [];
    while ($row = $result->fetch_assoc()) {
        $eventos[] = $row;
    }
    echo json_encode($eventos);
} else {
    echo json_encode(['error' => 'Categoría no especificada']);
}

$conn->close();
?>