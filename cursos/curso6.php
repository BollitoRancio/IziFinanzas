<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Curso: Planificación Financiera</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="estilo_cursos.css">
</head>
<body>
  <header class="header">
    <div class="user-info">
      <i class="bi bi-person-circle"></i>
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
          <li class="active" onclick="cargarLeccion(1)">Lección 1: Objetivos financieros personales</li>
          <li onclick="cargarLeccion(2)">Lección 2: Planificación mensual y anual</li>
          <li onclick="cargarLeccion(3)">Lección 3: Evaluación de tu salud financiera</li>
        </ul>
        <h4>Módulo 2</h4>
        <ul>
          <li onclick="cargarLeccion(4)">Lección 4: Plan de retiro y pensiones</li>
          <li onclick="cargarLeccion(5)">Lección 5: Educación financiera para tu familia</li>
          <li onclick="cargarLeccion(6)">Lección 6: Cómo adaptar tu plan en el tiempo</li>
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
        titulo: "Lección 1: Objetivos financieros personales",
        contenido: `
          <div class="row g-4">
            <div class="col-lg-6">
              <div class="card border-success shadow-sm h-100">
                <div class="card-header bg-success text-white">
                  <h4><i class="bi bi-bullseye"></i> Pirámide de objetivos financieros</h4>
                </div>
                <div class="card-body">
                  <div class="text-center mb-3">
                    <img src="https://bbvaassetmanagement.com/wp-content/uploads/sites/2/2022/03/pir%C3%A1mide-de-los-objetivos-financieros.png" class="img-fluid rounded" alt="Pirámide de objetivos" style="max-height: 200px;">
                  </div>
                  <ol class="list-group list-group-numbered">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Base: Seguridad</div>
                        Fondo de emergencias, seguro médico, deudas controladas
                      </div>
                      <span class="badge bg-success rounded-pill">1-2 años</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Intermedio: Estabilidad</div>
                        Propiedad, educación, inversiones moderadas
                      </div>
                      <span class="badge bg-success rounded-pill">3-10 años</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Cúspide: Crecimiento</div>
                        Negocios propios, inversiones sofisticadas, legado
                      </div>
                      <span class="badge bg-success rounded-pill">10+ años</span>
                    </li>
                  </ol>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card border-success shadow-sm h-100">
                <div class="card-header bg-success text-white">
                  <h4><i class="bi bi-clipboard2-check"></i> Ejercicio práctico</h4>
                </div>
                <div class="card-body">
                  <h5 class="text-success">Define tus objetivos SMART</h5>
                  <div class="mb-3">
                    <label class="form-label">Objetivo a corto plazo (1-2 años):</label>
                    <input type="text" class="form-control" placeholder="Ej: Ahorrar $50,000 para fondo emergencia">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Objetivo a mediano plazo (3-5 años):</label>
                    <input type="text" class="form-control" placeholder="Ej: Comprar departamento con 30% de enganche">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Objetivo a largo plazo (10+ años):</label>
                    <input type="text" class="form-control" placeholder="Ej: Jubilación con $2M MXN anuales">
                  </div>
                  <button class="btn btn-outline-success"><i class="bi bi-floppy"></i> Guardar mis objetivos</button>
                </div>
              </div>
            </div>
          </div>

          <div class="alert alert-success mt-4">
            <div class="row align-items-center">
              <div class="col-md-2 text-center">
                <i class="bi bi-lightbulb fs-1 text-success"></i>
              </div>
              <div class="col-md-10">
                <h5>Dato clave: La regla 10-20-30-40</h5>
                <p>Distribución ideal para objetivos: 10% corto plazo (liquidez), 20% protección (seguros), 30% crecimiento (inversiones), 40% estabilidad (activos fijos)</p>
              </div>
            </div>
          </div>
        `
      },
      {
        titulo: "Lección 2: Planificación mensual y anual",
        contenido: `
          <div class="card border-success shadow-sm mb-4">
            <div class="card-header bg-success text-white">
              <h4><i class="bi bi-calendar-range"></i> Sistema de planificación dual</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="card bg-light-green mb-3 h-100">
                    <div class="card-body">
                      <h5 class="text-success"><i class="bi bi-calendar-month"></i> Vista mensual</h5>
                      <ul>
                        <li><strong>Presupuesto detallado</strong> por categorías</li>
                        <li><strong>Pagos fijos</strong> (servicios, renta)</li>
                        <li><strong>Ahorro automático</strong> (10-20% de ingresos)</li>
                        <li><strong>Revisiones semanales</strong> de gastos</li>
                      </ul>
                      <img src="https://static.vecteezy.com/system/resources/previews/028/046/127/original/finance-planning-illustration-concept-a-flat-illustration-isolated-on-white-background-vector.jpg" class="img-fluid rounded mt-2" alt="Planificación mensual">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card bg-light-green h-100">
                    <div class="card-body">
                      <h5 class="text-success"><i class="bi bi-calendar-check"></i> Vista anual</h5>
                      <ul>
                        <li><strong>Metas trimestrales</strong> de ahorro</li>
                        <li><strong>Impuestos y declaraciones</strong></li>
                        <li><strong>Evaluación de inversiones</strong></li>
                        <li><strong>Ajustes estratégicos</strong></li>
                      </ul>
                      <div class="mt-3">
                        <h6 class="text-success">Hitos clave:</h6>
                        <div class="d-flex flex-wrap gap-2">
                          <span class="badge bg-success">Revisión de seguros</span>
                          <span class="badge bg-success">Ajuste de inversiones</span>
                          <span class="badge bg-success">Renovación crediticia</span>
                          <span class="badge bg-success">Balance patrimonial</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card border-success shadow-sm">
            <div class="card-header bg-success text-white">
              <h4><i class="bi bi-tools"></i> Herramientas recomendadas</h4>
            </div>
            <div class="card-body">
              <div class="row g-4">
                <div class="col-md-4">
                  <div class="card h-100 border-success">
                    <div class="card-body text-center">
                      <i class="bi bi-file-spreadsheet fs-1 text-success"></i>
                      <h5 class="mt-2">Plantilla avanzada</h5>
                      <p>Descarga nuestro modelo Excel con:</p>
                      <ul class="text-start">
                        <li>Presupuesto mensual/anual</li>
                        <li>Gráficos de progreso</li>
                        <li>Recordatorios automáticos</li>
                      </ul>
                      <button class="btn btn-sm btn-success">Descargar</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card h-100 border-success">
                    <div class="card-body text-center">
                      <i class="bi bi-phone fs-1 text-success"></i>
                      <h5 class="mt-2">Apps móviles</h5>
                      <div class="text-start">
                        <p><strong>YNAB:</strong> Enfoque en presupuesto</p>
                        <p><strong>Mint:</strong> Visión integral</p>
                        <p><strong>Fintonic:</strong> Para hispanohablantes</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card h-100 border-success">
                    <div class="card-body text-center">
                      <i class="bi bi-journal-bookmark fs-1 text-success"></i>
                      <h5 class="mt-2">Método físico</h5>
                      <p>Para quienes prefieren papel:</p>
                      <ol class="text-start">
                        <li>Carpeta con 12 sobres (1/mes)</li>
                        <li>Hoja resumen anual</li>
                        <li>Portarecibos clasificado</li>
                      </ol>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `
      },
      {
        titulo: "Lección 3: Evaluación de tu salud financiera",
        contenido: `
          <div class="card border-success shadow-sm mb-4">
            <div class="card-header bg-success text-white">
              <h4><i class="bi bi-clipboard2-pulse"></i> Diagnóstico financiero</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <h5 class="text-success">Indicadores clave</h5>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead class="table-success">
                        <tr>
                          <th>Indicador</th>
                          <th>Fórmula</th>
                          <th>Meta ideal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Liquidez inmediata</td>
                          <td>Activos líquidos / Gastos mensuales</td>
                          <td>3-6 meses</td>
                        </tr>
                        <tr>
                          <td>Endeudamiento</td>
                          <td>Deudas totales / Activos totales</td>
                          <td>< 35%</td>
                        </tr>
                        <tr>
                          <td>Ahorro</td>
                          <td>Ahorro mensual / Ingresos</td>
                          <td>15-20%</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <h5 class="text-success">Calculadora interactiva</h5>
                  <div class="mb-3">
                    <label class="form-label">Ingresos mensuales netos:</label>
                    <div class="input-group">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control" id="ingresos">
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Gastos fijos mensuales:</label>
                    <div class="input-group">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control" id="gastos">
                    </div>
                  </div>
                  <button class="btn btn-success" onclick="calcularSalud()">Evaluar</button>
                  <div id="resultadoSalud" class="mt-3 p-3 bg-light-green rounded d-none">
                    <h6>Tu porcentaje de ahorro: <span id="porcentajeAhorro" class="fw-bold"></span></h6>
                    <div class="progress mt-2" style="height: 25px;">
                      <div class="progress-bar bg-success" role="progressbar" id="barraProgreso"></div>
                    </div>
                    <p id="consejoSalud" class="mt-2 small"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="alert alert-success">
            <div class="row">
              <div class="col-md-8">
                <h5><i class="bi bi-heart-pulse"></i> Signos de buena salud financiera</h5>
                <ul>
                  <li>Fondo de emergencia cubre 6 meses de gastos</li>
                  <li>Menos del 30% de ingresos en deuda</li>
                  <li>15-20% de ahorro sistemático</li>
                  <li>Seguros adecuados a tu situación</li>
                </ul>
              </div>
              <div class="col-md-4 text-center">
                <img src="https://admin.tueres.us/wp-content/uploads/2023/11/que-es-salud-financiera.jpg" class="img-fluid rounded" style="max-height: 150px;">
              </div>
            </div>
          </div>
        `
      },
      {
        titulo: "Lección 4: Plan de retiro y pensiones",
        contenido: `
          <div class="card border-success shadow-sm">
            <div class="card-header bg-success text-white">
              <h4><i class="bi bi-piggy-bank"></i> Estrategias para el retiro</h4>
            </div>
            <div class="card-body">
              <div class="row g-4">
                <div class="col-lg-4">
                  <div class="card h-100 border-success">
                    <div class="card-body">
                      <h5 class="text-success"><i class="bi bi-building"></i> Sistemas pensiones</h5>
                      <ul>
                        <li><strong>SAR:</strong> Cuentas individuales</li>
                        <li><strong>AFORES:</strong> Administración profesional</li>
                        <li><strong>Planes privados:</strong> Complementarios</li>
                      </ul>
                      <div class="alert alert-success mt-3">
                        <small><strong>Dato:</strong> Necesitarás ~70% de tu último salario para mantener nivel de vida</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="card h-100 border-success">
                    <div class="card-body">
                      <h5 class="text-success"><i class="bi bi-calculator"></i> Cálculo de necesidades</h5>
                      <p>Fórmula básica:</p>
                      <p class="text-center fw-bold">(Gasto anual esperado × 25) = Capital necesario</p>
                      <p><small>Ejemplo: $300,000 anuales × 25 = $7,500,000</small></p>
                      <button class="btn btn-sm btn-outline-success mt-2">Simulador completo</button>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="card h-100 border-success">
                    <div class="card-body">
                      <h5 class="text-success"><i class="bi bi-graph-up-arrow"></i> Estrategias</h5>
                      <ol>
                        <li>Empieza antes de los 30</li>
                        <li>Aporta voluntariamente a tu AFORE</li>
                        <li>Diversifica (bienes raíces, inversiones)</li>
                        <li>Considera seguros de vida con ahorro</li>
                      </ol>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card border-success mt-4">
                <div class="card-header bg-light-green">
                  <h5 class="text-success"><i class="bi bi-clock-history"></i> El poder del tiempo</h5>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img src="https://www.sincomisiones.info/wp-content/uploads/2019/10/Calculadora-interes-compuesto.jpg" class="img-fluid rounded" alt="Interés compuesto" style="max-height: 200px;">
                  </div>
                  <p class="mt-3 text-center"><strong>Ejemplo:</strong> Ahorrando $2,000 mensuales al 7% anual:</p>
                  <ul>
                    <li><strong>20 años:</strong> $1,048,000</li>
                    <li><strong>30 años:</strong> $2,433,000</li>
                    <li><strong>40 años:</strong> $5,258,000</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        `
      },
      {
        titulo: "Lección 5: Educación financiera para tu familia",
        contenido: `
          <div class="card border-success shadow-sm">
            <div class="card-header bg-success text-white">
              <h4><i class="bi bi-people-fill"></i> Estrategias por edad</h4>
            </div>
            <div class="card-body">
              <div class="row g-4">
                <div class="col-md-6">
                  <div class="card h-100 border-success">
                    <div class="card-body">
                      <h5 class="text-success"><i class="bi bi-coin"></i> Niños (5-12 años)</h5>
                      <ul>
                        <li>Juegos sobre ahorro</li>
                        <li>Alcancías transparentes</li>
                        <li>Recompensas por metas</li>
                        <li>Conceptos básicos (necesidad vs deseo)</li>
                      </ul>
                      <div class="alert alert-success mt-3">
                        <small><strong>Actividad:</strong> "Supermercado en casa" con presupuesto limitado</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card h-100 border-success">
                    <div class="card-body">
                      <h5 class="text-success"><i class="bi bi-phone"></i> Adolescentes (13-18)</h5>
                      <ul>
                        <li>Primera cuenta bancaria</li>
                        <li>Apps de presupuesto</li>
                        <li>Microemprendimientos</li>
                        <li>Concepto de crédito</li>
                      </ul>
                      <div class="alert alert-success mt-3">
                        <small><strong>Recurso:</strong> Simuladores de tarjetas de crédito</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card h-100 border-success">
                    <div class="card-body">
                      <h5 class="text-success"><i class="bi bi-house-door"></i> Adultos jóvenes</h5>
                      <ul>
                        <li>Planificación de deudas</li>
                        <li>Primeras inversiones</li>
                        <li>Seguros básicos</li>
                        <li>Impuestos</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card h-100 border-success">
                    <div class="card-body">
                      <h5 class="text-success"><i class="bi bi-person-badge"></i> Adultos mayores</h5>
                      <ul>
                        <li>Plan sucesorio</li>
                        <li>Pensiones</li>
                        <li>Fraudes comunes</li>
                        <li>Herramientas digitales</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card border-success mt-4">
                <div class="card-header bg-light-green">
                  <h5 class="text-success"><i class="bi bi-piggy-bank"></i> Dinero en familia</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h6>Reuniones financieras familiares</h6>
                      <ol>
                        <li>Frecuencia mensual/trimestral</li>
                        <li>Todos participan (según edad)</li>
                        <li>Celebran logros</li>
                        <li>Revisan metas comunes</li>
                      </ol>
                    </div>
                    <div class="col-md-6">
                      <img src="https://img.freepik.com/free-vector/man-saving-money-family_74855-6566.jpg?t=st=1746697768~exp=1746701368~hmac=24951a852408466b499872f4a0ebb87361d5faa70291f78de474d3ac6c03491e&w=1380" class="img-fluid rounded" alt="Familia y finanzas">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `
      },
      {
        titulo: "Lección 6: Cómo adaptar tu plan en el tiempo",
        contenido: `
          <div class="card border-success shadow-sm">
            <div class="card-header bg-success text-white">
              <h4><i class="bi bi-arrow-repeat"></i> Ciclo de ajuste financiero</h4>
            </div>
            <div class="card-body">
              <div class="text-center mb-4">
                <img src="https://img.freepik.com/free-vector/flat-people-analyzing-budget-planning-calculation-financial-income-expenses_88138-1882.jpg?t=st=1746697832~exp=1746701432~hmac=62c7d7809d4e818ee6e5332f7cac447ff5a66149b5dcb5733a80ce2c81acd28a&w=826" class="img-fluid rounded" alt="Ciclo de ajuste" style="max-height: 250px;">
              </div>
              
              <div class="row g-4">
                <div class="col-md-4">
                  <div class="card h-100 border-success">
                    <div class="card-body">
                      <h5 class="text-success"><i class="bi bi-search"></i> 1. Revisión</h5>
                      <p><strong>Cada 3-6 meses:</strong></p>
                      <ul>
                        <li>Logros vs metas</li>
                        <li>Cambios en ingresos/gastos</li>
                        <li>Nuevas obligaciones</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card h-100 border-success">
                    <div class="card-body">
                      <h5 class="text-success"><i class="bi bi-tools"></i> 2. Ajuste</h5>
                      <p><strong>Modificaciones necesarias:</strong></p>
                      <ul>
                        <li>Redistribución presupuestal</li>
                        <li>Reasignación de ahorros</li>
                        <li>Actualización de metas</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card h-100 border-success">
                    <div class="card-body">
                      <h5 class="text-success"><i class="bi bi-check-circle"></i> 3. Implementación</h5>
                      <p><strong>Acciones concretas:</strong></p>
                      <ul>
                        <li>Cambios en automatizaciones</li>
                        <li>Nuevos instrumentos</li>
                        <li>Comunicación familiar</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card border-success mt-4">
                <div class="card-header bg-light-green">
                  <h5 class="text-success"><i class="bi bi-exclamation-triangle"></i> Eventos que requieren reajuste</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <ul>
                        <li><strong>Positivos:</strong> Aumento salarial, herencia, bonos</li>
                        <li><strong>Neutrales:</strong> Cambio laboral, movilidad</li>
                        <li><strong>Retos:</strong> Enfermedad, pérdida de empleo</li>
                      </ul>
                    </div>
                    <div class="col-md-6">
                      <div class="alert alert-success">
                        <h6><i class="bi bi-lightbulb"></i> Regla 20/80</h6>
                        <p>Dedica 20% del tiempo a planificar y 80% a ejecutar, pero nunca omitas la revisión</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="alert alert-success mt-4">
                <div class="row align-items-center">
                  <div class="col-md-9">
                    <h5><i class="bi bi-journal-bookmark"></i> Crea tu historial financiero</h5>
                    <p>Mantén un registro anual de:</p>
                    <ul>
                      <li>Metas establecidas</li>
                      <li>Resultados obtenidos</li>
                      <li>Lecciones aprendidas</li>
                    </ul>
                  </div>
                  <div class="col-md-3 text-center">
                    <img src="../img/historial-financiero.jpg" class="img-fluid rounded" style="max-height: 100px;">
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
    function calcularSalud() {
      const ingresos = parseFloat(document.getElementById('ingresos').value);
      const gastos = parseFloat(document.getElementById('gastos').value);
      const ahorro = ingresos - gastos;
      const porcentaje = ((ahorro / ingresos) * 100).toFixed(1);
      
      document.getElementById('porcentajeAhorro').textContent = porcentaje + '%';
      document.getElementById('barraProgreso').style.width = porcentaje + '%';
      
      let consejo = '';
      if(porcentaje < 10) {
        consejo = 'Necesitas reducir gastos o aumentar ingresos. Prioriza ahorrar al menos 10%.';
      } else if(porcentaje < 20) {
        consejo = 'Vas por buen camino. Intenta llegar al 20% para mayor seguridad.';
      } else {
        consejo = '¡Excelente! Mantén esta disciplina para alcanzar tus metas.';
      }
      
      document.getElementById('consejoSalud').textContent = consejo;
      document.getElementById('resultadoSalud').classList.remove('d-none');
    }
    function siguienteLeccion() {
      if (leccionActual < lecciones.length - 1) {
        leccionDesbloqueada = Math.max(leccionDesbloqueada, leccionActual + 1);
        cargarLeccion(leccionActual + 2);
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
    function mostrarEvaluacion() {
      const contenedor = document.getElementById("contenido-leccion");
      contenedor.scrollIntoView({ behavior: "smooth", block: "start" });
      document.getElementById("contenido-leccion").innerHTML = `
      <h3 class="text-center mb-4 text-success">Evaluación Final - Planificación Financiera</h3>
      <form id="formEvaluacion">
        <input type="hidden" name="curso" value="Planificación Financiera">

        <!-- Pregunta 1 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-bullseye"></i> 1. ¿Cuál es el orden CORRECTO en la pirámide de objetivos financieros?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta1" id="p1a" value="a">
              <label class="form-check-label" for="p1a">a) Base: Seguridad - Intermedio: Estabilidad - Cúspide: Crecimiento</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta1" id="p1b" value="b">
              <label class="form-check-label" for="p1b">b) Base: Inversiones - Intermedio: Ahorro - Cúspide: Gastos</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta1" id="p1c" value="c">
              <label class="form-check-label" for="p1c">c) Base: Créditos - Intermedio: Seguros - Cúspide: Jubilación</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 2 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-calendar-check"></i> 2. ¿Qué porcentaje de tus ingresos deberías destinar al ahorro según la regla 10-20-30-40?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta2" id="p2a" value="a">
              <label class="form-check-label" for="p2a">a) 15-20%</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta2" id="p2b" value="b">
              <label class="form-check-label" for="p2b">b) 5-10%</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta2" id="p2c" value="c">
              <label class="form-check-label" for="p2c">c) 30-40%</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 3 (Caso práctico) -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-calculator"></i> 3. Caso práctico: Juan gana $30,000 mensuales y gasta $25,000. ¿Qué diagnóstico tiene su salud financiera?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta3" id="p3a" value="a">
              <label class="form-check-label" for="p3a">a) Crítica (ahorra menos del 10%)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta3" id="p3b" value="b">
              <label class="form-check-label" for="p3b">b) Regular (ahorra 10-15%)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta3" id="p3c" value="c">
              <label class="form-check-label" for="p3c">c) Saludable (ahorra más del 20%)</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 4 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-piggy-bank"></i> 4. Para calcular el capital necesario para el retiro, ¿qué fórmula se recomienda?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta4" id="p4a" value="a">
              <label class="form-check-label" for="p4a">a) (Gasto anual esperado × 25)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta4" id="p4b" value="b">
              <label class="form-check-label" for="p4b">b) (Último salario × 10)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta4" id="p4c" value="c">
              <label class="form-check-label" for="p4c">c) (Ahorro actual × 100)</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 5 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-people-fill"></i> 5. ¿Qué actividad es adecuada para enseñar finanzas a niños de 8 años?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta5" id="p5a" value="a">
              <label class="form-check-label" for="p5a">a) Juego "Supermercado en casa" con presupuesto</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta5" id="p5b" value="b">
              <label class="form-check-label" for="p5b">b) Explicación detallada del mercado de valores</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta5" id="p5c" value="c">
              <label class="form-check-label" for="p5c">c) Firmar contratos de préstamo ficticios</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 6 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-arrow-repeat"></i> 6. ¿Con qué frecuencia debes revisar y ajustar tu plan financiero?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta6" id="p6a" value="a">
              <label class="form-check-label" for="p6a">a) Cada 3-6 meses</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta6" id="p6b" value="b">
              <label class="form-check-label" for="p6b">b) Cada 5 años</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta6" id="p6c" value="c">
              <label class="form-check-label" for="p6c">c) Solo cuando cambie de trabajo</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 7 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-lightning-charge"></i> 7. ¿Cuál es el primer paso ante un evento inesperado que afecte tus finanzas?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta7" id="p7a" value="a">
              <label class="form-check-label" for="p7a">a) Revisar tu fondo de emergencias y ajustar gastos</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta7" id="p7b" value="b">
              <label class="form-check-label" for="p7b">b) Pedir varios préstamos rápidamente</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta7" id="p7c" value="c">
              <label class="form-check-label" for="p7c">c) Ignorarlo hasta que se resuelva solo</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 8 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-graph-up"></i> 8. ¿Qué beneficio principal tiene empezar a ahorrar para el retiro desde los 25 años?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta8" id="p8a" value="a">
              <label class="form-check-label" for="p8a">a) El poder del interés compuesto genera mayor crecimiento</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta8" id="p8b" value="b">
              <label class="form-check-label" for="p8b">b) Permite retirarte a los 30 años</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta8" id="p8c" value="c">
              <label class="form-check-label" for="p8c">c) Evita pagar impuestos para siempre</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 9 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-journal-check"></i> 9. ¿Qué debe incluir un historial financiero personal?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta9" id="p9a" value="a">
              <label class="form-check-label" for="p9a">a) Metas, resultados y lecciones aprendidas</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta9" id="p9b" value="b">
              <label class="form-check-label" for="p9b">b) Solo los ingresos mensuales</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta9" id="p9c" value="c">
              <label class="form-check-label" for="p9c">c) Copia de todas las facturas de compras</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 10 (Caso práctico) -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-cash-stack"></i> 10. Caso: Laura recibe un aumento del 20%. ¿Cuál es la MEJOR estrategia?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta10" id="p10a" value="a">
              <label class="form-check-label" for="p10a">a) Ajustar su plan: aumentar ahorros e inversiones proporcionalmente</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta10" id="p10b" value="b">
              <label class="form-check-label" for="p10b">b) Incrementar todos sus gastos en 20%</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta10" id="p10c" value="c">
              <label class="form-check-label" for="p10c">c) Mantener todo igual y guardar el extra bajo el colchón</label>
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

      // Código para envío AJAX (igual que en curso 1)
      setTimeout(() => {
        document.getElementById("formEvaluacion").addEventListener("submit", async function (e) {
          e.preventDefault();
          const formData = new FormData(this);

          try {
            const response = await fetch("guardar_evaluacion.php", {
              method: "POST",
              body: formData
            });

            const data = await response.json();
            if (data.status !== "success") {
              alert("Error: " + data.mensaje);
              return;
            }

            document.getElementById("calificacionResultado").innerText = data.calificacion;
            document.getElementById("mensajeResultado").innerText = data.aprobado
              ? "¡Felicidades! Has aprobado este curso 🎉"
              : "No has aprobado esta vez 😓";

            document.getElementById("botonesResultado").innerHTML = data.aprobado
              ? `<a href="../menu_cursos.php" class="btn btn-success">Volver al menú de cursos</a>`
              : `<button class="btn btn-warning" onclick="cargarLeccion(1)" data-bs-dismiss="modal">Reintentar Lecciones</button>`;

            new bootstrap.Modal(document.getElementById('resultadoModal')).show();

          } catch (error) {
            alert("Hubo un error al procesar tu evaluación.");
            console.error(error);
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
