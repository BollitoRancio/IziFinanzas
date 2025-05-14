<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Curso: Estrategias de Ahorro</title>
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
          <li class="active" onclick="cargarLeccion(1)">Lección 1: ¿Por qué es importante ahorrar?</li>
          <li onclick="cargarLeccion(2)">Lección 2: Tipos de ahorro</li>
          <li onclick="cargarLeccion(3)">Lección 3: Establecimiento de metas de ahorro</li>
        </ul>
        <h4>Módulo 2</h4>
        <ul>
          <li onclick="cargarLeccion(4)">Lección 4: Presupuestos y control de gastos</li>
          <li onclick="cargarLeccion(5)">Lección 5: Automatización del ahorro</li>
          <li onclick="cargarLeccion(6)">Lección 6: Ahorro para emergencias y objetivos</li>
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
      titulo: "Lección 1: ¿Por qué es importante ahorrar?",
      contenido: `
        <div class="row align-items-center">
          <div class="col-md-6">
            <h4 class="titulo-verde">El poder del ahorro</h4>
            <p>El ahorro es la base de la libertad financiera. No se trata solo de guardar dinero, sino de crear oportunidades y seguridad para tu futuro.</p>
            
            <div class="card shadow-sm my-3">
              <div class="card-body">
                <h5><i class="bi bi-lightbulb"></i> Beneficios clave:</h5>
                <ul>
                  <li><strong>Seguridad:</strong> Protección ante imprevistos</li>
                  <li><strong>Oportunidades:</strong> Capacidad de aprovechar inversiones</li>
                  <li><strong>Paz mental:</strong> Reduce el estrés financiero</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <img src="https://librefinanciero.com/wp-content/uploads/2019/06/Pir%C3%A1mide-Financiera.png" class="img-fluid rounded" alt="Pirámide del ahorro">
          </div>
        </div>

        <div class="alert alert-warning mt-4">
          <strong>Dato impactante:</strong> El 60% de los adultos no podría cubrir un gasto imprevisto de $500 sin endeudarse.
        </div>
      `
    },
    {
      titulo: "Lección 2: Tipos de ahorro: corto, mediano y largo plazo",
      contenido: `
        <h4 class="titulo-verde">Estrategias según tus plazos</h4>
        
        <div class="row mt-4">
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="card-header bg-success text-white">
                <h5>Corto plazo (0-2 años)</h5>
              </div>
              <div class="card-body">
                <p><strong>Ejemplos:</strong> Vacaciones, emergencias</p>
                <p><strong>Instrumentos:</strong> Cuentas de ahorro, fondos monetarios</p>
                <p><strong>Liquidez:</strong> Alta</p>
              </div>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="card-header bg-warning text-dark">
                <h5>Mediano plazo (2-5 años)</h5>
              </div>
              <div class="card-body">
                <p><strong>Ejemplos:</strong> Enganche de casa, auto</p>
                <p><strong>Instrumentos:</strong> Certificados de depósito, bonos</p>
                <p><strong>Rendimiento:</strong> Moderado</p>
              </div>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="card-header bg-primary text-white">
                <h5>Largo plazo (+5 años)</h5>
              </div>
              <div class="card-body">
                <p><strong>Ejemplos:</strong> Retiro, educación hijos</p>
                <p><strong>Instrumentos:</strong> Acciones, fondos de inversión</p>
                <p><strong>Crecimiento:</strong> Alto potencial</p>
              </div>
            </div>
          </div>
        </div>

        <div class="alert alert-info mt-4">
          <i class="bi bi-graph-up"></i> <strong>Consejo:</strong> Divide tu ahorro en estos tres plazos para maximizar rendimientos sin sacrificar liquidez.
        </div>
      `
    },
    {
      titulo: "Lección 3: Estableciendo metas de ahorro",
      contenido: `
        <h4 class="titulo-verde">Metas SMART para ahorrar</h4>
        
        <div class="row align-items-center mt-4">
          <div class="col-md-6">
            <div class="card shadow-sm">
              <div class="card-body">
                <h5><i class="bi bi-bullseye"></i> Fórmula efectiva:</h5>
                <p><strong>1. Específicas:</strong> "Ahorrar $5,000 para viaje" vs "Ahorrar para viajar"</p>
                <p><strong>2. Medibles:</strong> Cantidad exacta y plazo</p>
                <p><strong>3. Alcanzables:</strong> Adaptadas a tu capacidad</p>
                <p><strong>4. Relevantes:</strong> Que realmente te motiven</p>
                <p><strong>5. Temporales:</strong> Con fecha límite</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <img src="https://cdn-co.comparabien.com/s3fs-public/field/image/finanzas-personales_0.jpg" class="img-fluid rounded" alt="Metas de ahorro" style="max-height: 250px;">
          </div>
        </div>

        <div class="card mt-4 shadow-sm">
          <div class="card-header">
            <h5>Ejemplo práctico</h5>
          </div>
          <div class="card-body">
            <p><strong>Meta:</strong> "Ahorrar $18,000 para enganche de auto en 3 años"</p>
            <p><strong>Plan:</strong> $500 mensuales en cuenta dedicada con rendimiento del 5% anual</p>
            <div class="progress mt-2" style="height: 25px;">
              <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Primer año</div>
            </div>
          </div>
        </div>
      `
    },
    {
      titulo: "Lección 4: Presupuestos y control de gastos",
      contenido: `
        <h4 class="titulo-verde">La regla 50/30/20</h4>
        
        <div class="row mt-4">
          <div class="col-md-8">
            <div class="card shadow-sm">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4 text-center py-3 bg-danger bg-opacity-10">
                    <h3 class="text-danger">50%</h3>
                    <p>Necesidades básicas</p>
                    <small>(Vivienda, comida, servicios)</small>
                  </div>
                  <div class="col-md-4 text-center py-3 bg-warning bg-opacity-10">
                    <h3 class="text-warning">30%</h3>
                    <p>Gastos personales</p>
                    <small>(Entretenimiento, salidas)</small>
                  </div>
                  <div class="col-md-4 text-center py-3 bg-success bg-opacity-10">
                    <h3 class="text-success">20%</h3>
                    <p>Ahorro/inversión</p>
                    <small>(Futuro y emergencias)</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5><i class="bi bi-phone"></i> Apps recomendadas</h5>
                <ul>
                  <li>Mint</li>
                  <li>YNAB</li>
                  <li>Spendee</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="card mt-4 shadow-sm">
          <div class="card-header">
            <h5>Técnica de los sobres físicos</h5>
          </div>
          <div class="card-body">
            <div class="row text-center">
              <div class="col">
                <img src="https://noticiastrabajo.huffingtonpost.es/uploads/images/2023/02/truco-sobres-ahorrar.jpg" class="img-fluid rounded" style="max-height: 150px;" alt="Sobres de ahorro">
              </div>
              <div class="col-md-8">
                <p>Sistema físico para categorizar gastos:</p>
                <ol>
                  <li>Divide tu efectivo en categorías</li>
                  <li>Usa solo lo asignado a cada sobre</li>
                  <li>Lo que sobra va a ahorro</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      `
    },
    {
      titulo: "Lección 5: Automatización del ahorro",
      contenido: `
        <h4 class="titulo-verde">Hazlo sin pensar</h4>
        
        <div class="row mt-4">
          <div class="col-md-6">
            <div class="card shadow-sm h-100">
              <div class="card-body">
                <h5><i class="bi bi-gear"></i> Métodos de automatización</h5>
                <ul>
                  <li><strong>Transferencia automática:</strong> Programa movimientos en fechas de pago</li>
                  <li><strong>Apps de round-up:</strong> Ahorra el "cambio" de tus compras</li>
                  <li><strong>Ahorro por nómina:</strong> Deposita directo a ahorro antes de gastar</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card shadow-sm h-100">
              <div class="card-body">
                <h5><i class="bi bi-graph-up"></i> Beneficios</h5>
                <ul>
                  <li>Elimina la tentación de gastar</li>
                  <li>Aprovecha el interés compuesto</li>
                  <li>Crea disciplina sin esfuerzo</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="card mt-4 shadow-sm">
          <div class="card-header bg-primary text-white">
            <h5>Ejemplo de automatización</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <p><strong>Situación:</strong> Sueldo de $2,000 cada quincena</p>
                <p><strong>Automatización:</strong></p>
                <ul>
                  <li>$400 a cuenta de retiro (20%)</li>
                  <li>$200 a fondo de emergencias (10%)</li>
                  <li>$50 a ahorro para vacaciones</li>
                </ul>
              </div>
              <div class="col-md-6">
                <img src="https://miasesorpatrimonial.mx/wp-content/uploads/2021/10/grafico-agorro-1024x576.png" class="img-fluid rounded" alt="Diagrama automatización">
              </div>
            </div>
          </div>
        </div>
      `
    },
    {
      titulo: "Lección 6: Ahorro para emergencias vs. ahorro para objetivos",
      contenido: `
        <h4 class="titulo-verde">Dos propósitos diferentes</h4>
        
        <div class="row mt-4">
          <div class="col-md-6">
            <div class="card shadow-sm h-100">
              <div class="card-header bg-warning">
                <h5>Fondo de emergencias</h5>
              </div>
              <div class="card-body">
                <p><strong>Monto ideal:</strong> 3-6 meses de gastos</p>
                <p><strong>Características:</strong></p>
                <ul>
                  <li>Alta liquidez inmediata</li>
                  <li>Bajo riesgo</li>
                  <li>Cuenta separada</li>
                </ul>
                <p><strong>Ejemplos de uso:</strong> Reparaciones médicas, pérdida de empleo</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card shadow-sm h-100">
              <div class="card-header bg-success text-white">
                <h5>Ahorro para objetivos</h5>
              </div>
              <div class="card-body">
                <p><strong>Monto ideal:</strong> Según meta específica</p>
                <p><strong>Características:</strong></p>
                <ul>
                  <li>Plazo definido</li>
                  <li>Mayor rendimiento</li>
                  <li>Puede tener restricciones</li>
                </ul>
                <p><strong>Ejemplos:</strong> Viaje, enganche de casa, educación</p>
              </div>
            </div>
          </div>
        </div>

        <div class="card mt-4 shadow-sm">
          <div class="card-body">
            <h5><i class="bi bi-lightbulb"></i> Estrategia combinada</h5>
            <p>Prioriza construir tu fondo de emergencias primero (3-6 meses de gastos), luego enfócate en objetivos específicos.</p>
            <div class="progress" style="height: 30px;">
              <div class="progress-bar bg-warning" role="progressbar" style="width: 30%;">Fondo emergencia</div>
              <div class="progress-bar bg-success" role="progressbar" style="width: 70%;">Objetivos</div>
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
      <h3 class="text-center mb-4 text-primary">Evaluación Final - Estrategias de Ahorro</h3>
      <form id="formEvaluacion">
        <input type="hidden" name="curso" value="Estrategias de Ahorro">

        <!-- Pregunta 1 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-piggy-bank"></i> 1. ¿Por qué es importante ahorrar regularmente?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta1" id="p1a" value="a">
              <label class="form-check-label" for="p1a">a) Para asegurar el pago de deudas rápidamente</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta1" id="p1b" value="b">
              <label class="form-check-label" for="p1b">b) Para crear oportunidades y seguridad financiera a largo plazo</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta1" id="p1c" value="c">
              <label class="form-check-label" for="p1c">c) Para gastar sin limitaciones en el futuro</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 2 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-graph-up"></i> 2. ¿Qué caracteriza el ahorro a largo plazo?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta2" id="p2a" value="a">
              <label class="form-check-label" for="p2a">a) Se utiliza para metas urgentes y emergencias</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta2" id="p2b" value="b">
              <label class="form-check-label" for="p2b">b) Se usa para la compra de bienes a corto plazo</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta2" id="p2c" value="c">
              <label class="form-check-label" for="p2c">c) Se enfoca en objetivos como la jubilación y la educación a largo plazo</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 3 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-pencil-square"></i> 3. ¿Qué significa establecer metas SMART en el ahorro?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta3" id="p3a" value="a">
              <label class="form-check-label" for="p3a">a) Establecer metas vagamente definidas para tener flexibilidad</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta3" id="p3b" value="b">
              <label class="form-check-label" for="p3b">b) Establecer metas que sean específicas, medibles, alcanzables, relevantes y temporales</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta3" id="p3c" value="c">
              <label class="form-check-label" for="p3c">c) Establecer metas que dependan únicamente de la cantidad de dinero disponible</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 4 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-credit-card"></i> 4. ¿Cuál es la mejor estrategia para ahorrar para emergencias?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta4" id="p4a" value="a">
              <label class="form-check-label" for="p4a">a) Ahorrar en una cuenta de ahorro separada con alta liquidez</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta4" id="p4b" value="b">
              <label class="form-check-label" for="p4b">b) Invertir en acciones de alto riesgo para obtener rendimientos rápidos</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta4" id="p4c" value="c">
              <label class="form-check-label" for="p4c">c) Guardar todo el dinero en efectivo bajo el colchón</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 5 (Caso práctico) -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-file-earmark-check"></i> 5. Caso práctico: Andrés quiere ahorrar para un viaje. ¿Cuál es la mejor estrategia?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta5" id="p5a" value="a">
              <label class="form-check-label" for="p5a">a) Establecer una meta de ahorro con un plazo específico y realizar aportes mensuales fijos</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta5" id="p5b" value="b">
              <label class="form-check-label" for="p5b">b) Ahorrar solo cuando le quede dinero al final del mes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta5" id="p5c" value="c">
              <label class="form-check-label" for="p5c">c) Pedir un préstamo para financiar el viaje</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 6 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-clock"></i> 6. ¿Qué tipo de ahorro es más adecuado para metas a largo plazo como la jubilación?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta6" id="p6a" value="a">
              <label class="form-check-label" for="p6a">a) Ahorro en una cuenta de alta liquidez, sin riesgo</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta6" id="p6b" value="b">
              <label class="form-check-label" for="p6b">b) Inversiones en productos con alto rendimiento, como fondos de inversión o acciones</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta6" id="p6c" value="c">
              <label class="form-check-label" for="p6c">c) Comprar bienes materiales con la esperanza de que su valor aumente</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 7 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-check-circle"></i> 7. ¿Qué se recomienda al crear un presupuesto personal?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta7" id="p7a" value="a">
              <label class="form-check-label" for="p7a">a) Asignar más dinero al ahorro que al gasto en entretenimiento</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta7" id="p7b" value="b">
              <label class="form-check-label" for="p7b">b) Priorizar el pago de deudas y ahorro antes de gastar en lujo</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta7" id="p7c" value="c">
              <label class="form-check-label" for="p7c">c) Gastar sin preocuparse por el ahorro y los pagos</label>
            </div>
          </div>
        </div>
        <!-- Pregunta 8 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-bar-chart-line"></i> 8. ¿Cuál es una de las ventajas del ahorro automático?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta8" id="p8a" value="a">
              <label class="form-check-label" for="p8a">a) Permite ahorrar sin tener que pensarlo constantemente</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta8" id="p8b" value="b">
              <label class="form-check-label" for="p8b">b) Solo es útil si tienes grandes sumas de dinero</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta8" id="p8c" value="c">
              <label class="form-check-label" for="p8c">c) Hace que tu cuenta corriente crezca automáticamente sin intervención</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 9 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-calendar-check"></i> 9. ¿Cuánto debería ser el fondo de emergencias recomendado?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta9" id="p9a" value="a">
              <label class="form-check-label" for="p9a">a) 1-2 meses de gastos básicos</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta9" id="p9b" value="b">
              <label class="form-check-label" for="p9b">b) 3-6 meses de gastos básicos</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta9" id="p9c" value="c">
              <label class="form-check-label" for="p9c">c) 12 meses de gastos básicos</label>
            </div>
          </div>
        </div>

        <!-- Pregunta 10 -->
        <div class="card mb-4 border-success shadow-sm">
          <div class="card-header bg-success text-white">
            <h5><i class="bi bi-percent"></i> 10. ¿Qué tipo de gasto debería ser recortado primero para aumentar el ahorro?</h5>
          </div>
          <div class="card-body">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta10" id="p10a" value="a">
              <label class="form-check-label" for="p10a">a) Los gastos fijos como el alquiler y las facturas</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta10" id="p10b" value="b">
              <label class="form-check-label" for="p10b">b) Los gastos variables como entretenimiento y comer fuera</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pregunta10" id="p10c" value="c">
              <label class="form-check-label" for="p10c">c) Los ahorros personales y las inversiones</label>
            </div>
          </div>
        </div>
        <!-- Enviar evaluación -->
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
