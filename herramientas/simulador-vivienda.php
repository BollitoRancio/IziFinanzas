<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Hipoteca | IziFinanzas</title>
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
            border-left: 4px solid var(--primary-blue);
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
            color: var(--primary-blue);
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
        
        .amortization-table {
            max-height: 300px;
            overflow-y: auto;
            margin-top: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        
        .table th {
            position: sticky;
            top: 0;
            background-color: white;
        }
        
        .scenario-card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-left: 4px solid var(--izi-green);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .scenario-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .scenario-title {
            font-weight: 600;
            color: var(--izi-green-darker);
            margin-bottom: 5px;
        }
        
        .scenario-detail {
            font-size: 0.9rem;
            margin-bottom: 3px;
        }
        
        .scenario-selected {
            border-left: 4px solid var(--primary-blue);
            background-color: var(--izi-green-light);
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
                <h1 class="header-title"><i class="bi bi-house-door"></i> Simulador de Hipoteca</h1>
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
                    <h2><i class="bi bi-calculator"></i> Simulador de Compra de Vivienda</h2>
                    <p>Simula diferentes escenarios para comprar tu casa y planea tu hipoteca</p>
                </div>
                
                <div class="calculator-body">
                    <!-- Formulario -->
                    <div class="calculator-form">
                        <div class="form-group">
                            <label for="valor-propiedad">Valor de la propiedad <i class="bi bi-info-circle info-icon" title="Precio total de la vivienda que deseas comprar"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="valor-propiedad" value="250000" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="enganche">Enganche (20%) <i class="bi bi-info-circle info-icon" title="Porcentaje inicial que pagarás de la propiedad"></i></label>
                            <div class="row">
                                <div class="col-8">
                                    <input type="range" class="form-range" id="enganche" min="5" max="50" value="20">
                                </div>
                                <div class="col-4">
                                    <span id="enganche-value">20</span>%
                                </div>
                            </div>
                            <div class="input-group mt-2">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="enganche-monto" value="50000" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="plazo">Plazo del crédito <i class="bi bi-info-circle info-icon" title="Años que tendrás para pagar la hipoteca"></i></label>
                            <div class="row">
                                <div class="col-8">
                                    <input type="range" class="form-range" id="plazo" min="5" max="30" value="20">
                                </div>
                                <div class="col-4">
                                    <span id="plazo-value">20</span> años
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="tasa-interes">Tasa de interés anual <i class="bi bi-info-circle info-icon" title="Tasa de interés que aplicará a tu crédito hipotecario"></i></label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="tasa-interes" value="8.5" min="0" max="30" step="0.1">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="ingresos-mensuales">Ingresos mensuales <i class="bi bi-info-circle info-icon" title="Total de ingresos netos mensuales del hogar"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="ingresos-mensuales" value="5000" min="0">
                            </div>
                        </div>
                        
                        <button id="calcular" class="btn btn-calculate mt-4">
                            <i class="bi bi-calculator"></i> Calcular hipoteca
                        </button>
                        
                        <div class="mt-4">
                            <h5 class="mb-3" style="color: var(--izi-green-darker);">
                                <i class="bi bi-lightning-charge"></i> Escenarios predefinidos
                            </h5>
                            
                            <div class="scenario-card" onclick="aplicarEscenario('conservador')">
                                <div class="scenario-title">Conservador</div>
                                <div class="scenario-detail">Enganche 30% - Plazo 15 años - Tasa 7.5%</div>
                                <div class="scenario-detail"><small>Pago mensual más alto pero menos intereses</small></div>
                            </div>
                            
                            <div class="scenario-card" onclick="aplicarEscenario('equilibrado')">
                                <div class="scenario-title">Equilibrado</div>
                                <div class="scenario-detail">Enganche 20% - Plazo 20 años - Tasa 8.5%</div>
                                <div class="scenario-detail"><small>Balance entre pago mensual y tiempo</small></div>
                            </div>
                            
                            <div class="scenario-card" onclick="aplicarEscenario('agresivo')">
                                <div class="scenario-title">Agresivo</div>
                                <div class="scenario-detail">Enganche 10% - Plazo 30 años - Tasa 9.5%</div>
                                <div class="scenario-detail"><small>Pago mensual más bajo pero más intereses</small></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Resultados -->
                    <div class="calculator-results">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="resumen-tab" data-bs-toggle="tab" data-bs-target="#resumen" type="button" role="tab">Resumen</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="amortizacion-tab" data-bs-toggle="tab" data-bs-target="#amortizacion" type="button" role="tab">Amortización</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="analisis-tab" data-bs-toggle="tab" data-bs-target="#analisis" type="button" role="tab">Análisis</button>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="resumen" role="tabpanel">
                                <div class="result-card">
                                    <div class="result-title">Pago mensual estimado</div>
                                    <div class="result-value" id="pago-mensual">$1,610.46</div>
                                    <div class="result-detail" id="porcentaje-ingresos">32.2% de tus ingresos mensuales</div>
                                </div>
                                
                                <div class="result-card">
                                    <div class="result-title">Monto a financiar</div>
                                    <div class="result-value" id="monto-financiar">$200,000.00</div>
                                    <div class="result-detail">Después de tu enganche</div>
                                </div>
                                
                                <div class="result-card">
                                    <div class="result-title">Intereses totales</div>
                                    <div class="result-value" id="intereses-totales">$186,510.53</div>
                                    <div class="result-detail">Costo total del crédito</div>
                                </div>
                                
                                <div class="chart-container">
                                    <canvas id="result-chart"></canvas>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="amortizacion" role="tabpanel">
                                <div class="amortization-table">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Año</th>
                                                <th>Pago Anual</th>
                                                <th>Principal</th>
                                                <th>Intereses</th>
                                                <th>Saldo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla-amortizacion">
                                            <!-- Datos de amortización se insertarán aquí -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="analisis" role="tabpanel">
                                <div class="result-card">
                                    <div class="result-title">Relación pago/ingresos</div>
                                    <div class="progress mb-3" style="height: 25px;">
                                        <div class="progress-bar bg-success" role="progressbar" id="progreso-relacion" style="width: 32%;" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100">32%</div>
                                    </div>
                                    <div class="result-detail">
                                        <strong>Recomendación:</strong> Idealmente tu pago hipotecario no debería exceder el 30% de tus ingresos.
                                    </div>
                                </div>
                                
                                <div class="result-card">
                                    <div class="result-title">Comparación de plazos</div>
                                    <div class="chart-container">
                                        <canvas id="plazos-chart"></canvas>
                                    </div>
                                    <div class="result-detail">
                                        <strong>Consejo:</strong> Plazos más cortos significan menos intereses pero pagos mensuales más altos.
                                    </div>
                                </div>
                                
                                <div class="result-card">
                                    <div class="result-title">Ahorro con enganche adicional</div>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Enganche</th>
                                                    <th>Pago Mensual</th>
                                                    <th>Intereses Totales</th>
                                                    <th>Ahorro</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabla-enganches">
                                                <!-- Datos de comparación de enganches se insertarán aquí -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center text-muted">
                <small><i class="bi bi-lightbulb"></i> "Comprar una casa es una de las decisiones financieras más importantes de tu vida. Tómate tu tiempo para analizar diferentes escenarios."</small>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos del DOM
            const valorPropiedad = document.getElementById('valor-propiedad');
            const engancheSlider = document.getElementById('enganche');
            const engancheValue = document.getElementById('enganche-value');
            const engancheMonto = document.getElementById('enganche-monto');
            const plazoSlider = document.getElementById('plazo');
            const plazoValue = document.getElementById('plazo-value');
            const tasaInteres = document.getElementById('tasa-interes');
            const ingresosMensuales = document.getElementById('ingresos-mensuales');
            const calcularBtn = document.getElementById('calcular');
            
            // Resultados
            const pagoMensual = document.getElementById('pago-mensual');
            const porcentajeIngresos = document.getElementById('porcentaje-ingresos');
            const montoFinanciar = document.getElementById('monto-financiar');
            const interesesTotales = document.getElementById('intereses-totales');
            const tablaAmortizacion = document.getElementById('tabla-amortizacion');
            const progresoRelacion = document.getElementById('progreso-relacion');
            const tablaEnganches = document.getElementById('tabla-enganches');
            
            // Gráficos
            const chartCtx = document.getElementById('result-chart').getContext('2d');
            let mortgageChart = new Chart(chartCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Valor propiedad', 'Enganche', 'Intereses'],
                    datasets: [{
                        data: [250000, 50000, 186510.53],
                        backgroundColor: [
                            'rgba(78, 115, 223, 0.8)',
                            'rgba(40, 167, 69, 0.8)',
                            'rgba(220, 53, 69, 0.8)'
                        ],
                        borderColor: [
                            'rgba(78, 115, 223, 1)',
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
                                    return `${label}: $${value.toLocaleString()}`;
                                }
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
            
            let plazosChart = null;
            
            // Event listeners
            engancheSlider.addEventListener('input', function() {
                engancheValue.textContent = this.value;
                actualizarEngancheMonto();
            });
            
            plazoSlider.addEventListener('input', function() {
                plazoValue.textContent = this.value;
            });
            
            valorPropiedad.addEventListener('input', actualizarEngancheMonto);
            
            calcularBtn.addEventListener('click', calcularHipoteca);
            
            // Calcular al cargar la página
            calcularHipoteca();
            
            // Funciones auxiliares
            function actualizarEngancheMonto() {
                const valor = parseFloat(valorPropiedad.value) || 0;
                const porcentaje = parseFloat(engancheSlider.value) / 100;
                engancheMonto.value = (valor * porcentaje).toFixed(2);
            }
            
            function aplicarEscenario(tipo) {
                switch(tipo) {
                    case 'conservador':
                        engancheSlider.value = 30;
                        plazoSlider.value = 15;
                        tasaInteres.value = 7.5;
                        break;
                    case 'equilibrado':
                        engancheSlider.value = 20;
                        plazoSlider.value = 20;
                        tasaInteres.value = 8.5;
                        break;
                    case 'agresivo':
                        engancheSlider.value = 10;
                        plazoSlider.value = 30;
                        tasaInteres.value = 9.5;
                        break;
                }
                
                engancheValue.textContent = engancheSlider.value;
                plazoValue.textContent = plazoSlider.value;
                actualizarEngancheMonto();
                calcularHipoteca();
                
                // Resaltar escenario seleccionado
                document.querySelectorAll('.scenario-card').forEach(card => {
                    card.classList.remove('scenario-selected');
                });
                event.currentTarget.classList.add('scenario-selected');
            }
            
            // Función principal de cálculo
            function calcularHipoteca() {
                const valor = parseFloat(valorPropiedad.value) || 0;
                const enganchePorcentaje = parseFloat(engancheSlider.value) / 100;
                const engancheMontoVal = valor * enganchePorcentaje;
                const montoFinanciarVal = valor - engancheMontoVal;
                const plazoAnios = parseFloat(plazoSlider.value);
                const tasaAnual = parseFloat(tasaInteres.value) / 100;
                const ingresos = parseFloat(ingresosMensuales.value) || 0;
                
                // Calcular pago mensual (fórmula de amortización)
                const tasaMensual = tasaAnual / 12;
                const plazoMeses = plazoAnios * 12;
                
                let pagoMensualVal = 0;
                if (tasaMensual > 0) {
                    pagoMensualVal = montoFinanciarVal * 
                                     (tasaMensual * Math.pow(1 + tasaMensual, plazoMeses)) / 
                                     (Math.pow(1 + tasaMensual, plazoMeses) - 1);
                } else {
                    pagoMensualVal = montoFinanciarVal / plazoMeses;
                }
                
                // Calcular intereses totales
                const interesesTotalesVal = (pagoMensualVal * plazoMeses) - montoFinanciarVal;
                
                // Calcular porcentaje de ingresos
                const porcentajeIngresosVal = ingresos > 0 ? (pagoMensualVal / ingresos) * 100 : 0;
                
                // Actualizar UI
                pagoMensual.textContent = '$' + pagoMensualVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                porcentajeIngresos.textContent = porcentajeIngresosVal.toFixed(1) + '% de tus ingresos mensuales';
                montoFinanciar.textContent = '$' + montoFinanciarVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                interesesTotales.textContent = '$' + interesesTotalesVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                // Actualizar gráfico
                mortgageChart.data.datasets[0].data = [valor, engancheMontoVal, interesesTotalesVal];
                mortgageChart.update();
                
                // Actualizar barra de relación pago/ingresos
                const relacionWidth = Math.min(100, porcentajeIngresosVal);
                progresoRelacion.style.width = relacionWidth + '%';
                progresoRelacion.setAttribute('aria-valuenow', relacionWidth);
                progresoRelacion.textContent = porcentajeIngresosVal.toFixed(1) + '%';
                
                // Actualizar tabla de amortización (simplificada por años)
                let amortizacionHTML = '';
                let saldo = montoFinanciarVal;
                
                for (let año = 1; año <= plazoAnios; año++) {
                    let interesAnual = 0;
                    let principalAnual = 0;
                    
                    for (let mes = 1; mes <= 12; mes++) {
                        const interesMensual = saldo * tasaMensual;
                        const principalMensual = pagoMensualVal - interesMensual;
                        
                        interesAnual += interesMensual;
                        principalAnual += principalMensual;
                        saldo -= principalMensual;
                    }
                    
                    amortizacionHTML += `
                        <tr>
                            <td>${año}</td>
                            <td>$${(pagoMensualVal * 12).toFixed(2)}</td>
                            <td>$${principalAnual.toFixed(2)}</td>
                            <td>$${interesAnual.toFixed(2)}</td>
                            <td>$${saldo > 0 ? saldo.toFixed(2) : '0.00'}</td>
                        </tr>
                    `;
                }
                
                tablaAmortizacion.innerHTML = amortizacionHTML;
                
                // Actualizar tabla de comparación de enganches
                let enganchesHTML = '';
                const enganches = [10, 20, 30, 40];
                
                enganches.forEach(eng => {
                    const engMonto = valor * (eng / 100);
                    const montoFin = valor - engMonto;
                    
                    let pagoMens = 0;
                    if (tasaMensual > 0) {
                        pagoMens = montoFin * 
                                 (tasaMensual * Math.pow(1 + tasaMensual, plazoMeses)) / 
                                 (Math.pow(1 + tasaMensual, plazoMeses) - 1);
                    } else {
                        pagoMens = montoFin / plazoMeses;
                    }
                    
                    const intTotal = (pagoMens * plazoMeses) - montoFin;
                    const ahorro = interesesTotalesVal - intTotal;
                    
                    enganchesHTML += `
                        <tr>
                            <td>${eng}% ($${engMonto.toFixed(0)})</td>
                            <td>$${pagoMens.toFixed(2)}</td>
                            <td>$${intTotal.toFixed(0)}</td>
                            <td class="${ahorro > 0 ? 'text-success' : 'text-danger'}">$${Math.abs(ahorro).toFixed(0)}</td>
                        </tr>
                    `;
                });
                
                tablaEnganches.innerHTML = enganchesHTML;
                
                // Actualizar gráfico de comparación de plazos
                if (plazosChart) {
                    plazosChart.destroy();
                }
                
                const plazosCtx = document.getElementById('plazos-chart').getContext('2d');
                const plazos = [10, 15, 20, 25, 30];
                const pagos = [];
                const intereses = [];
                
                plazos.forEach(plz => {
                    const plzMeses = plz * 12;
                    let pago = 0;
                    
                    if (tasaMensual > 0) {
                        pago = montoFinanciarVal * 
                             (tasaMensual * Math.pow(1 + tasaMensual, plzMeses)) / 
                             (Math.pow(1 + tasaMensual, plzMeses) - 1);
                    } else {
                        pago = montoFinanciarVal / plzMeses;
                    }
                    
                    pagos.push(pago);
                    intereses.push((pago * plzMeses) - montoFinanciarVal);
                });
                
                plazosChart = new Chart(plazosCtx, {
                    type: 'bar',
                    data: {
                        labels: plazos.map(p => p + ' años'),
                        datasets: [
                            {
                                label: 'Pago Mensual',
                                data: pagos,
                                backgroundColor: 'rgba(40, 167, 69, 0.8)',
                                borderColor: 'rgba(40, 167, 69, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Intereses Totales',
                                data: intereses,
                                backgroundColor: 'rgba(220, 53, 69, 0.8)',
                                borderColor: 'rgba(220, 53, 69, 1)',
                                borderWidth: 1
                            }
                        ]
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
                                        const label = context.dataset.label || '';
                                        const value = context.raw || 0;
                                        return `${label}: $${value.toFixed(2)}`;
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