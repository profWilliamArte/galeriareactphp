<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../config/conexion.php');

header('Content-Type: application/json'); // Set the content type to JSON

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare the query to get the gallery details
    $stmt = $conn->prepare("SELECT g.nombre, g.descripcion, d.imagen, d.id 
                            FROM galeria g 
                            LEFT JOIN detallegaleria d ON g.id = d.idgaleria 
                            WHERE g.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $galeriaDetails = [
        'nombre' => '',
        'descripcion' => '',
        'imagenes' => []
    ];

    while ($row = $result->fetch_assoc()) {
        if (empty($galeriaDetails['nombre'])) {
            $galeriaDetails['nombre'] = $row['nombre'];
            $galeriaDetails['descripcion'] = $row['descripcion'];
        }
        $galeriaDetails['imagenes'][] = [
            'id' => $row['id'],
            'imagen' => $row['imagen']
        ];
    }

    // Return the gallery details in JSON format
    echo json_encode($galeriaDetails);
} else {
    // Return an error message in JSON format
    echo json_encode(['error' => 'No gallery ID provided']);
}

$conn->close();
?>