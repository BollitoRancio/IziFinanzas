<?php
session_start();
$rol_usuario = $_SESSION['rol_usuario'] ?? '';
require '../conexion.php';

$sql = "SELECT a.*, u.nombre_usuario AS Autor 
        FROM Articulos a 
        JOIN Usuarios u ON a.Autor_ID = u.ID_Usuario 
        ORDER BY Fecha_Creacion DESC";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artículos - IziFinanzas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --izi-green: #28a745;
            --izi-green-light: #e8f5e9;
            --izi-green-dark: #218838;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding-left: 100px;
            transition: padding-left 0.3s ease;
        }
        .article-image {
            width: 100%;
            overflow: hidden;
            border-bottom: 1px solid #ddd;
        }

        .article-image img {
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        /* Sidebar */
        .sidebar {
            width: 100px;
            background-color: #0f1f10;
            color: white;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: 1100;
            display: flex;
            flex-direction: column;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .sidebar .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar .menu li {
            margin-bottom: 30px;
            text-align: center;
        }

        .sidebar .menu li a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 8px 0;
            transition: all 0.3s ease;
            border-radius: 4px;
            margin: 0 20px;
        }

        .sidebar .menu li a:hover {
            background-color: #1e3a1e;
        }

        .sidebar .menu .icon {
            font-size: 24px;
            margin-bottom: 5px;
        }

        /* Header */
        .header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 1rem 0;
            margin-bottom: 2rem;
            position: sticky;
            top: 0;
            z-index: 1050;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            color: var(--izi-green-dark);
        }

        .btn-izi {
            background-color: var(--izi-green);
            border-color: var(--izi-green);
            color: white;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .btn-izi:hover {
            background-color: var(--izi-green-dark);
            border-color: var(--izi-green-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.2);
        }

        .article-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            background-color: white;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        .article-header {
            background-color: var(--izi-green);
            color: white;
            padding: 1rem 1.5rem;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .article-body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .article-content {
            color: #555;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .article-meta {
            font-size: 0.85rem;
            color: #6c757d;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .read-more {
            color: var(--izi-green);
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .read-more:hover {
            color: var(--izi-green-dark);
            text-decoration: underline;
        }

        .read-more i {
            margin-left: 5px;
            transition: transform 0.3s;
        }

        .read-more:hover i {
            transform: translateX(3px);
        }

        .page-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 2rem;
        }

        .page-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 4px;
            background-color: var(--izi-green);
            border-radius: 2px;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            body {
                padding-left: 0;
            }

            .sidebar {
                display: none;
            }

            .header {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        @media (max-width: 576px) {
            .article-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .read-more {
                margin-top: 10px;
            }
        }

    </style>
</head>
<body>

<!-- Sidebar -->
    <div class="sidebar">
        <ul class="menu">
            <li><a href="../inicio.php"><i class="bi bi-house-fill icon"></i> Inicio</a></li>
            <li><a href="../menu_cursos.php"><i class="bi bi-journal-text icon"></i> Cursos</a></li>
            <li><a href="../menu_herramientas.php"><i class="bi bi-calculator-fill icon"></i> Herramientas</a></li>
            <li><a href="../articulos/articulos.php"><i class="bi bi-paperclip icon"></i> Artículos</a></li>
            <li><a href="../logout.php"><i class="bi bi-box-arrow-left icon"></i> Salir</a></li>
        </ul>
    </div>

<!-- Encabezado -->
<div class="header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="../dashboard.php" class="text-decoration-none">
                <h4 class="m-0 text-success"><i class="bi bi-currency-exchange"></i> IziFinanzas</h4>
            </a>
            <div class="user-info">
                <?php if(isset($_SESSION['nombre_usuario'])): ?>
                    <span class="me-2"><i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['nombre_usuario']) ?></span>
                    <span class="text-muted">(<?= htmlspecialchars($_SESSION['rol_usuario']) ?>)</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Contenido -->
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title">Artículos Educativos</h1>
        <?php if ($rol_usuario === 'Proveedor'): ?>
            <a href="crear_articulo.php" class="btn btn-izi">
                <i class="bi bi-plus-lg"></i> Nuevo Artículo
            </a>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="article-card">
                    <?php if (!empty($fila['Imagen'])): ?>
                        <div class="article-image">
                            <img src="../uploads/<?= htmlspecialchars($fila['Imagen']) ?>" alt="Imagen del artículo" class="img-fluid w-100" style="max-height: 200px; object-fit: cover;">
                        </div>
                    <?php endif; ?>
                    <div class="article-header">
                        <?= htmlspecialchars($fila['Titulo']) ?>
                    </div>
                    <div class="article-body">
                        <p class="article-content">
                            <?= nl2br(htmlspecialchars(substr($fila['Contenido'], 0, 200))) ?>...
                        </p>
                        <div class="article-meta">
                            <span>
                                <i class="bi bi-person"></i> <?= htmlspecialchars($fila['Autor']) ?><br>
                                <i class="bi bi-calendar"></i> <?= date('d/m/Y', strtotime($fila['Fecha_Creacion'])) ?>
                            </span>
                            <a href="ver_articulos.php?id=<?= $fila['ID_Articulo'] ?>" class="read-more">
                                Leer más <i class="bi bi-arrow-right-short"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
