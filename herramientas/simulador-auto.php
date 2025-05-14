<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Auto | IziFinanzas</title>
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
        
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .comparison-table th, .comparison-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        
        .comparison-table th {
            background-color: var(--izi-green-light);
            color: var(--izi-green-darker);
        }
        
        .comparison-table tr:hover {
            background-color: rgba(0,0,0,0.02);
        }
        
        .savings-badge {
            background-color: var(--izi-green);
            color: white;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .cost-breakdown {
            margin-top: 20px;
        }
        
        .cost-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed #dee2e6;
        }
        
        .cost-item:last-child {
            border-bottom: none;
            font-weight: 600;
            color: var(--izi-green-darker);
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
                <h1 class="header-title"><i class="bi bi-car-front"></i> Simulador de Compra de Auto</h1>
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
                    <h2><i class="bi bi-calculator"></i> Simulador de Compra de Auto</h2>
                    <p>Compara financiamiento vs. contado y calcula costos totales de propiedad</p>
                </div>
                
                <div class="calculator-body">
                    <!-- Formulario -->
                    <div class="calculator-form">
                        <div class="form-group">
                            <label for="precio-auto">Precio del vehículo <i class="bi bi-info-circle info-icon" title="Precio de lista del automóvil que deseas comprar"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="precio-auto" value="25000" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="enganche">Enganche inicial <i class="bi bi-info-circle info-icon" title="Cantidad inicial que pagarás por el vehículo"></i></label>
                            <div class="row">
                                <div class="col-8">
                                    <input type="range" class="form-range" id="enganche" min="10" max="100" value="20">
                                </div>
                                <div class="col-4">
                                    <span id="enganche-value">20</span>%
                                </div>
                            </div>
                            <div class="input-group mt-2">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="enganche-monto" value="5000" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="plazo">Plazo del crédito <i class="bi bi-info-circle info-icon" title="Meses que tendrás para pagar el financiamiento"></i></label>
                            <div class="row">
                                <div class="col-8">
                                    <input type="range" class="form-range" id="plazo" min="12" max="84" value="48">
                                </div>
                                <div class="col-4">
                                    <span id="plazo-value">48</span> meses
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="tasa-interes">Tasa de interés anual <i class="bi bi-info-circle info-icon" title="Tasa de interés que aplicará a tu crédito automotriz"></i></label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="tasa-interes" value="9.5" min="0" max="30" step="0.1">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="seguro">Seguro anual <i class="bi bi-info-circle info-icon" title="Costo estimado del seguro anual para el vehículo"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="seguro" value="1200" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="mantenimiento">Mantenimiento anual <i class="bi bi-info-circle info-icon" title="Costo estimado de mantenimiento y servicios anuales"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="mantenimiento" value="800" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="combustible">Combustible mensual <i class="bi bi-info-circle info-icon" title="Costo estimado de combustible por mes"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="combustible" value="150" min="0">
                            </div>
                        </div>
                        
                        <button id="calcular" class="btn btn-calculate mt-4">
                            <i class="bi bi-calculator"></i> Calcular costos
                        </button>
                    </div>
                    
                    <!-- Resultados -->
                    <div class="calculator-results">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="comparacion-tab" data-bs-toggle="tab" data-bs-target="#comparacion" type="button" role="tab">Comparación</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="detalle-tab" data-bs-toggle="tab" data-bs-target="#detalle" type="button" role="tab">Detalle</button>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="comparacion" role="tabpanel">
                                <h5 class="mt-3" style="color: var(--izi-green-darker);">Comparación de opciones</h5>
                                
                                <table class="comparison-table">
                                    <thead>
                                        <tr>
                                            <th>Concepto</th>
                                            <th>Al contado</th>
                                            <th>Financiado</th>
                                            <th>Diferencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Pago inicial</td>
                                            <td id="contado-inicial">$25,000.00</td>
                                            <td id="financiado-inicial">$5,000.00</td>
                                            <td id="diferencia-inicial" class="text-success">-$20,000.00</td>
                                        </tr>
                                        <tr>
                                            <td>Pagos mensuales</td>
                                            <td>$0.00</td>
                                            <td id="financiado-mensual">$497.70</td>
                                            <td id="diferencia-mensual" class="text-danger">+$497.70</td>
                                        </tr>
                                        <tr>
                                            <td>Total pagado</td>
                                            <td id="contado-total">$25,000.00</td>
                                            <td id="financiado-total">$28,889.60</td>
                                            <td id="diferencia-total" class="text-danger">+$3,889.60</td>
                                        </tr>
                                        <tr>
                                            <td>Costo financiero</td>
                                            <td>$0.00</td>
                                            <td id="financiado-intereses">$3,889.60</td>
                                            <td id="diferencia-intereses" class="text-danger">+$3,889.60</td>
                                        </tr>
                                        <tr>
                                            <td>Costos anuales</td>
                                            <td id="contado-anual">$2,900.00</td>
                                            <td id="financiado-anual">$2,900.00</td>
                                            <td>$0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Costo total 5 años</td>
                                            <td id="contado-5anios">$39,500.00</td>
                                            <td id="financiado-5anios">$43,389.60</td>
                                            <td id="diferencia-5anios" class="text-danger">+$3,889.60</td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <div class="result-card mt-4">
                                    <div class="result-title">Recomendación</div>
                                    <div class="result-detail">
                                        <p id="recomendacion-texto">Si tienes el capital disponible, comprar al contado te ahorraría <strong>$3,889.60</strong> en intereses. Sin embargo, el financiamiento permite conservar tu liquidez.</p>
                                        <p class="mb-0"><i class="bi bi-lightbulb"></i> <strong>Consejo:</strong> Considera hacer un enganche mayor o buscar una tasa de interés más baja para reducir costos.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="detalle" role="tabpanel">
                                <h5 class="mt-3" style="color: var(--izi-green-darker);">Detalle de costos financiados</h5>
                                
                                <div class="cost-breakdown">
                                    <div class="cost-item">
                                        <span>Precio del vehículo:</span>
                                        <span id="detalle-precio">$25,000.00</span>
                                    </div>
                                    <div class="cost-item">
                                        <span>Enganche (<span id="detalle-enganche-pct">20</span>%):</span>
                                        <span id="detalle-enganche">-$5,000.00</span>
                                    </div>
                                    <div class="cost-item">
                                        <span>Monto financiado:</span>
                                        <span id="detalle-financiado">$20,000.00</span>
                                    </div>
                                    <div class="cost-item">
                                        <span>Intereses totales (<span id="detalle-plazo">48</span> meses):</span>
                                        <span id="detalle-intereses" class="text-danger">+$3,889.60</span>
                                    </div>
                                    <div class="cost-item">
                                        <span>Costo total del crédito:</span>
                                        <span id="detalle-total-credito">$23,889.60</span>
                                    </div>
                                    <div class="cost-item">
                                        <span>Pago mensual:</span>
                                        <span id="detalle-mensual">$497.70</span>
                                    </div>
                                </div>
                                
                                <h5 class="mt-4" style="color: var(--izi-green-darker);">Costos anuales de propiedad</h5>
                                
                                <div class="cost-breakdown">
                                    <div class="cost-item">
                                        <span>Seguro:</span>
                                        <span id="detalle-seguro">$1,200.00</span>
                                    </div>
                                    <div class="cost-item">
                                        <span>Mantenimiento:</span>
                                        <span id="detalle-mantenimiento">$800.00</span>
                                    </div>
                                    <div class="cost-item">
                                        <span>Combustible:</span>
                                        <span id="detalle-combustible">$1,800.00</span>
                                    </div>
                                    <div class="cost-item">
                                        <span>Total anual:</span>
                                        <span id="detalle-total-anual">$3,800.00</span>
                                    </div>
                                </div>
                                
                                <div class="result-card mt-4">
                                    <div class="result-title">Consideraciones adicionales</div>
                                    <div class="result-detail">
                                        <ul class="mb-0">
                                            <li>Los costos de mantenimiento aumentan después de los primeros años</li>
                                            <li>El seguro puede disminuir según el historial de manejo</li>
                                            <li>Considera depreciación del vehículo (aprox. 15-20% anual)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center text-muted">
                <small><i class="bi bi-lightbulb"></i> "El verdadero costo de un auto no es su precio de compra, sino su costo total de propiedad durante el tiempo que lo tengas."</small>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos del DOM
            const precioAuto = document.getElementById('precio-auto');
            const engancheSlider = document.getElementById('enganche');
            const engancheValue = document.getElementById('enganche-value');
            const engancheMonto = document.getElementById('enganche-monto');
            const plazoSlider = document.getElementById('plazo');
            const plazoValue = document.getElementById('plazo-value');
            const tasaInteres = document.getElementById('tasa-interes');
            const seguro = document.getElementById('seguro');
            const mantenimiento = document.getElementById('mantenimiento');
            const combustible = document.getElementById('combustible');
            const calcularBtn = document.getElementById('calcular');
            
            // Resultados
            const contadoInicial = document.getElementById('contado-inicial');
            const financiadoInicial = document.getElementById('financiado-inicial');
            const diferenciaInicial = document.getElementById('diferencia-inicial');
            const financiadoMensual = document.getElementById('financiado-mensual');
            const diferenciaMensual = document.getElementById('diferencia-mensual');
            const contadoTotal = document.getElementById('contado-total');
            const financiadoTotal = document.getElementById('financiado-total');
            const diferenciaTotal = document.getElementById('diferencia-total');
            const financiadoIntereses = document.getElementById('financiado-intereses');
            const diferenciaIntereses = document.getElementById('diferencia-intereses');
            const contadoAnual = document.getElementById('contado-anual');
            const financiadoAnual = document.getElementById('financiado-anual');
            const contado5Anios = document.getElementById('contado-5anios');
            const financiado5Anios = document.getElementById('financiado-5anios');
            const diferencia5Anios = document.getElementById('diferencia-5anios');
            const recomendacionTexto = document.getElementById('recomendacion-texto');
            
            // Detalle
            const detallePrecio = document.getElementById('detalle-precio');
            const detalleEnganchePct = document.getElementById('detalle-enganche-pct');
            const detalleEnganche = document.getElementById('detalle-enganche');
            const detalleFinanciado = document.getElementById('detalle-financiado');
            const detallePlazo = document.getElementById('detalle-plazo');
            const detalleIntereses = document.getElementById('detalle-intereses');
            const detalleTotalCredito = document.getElementById('detalle-total-credito');
            const detalleMensual = document.getElementById('detalle-mensual');
            const detalleSeguro = document.getElementById('detalle-seguro');
            const detalleMantenimiento = document.getElementById('detalle-mantenimiento');
            const detalleCombustible = document.getElementById('detalle-combustible');
            const detalleTotalAnual = document.getElementById('detalle-total-anual');
            
            // Gráficos
            let comparacionChart = null;
            let costosChart = null;
            
            // Event listeners
            engancheSlider.addEventListener('input', function() {
                engancheValue.textContent = this.value;
                actualizarEngancheMonto();
            });
            
            plazoSlider.addEventListener('input', function() {
                plazoValue.textContent = this.value;
            });
            
            precioAuto.addEventListener('input', actualizarEngancheMonto);
            
            calcularBtn.addEventListener('click', calcularCostosAuto);
            
            // Calcular al cargar la página
            calcularCostosAuto();
            
            // Funciones auxiliares
            function actualizarEngancheMonto() {
                const valor = parseFloat(precioAuto.value) || 0;
                const porcentaje = parseFloat(engancheSlider.value) / 100;
                engancheMonto.value = (valor * porcentaje).toFixed(2);
            }
            
            // Función principal de cálculo
            function calcularCostosAuto() {
                const precio = parseFloat(precioAuto.value) || 0;
                const enganchePorcentaje = parseFloat(engancheSlider.value) / 100;
                const engancheMontoVal = precio * enganchePorcentaje;
                const montoFinanciarVal = precio - engancheMontoVal;
                const plazoMeses = parseFloat(plazoSlider.value);
                const tasaAnual = parseFloat(tasaInteres.value) / 100;
                const seguroVal = parseFloat(seguro.value) || 0;
                const mantenimientoVal = parseFloat(mantenimiento.value) || 0;
                const combustibleVal = parseFloat(combustible.value) || 0;
                
                // Calcular pago mensual del financiamiento
                const tasaMensual = tasaAnual / 12;
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
                const totalFinanciadoVal = precio + interesesTotalesVal;
                
                // Calcular costos anuales
                const costosAnualesVal = seguroVal + mantenimientoVal + (combustibleVal * 12);
                const costos5AniosVal = costosAnualesVal * 5;
                
                // Costo total contado (precio + costos 5 años)
                const totalContado5Anios = precio + costos5AniosVal;
                
                // Costo total financiado (enganche + pagos mensuales + costos 5 años)
                // Si el plazo es mayor a 5 años, solo contamos los primeros 60 pagos
                const pagos5Anios = Math.min(plazoMeses, 60) * pagoMensualVal;
                const totalFinanciado5Anios = engancheMontoVal + pagos5Anios + costos5AniosVal;
                
                // Actualizar tabla de comparación
                contadoInicial.textContent = '$' + precio.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                financiadoInicial.textContent = '$' + engancheMontoVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                diferenciaInicial.textContent = '-$' + (precio - engancheMontoVal).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                diferenciaInicial.className = 'text-success';
                
                financiadoMensual.textContent = '$' + pagoMensualVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                diferenciaMensual.textContent = '+$' + pagoMensualVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                diferenciaMensual.className = 'text-danger';
                
                contadoTotal.textContent = '$' + precio.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                financiadoTotal.textContent = '$' + totalFinanciadoVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                diferenciaTotal.textContent = '+$' + interesesTotalesVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                diferenciaTotal.className = 'text-danger';
                
                financiadoIntereses.textContent = '$' + interesesTotalesVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                diferenciaIntereses.textContent = '+$' + interesesTotalesVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                diferenciaIntereses.className = 'text-danger';
                
                contadoAnual.textContent = '$' + costosAnualesVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                financiadoAnual.textContent = '$' + costosAnualesVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                contado5Anios.textContent = '$' + totalContado5Anios.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                financiado5Anios.textContent = '$' + totalFinanciado5Anios.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                diferencia5Anios.textContent = '+$' + (totalFinanciado5Anios - totalContado5Anios).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                diferencia5Anios.className = 'text-danger';
                
                // Actualizar recomendación
                recomendacionTexto.innerHTML = `Si tienes el capital disponible, comprar al contado te ahorraría <strong>$${interesesTotalesVal.toFixed(2)}</strong> en intereses. Sin embargo, el financiamiento permite conservar tu liquidez.`;
                
                // Actualizar sección de detalle
                detallePrecio.textContent = '$' + precio.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                detalleEnganchePct.textContent = engancheSlider.value;
                detalleEnganche.textContent = '-$' + engancheMontoVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                detalleFinanciado.textContent = '$' + montoFinanciarVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                detallePlazo.textContent = plazoSlider.value;
                detalleIntereses.textContent = '+$' + interesesTotalesVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                detalleTotalCredito.textContent = '$' + totalFinanciadoVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                detalleMensual.textContent = '$' + pagoMensualVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                detalleSeguro.textContent = '$' + seguroVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                detalleMantenimiento.textContent = '$' + mantenimientoVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                detalleCombustible.textContent = '$' + (combustibleVal * 12).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                detalleTotalAnual.textContent = '$' + costosAnualesVal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                // Actualizar gráficos
                actualizarGraficos(precio, totalFinanciadoVal, costosAnualesVal, seguroVal, mantenimientoVal, combustibleVal * 12);
            }
        }
    )
    </script>
    </body>
</html>