<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Interés Compuesto | IziFinanzas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --izi-green: #28a745;
            --izi-green-light: #e8f5e9;
            --izi-green-dark: #1e7e34;
            --izi-green-darker: #0f1f10;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
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
            color: var(--izi-green-darker);
            font-weight: 600;
            margin: 0;
            font-size: 1.5rem;
        }
        
        /* Sidebar */
        .sidebar {
            width: 100px;
            background-color: var(--izi-green-darker);
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
            background-color: var(--izi-green-dark);
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
        
        /* Calculator Container */
        .calculator-container {
            max-width: 900px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .calculator-header {
            background-color: var(--izi-green);
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .calculator-header h2 {
            font-weight: 600;
            margin: 0;
        }
        
        .calculator-header p {
            margin: 5px 0 0;
            opacity: 0.9;
        }
        
        .calculator-body {
            display: flex;
            flex-wrap: wrap;
        }
        
        .calculator-form {
            flex: 1;
            min-width: 300px;
            padding: 30px;
            border-right: 1px solid #eee;
        }
        
        .calculator-results {
            flex: 1;
            min-width: 300px;
            padding: 30px;
            background-color: var(--izi-green-light);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            font-weight: 500;
            color: var(--izi-green-darker);
            margin-bottom: 8px;
            display: block;
        }
        
        .input-group-text {
            background-color: var(--izi-green);
            color: white;
            border-color: var(--izi-green);
        }
        
        .form-control {
            border-color: #ced4da;
            transition: border-color 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--izi-green);
            box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
        }
        
        .btn-calculate {
            background-color: var(--izi-green);
            color: white;
            border: none;
            padding: 10px 25px;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-calculate:hover {
            background-color: var(--izi-green-dark);
            transform: translateY(-2px);
        }
        
        .result-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-left: 4px solid var(--izi-green);
        }
        
        .result-title {
            font-size: 1rem;
            color: var(--izi-green-darker);
            font-weight: 500;
            margin-bottom: 10px;
        }
        
        .result-value {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--izi-green);
        }
        
        .result-detail {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 5px;
        }
        
        .chart-container {
            height: 250px;
            margin-top: 30px;
        }
        
        .info-icon {
            color: var(--izi-green);
            cursor: pointer;
            margin-left: 5px;
        }
        
        @media (max-width: 768px) {
            .calculator-body {
                flex-direction: column;
            }
            
            .calculator-form {
                border-right: none;
                border-bottom: 1px solid #eee;
            }
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
                <h1 class="header-title"><i class="bi bi-graph-up-arrow"></i> Calculadora de Interés Compuesto</h1>
                <div class="user-profile">
                    <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Usuario">
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="calculator-container">
                <div class="calculator-header">
                    <h2><i class="bi bi-calculator"></i> Calculadora de Interés Compuesto</h2>
                    <p>Descubre cómo crece tu dinero con el tiempo</p>
                </div>
                
                <div class="calculator-body">
                    <!-- Formulario -->
                    <div class="calculator-form">
                        <div class="form-group">
                            <label for="inversion-inicial">Inversión inicial <i class="bi bi-info-circle info-icon" title="Cantidad de dinero que invertirás al comenzar"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="inversion-inicial" value="1000" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="aportacion-mensual">Aportación mensual <i class="bi bi-info-circle info-icon" title="Cantidad que agregarás cada mes"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="aportacion-mensual" value="100" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="tasa-interes">Tasa de interés anual <i class="bi bi-info-circle info-icon" title="Rendimiento porcentual anual esperado"></i></label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="tasa-interes" value="7" min="0" max="100" step="0.1">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="periodo">Período de inversión <i class="bi bi-info-circle info-icon" title="Tiempo que mantendrás la inversión"></i></label>
                            <div class="row">
                                <div class="col-8">
                                    <input type="range" class="form-range" id="periodo" min="1" max="40" value="10">
                                </div>
                                <div class="col-4">
                                    <span id="periodo-value">10</span> años
                                </div>
                            </div>
                        </div>
                        
                        <button id="calcular" class="btn btn-calculate mt-4">
                            <i class="bi bi-calculator"></i> Calcular
                        </button>
                    </div>
                    
                    <!-- Resultados -->
                    <div class="calculator-results">
                        <h4 class="text-center mb-4" style="color: var(--izi-green-darker);">
                            <i class="bi bi-graph-up"></i> Resultados
                        </h4>
                        
                        <div class="result-card">
                            <div class="result-title">Valor futuro</div>
                            <div class="result-value" id="valor-futuro">$23,219.89</div>
                            <div class="result-detail">Total acumulado al final del período</div>
                        </div>
                        
                        <div class="result-card">
                            <div class="result-title">Total invertido</div>
                            <div class="result-value" id="total-invertido">$13,000.00</div>
                            <div class="result-detail">Suma de todas tus aportaciones</div>
                        </div>
                        
                        <div class="result-card">
                            <div class="result-title">Intereses generados</div>
                            <div class="result-value" id="intereses-generados">$10,219.89</div>
                            <div class="result-detail">Ganancias por interés compuesto</div>
                        </div>
                        
                        <div class="chart-container">
                            <canvas id="result-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center text-muted">
                <small><i class="bi bi-lightbulb"></i> El interés compuesto es la octava maravilla del mundo. Quien lo entiende, lo gana; quien no, lo paga. - Albert Einstein</small>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos del DOM
            const inversionInicial = document.getElementById('inversion-inicial');
            const aportacionMensual = document.getElementById('aportacion-mensual');
            const tasaInteres = document.getElementById('tasa-interes');
            const periodoSlider = document.getElementById('periodo');
            const periodoValue = document.getElementById('periodo-value');
            const calcularBtn = document.getElementById('calcular');
            
            // Resultados
            const valorFuturo = document.getElementById('valor-futuro');
            const totalInvertido = document.getElementById('total-invertido');
            const interesesGenerados = document.getElementById('intereses-generados');
            
            // Gráfico
            const chartCtx = document.getElementById('result-chart').getContext('2d');
            let compoundChart = new Chart(chartCtx, {
                type: 'bar',
                data: {
                    labels: ['Inversión', 'Intereses'],
                    datasets: [{
                        label: 'Composición',
                        data: [13000, 10219.89],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.7)',
                            'rgba(30, 126, 52, 0.7)'
                        ],
                        borderColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(30, 126, 52, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + 
                                           '$' + context.raw.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
            
            // Event listeners
            periodoSlider.addEventListener('input', function() {
                periodoValue.textContent = this.value;
            });
            
            calcularBtn.addEventListener('click', calcularInteresCompuesto);
            
            // Calcular al cargar la página
            calcularInteresCompuesto();
            
            // Función principal de cálculo
            function calcularInteresCompuesto() {
                const P = parseFloat(inversionInicial.value) || 0;
                const PM = parseFloat(aportacionMensual.value) || 0;
                const r = parseFloat(tasaInteres.value) / 100 / 12; // Tasa mensual
                const t = parseInt(periodoSlider.value) * 12; // Meses totales
                
                // Calcular valor futuro
                const valorFuturoCalculado = P * Math.pow(1 + r, t) + 
                                            PM * ((Math.pow(1 + r, t) - 1) / r);
                
                // Calcular total invertido
                const totalInvertidoCalculado = P + (PM * t);
                
                // Calcular intereses generados
                const interesesCalculados = valorFuturoCalculado - totalInvertidoCalculado;
                
                // Actualizar UI
                valorFuturo.textContent = '$' + valorFuturoCalculado.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                totalInvertido.textContent = '$' + totalInvertidoCalculado.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                interesesGenerados.textContent = '$' + interesesCalculados.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                // Actualizar gráfico
                compoundChart.data.datasets[0].data = [totalInvertidoCalculado, interesesCalculados];
                compoundChart.update();
            }
            
            // Tooltips de Bootstrap
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>