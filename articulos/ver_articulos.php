<?php
session_start();
require '../conexion.php';

// Obtener el ID del artículo desde la URL
$articulo_id = $_GET['id'] ?? null;
if (!$articulo_id) {
    header('Location: articulos.php');
    exit;
}

// Consulta para obtener el artículo y el nombre del autor
$sql = "SELECT a.ID_Articulo, a.Titulo, a.Contenido, a.Fecha_Creacion, a.Autor_ID, a.Imagen, u.nombre_usuario AS Autor
        FROM Articulos a
        JOIN Usuarios u ON a.Autor_ID = u.ID_Usuario
        WHERE a.ID_Articulo = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $articulo_id);
$stmt->execute();
$resultado = $stmt->get_result();
$articulo = $resultado->fetch_assoc();

if (!$articulo) {
    header('Location: articulos.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($articulo['Titulo']) ?> - IziFinanzas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 800px;
        }
        .titulo-articulo {
            color: #28a745;
            font-weight: 700;
            margin-top: 2rem;
        }
        .meta {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
        .contenido-articulo {
            font-size: 1.1rem;
            line-height: 1.7;
            white-space: pre-line;
        }
        .botones {
            margin-top: 2rem;
        }
        .btn-izi {
            background-color: #28a745;
            color: white;
        }
        .btn-izi:hover {
            background-color: #218838;
        }
        .imagen-articulo {
            max-height: 350px;
            overflow: hidden;
            border-radius: 12px;
            margin-top: 1rem;
        }
        .imagen-articulo img {
            width: 100%;
            object-fit: cover;
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <a href="articulos.php" class="btn btn-link mb-3"><i class="bi bi-arrow-left"></i> Volver a Artículos</a>

        <?php if (!empty($articulo['Imagen'])): ?>
            <div class="imagen-articulo">
                <img src="../uploads/<?= htmlspecialchars($articulo['Imagen']) ?>" alt="Imagen del artículo">
            </div>
        <?php endif; ?>

        <h1 class="titulo-articulo"><?= htmlspecialchars($articulo['Titulo']) ?></h1>
        <div class="meta">
            Publicado por <strong><?= htmlspecialchars($articulo['Autor']) ?></strong> el <?= date('d/m/Y', strtotime($articulo['Fecha_Creacion'])) ?> • <?= calcularTiempoLectura($articulo['Contenido']) ?> min lectura
        </div>

        <div class="contenido-articulo">
            <?= nl2br(htmlspecialchars($articulo['Contenido'])) ?>
        </div>

        <?php if (isset($_SESSION['rol_usuario']) && $_SESSION['rol_usuario'] === 'Proveedor' && $_SESSION['id_usuario'] == $articulo['Autor_ID']): ?>
            <div class="botones d-flex justify-content-end gap-2">
                <a href="editar_articulo.php?id=<?= $articulo['ID_Articulo'] ?>" class="btn btn-izi">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <a href="eliminar_articulo.php?id=<?= $articulo['ID_Articulo'] ?>" class="btn btn-outline-danger" onclick="return confirm('¿Deseas eliminar este artículo?')">
                    <i class="bi bi-trash"></i> Eliminar
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Calcula el tiempo de lectura en minutos
function calcularTiempoLectura($texto) {
    $palabras = str_word_count(strip_tags($texto));
    return max(1, ceil($palabras / 200)); // 200 palabras por minuto
}
?>
