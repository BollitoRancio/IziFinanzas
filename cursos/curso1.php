<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Curso: Introducción a las Finanzas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="estilo_cursos.css">
</head>
<body>
  <header class="header">
    <div class="user-info">
      <a href="../dashboard.php">
      <i class="bi bi-person-circle"></i>
      </a>
      <span><?php echo $_SESSION['nombre_usuario']; ?></span>
      <span style="color: #888;">(<?php echo $_SESSION['rol_usuario']; ?>)</span>
    </div>
  </header>
  <div class="container-fluid">
    <div class="row">
      <!-- Menú lateral -->
      <div class="col-md-3 sidebar">
        <h4>Módulo 1</h4>
        <ul id="menu-lecciones">
          <li class="active" onclick="cargarLeccion(1)">Lección 1: ¿Qué son las finanzas personales?</li>
          <li onclick="cargarLeccion(2)">Lección 2: Importancia de la educación financiera</li>
          <li onclick="cargarLeccion(3)">Lección 3: Ingresos, gastos y presupuesto</li>
        </ul>
        <h4>Módulo 2</h4>
        <ul>
          <li onclick="cargarLeccion(4)">Lección 4: Cómo identificar tus hábitos de consumo</li>
          <li onclick="cargarLeccion(5)">Lección 5: Control del dinero y toma de decisiones</li>
          <li onclick="cargarLeccion(6)">Lección 6: Errores financieros comunes y cómo evitarlos</li>
        </ul> 
        <div id="evaluacionFinal" class="mt-4" style="display: none;">
        <a class="btn btn-outline-success w-100" onclick="mostrarEvaluacion()">Evaluación Final</a>
        </div>
        <div class="mt-4">
          <label><strong>Progreso del curso</strong></label>
          <div class="progress">
            <div id="barraProgreso" class="progress-bar" role="progressbar" style="width: 16.6%;">16%</div>
          </div>
        </div>
      </div>

      <!-- Contenido de la lección -->
      <div class="col-md-9 lesson-content">
        <div id="contenido-leccion">
          <!-- Contenido dinámico -->
        </div>

        <button class="btn btn-success mt-4" onclick="leccionAnterior()">← Lección Anterior</button>

        <div class="mt-4 float-end">
          <button id="btnSiguiente" class="btn btn-success" onclick="siguienteLeccion()">Siguiente Lección →</button>
          <button id="btnEvaluacion" class="btn btn-primary" style="display: none;" onclick="mostrarEvaluacion()">Ir a Evaluación Final</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    const lecciones = [
      {
        titulo: "Lección 1: ¿Qué son las finanzas personales?",
        contenido: `
          <div class="card border-success shadow-sm mb-4">
            <div class="card-header bg-success text-white">
              <h4><i class="bi bi-wallet2"></i> El ABC de tus finanzas</h4>
            </div>
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <p>Las <strong class="text-success">finanzas personales</strong> son el sistema que te permite administrar todos los aspectos económicos de tu vida:</p>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="bi bi-arrow-down-circle text-success"></i> Ingresos</li>
                    <li class="list-group-item"><i class="bi bi-arrow-up-circle text-danger"></i> Gastos</li>
                    <li class="list-group-item"><i class="bi bi-piggy-bank text-warning"></i> Ahorro</li>
                    <li class="list-group-item"><i class="bi bi-graph-up text-primary"></i> Inversión</li>
                    <li class="list-group-item"><i class="bi bi-shield-check text-info"></i> Protección</li>
                  </ul>
                </div>
                <div class="col-md-6 text-center">
                  <img src="https://images.pexels.com/photos/669610/pexels-photo-669610.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="img-fluid rounded" alt="Componentes finanzas personales" style="max-height: 250px;">
                </div>
              </div>

              <div class="alert alert-success mt-4">
                <div class="row">
                  <div class="col-md-2 text-center">
                    <i class="bi bi-lightbulb fs-1"></i>
                  </div>
                  <div class="col-md-10">
                    <strong>Ejemplo práctico:</strong> Imagina que ganas $3,000 al mes. Sin finanzas personales podrías gastar $3,500 (endeudándote). Con un buen manejo, podrías gastar $2,500 y ahorrar $500 para tus metas.
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="card h-100 border-success shadow-sm">
                <div class="card-header bg-light-green">
                  <h5 class="text-success"><i class="bi bi-check-circle"></i> Beneficios clave</h5>
                </div>
                <div class="card-body">
                  <ul>
                    <li>Reduce el estrés económico</li>
                    <li>Prepara para emergencias</li>
                    <li>Permite alcanzar metas grandes</li>
                    <li>Mejora tu calidad de vida</li>
                    <li>Genera libertad de elección</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card h-100 border-success shadow-sm">
                <div class="card-header bg-light-green">
                  <h5 class="text-success"><i class="bi bi-exclamation-triangle"></i> Mitos comunes</h5>
                </div>
                <div class="card-body">
                  <ul>
                    <li>"Solo es para ricos" ➝ Falso, aplica a cualquier ingreso</li>
                    <li>"Requiere mucho tiempo" ➝ 1-2 horas semanales bastan</li>
                    <li>"Es demasiado complicado" ➝ Conceptos simples generan grandes resultados</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="card border-success shadow-sm mt-4">
            <div class="card-body text-center">
              <h5 class="text-success"><i class="bi bi-rocket-takeoff"></i> Comienza hoy mismo</h5>
              <p>Sigue estos 3 pasos básicos:</p>
              <div class="d-flex justify-content-center gap-3">
                <span class="badge bg-success rounded-pill p-3">1. Registra tus ingresos</span>
                <span class="badge bg-success rounded-pill p-3">2. Anota tus gastos</span>
                <span class="badge bg-success rounded-pill p-3">3. Define un objetivo</span>
              </div>
            </div>
          </div>
        `
      },
      {
        titulo: "Lección 2: Importancia de la educación financiera",
        contenido: `
          <div class="card border-success shadow-sm">
            <div class="card-header bg-success text-white">
              <h4><i class="bi bi-book"></i> Tu arma secreta contra problemas económicos</h4>
            </div>
            <div class="card-body">
              <div class="row align-items-center mb-4">
                <div class="col-md-7">
                  <p>La <strong class="text-success">educación financiera</strong> es el conjunto de conocimientos que te permiten:</p>
                  <ul>
                    <li>Entender cómo funciona el dinero</li>
                    <li>Tomar decisiones informadas</li>
                    <li>Evitar fraudes y abusos</li>
                    <li>Aprovechar oportunidades</li>
                  </ul>
                </div>
                <div class="col-md-5 text-center">
                  <img src="https://images.pexels.com/photos/6963857/pexels-photo-6963857.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="img-fluid rounded" alt="Importancia educación financiera">
                </div>
              </div>

              <div class="alert alert-success">
                <div class="row">
                  <div class="col-md-2 text-center">
                    <i class="bi bi-shield-lock fs-1"></i>
                  </div>
                  <div class="col-md-10">
                    <strong>Dato impactante:</strong> El 76% de los adultos en Latinoamérica no podrían explicar conceptos básicos como interés compuesto o inflación (CAF, 2023).
                  </div>
                </div>
              </div>

              <h4 class="mt-4 text-success"><i class="bi bi-graph-up"></i> Beneficios concretos</h4>
              <div class="row">
                <div class="col-md-6">
                  <div class="card h-100 border-success shadow-sm">
                    <div class="card-body">
                      <h5><i class="bi bi-person-check"></i> Para ti</h5>
                      <ul>
                        <li>+87% probabilidad de tener ahorros</li>
                        <li>-63% estrés financiero</li>
                        <li>Mejor preparación para el retiro</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card h-100 border-success shadow-sm">
                    <div class="card-body">
                      <h5><i class="bi bi-people-fill"></i> Para la sociedad</h5>
                      <ul>
                        <li>Menor sobreendeudamiento</li>
                        <li>+Inversión productiva</li>
                        <li>Economía más estable</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card border-success shadow-sm mt-4">
                <div class="card-header bg-light-green">
                  <h5 class="text-success"><i class="bi bi-lightbulb"></i> ¿Cómo empezar?</h5>
                </div>
                <div class="card-body">
                  <div class="row text-center">
                    <div class="col-md-3">
                      <div class="p-3">
                        <i class="bi bi-journal-text fs-1 text-success"></i>
                        <p>Cursos básicos</p>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="p-3">
                        <i class="bi bi-phone fs-1 text-success"></i>
                        <p>Apps financieras</p>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="p-3">
                        <i class="bi bi-calculator fs-1 text-success"></i>
                        <p>Simuladores</p>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="p-3">
                        <i class="bi bi-piggy-bank fs-1 text-success"></i>
                        <p>Talleres prácticos</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `
      },
      {
        titulo: "Lección 3: Ingresos, gastos y presupuesto",
        contenido: `
          <div class="card border-success shadow-sm">
            <div class="card-header bg-success text-white">
              <h4><i class="bi bi-cash-stack"></i> El triángulo fundamental</h4>
            </div>
            <div class="card-body">
              <div class="row align-items-center mb-4">
                <div class="col-md-5 text-center">
                  <img src="https://png.pngtree.com/back_origin_pic/04/07/65/f4a09a0d6c6d6644c81e3f4e2f0b7603.jpg" class="img-fluid rounded" alt="Balance financiero">
                </div>
                <div class="col-md-7">
                  <div class="card border-success shadow-sm">
                    <div class="card-body">
                      <h5 class="text-success">Fórmula básica</h5>
                      <p class="display-6 text-center text-success">Ingresos - Gastos = Ahorro</p>
                      <p class="text-center">(Cuando el resultado es negativo, significa DEUDA)</p>
                    </div>
                  </div>
                </div>
              </div>

              <h4 class="text-success"><i class="bi bi-wallet2"></i> Tipos de ingresos</h4>
              <div class="row">
                <div class="col-md-4">
                  <div class="card h-100 border-success shadow-sm">
                    <div class="card-header bg-light-green">
                      <h5 class="text-success">Activos</h5>
                    </div>
                    <div class="card-body">
                      <p>Por tu trabajo o esfuerzo:</p>
                      <ul>
                        <li>Sueldo</li>
                        <li>Honorarios</li>
                        <li>Comisiones</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card h-100 border-success shadow-sm">
                    <div class="card-header bg-light-green">
                      <h5 class="text-success">Pasivos</h5>
                    </div>
                    <div class="card-body">
                      <p>Dinero que genera dinero:</p>
                      <ul>
                        <li>Rentas</li>
                        <li>Intereses</li>
                        <li>Dividendos</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card h-100 border-success shadow-sm">
                    <div class="card-header bg-light-green">
                      <h5 class="text-success">Extraordinarios</h5>
                    </div>
                    <div class="card-body">
                      <p>No recurrentes:</p>
                      <ul>
                        <li>Bonos</li>
                        <li>Premios</li>
                        <li>Herencia</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <h4 class="mt-4 text-success"><i class="bi bi-receipt"></i> Clasificación de gastos</h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead class="table-success">
                    <tr>
                      <th>Tipo</th>
                      <th>Ejemplos</th>
                      <th>% Ideal</th>
                      <th>Flexibilidad</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><strong>Fijos necesarios</strong></td>
                      <td>Renta, servicios, educación</td>
                      <td>50-60%</td>
                      <td>Baja</td>
                    </tr>
                    <tr>
                      <td><strong>Variables necesarios</strong></td>
                      <td>Comida, transporte, salud</td>
                      <td>20-30%</td>
                      <td>Media</td>
                    </tr>
                    <tr>
                      <td><strong>Discrecionales</strong></td>
                      <td>Entretenimiento, viajes</td>
                      <td>10-20%</td>
                      <td>Alta</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="card border-success shadow-sm mt-4">
                <div class="card-header bg-success text-white">
                  <h5><i class="bi bi-clipboard2-pulse"></i> Taller práctico: Crea tu primer presupuesto</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Ingresos totales mensuales:</label>
                        <div class="input-group">
                          <span class="input-group-text">$</span>
                          <input type="number" class="form-control">
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Gastos fijos:</label>
                        <div class="input-group">
                          <span class="input-group-text">$</span>
                          <input type="number" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Gastos variables:</label>
                        <div class="input-group">
                          <span class="input-group-text">$</span>
                          <input type="number" class="form-control">
                        </div>
                      </div>
                      <button class="btn btn-success">Calcular balance</button>
                    </div>
                  </div>
                  <div id="resultadoPresupuesto" class="mt-3 p-3 bg-light-green rounded d-none">
                    <h5>Tu balance mensual: <span id="balanceResultado" class="fw-bold"></span></h5>
                    <div class="progress mt-2" style="height: 25px;">
                      <div class="progress-bar bg-success" role="progressbar" id="barraPresupuesto"></div>
                    </div>
                    <p id="consejoPresupuesto" class="mt-2"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `
      },
  {
    titulo: "Lección 4: Cómo identificar tus hábitos de consumo",
    contenido: `
      <div class="card border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h4><i class="bi bi-cart-check"></i> Tu huella financiera</h4>
        </div>
        <div class="card-body">
          <div class="row align-items-center mb-4">
            <div class="col-md-6">
              <p>Los <strong class="text-success">hábitos de consumo</strong> son patrones repetitivos que determinan cómo gastas tu dinero:</p>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><i class="bi bi-emoji-smile text-warning"></i> Gastos emocionales (60% son impulsivos)</li>
                <li class="list-group-item"><i class="bi bi-arrow-repeat text-primary"></i> Suscripciones recurrentes</li>
                <li class="list-group-item"><i class="bi bi-cup-hot text-danger"></i> Pequeños gastos diarios (café, snacks)</li>
              </ul>
            </div>
            <div class="col-md-6 text-center">
              <img src="https://www.monet.com.co/wp-content/uploads/2024/04/Habitos-Financieros-Saludables.png" class="img-fluid rounded" alt="Hábitos de consumo" style="max-height: 250px;">
            </div>
          </div>

          <div class="alert alert-success">
            <div class="row">
              <div class="col-md-2 text-center">
                <i class="bi bi-magic fs-1"></i>
              </div>
              <div class="col-md-10">
                <strong>Técnica efectiva:</strong> El método 72 horas - Espera 3 días antes de comprar algo no esencial. El 80% de estas compras nunca se concretan.
              </div>
            </div>
          </div>

          <h4 class="mt-4 text-success"><i class="bi bi-search"></i> Diagnóstico de tus gastos</h4>
          <div class="row">
            <div class="col-md-6">
              <div class="card h-100 border-success shadow-sm">
                <div class="card-header bg-light-green">
                  <h5 class="text-success"><i class="bi bi-clipboard-data"></i> Ejercicio práctico</h5>
                </div>
                <div class="card-body">
                  <p>Analiza tus últimos 3 meses:</p>
                  <ol>
                    <li>Descarga tus movimientos bancarios</li>
                    <li>Clasifica cada gasto con colores:
                      <span class="badge bg-danger">Necesario</span>
                      <span class="badge bg-warning">Prescindible</span>
                      <span class="badge bg-success">Inversión</span>
                    </li>
                    <li>Calcula porcentajes</li>
                  </ol>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card h-100 border-success shadow-sm">
                <div class="card-header bg-light-green">
                  <h5 class="text-success"><i class="bi bi-emoji-frown"></i> Señales de alerta</h5>
                </div>
                <div class="card-body">
                  <ul>
                    <li>+30% en gastos "misceláneos"</li>
                    <li>Compras después de situaciones estresantes</li>
                    <li>No recordar en qué se gastó el 20% del dinero</li>
                    <li>Pagos recurrentes que no usas (apps, gimnasio)</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="card border-success shadow-sm mt-4">
            <div class="card-header bg-success text-white">
              <h5><i class="bi bi-tools"></i> Kit de supervivencia financiera</h5>
            </div>
            <div class="card-body">
              <div class="row text-center">
                <div class="col-md-3 mb-3">
                  <div class="p-3 border rounded">
                    <i class="bi bi-hourglass-split fs-1 text-success"></i>
                    <p>Regla 24h para compras >$100</p>
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <div class="p-3 border rounded">
                    <i class="bi bi-envelope fs-1 text-success"></i>
                    <p>Suscripciones en un solo lugar</p>
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <div class="p-3 border rounded">
                    <i class="bi bi-cash-coin fs-1 text-success"></i>
                    <p>Presupuesto de "gustos"</p>
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <div class="p-3 border rounded">
                    <i class="bi bi-phone fs-1 text-success"></i>
                    <p>App de tracking en tiempo real</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    `
  },
  {
    titulo: "Lección 5: Control del dinero y toma de decisiones",
    contenido: `
      <div class="card border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h4><i class="bi bi-speedometer2"></i> El tablero de tu economía</h4>
        </div>
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="card h-100 border-success shadow-sm">
                <div class="card-header bg-light-green">
                  <h5 class="text-success"><i class="bi bi-funnel"></i> Filtro de decisiones</h5>
                </div>
                <div class="card-body">
                  <p>Antes de gastar, pregúntate:</p>
                  <ol>
                    <li>¿Es <strong>necesario</strong> o deseable?</li>
                    <li>¿Puedo pagarlo <strong>2 veces</strong>?</li>
                    <li>¿Cómo afecta mis <strong>metas</strong>?</li>
                    <li>¿Existe una alternativa <strong>más económica</strong>?</li>
                  </ol>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card h-100 border-success shadow-sm">
                <div class="card-header bg-light-green">
                  <h5 class="text-success"><i class="bi bi-pie-chart"></i> Regla 50/30/20</h5>
                </div>
                <div class="card-body">
                  <div class="text-center mb-3">
                    <img src="../img/regla-50-30-20.jpg" class="img-fluid rounded" style="max-height: 150px;">
                  </div>
                  <ul>
                    <li><strong>50%</strong> Necesidades básicas</li>
                    <li><strong>30%</strong> Deseos personales</li>
                    <li><strong>20%</strong> Ahorro/inversión</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <h4 class="text-success"><i class="bi bi-diagram-3"></i> Sistema de cuentas recomendado</h4>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="table-success">
                <tr>
                  <th>Cuenta</th>
                  <th>Propósito</th>
                  <th>% Ingresos</th>
                  <th>Ejemplo ($3,000)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Operativa</strong></td>
                  <td>Gastos diarios</td>
                  <td>60%</td>
                  <td>$1,800</td>
                </tr>
                <tr>
                  <td><strong>Seguridad</strong></td>
                  <td>Emergencias</td>
                  <td>15%</td>
                  <td>$450</td>
                </tr>
                <tr>
                  <td><strong>Metas</strong></td>
                  <td>Viajes, estudios</td>
                  <td>15%</td>
                  <td>$450</td>
                </tr>
                <tr>
                  <td><strong>Futuro</strong></td>
                  <td>Retiro, inversiones</td>
                  <td>10%</td>
                  <td>$300</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="card border-success shadow-sm mt-4">
            <div class="card-header bg-success text-white">
              <h5><i class="bi bi-phone"></i> Simulador: Toma de decisiones</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Compra que estás considerando:</label>
                    <input type="text" class="form-control" placeholder="Ej. Nuevo teléfono $800">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Tu ingreso mensual:</label>
                    <div class="input-group">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control" id="ingresoMensual">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">¿Es reemplazo de algo esencial?</label>
                    <select class="form-select">
                      <option>Sí, completamente necesario</option>
                      <option>Mejoraría lo que tengo</option>
                      <option>No, es un gusto nuevo</option>
                    </select>
                  </div>
                  <button class="btn btn-success" id="evaluarDecision">Evaluar decisión</button>
                </div>
              </div>
              <div id="resultadoDecision" class="mt-3 p-3 bg-light-green rounded d-none">
                <h5>Recomendación: <span id="textoResultado" class="fw-bold"></span></h5>
                <p id="explicacionResultado" class="mt-2"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    `
  },
  {
    titulo: "Lección 6: Errores financieros comunes y cómo evitarlos",
    contenido: `
      <div class="card border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h4><i class="bi bi-exclamation-octagon"></i> Trampas que debes conocer</h4>
        </div>
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="card h-100 border-danger shadow-sm">
                <div class="card-header bg-danger text-white">
                  <h5><i class="bi bi-x-circle"></i> Top 5 errores</h5>
                </div>
                <div class="card-body">
                  <ol>
                    <li><strong>No tener emergencias</strong> (77% de quiebras personales por imprevistos)</li>
                    <li><strong>Pagar mínimos de tarjetas</strong> (Intereses pueden duplicar deudas)</li>
                    <li><strong>Comprar activos que pierden valor</strong> (Autos, electrónicos)</li>
                    <li><strong>Invertir sin entender</strong> (90% pierde en cripto por falta de conocimiento)</li>
                    <li><strong>Postergar el ahorro</strong> ("Comenzaré el próximo año")</li>
                  </ol>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card h-100 border-success shadow-sm">
                <div class="card-header bg-success text-white">
                  <h5><i class="bi bi-check-circle"></i> Soluciones prácticas</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <div class="p-3 border rounded h-100">
                        <i class="bi bi-shield-check text-success"></i>
                        <p><strong>Fondo de emergencia</strong> antes que inversiones</p>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="p-3 border rounded h-100">
                        <i class="bi bi-credit-card text-success"></i>
                        <p><strong>Tarjetas con propósito</strong>: 1 para gastos fijos, 1 para emergencias</p>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="p-3 border rounded h-100">
                        <i class="bi bi-graph-up text-success"></i>
                        <p><strong>Educación financiera</strong> antes de invertir</p>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="p-3 border rounded h-100">
                        <i class="bi bi-calendar-check text-success"></i>
                        <p><strong>Automatizar ahorros</strong> (transferencia el día de pago)</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h4 class="text-success"><i class="bi bi-clipboard2-pulse"></i> Casos reales y soluciones</h4>
          <div class="accordion" id="casosReales">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#caso1">
                  Caso 1: Deuda de tarjetas acumulada
                </button>
              </h2>
              <div id="caso1" class="accordion-collapse collapse" data-bs-parent="#casosReales">
                <div class="accordion-body">
                  <p><strong>Situación:</strong> $15,000 en 3 tarjetas con intereses del 45% anual</p>
                  <p><strong>Solución:</strong></p>
                  <ol>
                    <li>Negociar tasa con los bancos</li>
                    <li>Usar método bola de nieve (pagar mínima en 2, máximo en 1)</li>
                    <li>Congelar físicamente las tarjetas</li>
                  </ol>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#caso2">
                  Caso 2: Sin ahorros a los 40 años
                </button>
              </h2>
              <div id="caso2" class="accordion-collapse collapse" data-bs-parent="#casosReales">
                <div class="accordion-body">
                  <p><strong>Situación:</strong> Ingresos altos pero gastos iguales</p>
                  <p><strong>Solución:</strong></p>
                  <ol>
                    <li>Aplicar "ahorro por default" (transferencia automática)</li>
                    <li>Reducir 3 gastos hormiga identificados</li>
                    <li>Invertir en fondos indexados</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>

          <div class="card border-success shadow-sm mt-4">
            <div class="card-header bg-success text-white">
              <h5><i class="bi bi-shield-check"></i> Plan de protección financiera</h5>
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap gap-2 justify-content-center">
                <span class="badge bg-success rounded-pill p-3">1. Fondo emergencia (3-6 meses)</span>
                <span class="badge bg-success rounded-pill p-3">2. Seguro médico básico</span>
                <span class="badge bg-success rounded-pill p-3">3. Testamento vital</span>
                <span class="badge bg-success rounded-pill p-3">4. Protección de identidad</span>
                <span class="badge bg-success rounded-pill p-3">5. Educación continua</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    `
  }
    ];

    let leccionActual = 0;
    let leccionDesbloqueada = 0; // Solo se puede acceder a esta o anteriores


    function cargarLeccion(index) {
      if (index - 1 > leccionDesbloqueada) {
        alert("Debes completar la lección anterior para continuar.");
        return;
      }
      leccionActual = index - 1;
      document.getElementById("contenido-leccion").innerHTML = `
        <h3>${lecciones[leccionActual].titulo}</h3>
        ${lecciones[leccionActual].contenido}
      `;
      actualizarMenu();
      actualizarProgreso();
      actualizarProgresoEnBD(leccionActual + 1, 'En curso');
      const btnSiguiente = document.getElementById("btnSiguiente");
      const btnEvaluacion = document.getElementById("btnEvaluacion");
      if (leccionActual === lecciones.length - 1) {
        btnSiguiente.style.display = "none";
        btnEvaluacion.style.display = "inline-block";
      } else {
        btnSiguiente.style.display = "inline-block";
        btnEvaluacion.style.display = "none";
      }
      document.getElementById("contenido-leccion").scrollIntoView({ behavior: "smooth", block: "start" });
    }
    function siguienteLeccion() {
      if (leccionActual < lecciones.length - 1) {
        leccionDesbloqueada = Math.max(leccionDesbloqueada, leccionActual + 1);
        cargarLeccion(leccionActual + 2);

        actualizarProgresoEnBD(leccionActual + 1, 'Completado');
      }
      const btnSiguiente = document.getElementById("btnSiguiente");
      const btnEvaluacion = document.getElementById("btnEvaluacion");

      if (leccionActual === lecciones.length - 1) {
        btnSiguiente.style.display = "none";
        btnEvaluacion.style.display = "inline-block";
      }
    }

    function leccionAnterior() {
      if (leccionActual > 0) {
        cargarLeccion(leccionActual); // leccionActual ya está en base 0
      }
    }

    function actualizarMenu() {
      const items = document.querySelectorAll('#menu-lecciones li, .sidebar ul:nth-of-type(2) li');

      items.forEach((item, idx) => {
        item.classList.remove('active', 'bloqueada');

        if (idx > leccionDesbloqueada) {
          item.classList.add('bloqueada');
        } else if (idx === leccionActual) {
          item.classList.add('active');
        }
      });
    }

    function actualizarProgreso() {
      const progreso = ((leccionActual + 1) / lecciones.length) * 100;
      const barra = document.getElementById("barraProgreso");
      barra.style.width = progreso + "%";
      barra.innerText = Math.round(progreso) + "%";
      // Mostrar evaluación cuando se complete el 100%
      if (Math.round(progreso) >= 100) {
        document.getElementById("evaluacionFinal").style.display = "block";
      }
    }
    function actualizarProgresoEnBD(leccionID, estado) {
      const formData = new FormData();
      formData.append("id_usuario", <?php echo $_SESSION['id_usuario']; ?>);  // ID del usuario desde la sesión
      formData.append("id_leccion", leccionID); 
      formData.append("estado", estado);  // Estado: 'En curso' o 'Completado'

      fetch("guardar_progreso.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          console.log('Progreso guardado correctamente');
        } else {
          console.error('Error al guardar progreso');
        }
      })
      .catch(error => console.error('Error:', error));
    }
    function calcularPresupuesto() {
      const ingresos = parseFloat(document.getElementById('ingresos').value);
      const gastosFijos = parseFloat(document.getElementById('gastosFijos').value);
      const gastosVariables = parseFloat(document.getElementById('gastosVariables').value);
      
      const balance = ingresos - (gastosFijos + gastosVariables);
      const porcentajeAhorro = ((balance / ingresos) * 100).toFixed(1);
      
      document.getElementById('balanceResultado').textContent = '$' + balance.toLocaleString();
      document.getElementById('barraPresupuesto').style.width = porcentajeAhorro + '%';
      
      let consejo = '';
      if(balance < 0) {
        consejo = 'Estás gastando más de lo que ganas!!. Revisa tus gastos variables.';
      } else if(porcentajeAhorro < 10) {
        consejo = 'Buen comienzo, intenta aumentar tu ahorro al 15%.';
      } else {
        consejo = '¡Excelente! Estás ahorrando más del 10% de tus ingresos.';
      }
      
      document.getElementById('consejoPresupuesto').textContent = consejo;
      document.getElementById('resultadoPresupuesto').classList.remove('d-none');
    }
    function mostrarEvaluacion() {
      const contenedor = document.getElementById("contenido-leccion");
      contenedor.scrollIntoView({ behavior: "smooth", block: "start" });
      document.getElementById("contenido-leccion").innerHTML = `
      <h3 class="text-center mb-4 text-primary">Evaluación Final - Introducción a las Finanzas</h3>
      <form id="formEvaluacion">
        <input type="hidden" name="curso" value="Introducción a las Finanzas">

        <!-- Pregunta 1 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-currency-dollar"></i> 1. ¿Qué son las finanzas personales?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta1" id="p1a" value="a">
              <label class="form-check-label" for="p1a">a) Administración del dinero personal y familiar</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta1" id="p1b" value="b">
              <label class="form-check-label" for="p1b">b) Administración del dinero de empresas grandes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta1" id="p1c" value="c">
              <label class="form-check-label" for="p1c">c) Solo el manejo de inversiones en bolsa</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 2 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-clipboard2-check"></i> 2. ¿Cuál es una herramienta clave para controlar tus gastos?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta2" id="p2a" value="a">
              <label class="form-check-label" for="p2a">a) Usar solo tarjetas de crédito</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta2" id="p2b" value="b">
              <label class="form-check-label" for="p2b">b) Realizar y seguir un presupuesto mensual</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta2" id="p2c" value="c">
              <label class="form-check-label" for="p2c">c) Pedir préstamos frecuentemente</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 3 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-journal-bookmark"></i> 3. ¿Qué es un presupuesto personal?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta3" id="p3a" value="a">
              <label class="form-check-label" for="p3a">a) Un plan detallado para administrar ingresos y gastos</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta3" id="p3b" value="b">
              <label class="form-check-label" for="p3b">b) Un documento para solicitar créditos</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta3" id="p3c" value="c">
              <label class="form-check-label" for="p3c">c) Un registro de todas las compras del último año</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 4 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-piggy-bank"></i> 4. ¿Qué significa realmente "ahorrar"?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta4" id="p4a" value="a">
              <label class="form-check-label" for="p4a">a) Guardar lo que sobra al final del mes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta4" id="p4b" value="b">
              <label class="form-check-label" for="p4b">b) Asignar primero una parte de los ingresos al ahorro antes de gastar</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta4" id="p4c" value="c">
              <label class="form-check-label" for="p4c">c) Invertir en productos de alto riesgo</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 5 (Caso práctico) -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-calculator"></i> 5. Caso práctico: María gana $1,500 mensuales y gasta $1,400. ¿Cómo puede reducir sus gastos?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta5" id="p5a" value="a">
              <label class="form-check-label" for="p5a">a) Eliminar suscripciones innecesarias y reducir gastos en comida fuera</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta5" id="p5b" value="b">
              <label class="form-check-label" for="p5b">b) Pedir un préstamo para cubrir sus gastos</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta5" id="p5c" value="c">
              <label class="form-check-label" for="p5c">c) No pagar algunas cuentas por unos meses</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 6 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-credit-card"></i> 6. ¿Qué caracteriza a una "deuda buena"?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta6" id="p6a" value="a">
              <label class="form-check-label" for="p6a">a) Financia algo que genera valor o ingresos (como educación o vivienda)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta6" id="p6b" value="b">
              <label class="form-check-label" for="p6b">b) Cualquier deuda que pueda obtener fácilmente</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta6" id="p6c" value="c">
              <label class="form-check-label" for="p6c">c) Deudas con intereses muy altos</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 7 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-exclamation-triangle"></i> 7. ¿Qué es el fondo de emergencias?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta7" id="p7a" value="a">
              <label class="form-check-label" for="p7a">a) Dinero reservado para imprevistos (3-6 meses de gastos)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta7" id="p7b" value="b">
              <label class="form-check-label" for="p7b">b) Dinero para vacaciones o gustos</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta7" id="p7c" value="c">
              <label class="form-check-label" for="p7c">c) El saldo disponible en tarjetas de crédito</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 8 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-pie-chart"></i> 8. ¿Qué significa diversificar inversiones?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta8" id="p8a" value="a">
              <label class="form-check-label" for="p8a">a) Distribuir el dinero en diferentes tipos de activos para reducir riesgo</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta8" id="p8b" value="b">
              <label class="form-check-label" for="p8b">b) Invertir todo en una sola opción prometedora</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta8" id="p8c" value="c">
              <label class="form-check-label" for="p8c">c) Comprar solo lo que recomiendan amigos</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 9 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-graph-up"></i> 9. ¿Cómo mejorar tu puntaje crediticio?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta9" id="p9a" value="a">
              <label class="form-check-label" for="p9a">a) Pagar deudas a tiempo y usar responsablemente el crédito</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta9" id="p9b" value="b">
              <label class="form-check-label" for="p9b">b) Tener muchas tarjetas de crédito sin usar</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta9" id="p9c" value="c">
              <label class="form-check-label" for="p9c">c) No tener nunca deudas de ningún tipo</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 10 (Caso práctico) -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-percent"></i> 10. Caso: Carlos quiere pedir un préstamo. ¿Qué debe considerar sobre la tasa de interés?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta10" id="p10a" value="a">
              <label class="form-check-label" for="p10a">a) El costo real del crédito (tasa + comisiones) y si puede pagarlo</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta10" id="p10b" value="b">
              <label class="form-check-label" for="p10b">b) Solo el monto mensual a pagar</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta10" id="p10c" value="c">
              <label class="form-check-label" for="p10c">c) Que mientras más alta la tasa, mejor el préstamo</label>
            </div>
          </div>
        </div>

        <div class="d-grid gap-2 col-md-6 mx-auto">
          <button type="submit" class="btn btn-success btn-lg shadow">
            <i class="bi bi-send-check"></i> Enviar evaluación
          </button>
        </div>
      </form>

      `;
              // Agregar evento de envío con AJAX
              setTimeout(() => {
              document.getElementById("formEvaluacion").addEventListener("submit", async function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                try {
                  const response = await fetch("guardar_evaluacion.php", {
                    method: "POST",
                    body: formData
                  });

                  if (!response.ok) throw new Error("Error en la respuesta del servidor");

                  const data = await response.json();

                            // Verifica el estado de la respuesta y muestra el modal con los resultados
                  if (data.status === "success") {
                      document.getElementById("calificacionResultado").innerText = data.calificacion;
                      document.getElementById("mensajeResultado").innerText = data.aprobado
                          ? "¡Felicidades! Has aprobado este curso :D"
                          : "No has aprobado esta vez:c";

                      document.getElementById("botonesResultado").innerHTML = data.aprobado
                          ? `<a href="../menu_cursos.php" class="btn btn-success">Volver al menú de cursos</a>`
                          : `<button class="btn btn-warning" onclick="cargarLeccion(1)" data-bs-dismiss="modal">Reintentar Lecciones</button>`;

                      // Mostrar el modal de resultados
                      new bootstrap.Modal(document.getElementById('resultadoModal')).show();
                  } else {
                      alert(data.mensaje || "Hubo un error al procesar la evaluación");
                  }
              } catch (error) {
                  console.error("Error al enviar la evaluación:", error);
                  alert("Hubo un error al procesar tu evaluación.");
              }
          });
            }, 100);

    }
    // Cargar primera lección al iniciar
    window.onload = () => cargarLeccion(1);
    

  </script>
    <!-- Modal de Resultado -->
  <div class="modal fade" id="resultadoModal" tabindex="-1" aria-labelledby="resultadoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="resultadoModalLabel">Resultado de la Evaluación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <h4 id="mensajeResultado"></h4>
          <p class="my-3">Tu calificación: <strong id="calificacionResultado"></strong>/10</p>
          <div id="botonesResultado"></div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
