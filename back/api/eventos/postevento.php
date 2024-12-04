<?php
require_once('../../config/permisos.php');
require_once('../../config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar los datos de entrada
    $autor = htmlspecialchars(trim($_POST['idautor'])); 
    $categoria = htmlspecialchars(trim($_POST['idcategoria']));
    $tipoEvento = htmlspecialchars(trim($_POST['idtipoevento']));
    $lugar = htmlspecialchars(trim($_POST['lugar']));
    $fecha = htmlspecialchars(trim($_POST['fecha']));
    $descripcion = htmlspecialchars(trim($_POST['descripcion']));


    if (!DateTime::createFromFormat('Y-m-d', $fecha)) {
        die("Fecha no válida.");
    }
    $imagenes = $_FILES['imagen']; 
    if (empty($imagenes['name'][0])) {
        die("No se han subido imágenes.");
    }
    $estatus=1;
    // Preparar la consulta para insertar en la tabla evento
    $stmt = $conn->prepare("INSERT INTO eventos (idautor, idestatus, idcategoria, idtipoevento, lugar, fecha, descripcion) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiisss", $autor, $estatus, $categoria, $tipoEvento, $lugar, $fecha, $descripcion);

    if ($stmt->execute()) {
        $idEvento = $stmt->insert_id; 
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
        foreach ($imagenes['tmp_name'] as $key => $tmpName) {
            if ($imagenes['error'][$key] === UPLOAD_ERR_OK) {
                $tipoArchivo = mime_content_type($tmpName);
                if (in_array($tipoArchivo, $tiposPermitidos)) {
                    // Generar un hash para el nombre de la imagen
                    $imagenNombre = basename($imagenes['name'][$key]);
                    $hashNombre = md5(uniqid($imagenNombre, true)) . '.' . pathinfo($imagenNombre, PATHINFO_EXTENSION);
                    $rutaDestino = "../../../front/src/assets/imgeventos/" . $hashNombre; 
               
                    // Mover la imagen a la carpeta imgEventos
                    if (move_uploaded_file($tmpName, $rutaDestino)) {
                        $stmtDetalle = $conn->prepare("INSERT INTO detalleevento (idevento, imagen) VALUES (?, ?)");
                        $stmtDetalle->bind_param("is", $idEvento, $hashNombre);

                        if (!$stmtDetalle->execute()) {
                            echo "Error al guardar la imagen en detalleevento: " . $stmtDetalle->error;
                        }

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
    $stmt->close();
}
$conn->close();
?>