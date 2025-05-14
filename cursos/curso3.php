<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Curso:Gestión de Deudas</title>
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
          <li class="active" onclick="cargarLeccion(1)">Lección 1: Tipos de deuda</li>
          <li onclick="cargarLeccion(2)">Lección 2: Tasa de interés y su impacto</li>
          <li onclick="cargarLeccion(3)">Lección 3: Cómo evitar el sobreendeudamiento</li>
        </ul>
        <h4>Módulo 2</h4>
        <ul>
          <li onclick="cargarLeccion(4)">Lección 4: Método bola de nieve vs avalancha</li>
          <li onclick="cargarLeccion(5)">Lección 5: Negociación con acreedores</li>
          <li onclick="cargarLeccion(6)">Lección 6: Consolidación y refinanciamiento</li>
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
        titulo: "Lección 1: Tipos de deuda (crédito, hipoteca, préstamos)",
        contenido: `
          <p>Antes de gestionar tus deudas, es importante conocer los diferentes tipos que existen. Algunas deudas pueden ser útiles si se manejan correctamente, mientras que otras pueden convertirse en un obstáculo financiero.</p>

          <div class="alert alert-info mt-3" role="alert">
            <strong>Dato:</strong> No todas las deudas son malas. Algunas pueden ayudarte a alcanzar objetivos importantes si sabes usarlas.
          </div>

          <h5 class="tituloverde mt-4">Deuda Revolvente</h5>
          <p>Este tipo de deuda te permite usar y devolver dinero de forma continua. Las tarjetas de crédito son el ejemplo más común. Solo pagas intereses por el monto que no pagas completo al final del mes.</p>

          <div class="text-center my-3">
            <img src="ruta/a/tu/imagen-tarjeta-credito.jpg" class="img-fluid rounded shadow" alt="Tarjeta de crédito">
          </div>

          <h5 class="tituloverde mt-4">Préstamos Personales</h5>
          <p>Son préstamos con un monto fijo y un plazo definido. Suelen usarse para consolidar deudas, hacer reparaciones, cubrir emergencias, etc.</p>

          <div class="row my-4">
            <div class="col-md-6">
              <div class="card p-3 shadow-sm">
                <h6 class="text-success"><i class="bi bi-check-circle-fill"></i> Ventajas</h6>
                <ul>
                  <li>Cuotas fijas</li>
                  <li>Interés preestablecido</li>
                  <li>Fácil de comparar entre bancos</li>
                </ul>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card p-3 shadow-sm">
                <h6 class="text-danger"><i class="bi bi-x-circle-fill"></i> Desventajas</h6>
                <ul>
                  <li>Intereses pueden ser altos</li>
                  <li>Penalización por pago anticipado en algunos casos</li>
                </ul>
              </div>
            </div>
          </div>

          <h5 class="tituloverde mt-4">Hipotecas</h5>
          <p>Una hipoteca es un préstamo a largo plazo para adquirir una vivienda. Usualmente tienen tasas de interés más bajas que otros tipos de crédito, pero implican un compromiso de muchos años.</p>

          <div class="text-center my-3">
            <img src="ruta/a/tu/imagen-casa.jpg" class="img-fluid rounded shadow" alt="Casa e hipoteca">
          </div>

          <h5 class="tituloverde mt-4">Crédito Automotriz</h5>
          <p>Se usa para financiar la compra de un vehículo. El auto suele ser la garantía del préstamo.</p>

          <table class="table table-bordered mt-4">
            <thead class="table-light">
              <tr>
                <th>Tipo de deuda</th>
                <th>Plazo</th>
                <th>Tasa de interés (promedio)</th>
                <th>Ejemplo común</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Revolvente</td>
                <td>Indefinido</td>
                <td>35% o más</td>
                <td>Tarjeta de crédito</td>
              </tr>
              <tr>
                <td>Préstamo personal</td>
                <td>1-5 años</td>
                <td>20% - 40%</td>
                <td>Crédito para emergencia</td>
              </tr>
              <tr>
                <td>Hipoteca</td>
                <td>15-30 años</td>
                <td>8% - 12%</td>
                <td>Compra de vivienda</td>
              </tr>
              <tr>
                <td>Crédito automotriz</td>
                <td>2-6 años</td>
                <td>12% - 20%</td>
                <td>Compra de auto</td>
              </tr>
            </tbody>
          </table>

          <div class="alert alert-warning mt-4" role="alert">
            <strong>Importante:</strong> Siempre compara opciones antes de aceptar un crédito. Un préstamo mal elegido puede volverse una carga pesada.
          </div>

          <h5 class="tituloverde mt-4">Resumen rápido</h5>
          <ul>
            <li><strong>Crédito Revolvente:</strong> Flexible pero puede ser caro.</li>
            <li><strong>Préstamos Personales:</strong> Útiles para emergencias o consolidación.</li>
            <li><strong>Hipoteca:</strong> Deuda a largo plazo, ideal para vivienda.</li>
            <li><strong>Crédito Automotriz:</strong> Específico para vehículos.</li>
          </ul>
        `
      }
,
      {
        titulo: "Lección 2: Tasa de interés y cómo afecta tu deuda",
        contenido: `
          <p>La <strong>tasa de interés</strong> es uno de los factores más importantes a considerar al adquirir una deuda. Esta representa el costo que pagas por usar el dinero prestado y puede tener un gran impacto en el monto final que terminas pagando.</p>

          <div class="alert alert-warning mt-3" role="alert">
            <strong>Atención:</strong> Una tasa de interés alta puede hacer que una deuda pequeña crezca rápidamente si no se paga a tiempo.
          </div>

          <h5 class="tituloverde mt-4">¿Qué es la tasa de interés?</h5>
          <p>Es el porcentaje que el prestamista cobra sobre el monto prestado. Se puede aplicar de forma anual (Tasa Anual Equivalente, TAE) o mensual.</p>

          <ul class="mb-4">
            <li><strong>Tasa fija:</strong> Se mantiene constante durante todo el periodo del préstamo.</li>
            <li><strong>Tasa variable:</strong> Puede cambiar según el mercado o condiciones acordadas.</li>
            <li><strong>Interés simple vs compuesto:</strong> El interés compuesto se calcula sobre el capital inicial y los intereses acumulados, lo que genera un crecimiento más rápido de la deuda.</li>
          </ul>

          <div class="espacio-imagen mb-4">
            <!-- Espacio para insertar una imagen ilustrativa de los tipos de tasas -->
          </div>

          <h5 class="tituloverde mt-4">Ejemplo práctico</h5>
          <div class="row">
            <div class="col-md-6">
              <div class="card p-3 shadow-sm">
                <h6 class="text-success"><i class="bi bi-calculator"></i> Préstamo con interés bajo:</h6>
                <p>Un préstamo de $5,000 con una tasa del 5% anual pagado en 2 años generará alrededor de $250 en intereses.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card p-3 shadow-sm">
                <h6 class="text-danger"><i class="bi bi-exclamation-circle"></i> Préstamo con interés alto:</h6>
                <p>El mismo préstamo con una tasa del 20% anual podría generar hasta $2,000 en intereses si no se paga a tiempo.</p>
              </div>
            </div>
          </div>

          <div class="espacio-imagen mt-4 mb-4">
            <!-- Espacio para insertar una imagen comparativa entre tasas bajas y altas -->
          </div>

          <h5 class="tituloverde">Consejo práctico</h5>
          <div class="alert alert-info mt-3" role="alert">
            <i class="bi bi-lightbulb-fill"></i> <strong>Tip:</strong> Siempre compara la tasa de interés entre varias opciones antes de tomar un crédito. Un pequeño porcentaje puede significar una gran diferencia a largo plazo.
          </div>
        `
      }

,
{
  titulo: "Lección 3: Cómo evitar el sobreendeudamiento",
  contenido: `
    <p>El <strong>sobreendeudamiento</strong> ocurre cuando tus deudas superan tu capacidad de pago. Esta situación puede generar estrés financiero y afectar tu calidad de vida. Afortunadamente, existen prácticas sencillas para evitarlo.</p>

    <div class="alert alert-danger mt-3" role="alert">
      <strong>¡Cuidado!</strong> Acumular muchas deudas pequeñas puede llevarte a un gran problema si no las controlas a tiempo.
    </div>

    <h5 class="tituloverde mt-4">Señales de sobreendeudamiento</h5>
    <ul>
      <li>Usas una tarjeta de crédito para pagar otra.</li>
      <li>Te atrasas constantemente en tus pagos.</li>
      <li>No puedes ahorrar porque todo se va en deudas.</li>
      <li>Solicitas préstamos para cubrir gastos básicos.</li>
    </ul>

    <div class="espacio-imagen mb-4">
      <!-- Espacio para una imagen ilustrativa sobre estrés por deudas o señales comunes -->
    </div>

    <h5 class="tituloverde">Buenas prácticas para evitarlo</h5>
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card p-3 shadow-sm h-100">
          <h6 class="text-success"><i class="bi bi-wallet-fill"></i> Presupuesta tus ingresos</h6>
          <p>Lleva un registro mensual de tus ingresos y gastos. Así sabrás cuánto puedes destinar al pago de deudas.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3 shadow-sm h-100">
          <h6 class="text-success"><i class="bi bi-credit-card-fill"></i> Usa el crédito con responsabilidad</h6>
          <p>No uses más del 30% del límite de tu tarjeta y evita pagar solo el mínimo.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3 shadow-sm h-100">
          <h6 class="text-success"><i class="bi bi-bar-chart-fill"></i> Evalúa antes de endeudarte</h6>
          <p>Pregunta: ¿Realmente necesito esto? ¿Puedo pagarlo en el plazo? ¿Afectará mis otras obligaciones?</p>
        </div>
      </div>
    </div>

    <h5 class="tituloverde">Simula tus pagos</h5>
    <div class="alert alert-info mt-3" role="alert">
      <i class="bi bi-lightbulb-fill"></i> <strong>Tip:</strong> Usa simuladores para calcular tus pagos mensuales antes de adquirir un crédito. Te ayudará a tomar decisiones más informadas.
    </div>

    <div class="espacio-imagen mt-4 mb-4">
      <!-- Espacio para insertar gráfico o tabla sobre control de deudas -->
    </div>

    <p class="mt-3">Evitar el sobreendeudamiento no significa no endeudarse nunca, sino hacerlo con conciencia y planificación. Si controlas tus finanzas, podrás usar el crédito a tu favor sin poner en riesgo tu estabilidad.</p>
  `
}

,
      {
        titulo: "Lección 4: Método bola de nieve vs. avalancha",
        contenido: `      <p>Cuando tienes múltiples deudas, dos métodos populares pueden ayudarte a pagarlas de forma estratégica: el <strong>método bola de nieve</strong> y el <strong>método avalancha</strong>. Cada uno tiene ventajas según tu situación.</p>

      <div class="alert alert-info mt-3" role="alert">
        <strong>Sabías que:</strong> Usar un método estructurado puede ayudarte a pagar tus deudas hasta un 30% más rápido.
      </div>

      <h5 class="tituloverde mt-4">Método Bola de Nieve</h5>
      <div class="row align-items-center">
        <div class="col-md-6">
          <p>Este método se enfoca en pagar primero las deudas más pequeñas, independientemente de su tasa de interés. Así ganas motivación al ver progreso rápido.</p>
          <ul>
            <li>Ordena tus deudas de menor a mayor saldo</li>
            <li>Paga el mínimo en todas excepto la más pequeña</li>
            <li>Destina todo el dinero extra a la deuda más pequeña</li>
            <li>Cuando la pagues, pasa a la siguiente</li>
          </ul>
        </div>
        <div class="col-md-6 text-center">
          <img src="../img/bola-nieve.jpg" class="img-fluid rounded shadow" alt="Método bola de nieve" style="max-height: 250px;">
        </div>
      </div>

      <h5 class="tituloverde mt-4">Método Avalancha</h5>
      <div class="row align-items-center">
        <div class="col-md-6 order-md-2">
          <p>Este método prioriza las deudas con mayores tasas de interés, ahorrándote dinero a largo plazo aunque el progreso inicial sea menos visible.</p>
          <ul>
            <li>Ordena tus deudas de mayor a menor tasa de interés</li>
            <li>Paga el mínimo en todas excepto la de mayor interés</li>
            <li>Destina todo el dinero extra a la deuda con mayor interés</li>
            <li>Cuando la pagues, pasa a la siguiente</li>
          </ul>
        </div>
        <div class="col-md-6 text-center order-md-1">
          <img src="../img/avalancha-deudas.jpg" class="img-fluid rounded shadow" alt="Método avalancha" style="max-height: 250px;">
        </div>
      </div>

      <div class="card shadow-sm mt-4">
        <div class="card-header bg-light">
          <h5 class="mb-0 tituloverde">Comparación: Bola de Nieve vs. Avalancha</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="table-light">
                <tr>
                  <th>Aspecto</th>
                  <th>Bola de Nieve</th>
                  <th>Avalancha</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Orden de pago</strong></td>
                  <td>De menor a mayor saldo</td>
                  <td>De mayor a menor interés</td>
                </tr>
                <tr>
                  <td><strong>Ventaja principal</strong></td>
                  <td>Motivación psicológica</td>
                  <td>Ahorro en intereses</td>
                </tr>
                <tr>
                  <td><strong>Mejor para</strong></td>
                  <td>Personas que necesitan ver progreso rápido</td>
                  <td>Personas enfocadas en ahorrar dinero</td>
                </tr>
                <tr>
                  <td><strong>Tiempo de pago</strong></td>
                  <td>Puede ser más largo</td>
                  <td>Generalmente más rápido</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-md-6">
          <div class="card p-3 shadow-sm h-100">
            <h6 class="tituloverde"><i class="bi bi-check-circle-fill text-success"></i> Caso para Bola de Nieve</h6>
            <p>Si tienes 3 deudas:</p>
            <ul>
              <li>Tarjeta A: $500 al 15%</li>
              <li>Préstamo B: $2,000 al 10%</li>
              <li>Tarjeta C: $1,000 al 20%</li>
            </ul>
            <p>Con Bola de Nieve pagarías primero la Tarjeta A ($500), luego Tarjeta C ($1,000), y finalmente Préstamo B ($2,000).</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card p-3 shadow-sm h-100">
            <h6 class="tituloverde"><i class="bi bi-check-circle-fill text-success"></i> Caso para Avalancha</h6>
            <p>Con las mismas deudas:</p>
            <ul>
              <li>Tarjeta C: $1,000 al 20% (primera)</li>
              <li>Tarjeta A: $500 al 15% (segunda)</li>
              <li>Préstamo B: $2,000 al 10% (última)</li>
            </ul>
            <p>Ahorrarías más en intereses aunque la segunda deuda en pagarse sea más pequeña.</p>
          </div>
        </div>
      </div>

      <div class="alert alert-warning mt-4" role="alert">
        <i class="bi bi-lightbulb-fill"></i> <strong>Consejo:</strong> Elige el método que mejor se adapte a tu personalidad. Lo más importante es ser consistente con el plan que elijas.
      </div>
        `
      }
      ,
      {
        titulo: "Lección 5: Negociación con acreedores",
        contenido: `
      <p>Negociar con acreedores puede ser una herramienta poderosa para mejorar tus condiciones de pago cuando enfrentas dificultades financieras. Muchas instituciones están dispuestas a negociar antes que enfrentar un impago total.</p>

      <div class="alert alert-info mt-3" role="alert">
        <strong>Dato importante:</strong> Según estudios, más del 60% de las negociaciones con acreedores tienen éxito cuando se plantean adecuadamente.
      </div>

      <h5 class="tituloverde mt-4">¿Cuándo negociar con acreedores?</h5>
      <ul>
        <li>Cuando anticipas dificultades para cumplir con los pagos</li>
        <li>Si has tenido un cambio repentino en tu situación financiera (pérdida de empleo, enfermedad)</li>
        <li>Cuando tienes múltiples deudas y necesitas unificar pagos</li>
      </ul>

      <div class="text-center my-4">
        <img src="../img/negociacion-acreedores.jpg" class="img-fluid rounded shadow" alt="Negociación con acreedores" style="max-height: 250px;">
      </div>

      <h5 class="tituloverde">Pasos para una negociación exitosa</h5>
      <div class="row mt-3">
        <div class="col-md-4">
          <div class="card p-3 shadow-sm h-100">
            <div class="text-center">
              <span class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; line-height: 30px;">1</span>
            </div>
            <h6 class="text-center">Prepárate</h6>
            <p>Reúne información sobre tu deuda (saldo, tasa de interés, pagos realizados) y define qué puedes ofrecer.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3 shadow-sm h-100">
            <div class="text-center">
              <span class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; line-height: 30px;">2</span>
            </div>
            <h6 class="text-center">Contacta al departamento correcto</h6>
            <p>Busca el área de "soluciones financieras" o "atención a clientes con dificultades". Evita hablar solo con cobradores.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3 shadow-sm h-100">
            <div class="text-center">
              <span class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; line-height: 30px;">3</span>
            </div>
            <h6 class="text-center">Sé claro y honesto</h6>
            <p>Explica tu situación sin exagerar. Propone un plan realista que puedas cumplir.</p>
          </div>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-4">
          <div class="card p-3 shadow-sm h-100">
            <div class="text-center">
              <span class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; line-height: 30px;">4</span>
            </div>
            <h6 class="text-center">Pide opciones concretas</h6>
            <p>Solicita reducción de intereses, extensión de plazo, quita de deuda o plan de pagos especial.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3 shadow-sm h-100">
            <div class="text-center">
              <span class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; line-height: 30px;">5</span>
            </div>
            <h6 class="text-center">Obtén todo por escrito</h6>
            <p>No aceptes acuerdos verbales. Pide documentación que respalde los nuevos términos.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3 shadow-sm h-100">
            <div class="text-center">
              <span class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; line-height: 30px;">6</span>
            </div>
            <h6 class="text-center">Cumple lo acordado</h6>
            <p>Mantén los nuevos pagos puntuales para evitar retrocesos en la negociación.</p>
          </div>
        </div>
      </div>

      <h5 class="tituloverde mt-4">Estrategias de negociación comunes</h5>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>Estrategia</th>
              <th>Descripción</th>
              <th>Cuándo usarla</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Reducción de tasa de interés</strong></td>
              <td>Pedir que bajen la tasa de interés de tu deuda</td>
              <td>Cuando puedes pagar el capital pero los intereses son muy altos</td>
            </tr>
            <tr>
              <td><strong>Plan de pagos extendido</strong></td>
              <td>Ampliar el plazo para pagar la deuda reduciendo la cuota mensual</td>
              <td>Cuando necesitas reducir tu carga mensual de pagos</td>
            </tr>
            <tr>
              <td><strong>Acuerdo de pago único</strong></td>
              <td>Ofrecer un pago menor al adeudo total como liquidación</td>
              <td>Cuando tienes acceso a una suma de dinero pero no al total adeudado</td>
            </tr>
            <tr>
              <td><strong>Reestructuración</strong></td>
              <td>Modificar los términos del crédito original</td>
              <td>Cuando tu situación ha cambiado permanentemente</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="alert alert-warning mt-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i> <strong>Precaución:</strong> Algunas negociaciones pueden afectar tu historial crediticio. Pregunta siempre sobre las consecuencias antes de aceptar.
      </div>

      <div class="card shadow-sm mt-4">
        <div class="card-body">
          <h5 class="tituloverde"><i class="bi bi-telephone"></i> Ejemplo de diálogo para negociar</h5>
          <div class="bg-light p-3 rounded mt-2">
            <p><strong>Tú:</strong> "Buen día, llamo porque debido a [situación específica] me está resultando difícil cumplir con los pagos actuales. Quisiera saber qué opciones tienen para ayudarme a continuar pagando mi deuda."</p>
            <p><strong>Acreedor:</strong> "¿Qué tipo de ayuda está buscando?"</p>
            <p><strong>Tú:</strong> "Me gustaría explorar la posibilidad de [reducción de tasa/extensión de plazo/etc.]. Actualmente puedo comprometerme a pagar [cantidad realista] mensual."</p>
          </div>
        </div>
      </div>

    `
      }
      ,
      {
    titulo: "Lección 6: Cuándo consolidar o refinanciar deudas",
    contenido: `
      <p>La consolidación y refinanciación de deudas son estrategias poderosas para simplificar tus pagos y potencialmente reducir costos, pero deben usarse en el momento adecuado para ser efectivas.</p>

      <div class="alert alert-info mt-3" role="alert">
        <strong>Dato clave:</strong> Un 78% de personas que consolidan deudas sin cambiar hábitos terminan endeudándose nuevamente en 2 años.
      </div>

      <h5 class="tituloverde mt-4">¿Qué es consolidar deudas?</h5>
      <p>Consolidar significa unir varias deudas en una sola, generalmente con un único pago mensual. Esto puede hacerse mediante:</p>

      <div class="row">
        <div class="col-md-6">
          <div class="card p-3 shadow-sm h-100">
            <h6 class="tituloverde"><i class="bi bi-credit-card"></i> Préstamo de consolidación</h6>
            <p>Obtienes un nuevo préstamo para pagar varias deudas pequeñas, quedando con solo este préstamo por pagar.</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card p-3 shadow-sm h-100">
            <h6 class="tituloverde"><i class="bi bi-bank"></i> Transferencia de saldos</h6>
            <p>Mueves varios saldos de tarjetas a una sola tarjeta, usualmente con una tasa promocional.</p>
          </div>
        </div>
      </div>

      <div class="text-center my-4">
        <img src="../img/consolidacion-deudas.jpg" class="img-fluid rounded shadow" alt="Consolidación de deudas" style="max-height: 250px;">
      </div>

      <h5 class="tituloverde">¿Qué es refinanciar una deuda?</h5>
      <p>Refinanciar significa reemplazar una deuda existente por una nueva con mejores condiciones (menor tasa, mayor plazo, etc.).</p>

      <div class="row mt-3">
        <div class="col-md-6">
          <div class="card p-3 shadow-sm h-100">
            <h6 class="tituloverde"><i class="bi bi-house-door"></i> Ejemplo con hipoteca</h6>
            <p>Si tu hipoteca tiene tasa del 10% y ahora calificas para una del 7%, puedes refinanciar para pagar menos intereses.</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card p-3 shadow-sm h-100">
            <h6 class="tituloverde"><i class="bi bi-arrow-left-right"></i> Ejemplo con préstamo personal</h6>
            <p>Si tienes un préstamo a 3 años al 15%, podrías refinanciarlo a 5 años al 12% para bajar la cuota mensual.</p>
          </div>
        </div>
      </div>

      <h5 class="tituloverde mt-4">Cuándo consolidar o refinanciar</h5>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>Situación</th>
              <th>Solución recomendada</th>
              <th>Beneficio potencial</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Tienes múltiples deudas con altos pagos mínimos</td>
              <td>Consolidación</td>
              <td>Un solo pago más manejable</td>
            </tr>
            <tr>
              <td>Puedes obtener una tasa significativamente menor</td>
              <td>Refinanciación</td>
              <td>Ahorro en intereses</td>
            </tr>
            <tr>
              <td>Tu situación crediticia ha mejorado</td>
              <td>Refinanciación</td>
              <td>Mejores condiciones</td>
            </tr>
            <tr>
              <td>Tienes deudas con tasas variables que están subiendo</td>
              <td>Refinanciación a tasa fija</td>
              <td>Estabilidad en pagos</td>
            </tr>
          </tbody>
        </table>
      </div>

      <h5 class="tituloverde mt-4">Pros y contras</h5>
      <div class="row">
        <div class="col-md-6">
          <div class="card p-3 shadow-sm h-100">
            <h6 class="text-success"><i class="bi bi-check-circle-fill"></i> Ventajas</h6>
            <ul>
              <li>Simplifica tus finanzas con menos pagos</li>
              <li>Puede reducir tu tasa de interés promedio</li>
              <li>Puede bajar tu pago mensual total</li>
              <li>Reduce el estrés de manejar múltiples deudas</li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card p-3 shadow-sm h-100">
            <h6 class="text-danger"><i class="bi bi-x-circle-fill"></i> Riesgos</h6>
            <ul>
              <li>Puede extender el tiempo total de pago</li>
              <li>Algunas opciones tienen comisiones ocultas</li>
              <li>Podrías pagar más intereses a largo plazo</li>
              <li>Sin disciplina, podrías acumular nuevas deudas</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="card shadow-sm mt-4">
        <div class="card-header bg-light">
          <h5 class="mb-0 tituloverde">Checklist: ¿Es buen momento para consolidar/refinanciar?</h5>
        </div>
        <div class="card-body">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="check1">
            <label class="form-check-label" for="check1">Las tasas actuales son al menos 2% más bajas que tus tasas existentes</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="check2">
            <label class="form-check-label" for="check2">Tu puntaje crediticio ha mejorado significativamente</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="check3">
            <label class="form-check-label" for="check3">Tienes problemas para manejar múltiples pagos cada mes</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="check4">
            <label class="form-check-label" for="check4">Puedes comprometerte a no acumular nuevas deudas</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="check5">
            <label class="form-check-label" for="check5">Has calculado que ahorrarás dinero a largo plazo</label>
          </div>
        </div>
      </div>

      <h5 class="tituloverde mt-4">Pasos para consolidar/refinanciar</h5>
      <div class="row mt-3">
        <div class="col-md-4">
          <div class="card p-3 shadow-sm h-100">
            <div class="text-center">
              <span class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; line-height: 30px;">1</span>
            </div>
            <h6 class="text-center">Reúne información</h6>
            <p>Lista todas tus deudas actuales con sus tasas, saldos y pagos mínimos.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3 shadow-sm h-100">
            <div class="text-center">
              <span class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; line-height: 30px;">2</span>
            </div>
            <h6 class="text-center">Compara opciones</h6>
            <p>Busca al menos 3 ofertas de diferentes instituciones financieras.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3 shadow-sm h-100">
            <div class="text-center">
              <span class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; line-height: 30px;">3</span>
            </div>
            <h6 class="text-center">Calcula el costo total</h6>
            <p>Considera no solo la tasa, sino también comisiones y plazo.</p>
          </div>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-4">
          <div class="card p-3 shadow-sm h-100">
            <div class="text-center">
              <span class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; line-height: 30px;">4</span>
            </div>
            <h6 class="text-center">Solicita la opción elegida</h6>
            <p>Prepara toda la documentación requerida.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3 shadow-sm h-100">
            <div class="text-center">
              <span class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; line-height: 30px;">5</span>
            </div>
            <h6 class="text-center">Liquida las deudas anteriores</h6>
            <p>Verifica que las deudas antiguas se cierren correctamente.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3 shadow-sm h-100">
            <div class="text-center">
              <span class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; line-height: 30px;">6</span>
            </div>
            <h6 class="text-center">Mantén la disciplina</h6>
            <p>No acumules nuevas deudas y cumple con los nuevos pagos.</p>
          </div>
        </div>
      </div>

      <div class="alert alert-warning mt-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i> <strong>Importante:</strong> Antes de consolidar, verifica si hay penalizaciones por pago anticipado en tus deudas actuales.
      </div>

      <div class="card shadow-sm mt-4">
        <div class="card-body">
          <h5 class="tituloverde"><i class="bi bi-calculator"></i> Ejemplo práctico de consolidación</h5>
          <p>Si tienes:</p>
          <ul>
            <li>Tarjeta A: $5,000 al 24% (pago mínimo $150)</li>
            <li>Tarjeta B: $3,000 al 18% (pago mínimo $90)</li>
            <li>Préstamo C: $2,000 al 15% (pago $120)</li>
          </ul>
          <p>Total pagos mínimos: $360/mes</p>
          <p>Con un préstamo de consolidación a 12% por 3 años:</p>
          <ul>
            <li>Pago único de $333/mes</li>
            <li>Ahorro de $27/mes inmediato</li>
            <li>Posible ahorro en intereses de $1,200+</li>
          </ul>
        </div>
      </div>

      <div class="alert alert-success mt-4" role="alert">
        <i class="bi bi-lightbulb-fill"></i> <strong>Consejo final:</strong> Considera hablar con un asesor financiero antes de tomar esta decisión, especialmente si tienes deudas muy grandes o complejas.
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
        <h3>Evaluación Final</h3>
        <form id="formEvaluacion">
          <input type="hidden" name="curso" value="Gestión de deudas">
  <div class="mb-3 card p-3 shadow-sm">
    <p class="fw-bold">1. ¿Cuál de estos NO es un tipo común de deuda?</p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta1" id="p1a" value="a">
      <label class="form-check-label" for="p1a">a) Tarjeta de crédito</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta1" id="p1b" value="b">
      <label class="form-check-label" for="p1b">b) Hipoteca</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta1" id="p1c" value="c">
      <label class="form-check-label" for="p1c">c) Certificado de ahorro</label>
    </div>
  </div>

  <div class="mb-3 card p-3 shadow-sm">
    <p class="fw-bold">2. Si una deuda tiene tasa de interés compuesto del 20% anual, ¿qué significa?</p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta2" id="p2a" value="a">
      <label class="form-check-label" for="p2a">a) Los intereses se calculan sobre el capital + intereses acumulados</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta2" id="p2b" value="b">
      <label class="form-check-label" for="p2b">b) El interés se mantiene fijo durante toda la deuda</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta2" id="p2c" value="c">
      <label class="form-check-label" for="p2c">c) Solo se pagan intereses los primeros 20 meses</label>
    </div>
  </div>

  <div class="mb-3 card p-3 shadow-sm">
    <p class="fw-bold">3. Juan tiene 3 deudas:<br>
      - Tarjeta A: $1,000 al 24%<br>
      - Préstamo B: $3,000 al 12%<br>
      - Tarjeta C: $500 al 30%<br>
      ¿Cuál debería pagar primero si usa el método bola de nieve?
    </p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta3" id="p3a" value="a">
      <label class="form-check-label" for="p3a">a) Tarjeta A</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta3" id="p3b" value="b">
      <label class="form-check-label" for="p3b">b) Préstamo B</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta3" id="p3c" value="c">
      <label class="form-check-label" for="p3c">c) Tarjeta C</label>
    </div>
  </div>

  <div class="mb-3 card p-3 shadow-sm">
    <p class="fw-bold">4. ¿Cuál es la mejor estrategia para negociar con acreedores?</p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta4" id="p4a" value="a">
      <label class="form-check-label" for="p4a">a) Ignorar sus llamadas hasta que ofrezcan mejor condiciones</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta4" id="p4b" value="b">
      <label class="form-check-label" for="p4b">b) Contactarlos proactivamente con un plan de pago realista</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta4" id="p4c" value="c">
      <label class="form-check-label" for="p4c">c) Amenazar con no pagar nada</label>
    </div>
  </div>

  <div class="mb-3 card p-3 shadow-sm">
    <p class="fw-bold">5. ¿Cuándo es recomendable consolidar deudas?</p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta5" id="p5a" value="a">
      <label class="form-check-label" for="p5a">a) Cuando puedes obtener una tasa significativamente menor</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta5" id="p5b" value="b">
      <label class="form-check-label" for="p5b">b) Cuando quieres ocultar deudas a tu pareja</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta5" id="p5c" value="c">
      <label class="form-check-label" for="p5c">c) Cuando planeas pedir más créditos inmediatamente después</label>
    </div>
  </div>

  <div class="mb-3 card p-3 shadow-sm">
    <p class="fw-bold">6. ¿Qué porcentaje máximo de tus ingresos debería destinarse al pago total de deudas (según la regla 28/36)?</p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta6" id="p6a" value="a">
      <label class="form-check-label" for="p6a">a) 28%</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta6" id="p6b" value="b">
      <label class="form-check-label" for="p6b">b) 36%</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta6" id="p6c" value="c">
      <label class="form-check-label" for="p6c">c) 50%</label>
    </div>
  </div>

  <div class="mb-3 card p-3 shadow-sm">
    <p class="fw-bold">7. María tiene una deuda de $10,000 al 15% de interés. ¿Qué estrategia le ayudaría a pagar MENOS intereses?</p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta7" id="p7a" value="a">
      <label class="form-check-label" for="p7a">a) Pagar solo el mínimo cada mes</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta7" id="p7b" value="b">
      <label class="form-check-label" for="p7b">b) Hacer pagos adicionales al capital cuando pueda</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta7" id="p7c" value="c">
      <label class="form-check-label" for="p7c">c) Transferir el saldo a otra tarjeta sin cambiar hábitos</label>
    </div>
  </div>

  <div class="mb-3 card p-3 shadow-sm">
    <p class="fw-bold">8. ¿Cuál es una señal de sobreendeudamiento?</p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta8" id="p8a" value="a">
      <label class="form-check-label" for="p8a">a) Usar una tarjeta de crédito para pagar otra</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta8" id="p8b" value="b">
      <label class="form-check-label" for="p8b">b) Tener un préstamo hipotecario</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta8" id="p8c" value="c">
      <label class="form-check-label" for="p8c">c) Pagar el saldo completo de tu tarjeta cada mes</label>
    </div>
  </div>

  <div class="mb-3 card p-3 shadow-sm">
    <p class="fw-bold">9. ¿Qué ventaja tiene el método avalancha para pagar deudas?</p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta9" id="p9a" value="a">
      <label class="form-check-label" for="p9a">a) Te ahorra más dinero en intereses a largo plazo</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta9" id="p9b" value="b">
      <label class="form-check-label" for="p9b">b) Proporciona motivación psicológica rápida</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta9" id="p9c" value="c">
      <label class="form-check-label" for="p9c">c) Es más fácil de implementar sin disciplina</label>
    </div>
  </div>

  <div class="mb-3 card p-3 shadow-sm">
    <p class="fw-bold">10. ¿Cuándo es buena idea refinanciar una hipoteca?</p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta10" id="p10a" value="a">
      <label class="form-check-label" for="p10a">a) Cuando las tasas han bajado significativamente</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta10" id="p10b" value="b">
      <label class="form-check-label" for="p10b">b) Cuando quieres comprar un auto nuevo</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pregunta10" id="p10c" value="c">
      <label class="form-check-label" for="p10c">c) Cuando no has pagado a tiempo los últimos meses</label>
    </div>
</div>
          <button type="submit" class="btn btn-success mt-3">Enviar evaluación</button>
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
