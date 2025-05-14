<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Curso: Inversiones 101</title>
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
          <li class="active" onclick="cargarLeccion(1)">Lección 1: ¿Qué es invertir y por qué hacerlo?</li>
          <li onclick="cargarLeccion(2)">Lección 2: Tipos de inversión</li>
          <li onclick="cargarLeccion(3)">Lección 3: Perfil de inversionista</li>
        </ul>
        <h4>Módulo 2</h4>
        <ul>
          <li onclick="cargarLeccion(4)">Lección 4: Bolsa de valores y acciones</li>
          <li onclick="cargarLeccion(5)">Lección 5: Fondos de inversión y ETFs</li>
          <li onclick="cargarLeccion(6)">Lección 6: Riesgos y rendimientos</li>
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
        titulo: "Lección 1: ¿Qué es invertir y por qué hacerlo?",
        contenido: `
          <p>Invertir consiste en utilizar tu dinero con el objetivo de obtener un rendimiento en el futuro. A diferencia de ahorrar, que implica guardar dinero sin riesgo, invertir implica un grado de incertidumbre, pero con el potencial de obtener mayores ganancias.</p>

          <div class="row align-items-center my-4">
            <div class="col-md-7">
              <ul>
                <li><strong>Multiplicar tu dinero:</strong> Al invertir, tu dinero puede crecer con el tiempo gracias al interés compuesto o al aumento del valor de los activos.</li>
                <li><strong>Alcanzar metas financieras:</strong> Como comprar una casa, pagar estudios o lograr una jubilación cómoda.</li>
                <li><strong>Protegerte contra la inflación:</strong> Invertir en activos que se revalúan puede evitar que tu dinero pierda valor con el tiempo.</li>
              </ul>
            </div>
            <div class="col-md-5 text-center">
              <img src="../img/invertir.jpg" class="img-fluid rounded shadow" alt="Invertir imagen">
            </div>
          </div>

          <div class="alert alert-success mt-4">
            <i class="bi bi-lightbulb"></i> <strong>Dato curioso:</strong> Si hubieras invertido $1,000 USD en acciones del S&P 500 hace 30 años, hoy podrías tener más de $10,000.
          </div>
        `
      },
      {
        titulo: "Lección 2: Tipos de inversión",
        contenido: `
          <p>Existen muchos tipos de inversión, pero se pueden agrupar principalmente en dos grandes categorías: <strong>renta fija</strong> y <strong>renta variable</strong>.</p>

          <div class="row align-items-center my-4">
            <div class="col-md-6">
              <h5 class="tituloverde">Renta Fija</h5>
              <p>Es una inversión donde conoces de antemano cuánto vas a ganar. Ejemplos comunes son los bonos del gobierno o los certificados de depósito. Son más estables y con menor riesgo, ideales para perfiles conservadores.</p>
            </div>
            <div class="col-md-6 text-center">
              <img src="../img/rentafija.jpg" class="img-fluid rounded shadow-sm" alt="Renta fija">
            </div>
          </div>

          <div class="row align-items-center my-4">
            <div class="col-md-6 text-center order-md-2">
              <img src="../img/rentavariable.jpg" class="img-fluid rounded shadow-sm" alt="Renta variable">
            </div>
            <div class="col-md-6 order-md-1">
              <h5 class="tituloverde">Renta Variable</h5>
              <p>En este tipo de inversión no sabes con certeza cuánto ganarás. Invertir en acciones de empresas o criptomonedas es un ejemplo. Tiene más riesgo, pero también la posibilidad de mayores ganancias.</p>
            </div>
          </div>

          <p>Elegir el tipo adecuado depende de tu perfil de riesgo, objetivos financieros y horizonte de tiempo. Una buena estrategia suele incluir una combinación de ambos.</p>
        `
      },
      {
        titulo: "Lección 3: Perfil de inversionista",
        contenido: `
          <p>Antes de comenzar a invertir, es fundamental conocer tu perfil de inversionista. Este perfil refleja tu tolerancia al riesgo, tu experiencia financiera y tus objetivos a corto, mediano y largo plazo.</p>

          <div class="row align-items-center my-4">
            <div class="col-md-6">
              <h5 class="tituloverde">¿Por qué es importante conocer tu perfil?</h5>
              <p>Tu perfil determinará qué tipo de instrumentos son más adecuados para ti. Invertir sin saber tu perfil puede llevarte a decisiones emocionales, como vender cuando el mercado baja o invertir en productos que no entiendes.</p>
            </div>
            <div class="col-md-6 text-center">
              <img src="../img/perfilinversionista.jpg" alt="Perfil de inversionista" class="img-fluid rounded shadow-sm">
            </div>
          </div>

          <div class="card shadow-sm my-3 p-3">
            <h5 class="tituloverde mb-3">Tipos de perfiles más comunes</h5>
            <ul>
              <li><strong>Conservador:</strong> Prefiere inversiones seguras y predecibles. Tolera poco o nada de riesgo.</li>
              <li><strong>Moderado:</strong> Acepta cierto riesgo buscando un equilibrio entre seguridad y rentabilidad.</li>
              <li><strong>Arriesgado (agresivo):</strong> Busca altos rendimientos y acepta posibles pérdidas en el camino.</li>
            </ul>
          </div>
          <div class="row my-4">
            <div class="col-md-6 text-center">
              <img src="../img/inversionista_perfiles.jpg" alt="Tipos de perfiles" class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md-6">
              <h5 class="tituloverde">¿Cómo descubrir tu perfil?</h5>
              <p>Existen cuestionarios en línea que analizan tus respuestas y te orientan. También puedes hablar con un asesor financiero que evalúe tu situación completa.</p>
              <p>Recuerda que tu perfil puede cambiar con el tiempo, a medida que creces financieramente o cambian tus metas.</p>
            </div>
          </div>
          <p>Conocer tu perfil te dará más seguridad y claridad para tomar decisiones inteligentes que estén alineadas con tu estilo de vida y tus metas.</p>
        `
      },
      {
        titulo: "Lección 4: Bolsa de valores y acciones",
        contenido: `
          <p>La <strong>bolsa de valores</strong> es un mercado organizado donde se compran y venden acciones de empresas, bonos y otros instrumentos financieros. Es uno de los lugares más conocidos para invertir.</p>
          <div class="row my-4 align-items-center">
            <div class="col-md-6">
              <h5 class="tituloverde">¿Qué es una acción?</h5>
              <p>Una acción representa una pequeña parte del capital de una empresa. Al comprar una acción, te conviertes en propietario parcial de esa compañía y puedes beneficiarte si esta crece o genera ganancias.</p>
            </div>
            <div class="col-md-6 text-center">
              <img src="../img/accion_bolsa.jpg" alt="Acción de empresa" class="img-fluid rounded shadow-sm">
            </div>
          </div>
          <div class="card p-3 shadow-sm my-4">
            <h5 class="tituloverde mb-3">¿Cómo funciona la bolsa de valores?</h5>
            <ul>
              <li>Las empresas venden acciones para obtener financiamiento.</li>
              <li>Los inversionistas compran esas acciones esperando que su valor aumente con el tiempo.</li>
              <li>El precio de las acciones cambia constantemente según la oferta y demanda del mercado.</li>
              <li>Las bolsas más conocidas incluyen la Bolsa de Nueva York (NYSE) y Nasdaq.</li>
            </ul>
          </div>
          <div class="row my-4">
            <div class="col-md-6 text-center">
              <img src="../img/bolsa_valores.jpg" alt="Bolsa de valores" class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md-6">
              <h5 class="tituloverde">Ventajas de invertir en acciones</h5>
              <ul>
                <li>Posibilidad de obtener altos rendimientos a largo plazo.</li>
                <li>Acceso al crecimiento de grandes empresas.</li>
                <li>Liquidez: puedes vender tus acciones cuando lo necesites.</li>
              </ul>
            </div>
          </div>
          <p>Invertir en la bolsa puede parecer complejo al principio, pero entender los conceptos básicos te permitirá comenzar con seguridad y tomar decisiones más informadas.</p>
        `},
      {
        titulo: "Lección 5: Fondos de inversión y ETFs",
        contenido: `
          <p>Los <strong>fondos de inversión</strong> y los <strong>ETFs</strong> (fondos cotizados en bolsa) son formas populares de invertir sin necesidad de seleccionar activos individualmente. Son ideales para quienes desean diversificar su portafolio de forma sencilla.</p>

          <div class="row my-4">
            <div class="col-md-6">
              <h5 class="tituloverde">¿Qué es un fondo de inversión?</h5>
              <p>Es un vehículo financiero que reúne el dinero de varios inversionistas para invertirlo en una cartera diversificada de activos como acciones, bonos o bienes raíces.</p>
              <ul>
                <li>Gestionado por un profesional financiero.</li>
                <li>Acceso a mercados y activos que podrían estar fuera del alcance individual.</li>
                <li>Pagas una comisión por la administración del fondo.</li>
              </ul>
            </div>
            <div class="col-md-6 text-center">
              <img src="../img/fondo_inversion.jpg" alt="Fondo de inversión" class="img-fluid rounded shadow-sm">
            </div>
          </div>

          <div class="row my-4">
            <div class="col-md-6 text-center">
              <img src="../img/etf_grafica.jpg" alt="ETF" class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md-6">
              <h5 class="tituloverde">¿Qué es un ETF?</h5>
              <p>Un ETF es un tipo de fondo de inversión que se <strong>compra y vende como una acción</strong> en la bolsa de valores. Sigue el comportamiento de un índice o sector específico.</p>
              <ul>
                <li>Costos más bajos que los fondos tradicionales.</li>
                <li>Mayor flexibilidad y transparencia.</li>
                <li>Ideal para inversionistas que prefieren operar por su cuenta.</li>
              </ul>
            </div>
          </div>

          <div class="card p-3 my-4 shadow-sm">
            <h5 class="tituloverde">Comparación rápida</h5>
            <table class="table table-bordered table-sm mt-2">
              <thead>
                <tr class="table-success text-center">
                  <th></th>
                  <th>Fondo de Inversión</th>
                  <th>ETF</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Forma de compra</strong></td>
                  <td>Con una gestora financiera</td>
                  <td>En la bolsa, como una acción</td>
                </tr>
                <tr>
                  <td><strong>Costo</strong></td>
                  <td>Comisiones de gestión más altas</td>
                  <td>Bajo costo de mantenimiento</td>
                </tr>
                <tr>
                  <td><strong>Liquidez</strong></td>
                  <td>Disponible en ciertos horarios</td>
                  <td>Se puede comprar/vender durante el día</td>
                </tr>
              </tbody>
            </table>
          </div>

          <p>Ambos instrumentos son excelentes opciones para construir un portafolio diversificado. La elección depende de tu nivel de experiencia, objetivos y preferencias de inversión.</p>
        `
      }
      ,
      {
        titulo: "Lección 6: Riesgos y rendimientos",
        contenido: `
          <p>Cuando se trata de invertir, es fundamental comprender la relación entre <strong>riesgo</strong> y <strong>rendimiento</strong>. Ambos van de la mano y entender su equilibrio te ayudará a tomar decisiones más acertadas.</p>

          <div class="alert alert-warning mt-3" role="alert">
            <strong>Importante:</strong> No existe inversión sin riesgo. Incluso tener dinero guardado en una cuenta de ahorro puede estar expuesto a la inflación.
          </div>

          <h5 class="tituloverde mt-4">¿Qué es el riesgo financiero?</h5>
          <p>Es la probabilidad de que el resultado de una inversión sea diferente al esperado, lo que incluye la posibilidad de perder parte o todo el capital invertido.</p>

          <ul class="mb-4">
            <li><strong>Riesgo de mercado:</strong> Fluctuaciones en los precios debido a eventos económicos o políticos.</li>
            <li><strong>Riesgo de crédito:</strong> Posibilidad de que un emisor de deuda no pague lo prometido.</li>
            <li><strong>Riesgo de liquidez:</strong> Dificultad para vender una inversión sin perder valor.</li>
          </ul>

          <div class="alert alert-success" role="alert">
            <strong>Dato clave:</strong> Diversificar tu portafolio ayuda a reducir el riesgo sin sacrificar tanto el rendimiento.
          </div>

          <h5 class="tituloverde mt-4">¿Y qué es el rendimiento?</h5>
          <p>Es la ganancia generada por una inversión en un periodo determinado. Se puede medir como un porcentaje del monto invertido.</p>

          <div class="row mt-4">
            <div class="col-md-6">
              <div class="card p-3 shadow-sm">
                <h6 class="text-success"><i class="bi bi-graph-up-arrow"></i> Ejemplo de Rendimiento:</h6>
                <p>Si inviertes $10,000 en un fondo y al cabo de un año tienes $11,000, el rendimiento fue del 10%.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card p-3 shadow-sm">
                <h6 class="text-danger"><i class="bi bi-graph-down-arrow"></i> Ejemplo de Pérdida:</h6>
                <p>Si esos $10,000 se convierten en $9,000, perdiste el 10% de tu capital.</p>
              </div>
            </div>
          </div>

          <h5 class="tituloverde mt-4">Relación riesgo-rendimiento</h5>
          <p>Generalmente, cuanto mayor sea el rendimiento esperado de una inversión, mayor será su riesgo.</p>

          <table class="table table-bordered mt-3">
            <thead>
              <tr class="table-light">
                <th>Tipo de inversión</th>
                <th>Nivel de riesgo</th>
                <th>Rendimiento potencial</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Cuenta de ahorro</td>
                <td>Bajo</td>
                <td>Bajo</td>
              </tr>
              <tr>
                <td>Bonos del gobierno</td>
                <td>Medio</td>
                <td>Moderado</td>
              </tr>
              <tr>
                <td>Acciones</td>
                <td>Alto</td>
                <td>Alto</td>
              </tr>
            </tbody>
          </table>

          <div class="alert alert-info mt-4" role="alert">
            <i class="bi bi-lightbulb-fill"></i> <strong>Consejo:</strong> Nunca inviertas dinero que no estés dispuesto a perder. Comienza con inversiones que se alineen con tu perfil y metas.
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
      <h3 class="text-center mb-4 text-success">Evaluación Final - Inversiones 101</h3>
<form id="formEvaluacion">
  <input type="hidden" name="curso" value="Inversiones 101">

  <!-- Pregunta 1 -->
  <div class="card mb-4 border-success shadow-sm">
    <div class="card-header bg-success text-white">
      <h5><i class="bi bi-graph-up-arrow"></i> 1. ¿Cuál es el principal beneficio de invertir a largo plazo?</h5>
    </div>
    <div class="card-body">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta1" id="p1a" value="a">
        <label class="form-check-label" for="p1a">a) Generar ingresos inmediatos</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta1" id="p1b" value="b">
        <label class="form-check-label" for="p1b">b) Obtener rendimientos compuestos y amortiguar la volatilidad</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta1" id="p1c" value="c">
        <label class="form-check-label" for="p1c">c) Evitar pagar impuestos</label>
      </div>
      <div class="mt-3 alert alert-warning bg-light-warning">
        <i class="bi bi-lightbulb"></i> <small>El interés compuesto puede multiplicar tu inversión inicial gracias al efecto "bola de nieve".</small>
      </div>
    </div>
  </div>

  <!-- Pregunta 2 -->
  <div class="card mb-4 border-success shadow-sm">
    <div class="card-header bg-success text-white">
      <h5><i class="bi bi-building"></i> 2. ¿Qué instrumento representa una parte del capital de una empresa?</h5>
    </div>
    <div class="card-body">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta2" id="p2a" value="a">
        <label class="form-check-label" for="p2a">a) Bono corporativo</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta2" id="p2b" value="b">
        <label class="form-check-label" for="p2b">b) Acción</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta2" id="p2c" value="c">
        <label class="form-check-label" for="p2c">c) ETF</label>
      </div>
      <div class="text-center mt-3">
        <img src="../img/acciones-vs-bonos.jpg" class="img-fluid rounded" alt="Diferencias acciones y bonos" style="max-height: 120px;">
      </div>
    </div>
  </div>

  <!-- Pregunta 3 -->
  <div class="card mb-4 border-success shadow-sm">
    <div class="card-header bg-success text-white">
      <h5><i class="bi bi-bank"></i> 3. ¿Cuál es una característica principal de los fondos de inversión?</h5>
    </div>
    <div class="card-body">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta3" id="p3a" value="a">
        <label class="form-check-label" for="p3a">a) Solo permiten invertir en acciones</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta3" id="p3b" value="b">
        <label class="form-check-label" for="p3b">b) Son administrados por un gestor profesional</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta3" id="p3c" value="c">
        <label class="form-check-label" for="p3c">c) Garantizan rendimientos fijos</label>
      </div>
    </div>
  </div>

  <!-- Pregunta 4 -->
  <div class="card mb-4 border-success shadow-sm">
    <div class="card-header bg-success text-white">
      <h5><i class="bi bi-collection"></i> 4. ¿Qué describe mejor un ETF?</h5>
    </div>
    <div class="card-body">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta4" id="p4a" value="a">
        <label class="form-check-label" for="p4a">a) Fondo que invierte únicamente en bienes raíces</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta4" id="p4b" value="b">
        <label class="form-check-label" for="p4b">b) Fondo que replica el comportamiento de un índice</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta4" id="p4c" value="c">
        <label class="form-check-label" for="p4c">c) Instrumento con riesgo mínimo garantizado</label>
      </div>
      <div class="mt-2">
        <span class="badge bg-warning text-dark">Ejemplo:</span> <small>El ETF $SPY replica el S&P 500 con una comisión del 0.09% anual.</small>
      </div>
    </div>
  </div>

  <!-- Pregunta 5 -->
  <div class="card mb-4 border-success shadow-sm">
    <div class="card-header bg-success text-white">
      <h5><i class="bi bi-person-badge"></i> 5. ¿Qué determina el perfil de un inversionista?</h5>
    </div>
    <div class="card-body">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta5" id="p5a" value="a">
        <label class="form-check-label" for="p5a">a) Su nivel de estudios</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta5" id="p5b" value="b">
        <label class="form-check-label" for="p5b">b) Su edad y estatura</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta5" id="p5c" value="c">
        <label class="form-check-label" for="p5c">c) Su tolerancia al riesgo y objetivos financieros</label>
      </div>
      <div class="mt-3">
        <div class="progress" style="height: 20px;">
          <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: 25%">Conservador</div>
          <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: 50%">Moderado</div>
          <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 25%">Arriesgado</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pregunta 6 -->
  <div class="card mb-4 border-success shadow-sm">
    <div class="card-header bg-success text-white">
      <h5><i class="bi bi-exclamation-triangle"></i> 6. ¿Cuál de los siguientes tiene mayor riesgo?</h5>
    </div>
    <div class="card-body">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta6" id="p6a" value="a">
        <label class="form-check-label" for="p6a">a) Acciones tecnológicas en mercados emergentes</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta6" id="p6b" value="b">
        <label class="form-check-label" for="p6b">b) Bonos del gobierno a 5 años</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta6" id="p6c" value="c">
        <label class="form-check-label" for="p6c">c) Cuentas de ahorro</label>
      </div>
    </div>
  </div>

  <!-- Pregunta 7 -->
  <div class="card mb-4 border-success shadow-sm">
    <div class="card-header bg-success text-white">
      <h5><i class="bi bi-shuffle"></i> 7. ¿Qué significa diversificar?</h5>
    </div>
    <div class="card-body">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta7" id="p7a" value="a">
        <label class="form-check-label" for="p7a">a) Comprar solo acciones de una empresa</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta7" id="p7b" value="b">
        <label class="form-check-label" for="p7b">b) Invertir en varios instrumentos y sectores</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta7" id="p7c" value="c">
        <label class="form-check-label" for="p7c">c) Invertir en moneda extranjera</label>
      </div>
      <div class="mt-3 text-center">
        <img src="../img/diversificacion-portafolio.jpg" class="img-fluid rounded" alt="Portafolio diversificado" style="max-height: 100px;">
      </div>
    </div>
  </div>

  <!-- Pregunta 8 -->
  <div class="card mb-4 border-success shadow-sm">
    <div class="card-header bg-success text-white">
      <h5><i class="bi bi-newspaper"></i> 8. ¿Qué factor puede afectar el precio de una acción?</h5>
    </div>
    <div class="card-body">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta8" id="p8a" value="a">
        <label class="form-check-label" for="p8a">a) Los hábitos de ahorro del inversionista</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta8" id="p8b" value="b">
        <label class="form-check-label" for="p8b">b) Noticias económicas y resultados financieros de la empresa</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta8" id="p8c" value="c">
        <label class="form-check-label" for="p8c">c) El color del logotipo de la empresa</label>
      </div>
      <div class="alert alert-warning bg-light-warning mt-3">
        <i class="bi bi-info-circle"></i> Factores clave: Ganancias trimestrales, cambios regulatorios, innovaciones tecnológicas, competencia.
      </div>
    </div>
  </div>

  <!-- Pregunta 9 -->
  <div class="card mb-4 border-success shadow-sm">
    <div class="card-header bg-success text-white">
      <h5><i class="bi bi-cash-coin"></i> 9. ¿Qué es el riesgo de liquidez?</h5>
    </div>
    <div class="card-body">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta9" id="p9a" value="a">
        <label class="form-check-label" for="p9a">a) Posibilidad de perder todo el capital</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta9" id="p9b" value="b">
        <label class="form-check-label" for="p9b">b) Dificultad para vender una inversión sin perder valor</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta9" id="p9c" value="c">
        <label class="form-check-label" for="p9c">c) Variación del tipo de cambio</label>
      </div>
      <div class="mt-3">
        <div class="d-flex justify-content-between">
          <span class="badge bg-success">Alta liquidez</span>
          <span class="badge bg-warning">Liquidez media</span>
          <span class="badge bg-danger">Baja liquidez</span>
        </div>
        <div class="d-flex justify-content-between small mt-1">
          <span>Acciones grandes</span>
          <span>Bienes raíces</span>
          <span>Arte/coleccionables</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Pregunta 10 -->
  <div class="card mb-4 border-success shadow-sm">
    <div class="card-header bg-success text-white">
      <h5><i class="bi bi-trophy"></i> 10. ¿Cuál es una ventaja de invertir en ETFs?</h5>
    </div>
    <div class="card-body">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta10" id="p10a" value="a">
        <label class="form-check-label" for="p10a">a) Ofrecen rendimientos garantizados</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta10" id="p10b" value="b">
        <label class="form-check-label" for="p10b">b) Permiten diversificar con bajo costo</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pregunta10" id="p10c" value="c">
        <label class="form-check-label" for="p10c">c) No están sujetos a impuestos</label>
      </div>
      <div class="row mt-3">
        <div class="col-md-6">
          <div class="card border-success shadow-sm">
            <div class="card-body text-center">
              <i class="bi bi-coin text-success fs-4"></i>
              <p class="mb-0"><small>Comisiones típicas: 0.03%-0.30%</small></p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card border-success shadow-sm">
            <div class="card-body text-center">
              <i class="bi bi-collection text-success fs-4"></i>
              <p class="mb-0"><small>+200 ETFs disponibles en México</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-grid gap-2 col-md-6 mx-auto">
    <button type="submit" class="btn btn-success btn-lg shadow text-white">
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
              ? "¡Felicidades! Has aprobado este curso"
              : "No has aprobado esta vez ";

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
