<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora 50/30/20 | IziFinanzas</title>
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
            --necesidades: #4e73df;
            --deseos: #1cc88a;
            --ahorro: #36b9cc;
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
        }
        
        .necesidades-card {
            border-left: 4px solid var(--necesidades);
        }
        
        .deseos-card {
            border-left: 4px solid var(--deseos);
        }
        
        .ahorro-card {
            border-left: 4px solid var(--ahorro);
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
        }
        
        .necesidades-value {
            color: var(--necesidades);
        }
        
        .deseos-value {
            color: var(--deseos);
        }
        
        .ahorro-value {
            color: var(--ahorro);
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
        
        .method-explanation {
            margin-top: 20px;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .method-title {
            font-weight: 600;
            color: var(--izi-green-darker);
            margin-bottom: 10px;
        }
        
        .method-step {
            display: flex;
            margin-bottom: 10px;
        }
        
        .step-number {
            background-color: var(--izi-green);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        
        .step-content {
            flex: 1;
            font-size: 0.9rem;
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
             <li><a href="../inicio.php"><i class="bi bi-house-fill icon"></i> Inicio</a></li>
            <li><a href="../menu_cursos.php"><i class="bi bi-journal-text icon"></i> Cursos</a></li>
            <li><a href="../menu_herramientas.php"><i class="bi bi-calculator-fill icon"></i> Herramientas</a></li>
            <li><a href="../articulos.php"><i class="bi bi-paperclip icon"></i> Artículos</a></li>
            <li><a href="../logout.php"><i class="bi bi-box-arrow-left icon"></i> Salir</a></li>
        </ul>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="header-title"><i class="bi bi-pie-chart-fill"></i> Calculadora 50/30/20</h1>
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
                    <h2><i class="bi bi-calculator"></i> Calculadora de Presupuesto 50/30/20</h2>
                    <p>Distribuye tus ingresos de manera óptima entre necesidades, deseos y ahorro</p>
                </div>
                
                <div class="calculator-body">
                    <!-- Formulario -->
                    <div class="calculator-form">
                        <div class="form-group">
                            <label for="ingresos-mensuales">Ingresos mensuales <i class="bi bi-info-circle info-icon" title="Total de ingresos netos que recibes cada mes"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="ingresos-mensuales" value="3000" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="gastos-necesidades">Gastos actuales en necesidades <i class="bi bi-info-circle info-icon" title="Lo que actualmente gastas en vivienda, comida, transporte, servicios básicos, etc."></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="gastos-necesidades" value="1800" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="gastos-deseos">Gastos actuales en deseos <i class="bi bi-info-circle info-icon" title="Lo que actualmente gastas en entretenimiento, salidas, hobbies, etc."></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="gastos-deseos" value="900" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="gastos-ahorro">Ahorro actual <i class="bi bi-info-circle info-icon" title="Lo que actualmente ahorras o inviertes cada mes"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="gastos-ahorro" value="300" min="0">
                            </div>
                        </div>
                        
                        <button id="calcular" class="btn btn-calculate mt-4">
                            <i class="bi bi-calculator"></i> Calcular distribución ideal
                        </button>
                        
                        <div class="method-explanation mt-4">
                            <div class="method-title">¿Qué es el método 50/30/20?</div>
                            
                            <div class="method-step">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <strong>50% Necesidades:</strong> Gastos esenciales como vivienda, comida, transporte, servicios básicos, seguros y pagos mínimos de deudas.
                                </div>
                            </div>
                            
                            <div class="method-step">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <strong>30% Deseos:</strong> Gastos no esenciales como entretenimiento, salidas, vacaciones, suscripciones y compras discrecionales.
                                </div>
                            </div>
                            
                            <div class="method-step">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <strong>20% Ahorro:</strong> Ahorro para emergencias, inversiones, pago adicional de deudas y metas financieras a futuro.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Resultados -->
                    <div class="calculator-results">
                        <h4 class="text-center mb-4" style="color: var(--izi-green-darker);">
                            <i class="bi bi-pie-chart"></i> Distribución ideal
                        </h4>
                        
                        <div class="result-card necesidades-card">
                            <div class="result-title">Necesidades (50%)</div>
                            <div class="result-value necesidades-value" id="necesidades-ideal">$1,500.00</div>
                            <div class="result-detail">
                                <span id="necesidades-diferencia" class="badge bg-success">-$300.00</span> 
                                vs tu gasto actual
                            </div>
                        </div>
                        
                        <div class="result-card deseos-card">
                            <div class="result-title">Deseos (30%)</div>
                            <div class="result-value deseos-value" id="deseos-ideal">$900.00</div>
                            <div class="result-detail">
                                <span id="deseos-diferencia" class="badge bg-success">$0.00</span> 
                                vs tu gasto actual
                            </div>
                        </div>
                        
                        <div class="result-card ahorro-card">
                            <div class="result-title">Ahorro (20%)</div>
                            <div class="result-value ahorro-value" id="ahorro-ideal">$600.00</div>
                            <div class="result-detail">
                                <span id="ahorro-diferencia" class="badge bg-success">+$300.00</span> 
                                vs tu ahorro actual
                            </div>
                        </div>
                        
                        <div class="chart-container">
                            <canvas id="result-chart"></canvas>
                        </div>
                        
                        <div class="result-card mt-4">
                            <div class="result-title">Resumen de tu situación actual</div>
                            <div class="progress mb-3" style="height: 25px;">
                                <div class="progress-bar bg-primary" role="progressbar" id="progress-necesidades" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">Necesidades 60%</div>
                                <div class="progress-bar bg-success" role="progressbar" id="progress-deseos" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">Deseos 30%</div>
                                <div class="progress-bar bg-info" role="progressbar" id="progress-ahorro" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">Ahorro 10%</div>
                            </div>
                            <div class="result-detail">
                                Tu distribución actual: <strong id="distribucion-actual">60% / 30% / 10%</strong>
                            </div>
                            <div class="result-detail">
                                Distribución ideal: <strong>50% / 30% / 20%</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center text-muted">
                <small><i class="bi bi-lightbulb"></i> "No ahorres lo que te queda después de gastar, gasta lo que te queda después de ahorrar." - Warren Buffett</small>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos del DOM
            const ingresosMensuales = document.getElementById('ingresos-mensuales');
            const gastosNecesidades = document.getElementById('gastos-necesidades');
            const gastosDeseos = document.getElementById('gastos-deseos');
            const gastosAhorro = document.getElementById('gastos-ahorro');
            const calcularBtn = document.getElementById('calcular');
            
            // Resultados
            const necesidadesIdeal = document.getElementById('necesidades-ideal');
            const deseosIdeal = document.getElementById('deseos-ideal');
            const ahorroIdeal = document.getElementById('ahorro-ideal');
            const necesidadesDiferencia = document.getElementById('necesidades-diferencia');
            const deseosDiferencia = document.getElementById('deseos-diferencia');
            const ahorroDiferencia = document.getElementById('ahorro-diferencia');
            const distribucionActual = document.getElementById('distribucion-actual');
            const progressNecesidades = document.getElementById('progress-necesidades');
            const progressDeseos = document.getElementById('progress-deseos');
            const progressAhorro = document.getElementById('progress-ahorro');
            
            // Gráfico
            const chartCtx = document.getElementById('result-chart').getContext('2d');
            let budgetChart = new Chart(chartCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Necesidades', 'Deseos', 'Ahorro'],
                    datasets: [{
                        data: [1500, 900, 600],
                        backgroundColor: [
                            'rgba(78, 115, 223, 0.8)',
                            'rgba(28, 200, 138, 0.8)',
                            'rgba(54, 185, 204, 0.8)'
                        ],
                        borderColor: [
                            'rgba(78, 115, 223, 1)',
                            'rgba(28, 200, 138, 1)',
                            'rgba(54, 185, 204, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: $${value.toLocaleString()} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
            
            // Event listeners
            calcularBtn.addEventListener('click', calcularPresupuesto);
            
            // Calcular al cargar la página
            calcularPresupuesto();
            
            // Función principal de cálculo
            function calcularPresupuesto() {
                const ingresos = parseFloat(ingresosMensuales.value) || 0;
                const necesidadesActual = parseFloat(gastosNecesidades.value) || 0;
                const deseosActual = parseFloat(gastosDeseos.value) || 0;
                const ahorroActual = parseFloat(gastosAhorro.value) || 0;
                
                // Calcular distribución ideal
                const necesidadesIdealVal = ingresos * 0.5;
                const deseosIdealVal = ingresos * 0.3;
                const ahorroIdealVal = ingresos * 0.2;
                
                // Calcular diferencias
                const necesidadesDiff = necesidadesIdealVal - necesidadesActual;
                const deseosDiff = deseosIdealVal - deseosActual;
                const ahorroDiff = ahorroIdealVal - ahorroActual;
                
                // Calcular distribución actual en porcentajes
                const totalActual = necesidadesActual + deseosActual + ahorroActual;
                let necesidadesPct = 0;
                let deseosPct = 0;
                let ahorroPct = 0;
                
                if (totalActual > 0) {
                    necesidadesPct = Math.round((necesidadesActual / totalActual) * 100);
                    deseosPct = Math.round((deseosActual / totalActual) * 100);
                    ahorroPct = Math.round((ahorroActual / totalActual) * 100);
                }
                
                // Actualizar UI
                necesidadesIdeal.textContent = '$' + necesidadesIdealVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                deseosIdeal.textContent = '$' + deseosIdealVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                ahorroIdeal.textContent = '$' + ahorroIdealVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                necesidadesDiferencia.textContent = (necesidadesDiff >= 0 ? '+' : '') + '$' + Math.abs(necesidadesDiff).toFixed(2);
                necesidadesDiferencia.className = 'badge ' + (necesidadesDiff >= 0 ? 'bg-success' : 'bg-danger');
                
                deseosDiferencia.textContent = (deseosDiff >= 0 ? '+' : '') + '$' + Math.abs(deseosDiff).toFixed(2);
                deseosDiferencia.className = 'badge ' + (deseosDiff >= 0 ? 'bg-success' : 'bg-danger');
                
                ahorroDiferencia.textContent = (ahorroDiff >= 0 ? '+' : '') + '$' + Math.abs(ahorroDiff).toFixed(2);
                ahorroDiferencia.className = 'badge ' + (ahorroDiff >= 0 ? 'bg-success' : 'bg-danger');
                
                distribucionActual.textContent = necesidadesPct + '% / ' + deseosPct + '% / ' + ahorroPct + '%';
                
                // Actualizar gráfico
                budgetChart.data.datasets[0].data = [necesidadesIdealVal, deseosIdealVal, ahorroIdealVal];
                budgetChart.update();
                
                // Actualizar barra de progreso
                progressNecesidades.style.width = necesidadesPct + '%';
                progressNecesidades.setAttribute('aria-valuenow', necesidadesPct);
                progressNecesidades.textContent = `Necesidades ${necesidadesPct}%`;
                
                progressDeseos.style.width = deseosPct + '%';
                progressDeseos.setAttribute('aria-valuenow', deseosPct);
                progressDeseos.textContent = `Deseos ${deseosPct}%`;
                
                progressAhorro.style.width = ahorroPct + '%';
                progressAhorro.setAttribute('aria-valuenow', ahorroPct);
                progressAhorro.textContent = `Ahorro ${ahorroPct}%`;
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