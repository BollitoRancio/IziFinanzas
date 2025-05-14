<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Retiro | IziFinanzas</title>
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
            --primary-blue: #4e73df;
            --secondary-blue: #2e59d9;
            --retirement-orange: #fd7e14;
            --retirement-purple: #6f42c1;
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
            left: 100px;
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
            max-width: 1000px;
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
        
        .savings-card {
            border-left: 4px solid var(--primary-blue);
        }
        
        .retirement-card {
            border-left: 4px solid var(--retirement-orange);
        }
        
        .pension-card {
            border-left: 4px solid var(--retirement-purple);
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
        
        .savings-value {
            color: var(--primary-blue);
        }
        
        .retirement-value {
            color: var(--retirement-orange);
        }
        
        .pension-value {
            color: var(--retirement-purple);
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
        
        .tab-content {
            padding: 15px 0;
        }
        
        .nav-tabs .nav-link {
            color: var(--izi-green-darker);
            font-weight: 500;
        }
        
        .nav-tabs .nav-link.active {
            color: var(--primary-blue);
            font-weight: 600;
            border-bottom: 3px solid var(--primary-blue);
        }
        
        .timeline-container {
            margin-top: 20px;
            position: relative;
            padding-left: 30px;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }
        
        .timeline-item:last-child {
            padding-bottom: 0;
        }
        
        .timeline-dot {
            position: absolute;
            left: -30px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: var(--izi-green);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.7rem;
        }
        
        .timeline-content {
            background-color: white;
            padding: 10px 15px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .timeline-year {
            font-weight: 600;
            color: var(--izi-green-darker);
        }
        
        .timeline-amount {
            font-weight: 500;
            margin-top: 5px;
        }
        
        .timeline-connector {
            position: absolute;
            left: -21px;
            top: 20px;
            bottom: 0;
            width: 2px;
            background-color: #dee2e6;
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
                <h1 class="header-title"><i class="bi bi-piggy-bank"></i> Simulador de Retiro</h1>
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
                    <h2><i class="bi bi-calculator"></i> Simulador de Retiro y Jubilación</h2>
                    <p>Planifica tu futuro financiero y calcula cuánto necesitarás para tu jubilación</p>
                </div>
                
                <div class="calculator-body">
                    <!-- Formulario -->
                    <div class="calculator-form">
                        <div class="form-group">
                            <label for="edad-actual">Edad actual <i class="bi bi-info-circle info-icon" title="Tu edad actual en años"></i></label>
                            <input type="number" class="form-control" id="edad-actual" value="35" min="18" max="80">
                        </div>
                        
                        <div class="form-group">
                            <label for="edad-retiro">Edad de retiro <i class="bi bi-info-circle info-icon" title="Edad a la que planeas retirarte"></i></label>
                            <input type="number" class="form-control" id="edad-retiro" value="65" min="40" max="90">
                        </div>
                        
                        <div class="form-group">
                            <label for="ahorros-actuales">Ahorros actuales <i class="bi bi-info-circle info-icon" title="Cantidad que has ahorrado hasta ahora para tu retiro"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="ahorros-actuales" value="50000" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="ingreso-mensual">Ingreso mensual actual <i class="bi bi-info-circle info-icon" title="Tu ingreso neto mensual actual"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="ingreso-mensual" value="3000" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="ahorro-mensual">Ahorro mensual <i class="bi bi-info-circle info-icon" title="Cantidad que ahorras cada mes para tu retiro"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="ahorro-mensual" value="500" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="tasa-rendimiento">Tasa de rendimiento anual <i class="bi bi-info-circle info-icon" title="Rendimiento anual esperado de tus inversiones"></i></label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="tasa-rendimiento" value="7" min="0" max="20" step="0.1">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="pension-mensual">Pensión mensual esperada <i class="bi bi-info-circle info-icon" title="Pensión que esperas recibir mensualmente"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="pension-mensual" value="1500" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="gasto-mensual">Gasto mensual en retiro <i class="bi bi-info-circle info-icon" title="Cantidad que necesitarás mensualmente durante tu retiro"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="gasto-mensual" value="2500" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="expectativa-vida">Expectativa de vida <i class="bi bi-info-circle info-icon" title="Edad hasta la que esperas vivir"></i></label>
                            <input type="number" class="form-control" id="expectativa-vida" value="85" min="60" max="120">
                        </div>
                        
                        <button id="calcular" class="btn btn-calculate mt-4">
                            <i class="bi bi-calculator"></i> Calcular plan de retiro
                        </button>
                    </div>
                    
                    <!-- Resultados -->
                    <div class="calculator-results">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="resumen-tab" data-bs-toggle="tab" data-bs-target="#resumen" type="button" role="tab">Resumen</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="proyeccion-tab" data-bs-toggle="tab" data-bs-target="#proyeccion" type="button" role="tab">Proyección</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="analisis-tab" data-bs-toggle="tab" data-bs-target="#analisis" type="button" role="tab">Análisis</button>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="resumen" role="tabpanel">
                                <div class="result-card savings-card">
                                    <div class="result-title">Ahorro estimado al retiro</div>
                                    <div class="result-value savings-value" id="ahorro-retiro">$987,432.00</div>
                                    <div class="result-detail">Basado en tus aportaciones actuales y rendimiento esperado</div>
                                </div>
                                
                                <div class="result-card retirement-card">
                                    <div class="result-title">Fondos necesarios para retiro</div>
                                    <div class="result-value retirement-value" id="necesario-retiro">$1,250,000.00</div>
                                    <div class="result-detail">Para cubrir tus gastos durante <span id="anos-retiro">20</span> años de jubilación</div>
                                </div>
                                
                                <div class="result-card pension-card">
                                    <div class="result-title">Brecha de financiamiento</div>
                                    <div class="result-value pension-value" id="brecha-retiro">$262,568.00</div>
                                    <div class="result-detail">Diferencia entre lo que tendrás y lo que necesitarás</div>
                                </div>
                                
                                <div class="result-card mt-4">
                                    <div class="result-title">Recomendaciones</div>
                                    <div class="result-detail">
                                        <p id="recomendacion-texto">Para cerrar la brecha, puedes:</p>
                                        <ul>
                                            <li>Aumentar tus ahorros mensuales a <strong>$750</strong></li>
                                            <li>Retirarte 2 años más tarde</li>
                                            <li>Reducir tus gastos en retiro un 10%</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="proyeccion" role="tabpanel">
                                <div class="chart-container">
                                    <canvas id="ahorros-chart"></canvas>
                                </div>
                                
                                <div class="timeline-container">
                                    <div class="timeline-item">
                                        <div class="timeline-dot"><i class="bi bi-calendar-event"></i></div>
                                        <div class="timeline-content">
                                            <div class="timeline-year">Hoy (<span id="edad-actual-text">35</span> años)</div>
                                            <div class="timeline-amount">Ahorros actuales: <strong id="ahorro-actual-text">$50,000</strong></div>
                                        </div>
                                        <div class="timeline-connector"></div>
                                    </div>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-dot"><i class="bi bi-graph-up"></i></div>
                                        <div class="timeline-content">
                                            <div class="timeline-year">Retiro (<span id="edad-retiro-text">65</span> años)</div>
                                            <div class="timeline-amount">Ahorro proyectado: <strong id="ahorro-proyectado-text">$987,432</strong></div>
                                        </div>
                                        <div class="timeline-connector"></div>
                                    </div>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-dot"><i class="bi bi-cash-stack"></i></div>
                                        <div class="timeline-content">
                                            <div class="timeline-year">Fin de fondos (<span id="edad-fin-text">82</span> años)</div>
                                            <div class="timeline-amount">Edad estimada cuando se agoten tus ahorros</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="analisis" role="tabpanel">
                                <div class="chart-container">
                                    <canvas id="fuentes-chart"></canvas>
                                </div>
                                
                                <div class="result-card mt-4">
                                    <div class="result-title">Análisis de sostenibilidad</div>
                                    <div class="result-detail">
                                        <p>Tus ahorros durarán aproximadamente <strong id="anos-sostenibilidad">17</strong> años de retiro.</p>
                                        <p>Para mantener tu estilo de vida hasta los <strong id="expectativa-texto">85</strong> años, necesitarías:</p>
                                        <ul>
                                            <li>Aumentar tu ahorro mensual a <strong id="ahorro-requerido">$750</strong></li>
                                            <li>Obtener un rendimiento del <strong id="rendimiento-requerido">8.5%</strong> anual</li>
                                            <li>Reducir tus gastos en retiro a <strong id="gasto-requerido">$2,250</strong> mensuales</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="result-card">
                                    <div class="result-title">Estrategias recomendadas</div>
                                    <div class="result-detail">
                                        <ul class="mb-0">
                                            <li>Considera instrumentos de inversión con mayor rendimiento</li>
                                            <li>Explora planes de pensiones complementarios</li>
                                            <li>Evalúa reducir deudas antes del retiro</li>
                                            <li>Diversifica tus fuentes de ingreso en jubilación</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center text-muted">
                <small><i class="bi bi-lightbulb"></i> "El mejor momento para empezar a planificar tu retiro fue hace 20 años. El segundo mejor momento es hoy."</small>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos del DOM
            const edadActual = document.getElementById('edad-actual');
            const edadRetiro = document.getElementById('edad-retiro');
            const ahorrosActuales = document.getElementById('ahorros-actuales');
            const ingresoMensual = document.getElementById('ingreso-mensual');
            const ahorroMensual = document.getElementById('ahorro-mensual');
            const tasaRendimiento = document.getElementById('tasa-rendimiento');
            const pensionMensual = document.getElementById('pension-mensual');
            const gastoMensual = document.getElementById('gasto-mensual');
            const expectativaVida = document.getElementById('expectativa-vida');
            const calcularBtn = document.getElementById('calcular');
            
            // Resultados
            const ahorroRetiro = document.getElementById('ahorro-retiro');
            const necesarioRetiro = document.getElementById('necesario-retiro');
            const brechaRetiro = document.getElementById('brecha-retiro');
            const anosRetiro = document.getElementById('anos-retiro');
            const recomendacionTexto = document.getElementById('recomendacion-texto');
            const edadActualTexto = document.getElementById('edad-actual-text');
            const ahorroActualTexto = document.getElementById('ahorro-actual-text');
            const edadRetiroTexto = document.getElementById('edad-retiro-text');
            const ahorroProyectadoTexto = document.getElementById('ahorro-proyectado-text');
            const edadFinTexto = document.getElementById('edad-fin-text');
            const anosSostenibilidad = document.getElementById('anos-sostenibilidad');
            const expectativaTexto = document.getElementById('expectativa-texto');
            const ahorroRequerido = document.getElementById('ahorro-requerido');
            const rendimientoRequerido = document.getElementById('rendimiento-requerido');
            const gastoRequerido = document.getElementById('gasto-requerido');
            
            // Gráficos
            let ahorrosChart = null;
            let fuentesChart = null;
            
            // Event listeners
            calcularBtn.addEventListener('click', calcularRetiro);
            
            // Calcular al cargar la página
            calcularRetiro();
            
            // Función principal de cálculo
            function calcularRetiro() {
                const edadActualVal = parseInt(edadActual.value) || 35;
                const edadRetiroVal = parseInt(edadRetiro.value) || 65;
                const ahorrosActualesVal = parseFloat(ahorrosActuales.value) || 0;
                const ingresoMensualVal = parseFloat(ingresoMensual.value) || 0;
                const ahorroMensualVal = parseFloat(ahorroMensual.value) || 0;
                const tasaRendimientoVal = parseFloat(tasaRendimiento.value) / 100 || 0;
                const pensionMensualVal = parseFloat(pensionMensual.value) || 0;
                const gastoMensualVal = parseFloat(gastoMensual.value) || 0;
                const expectativaVidaVal = parseInt(expectativaVida.value) || 85;
                
                // Calcular años hasta el retiro
                const anosHastaRetiro = edadRetiroVal - edadActualVal;
                
                // Calcular ahorro acumulado al retiro (con interés compuesto mensual)
                const tasaMensual = Math.pow(1 + tasaRendimientoVal, 1/12) - 1;
                let ahorroAcumulado = ahorrosActualesVal;
                
                // Proyección año por año
                const proyeccionAhorros = [];
                for (let i = 0; i <= anosHastaRetiro; i++) {
                    proyeccionAhorros.push({
                        year: edadActualVal + i,
                        amount: i === 0 ? ahorrosActualesVal : 0
                    });
                }
                
                for (let mes = 1; mes <= anosHastaRetiro * 12; mes++) {
                    ahorroAcumulado = ahorroAcumulado * (1 + tasaMensual) + ahorroMensualVal;
                    
                    // Actualizar proyección anual
                    const anoActual = Math.floor(mes / 12);
                    if (mes % 12 === 0 && anoActual > 0) {
                        proyeccionAhorros[anoActual].amount = ahorroAcumulado;
                    }
                }
                
                // Calcular fondos necesarios para retiro
                const anosRetiroVal = expectativaVidaVal - edadRetiroVal;
                const necesidadMensual = gastoMensualVal - pensionMensualVal;
                const tasaInflacion = 0.03; // Supuesto de inflación del 3% anual
                const tasaReal = (tasaRendimientoVal - tasaInflacion) / (1 + tasaInflacion);
                const tasaMensualReal = Math.pow(1 + tasaReal, 1/12) - 1;
                
                let fondosNecesarios = 0;
                if (tasaMensualReal > 0) {
                    fondosNecesarios = necesidadMensual * ((1 - Math.pow(1 + tasaMensualReal, -anosRetiroVal * 12)) / tasaMensualReal);
                } else {
                    fondosNecesarios = necesidadMensual * anosRetiroVal * 12;
                }
                
                // Calcular brecha
                const brecha = fondosNecesarios - ahorroAcumulado;
                
                // Calcular sostenibilidad
                let anosSostenibilidadVal = 0;
                let saldoRetiro = ahorroAcumulado;
                let gastoMensualAjustado = necesidadMensual;
                
                while (saldoRetiro > 0 && anosSostenibilidadVal < 50) { // Máximo 50 años
                    const retiroMensual = Math.min(gastoMensualAjustado, saldoRetiro * tasaMensualReal);
                    saldoRetiro = saldoRetiro * (1 + tasaMensualReal) - gastoMensualAjustado;
                    anosSostenibilidadVal += 1/12;
                    gastoMensualAjustado *= Math.pow(1 + tasaInflacion/12, 1);
                }
                
                // Actualizar UI
                ahorroRetiro.textContent = '$' + ahorroAcumulado.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                necesarioRetiro.textContent = '$' + fondosNecesarios.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                brechaRetiro.textContent = brecha >= 0 ? '$' + brecha.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") : '$0.00';
                anosRetiro.textContent = anosRetiroVal;
                
                // Recomendaciones
                let recomendaciones = "Para cerrar la brecha, puedes:";
                if (brecha > 0) {
                    const ahorroExtraMensual = (ahorroMensualVal * (brecha / ahorroAcumulado)).toFixed(0);
                    const anosExtraRetiro = (brecha / (ahorroAcumulado * tasaRendimientoVal + ahorroMensualVal * 12)).toFixed(1);
                    const reduccionGastos = (gastoMensualVal * 0.1).toFixed(0);
                    
                    recomendaciones += `<ul>
                        <li>Aumentar tus ahorros mensuales a <strong>$${ahorroExtraMensual}</strong></li>
                        <li>Retirarte ${anosExtraRetiro} años más tarde</li>
                        <li>Reducir tus gastos en retiro un 10% ($${reduccionGastos} menos mensual)</li>
                    </ul>`;
                } else {
                    recomendaciones += "<p>¡Felicidades! Estás en camino a tener suficiente para tu retiro.</p>";
                }
                
                recomendacionTexto.innerHTML = recomendaciones;
                
                // Actualizar detalles
                edadActualTexto.textContent = edadActualVal;
                ahorroActualTexto.textContent = '$' + ahorrosActualesVal.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                edadRetiroTexto.textContent = edadRetiroVal;
                ahorroProyectadoTexto.textContent = '$' + ahorroAcumulado.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                edadFinTexto.textContent = Math.min(edadRetiroVal + Math.floor(anosSostenibilidadVal), expectativaVidaVal);
                anosSostenibilidad.textContent = Math.floor(anosSostenibilidadVal);
                expectativaTexto.textContent = expectativaVidaVal;
                
                // Calcular valores requeridos
                const ahorroReq = (ahorroMensualVal * (brecha > 0 ? 1.5 : 1)).toFixed(0);
                const rendimientoReq = (tasaRendimientoVal * 1.2).toFixed(1);
                const gastoReq = (gastoMensualVal * 0.9).toFixed(0);
                
                ahorroRequerido.textContent = '$' + ahorroReq;
                rendimientoRequerido.textContent = rendimientoReq + '%';
                gastoRequerido.textContent = '$' + gastoReq;
                
                // Actualizar gráficos
                actualizarGraficos(proyeccionAhorros, ahorroAcumulado, fondosNecesarios, pensionMensualVal, necesidadMensual);
            }
            
            function actualizarGraficos(proyeccion, ahorroAcumulado, fondosNecesarios, pension, necesidad) {
                // Destruir gráficos existentes si los hay
                if (ahorrosChart) {
                    ahorrosChart.destroy();
                }
                if (fuentesChart) {
                    fuentesChart.destroy();
                }
                
                // Gráfico de proyección de ahorros
                const ahorrosCtx = document.getElementById('ahorros-chart').getContext('2d');
                ahorrosChart = new Chart(ahorrosCtx, {
                    type: 'line',
                    data: {
                        labels: proyeccion.map(item => item.year),
                        datasets: [{
                            label: 'Ahorro acumulado',
                            data: proyeccion.map(item => item.amount),
                            borderColor: 'rgba(78, 115, 223, 1)',
                            backgroundColor: 'rgba(78, 115, 223, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'Ahorro: $' + context.raw.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                }
                            }
                        }
                    }
                });
                
                // Gráfico de fuentes de ingreso en retiro
                const fuentesCtx = document.getElementById('fuentes-chart').getContext('2d');
                fuentesChart = new Chart(fuentesCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Pensión', 'Ahorros personales', 'Brecha'],
                        datasets: [{
                            data: [pension, ahorroAcumulado / (parseInt(expectativaVida.value) - parseInt(edadRetiro.value)) / 12, Math.max(0, necesidad * (parseInt(expectativaVida.value) - parseInt(edadRetiro.value)) * 12 - ahorroAcumulado)],
                            backgroundColor: [
                                'rgba(111, 66, 193, 0.8)',
                                'rgba(40, 167, 69, 0.8)',
                                'rgba(220, 53, 69, 0.8)'
                            ],
                            borderColor: [
                                'rgba(111, 66, 193, 1)',
                                'rgba(40, 167, 69, 1)',
                                'rgba(220, 53, 69, 1)'
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
                                        return `${label}: $${value.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`;
                                    }
                                }
                            }
                        },
                        cutout: '65%'
                    }
                });
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