<?php
session_start();
require '../conexion.php';

if (!isset($_SESSION['rol_usuario']) || $_SESSION['rol_usuario'] !== 'Proveedor') {
    header("Location: articulos.php");
    exit;
}

$titulo = $_POST['titulo'] ?? '';
$contenido = $_POST['contenido'] ?? '';
$autor_id = $_SESSION['id_usuario'] ?? null;
$imagenNombre = null;

// Procesar imagen si se ha subido
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $archivoTmp = $_FILES['imagen']['tmp_name'];
    $nombreOriginal = basename($_FILES['imagen']['name']);
    $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

    // Validar extensión segura
    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (in_array($extension, $extensionesPermitidas)) {
        // Validar que el archivo sea una imagen real
        if (getimagesize($archivoTmp)) {
            // Crear nombre único
            $imagenNombre = uniqid('img_', true) . '.' . $extension;

            // Asegurar que la carpeta uploads/ existe
            $rutaUploads = '../uploads/';
            if (!file_exists($rutaUploads)) {
                mkdir($rutaUploads, 0755, true);
            }

            // Mover el archivo a la carpeta
            move_uploaded_file($archivoTmp, $rutaUploads . $imagenNombre);
        }
    }
}

// Insertar artículo
if ($titulo && $contenido && $autor_id) {
    $sql = $conexion->prepare("INSERT INTO Articulos (Titulo, Contenido, Autor_ID, Fecha_Creacion, Imagen) VALUES (?, ?, ?, NOW(), ?)");
    $sql->bind_param("ssis", $titulo, $contenido, $autor_id, $imagenNombre);
    $sql->execute();
}

header("Location: articulos.php");
exit;
