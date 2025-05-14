<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Pago de Deudas | IziFinanzas</title>
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
        
        .method-comparison {
            margin-top: 20px;
        }
        
        .method-card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-left: 4px solid var(--izi-green);
        }
        
        .method-title {
            font-weight: 600;
            color: var(--izi-green-darker);
            margin-bottom: 10px;
        }
        
        .method-detail {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .savings-badge {
            background-color: var(--izi-green);
            color: white;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 500;
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
                <h1 class="header-title"><i class="bi bi-credit-card"></i> Calculadora de Pago de Deudas</h1>
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
                    <h2><i class="bi bi-calculator"></i> Calculadora de Pago de Deudas</h2>
                    <p>Compara métodos de pago y descubre cuánto puedes ahorrar en intereses</p>
                </div>
                
                <div class="calculator-body">
                    <!-- Formulario -->
                    <div class="calculator-form">
                        <div class="form-group">
                            <label for="saldo-deuda">Saldo total de la deuda <i class="bi bi-info-circle info-icon" title="Cantidad total que debes actualmente"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="saldo-deuda" value="10000" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="tasa-interes">Tasa de interés anual <i class="bi bi-info-circle info-icon" title="Tasa de interés que aplica a tu deuda"></i></label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="tasa-interes" value="18" min="0" max="100" step="0.1">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="pago-minimo">Pago mínimo mensual <i class="bi bi-info-circle info-icon" title="Pago mínimo requerido por el acreedor"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="pago-minimo" value="200" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="pago-extra">Pago extra mensual (opcional) <i class="bi bi-info-circle info-icon" title="Cantidad adicional que puedes pagar cada mes"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="pago-extra" value="100" min="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="metodo-pago">Método de pago <i class="bi bi-info-circle info-icon" title="Estrategia para pagar tus deudas"></i></label>
                            <select class="form-select" id="metodo-pago">
                                <option value="minimo">Solo pago mínimo</option>
                                <option value="snowball" selected>Método bola de nieve (de menor a mayor)</option>
                                <option value="avalancha">Método avalancha (mayor interés primero)</option>
                                <option value="fijo">Pago fijo mensual</option>
                            </select>
                        </div>
                        
                        <div class="form-group" id="pago-fijo-group" style="display: none;">
                            <label for="pago-fijo">Pago fijo mensual <i class="bi bi-info-circle info-icon" title="Cantidad fija que pagarás cada mes"></i></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="pago-fijo" value="300" min="0">
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
                            <div class="result-title">Tiempo para pagar la deuda</div>
                            <div class="result-value" id="tiempo-pago">5 años 3 meses</div>
                            <div class="result-detail">Con tu estrategia de pago actual</div>
                        </div>
                        
                        <div class="result-card">
                            <div class="result-title">Total a pagar</div>
                            <div class="result-value" id="total-pagar">$14,200.00</div>
                            <div class="result-detail">Incluyendo intereses</div>
                        </div>
                        
                        <div class="result-card">
                            <div class="result-title">Intereses totales</div>
                            <div class="result-value" id="intereses-totales">$4,200.00</div>
                            <div class="result-detail">Costo del crédito</div>
                        </div>
                        
                        <div class="method-comparison">
                            <h5 class="text-center mb-3" style="color: var(--izi-green-darker);">
                                <i class="bi bi-compass"></i> Comparación de métodos
                            </h5>
                            
                            <div class="method-card">
                                <div class="method-title">Método Bola de Nieve</div>
                                <div class="method-detail"><strong>Tiempo:</strong> 3 años 8 meses</div>
                                <div class="method-detail"><strong>Intereses:</strong> $2,850.00</div>
                                <div class="text-end"><span class="savings-badge">Ahorras $1,350.00</span></div>
                            </div>
                            
                            <div class="method-card">
                                <div class="method-title">Método Avalancha</div>
                                <div class="method-detail"><strong>Tiempo:</strong> 3 años 5 meses</div>
                                <div class="method-detail"><strong>Intereses:</strong> $2,650.00</div>
                                <div class="text-end"><span class="savings-badge">Ahorras $1,550.00</span></div>
                            </div>
                            
                            <div class="method-card">
                                <div class="method-title">Pago Fijo ($300/mes)</div>
                                <div class="method-detail"><strong>Tiempo:</strong> 4 años 2 meses</div>
                                <div class="method-detail"><strong>Intereses:</strong> $3,200.00</div>
                                <div class="text-end"><span class="savings-badge">Ahorras $1,000.00</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center text-muted">
                <small><i class="bi bi-lightbulb"></i> Pagar deudas no es solo cuestión de dinero, es cuestión de libertad financiera.</small>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos del DOM
            const saldoDeuda = document.getElementById('saldo-deuda');
            const tasaInteres = document.getElementById('tasa-interes');
            const pagoMinimo = document.getElementById('pago-minimo');
            const pagoExtra = document.getElementById('pago-extra');
            const metodoPago = document.getElementById('metodo-pago');
            const pagoFijoGroup = document.getElementById('pago-fijo-group');
            const pagoFijo = document.getElementById('pago-fijo');
            const calcularBtn = document.getElementById('calcular');
            
            // Resultados
            const tiempoPago = document.getElementById('tiempo-pago');
            const totalPagar = document.getElementById('total-pagar');
            const interesesTotales = document.getElementById('intereses-totales');
            
            // Mostrar/ocultar campo de pago fijo según selección
            metodoPago.addEventListener('change', function() {
                if (this.value === 'fijo') {
                    pagoFijoGroup.style.display = 'block';
                } else {
                    pagoFijoGroup.style.display = 'none';
                }
            });
            
            // Event listeners
            calcularBtn.addEventListener('click', calcularPagoDeuda);
            
            // Función principal de cálculo
            function calcularPagoDeuda() {
                const deuda = parseFloat(saldoDeuda.value) || 0;
                const tasa = parseFloat(tasaInteres.value) / 100 / 12; // Tasa mensual
                const pagoMin = parseFloat(pagoMinimo.value) || 0;
                const pagoExt = parseFloat(pagoExtra.value) || 0;
                const metodo = metodoPago.value;
                const pagoFij = parseFloat(pagoFijo.value) || 0;
                
                let meses = 0;
                let interesesAcumulados = 0;
                let saldoActual = deuda;
                let pagoMensual = pagoMin;
                
                if (metodo === 'fijo') {
                    pagoMensual = pagoFij;
                }
                
                // Simular pagos mes a mes
                while (saldoActual > 0 && meses < 600) { // Límite de 50 años
                    // Calcular interés del mes
                    const interesMensual = saldoActual * tasa;
                    interesesAcumulados += interesMensual;
                    
                    // Aplicar pago
                    let pagoAplicado = Math.min(pagoMensual + pagoExt, saldoActual + interesMensual);
                    saldoActual = saldoActual + interesMensual - pagoAplicado;
                    
                    meses++;
                    
                    // Ajustar pago según método (simplificado para ejemplo)
                    if (metodo === 'snowball' && meses % 12 === 0) {
                        pagoMensual += 50; // Simulación de aumento en bola de nieve
                    } else if (metodo === 'avalancha' && meses % 6 === 0) {
                        pagoMensual += 75; // Simulación de aumento en avalancha
                    }
                }
                
                // Calcular años y meses
                const años = Math.floor(meses / 12);
                const mesesRestantes = meses % 12;
                
                // Calcular total a pagar
                const totalAPagar = deuda + interesesAcumulados;
                
                // Actualizar UI
                tiempoPago.textContent = `${años} años ${mesesRestantes} meses`;
                totalPagar.textContent = '$' + totalAPagar.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                interesesTotales.textContent = '$' + interesesAcumulados.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                // Aquí irían los cálculos para los otros métodos de comparación
                // (en una implementación real, se harían simulaciones similares para cada método)
            }
            
            // Tooltips de Bootstrap
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Calcular al cargar la página
            calcularPagoDeuda();
        });
    </script>
</body>
</html>