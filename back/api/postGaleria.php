<?php
require_once('../config/permisos.php');
require_once('../config/conexion.php');

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar los datos de entrada
	$autor = htmlspecialchars(trim($_POST['autor']));
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $fecha = Date('Y/m/d');


 
    // Manejo de la imagen
    $imagen = $_FILES['imagen'];

    // Validar que se haya subido un archivo
    if ($imagen['error'] !== UPLOAD_ERR_OK) {
        die("Error al subir la imagen.");
    }

    // Validar el tipo de archivo
    $tipoArchivo = mime_content_type($imagen['tmp_name']);
    $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($tipoArchivo, $tiposPermitidos)) {
        die("Tipo de archivo no permitido. Solo se permiten imágenes JPEG, PNG y GIF.");
    }

    // Generar un hash para el nombre de la imagen
    $imagenNombre = basename($imagen['name']);
    $hashNombre = md5(uniqid($imagenNombre, true)) . '.' . pathinfo($imagenNombre, PATHINFO_EXTENSION);
    $rutaDestino = "../../imgGaleria/" . $hashNombre;

    // Mover la imagen a la carpeta imgGaleria
    if (move_uploaded_file($imagen['tmp_name'], $rutaDestino)) {
        // Preparar y vincular
        $stmt = $conn->prepare("INSERT INTO minigaleria (autor, nombre, fecha,  imagen) VALUES (?, ?, ?,  ?)");
        $stmt->bind_param("ssss", $autor, $nombre, $fecha,  $hashNombre);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Datos guardados correctamente.";
        } else {
            echo "Error al guardar los datos: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al mover la imagen.";
    }
}

// Cerrar conexión
$conn->close();
?>