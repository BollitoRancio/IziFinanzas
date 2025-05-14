<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario | IziFinanzas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #108b36;
            --primary-light: #1ec75f;
            --primary-dark: #0a5a24;
            --secondary-color: #2c3e50;
            --light-gray: #f8f9fa;
            --white: #ffffff;
            --text-color: #2d3436;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--primary-dark);
            color: white;
            padding: 20px 0; /* Reducido el padding superior/inferior */
            height: 100vh;
            position: fixed;
            transition: var(--transition);
            overflow-y: auto; /* Para contenido que exceda la altura */
        }

        .menu-header {
            text-align: center;
            padding: 10px 15px; /* Padding más ajustado */
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 15px;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .logo img {
            width: 250px; /* Tamaño fijo para desktop */
            height: auto;
            object-fit: contain; /* Asegura que la imagen mantenga sus proporciones */
            transition: var(--transition);
        }

        .profile-name {
            font-size: 16px; /* Reducido ligeramente */
            font-weight: 600;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .profile-role {
            font-size: 12px; /* Reducido ligeramente */
            color: var(--primary-light);
            background: rgba(255, 255, 255, 0.1);
            padding: 2px 8px;
            border-radius: 20px;
            display: inline-block;
        }

        .menu {
            padding: 20px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            border-left: 3px solid transparent;
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 3px solid var(--primary-light);
        }

        .menu-item i {
            margin-right: 12px;
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .menu-item .badge {
            margin-left: auto;
            background: var(--primary-light);
            color: white;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            flex-grow: 1;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--primary-dark);
        }

        .page-subtitle {
            color: var(--secondary-color);
            font-size: 16px;
            margin-top: 5px;
        }

        .profile-card {
            background: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 30px;
            margin-bottom: 30px;
        }

        .profile-section {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 25px;
            border: 3px solid var(--primary-light);
        }

        .profile-info h2 {
            font-size: 22px;
            margin-bottom: 5px;
            color: var(--primary-dark);
        }

        .profile-info p {
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

        .tag {
            display: inline-block;
            background: var(--primary-light);
            color: white;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .info-card {
            background: var(--white);
            border-radius: 8px;
            box-shadow: var(--shadow);
            padding: 20px;
        }

        .info-card h3 {
            font-size: 16px;
            color: var(--secondary-color);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .info-card h3 i {
            margin-right: 10px;
            color: var(--primary-light);
        }

        .info-item {
            margin-bottom: 15px;
        }

        .info-label {
            font-size: 13px;
            color: #7f8c8d;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 500;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: var(--primary-light);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary-light);
            color: var(--primary-light);
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-outline:hover {
            background: rgba(30, 199, 95, 0.1);
        }

        /* Ajusta la media query para móviles */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                overflow: hidden;
            }
            
            .menu-header {
                padding: 15px 0; /* Reduce el padding */
            }
            
            .logo img {
                width: 30px; /* Tamaño adecuado para móvil */
                margin-bottom: 5px;
            }
            
            .profile-name, 
            .profile-role, 
            .menu-item span {
                display: none;
            }
            
            .menu-item {
                justify-content: center;
                padding: 15px 0;
            }
            
            .menu-item i {
                margin-right: 0;
                font-size: 20px;
            }
            
            .main-content {
                margin-left: 80px;
            }
        }
        @media (max-width: 768px) {
            .profile-section {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-avatar {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="menu-header">
            <div class="logo">
                <img src="img/izblanco.png" alt="logo">
        </div>
        </div>
        <nav class="menu">
            <a href="http://localhost/IziFinanzas/inicio.php" class="menu-item">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>
            <a href="dashboard-cursos.php" class="menu-item">
                <i class="fas fa-book-open"></i>
                <span>Cursos y Lecciones</span>
            </a>
            <a href="dashboard.php" class="menu-item active">
                <i class="fas fa-user"></i>
                <span>Perfil de Usuario</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-heart"></i>
                <span>Artículos Favoritos</span>
                <span class="badge">3</span>
            </a>
            <a href="logout.php" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Cerrar Sesión</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <div>
                <h1 class="page-title">Perfil De Usuario</h1>
                <p class="page-subtitle">Modificar detalles, visualizar estatus y cambiar contraseña</p>
            </div>
        </div>

        <div class="profile-card">
            <div class="profile-section">
                <img src="img/avatar.png" alt="avatar" class="profile-avatar">
                <div class="profile-info">
                    <h2> <?php echo htmlspecialchars($_SESSION['Nombre']); ?>  <?php echo htmlspecialchars($_SESSION['Apellidos']); ?></h2>
                    <div class="tag">Usuario Aprendiz</div>
                    <a href="#" class="btn btn-outline"><i class="fas fa-pencil-alt"></i> Editar Perfil</a>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <h3><i class="fas fa-info-circle"></i> Información General</h3>
                    
                    <div class="info-item">
                        <div class="info-label">Nombre</div>
                        <div class="info-value"><?php echo htmlspecialchars($_SESSION['Nombre']); ?> </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label"> Apellidos</div>
                        <div class="info-value"><?php echo htmlspecialchars($_SESSION['Apellidos']); ?></div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Nombre de usuario</div>
                        <div class="info-value"><?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></div>
                    </div>
                    
                    <a href="#" class="btn btn-outline" style="margin-top: 10px; display: inline-block;">
                        <i class="fas fa-edit"></i> Cambiar nombre de usuario
                    </a>
                </div>

                <div class="info-card">
                    <h3><i class="fas fa-shield-alt"></i> Seguridad</h3>
                    
                    <div class="info-item">
                        <div class="info-label">Correo Electrónico</div>
                        <div class="info-value"><?php echo htmlspecialchars($_SESSION['Correo']); ?></div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Contraseña</div>
                        <div class="info-value">•••••••••••</div>
                    </div>
                    
                    <a href="#" class="btn btn-outline" style="margin-top: 10px; display: inline-block;">
                        <i class="fas fa-key"></i> Modificar Contraseña
                    </a>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Aquí puedes añadir interacciones con JavaScript
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>