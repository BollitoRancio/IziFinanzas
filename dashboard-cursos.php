<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos y Lecciones | IziFinanzas</title>
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

        /* Sidebar (mantener el mismo estilo que en perfil) */
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
            flex-wrap: wrap;
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

        /* Filtros */
        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 16px;
            background: var(--white);
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            cursor: pointer;
            transition: var(--transition);
            font-size: 14px;
        }

        .filter-btn.active, .filter-btn:hover {
            background: var(--primary-light);
            color: white;
            border-color: var(--primary-light);
        }

        /* Cursos */
        .courses-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .course-card {
            background: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: var(--transition);
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .course-image {
            height: 150px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .course-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary-light);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .course-content {
            padding: 20px;
        }

        .course-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--primary-dark);
        }

        .course-description {
            font-size: 14px;
            color: var(--secondary-color);
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .progress-container {
            margin-bottom: 15px;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 13px;
        }

        .progress-bar {
            height: 6px;
            background: #e0e0e0;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--primary-light);
            border-radius: 3px;
            transition: width 0.5s ease;
        }

        .course-meta {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: var(--secondary-color);
        }

        .course-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            text-align: center;
            flex: 1;
        }

        .btn-primary {
            background: var(--primary-light);
            color: white;
            border: none;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary-light);
            color: var(--primary-light);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-outline:hover {
            background: rgba(30, 199, 95, 0.1);
        }

        /* Lecciones */
        .lessons-container {
            margin-top: 40px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
            color: var(--primary-light);
        }

        .lesson-list {
            background: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .lesson-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }

        .lesson-item:last-child {
            border-bottom: none;
        }

        .lesson-item:hover {
            background: rgba(30, 199, 95, 0.05);
        }

        .lesson-check {
            margin-right: 15px;
            color: var(--primary-light);
            font-size: 18px;
        }

        .lesson-info {
            flex: 1;
        }

        .lesson-title {
            font-weight: 500;
            margin-bottom: 3px;
        }

        .lesson-duration {
            font-size: 13px;
            color: var(--secondary-color);
        }

        .lesson-status {
            font-size: 12px;
            padding: 3px 10px;
            border-radius: 20px;
            margin-left: 15px;
        }

        .status-completed {
            background: rgba(30, 199, 95, 0.1);
            color: var(--primary-dark);
        }

        .status-in-progress {
            background: rgba(255, 193, 7, 0.1);
            color: #ff9800;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }
            
            .main-content {
                margin-left: 80px;
            }
        }

        @media (max-width: 768px) {
            .courses-container {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .filters {
                margin-top: 15px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 20px 15px;
            }
            
            .course-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>

</head>
<body>
    <!-- Sidebar (mantener el mismo que en perfil) -->
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
                <h1 class="page-title">Cursos y Lecciones</h1>
                <p class="page-subtitle">Continúa tu aprendizaje y revisa tu progreso</p>
            </div>
            
            <div class="filters">
                <button class="filter-btn active">Todos</button>
                <button class="filter-btn">En progreso</button>
                <button class="filter-btn">Completados</button>
                <button class="filter-btn">Nuevos</button>
            </div>
        </div>

        <div class="courses-container">
            <!-- Curso 1 -->
            <div class="course-card">
                <div class="course-image" style="background-image: url('img/curso-finanzas.jpg');">
                    <span class="course-badge">En progreso</span>
                </div>
                <div class="course-content">
                    <h3 class="course-title">Finanzas Personales Básicas</h3>
                    <p class="course-description">Aprende los fundamentos de las finanzas personales, presupuestos y ahorro inteligente.</p>
                    
                    <div class="progress-container">
                        <div class="progress-label">
                            <span>Progreso</span>
                            <span>65%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 65%;"></div>
                        </div>
                    </div>
                    
                    <div class="course-meta">
                        <span><i class="far fa-bookmark"></i> 12 lecciones</span>
                        <span><i class="far fa-clock"></i> 8 horas</span>
                    </div>
                    
                    <div class="course-actions">
                        <a href="curso-detalle.php?id=1" class="btn btn-primary">Continuar</a>
                        <a href="#" class="btn btn-outline">Detalles</a>
                    </div>
                </div>
            </div>
            
            <!-- Curso 2 -->
            <div class="course-card">
                <div class="course-image" style="background-image: url('img/curso-inversion.jpg');">
                    <span class="course-badge">Completado</span>
                </div>
                <div class="course-content">
                    <h3 class="course-title">Introducción a las Inversiones</h3>
                    <p class="course-description">Descubre cómo hacer que tu dinero trabaje para ti mediante inversiones inteligentes.</p>
                    
                    <div class="progress-container">
                        <div class="progress-label">
                            <span>Progreso</span>
                            <span>100%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 100%;"></div>
                        </div>
                    </div>
                    
                    <div class="course-meta">
                        <span><i class="far fa-bookmark"></i> 10 lecciones</span>
                        <span><i class="far fa-clock"></i> 6 horas</span>
                    </div>
                    
                    <div class="course-actions">
                        <a href="curso-detalle.php?id=2" class="btn btn-primary">Ver de nuevo</a>
                        <a href="#" class="btn btn-outline">Certificado</a>
                    </div>
                </div>
            </div>
            
            <!-- Curso 3 -->
            <div class="course-card">
                <div class="course-image" style="background-image: url('img/curso-ahorro.jpg');">
                    <span class="course-badge">Nuevo</span>
                </div>
                <div class="course-content">
                    <h3 class="course-title">Estrategias de Ahorro</h3>
                    <p class="course-description">Técnicas comprobadas para ahorrar más sin sacrificar tu calidad de vida.</p>
                    
                    <div class="progress-container">
                        <div class="progress-label">
                            <span>Progreso</span>
                            <span>0%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 0%;"></div>
                        </div>
                    </div>
                    
                    <div class="course-meta">
                        <span><i class="far fa-bookmark"></i> 8 lecciones</span>
                        <span><i class="far fa-clock"></i> 5 horas</span>
                    </div>
                    
                    <div class="course-actions">
                        <a href="curso-detalle.php?id=3" class="btn btn-primary">Comenzar</a>
                        <a href="#" class="btn btn-outline">Detalles</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="lessons-container">
            <h3 class="section-title"><i class="fas fa-tasks"></i> Lecciones recientes</h3>
            
            <div class="lesson-list">
                <div class="lesson-item">
                    <i class="fas fa-check-circle lesson-check"></i>
                    <div class="lesson-info">
                        <div class="lesson-title">Conceptos básicos de presupuesto</div>
                        <div class="lesson-duration">25 min · Finanzas Personales Básicas</div>
                    </div>
                    <span class="lesson-status status-completed">Completado</span>
                </div>
                
                <div class="lesson-item">
                    <i class="fas fa-play-circle lesson-check"></i>
                    <div class="lesson-info">
                        <div class="lesson-title">Tipos de gastos y categorización</div>
                        <div class="lesson-duration">32 min · Finanzas Personales Básicas</div>
                    </div>
                    <span class="lesson-status status-in-progress">En progreso</span>
                </div>
                
                <div class="lesson-item">
                    <i class="fas fa-check-circle lesson-check"></i>
                    <div class="lesson-info">
                        <div class="lesson-title">Introducción al mercado de valores</div>
                        <div class="lesson-duration">45 min · Introducción a las Inversiones</div>
                    </div>
                    <span class="lesson-status status-completed">Completado</span>
                </div>
                
                <div class="lesson-item">
                    <i class="far fa-circle lesson-check"></i>
                    <div class="lesson-info">
                        <div class="lesson-title">El poder del interés compuesto</div>
                        <div class="lesson-duration">28 min · Estrategias de Ahorro</div>
                    </div>
                    <span class="lesson-status">Pendiente</span>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Filtrado de cursos
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Aquí iría la lógica para filtrar los cursos
                // Puedes implementar esto según tu base de datos
            });
        });
        
        // Interacción con las lecciones
        document.querySelectorAll('.lesson-item').forEach(item => {
            item.addEventListener('click', function() {
                // Redirigir a la lección correspondiente
                // window.location.href = 'leccion.php?id=X';
            });
        });
    </script>
</body>
</html>