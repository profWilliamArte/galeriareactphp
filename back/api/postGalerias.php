<?php
require_once('../config/permisos.php');
require_once('../config/conexion.php');

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar los datos de entrada
    $autor = htmlspecialchars(trim($_POST['autor']));
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $fecha = htmlspecialchars(trim($_POST['fecha']));
    $descripcion = htmlspecialchars(trim($_POST['descripcion']));

    // Validar la fecha
    if (!DateTime::createFromFormat('Y-m-d', $fecha)) {
        die("Fecha no válida.");
    }

    // Manejo de las imágenes
    $imagenes = $_FILES['imagen']; // Se espera que 'imagen' sea un array de archivos

    // Validar que se hayan subido archivos
    if (empty($imagenes['name'][0])) {
        die("No se han subido imágenes.");
    }

    // Preparar la consulta para insertar en la tabla galeria
    $stmt = $conn->prepare("INSERT INTO galeria (autor, nombre, fecha, descripcion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $autor, $nombre, $fecha, $descripcion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $idGaleria = $stmt->insert_id; // Obtener el ID de la galería recién creada

        // Validar y mover cada imagen
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
        foreach ($imagenes['tmp_name'] as $key => $tmpName) {
            if ($imagenes['error'][$key] === UPLOAD_ERR_OK) {
                $tipoArchivo = mime_content_type($tmpName);
                if (in_array($tipoArchivo, $tiposPermitidos)) {
                    // Generar un hash para el nombre de la imagen
                    $imagenNombre = basename($imagenes['name'][$key]);
                    $hashNombre = md5(uniqid($imagenNombre, true)) . '.' . pathinfo($imagenNombre, PATHINFO_EXTENSION);
                    $rutaDestino = "../../imgGaleria/" . $hashNombre;

                    // Mover la imagen a la carpeta imgGaleria
                    if (move_uploaded_file($tmpName, $rutaDestino)) {
                        // Preparar y vincular para la tabla detallegaleria
                        $stmtDetalle = $conn->prepare("INSERT INTO detallegaleria (idgaleria, imagen) VALUES (?, ?)");
                        $stmtDetalle->bind_param("is", $idGaleria, $hashNombre);

                        // Ejecutar la consulta para detallegaleria
                        if (!$stmtDetalle->execute()) {
                            echo "Error al guardar la imagen en detallegaleria: " . $stmtDetalle->error;
                        }

                        // Cerrar la declaración de detallegaleria
                        $stmtDetalle->close();
                    } else {
                        echo "Error al mover la imagen: " . $imagenes['name'][$key];
                    }
                } else {
                    echo "Tipo de archivo no permitido para la imagen: " . $imagenes['name'][$key];
                }
            } else {
                echo "Error al subir la imagen: " . $imagenes['name'][$key];
            }
        }
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    // Cerrar la declaración de galeria
    $stmt->close();
}

// Cerrar conexión
$conn->close();
?>