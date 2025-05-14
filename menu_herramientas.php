<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herramientas Financieras | IziFinanzas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --izi-green: #28a745;
            --izi-green-light: #e8f5e9;
            --izi-green-dark: #1e7e34;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        /* Header */
        .header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            left: 100px; /* Ajuste para el sidebar */
        }
        
        .header-title {
            color: var(--izi-green-dark);
            font-weight: 600;
            margin: 0;
            font-size: 1.5rem;
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
        }
        .header img{
            width: 50px;
            height: auto;
        }
        
        .sidebar .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
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
            margin: 0 10px;
        }
        
        .sidebar .menu li a:hover {
            background-color: #1e3a1e;
        }
        
        .sidebar .menu .icon {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 100px;
            margin-top: 80px;
            padding: 30px;
        }
        
        /* Tools Grid */
        .tools-header {
            margin-bottom: 30px;
        }
        
        .tools-header h1 {
            color: var(--izi-green-dark);
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .tools-header p {
            color: #6c757d;
            font-size: 1.1rem;
        }
        
        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        
        .tool-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-top: 4px solid var(--izi-green);
        }
        
        .tool-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        
        .tool-card.calculator {
            border-top-color:rgb(6, 136, 2);
        }
        
        .tool-card.simulator {
            border-top-color:rgb(6, 136, 2);
        }
        
        .tool-icon {
            background-color: var(--izi-green-light);
            color: var(--izi-green);
            font-size: 2.5rem;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 25px auto 20px;
        }
        
        .calculator .tool-icon {
            background-color: #e8f0fe;
            color:rgb(5, 105, 2);
        }
        
        .simulator .tool-icon {
            background-color: #e6f7fa;
            color:rgb(5, 105, 2);
        }
        
        .tool-content {
            padding: 0 25px 25px;
            text-align: center;
        }
        
        .tool-title {
            color: #343a40;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }
        
        .tool-desc {
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 20px;
            min-height: 60px;
        }
        
        .btn-tool {
            background-color: var(--izi-green);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-tool:hover {
            background-color: var(--izi-green-dark);
            color: white;
            transform: translateY(-2px);
        }
        
        .calculator .btn-tool {
            background-color:rgb(2, 73, 0);
        }
        
        .calculator .btn-tool:hover {
            background-color:rgb(10, 136, 48);
        }
        
        .simulator .btn-tool {
            background-color:rgb(2, 73, 0);
        }
        
        .simulator .btn-tool:hover {
            background-color:rgb(10, 136, 48);
        }
        
        .section-title {
            color: var(--izi-green-dark);
            font-weight: 600;
            margin: 40px 0 20px;
            position: relative;
            padding-left: 15px;
        }
        
        .section-title::before {
            content: "";
            position: absolute;
            left: 0;
            top: 5px;
            height: 20px;
            width: 5px;
            background-color: var(--izi-green);
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="menu">
            <li><a href="inicio.php"><i class="bi bi-house-fill icon"></i> Inicio</a></li>
            <li><a href="menu_cursos.php"><i class="bi bi-journal-text icon"></i> Cursos</a></li>
            <li><a href="menu_herramientas.php"><i class="bi bi-calculator-fill icon"></i> Herramientas</a></li>
            <li><a href="articulos.php"><i class="bi bi-paperclip icon"></i> Artículos</a></li>
            <li><a href="logout.php"><i class="bi bi-box-arrow-left icon"></i> Salir</a></li>
        </ul>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="header-title"> IziFinanzas</h1>
                <div class="user-profile">
                    <img src="img/avatar.png" class="rounded-circle" alt="Usuario">
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="tools-header">
                <h1>Explora nuestras herramientas</h1>
                <p>Calculadoras y simuladores para gestionar mejor tus finanzas</p>
            </div>
            
            <h3 class="section-title">Calculadoras financieras</h3>
            <div class="tools-grid">
                <!-- Calculadora 1 -->
                <div class="tool-card calculator">
                    <div class="tool-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <div class="tool-content">
                        <h3 class="tool-title">Interés Compuesto</h3>
                        <p class="tool-desc">Calcula cómo crece tu dinero con el tiempo gracias al poder del interés compuesto.</p>
                        <a href="http://localhost/IziFinanzas/herramientas/calculadora-interes.php" class="btn btn-tool">Usar calculadora</a>
                    </div>
                </div>
                
                <!-- Calculadora 2 -->
                <div class="tool-card calculator">
                    <div class="tool-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <div class="tool-content">
                        <h3 class="tool-title">Pago de Deudas</h3>
                        <p class="tool-desc">Compara métodos de pago y descubre cuánto puedes ahorrar en intereses.</p>
                        <a href="http://localhost/IziFinanzas/herramientas/calculadora-deudas.php" class="btn btn-tool">Usar calculadora</a>
                    </div>
                </div>
                
                <!-- Calculadora 3 -->
                <div class="tool-card calculator">
                    <div class="tool-icon">
                        <i class="bi bi-pie-chart"></i>
                    </div>
                    <div class="tool-content">
                        <h3 class="tool-title">Presupuesto 50/30/20</h3>
                        <p class="tool-desc">Distribuye tus ingresos de manera óptima entre necesidades, deseos y ahorro.</p>
                        <a href="http://localhost/IziFinanzas/herramientas/calculadora-presupuesto.php" class="btn btn-tool">Usar calculadora</a>
                    </div>
                </div>
            </div>
            
            <h3 class="section-title">Simuladores financieros</h3>
            <div class="tools-grid">
                <!-- Simulador 1 -->
                <div class="tool-card simulator">
                    <div class="tool-icon">
                        <i class="bi bi-house"></i>
                    </div>
                    <div class="tool-content">
                        <h3 class="tool-title">Compra de Vivienda</h3>
                        <p class="tool-desc">Simula diferentes escenarios para comprar tu casa y planea tu hipoteca.</p>
                        <a href="http://localhost/IziFinanzas/herramientas/simulador-vivienda.php" class="btn btn-tool">Usar simulador</a>
                    </div>
                </div>
                
                <!-- Simulador 2 -->
                <div class="tool-card simulator">
                    <div class="tool-icon">
                        <i class="bi bi-calculator"></i>
                    </div>
                    <div class="tool-content">
                        <h3 class="tool-title">Compra de Auto</h3>
                        <p class="tool-desc">Compara financiamiento vs. contado y calcula costos totales de propiedad.</p>
                        <a href="http://localhost/IziFinanzas/herramientas/simulador-auto.php" class="btn btn-tool">Usar simulador</a>
                    </div>
                </div>
                
                <!-- Simulador 3 -->
                <div class="tool-card simulator">
                    <div class="tool-icon">
                        <i class="bi bi-coin"></i>
                    </div>
                    <div class="tool-content">
                        <h3 class="tool-title">Retiro y Jubilación</h3>
                        <p class="tool-desc">Proyecta cuánto necesitarás ahorrar para alcanzar tu meta de retiro.</p>
                        <a href="http://localhost/IziFinanzas/herramientas/simulador-retiro.php" class="btn btn-tool">Usar simulador</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Efecto hover para las tarjetas
        document.querySelectorAll('.tool-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.12)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '0 4px 15px rgba(0,0,0,0.08)';
            });
        });
    </script>
</body>
</html>