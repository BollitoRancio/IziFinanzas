<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Curso: Fundamentos Bancarios</title>
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
          <li class="active" onclick="cargarLeccion(1)">Lección 1: ¿Qué es un banco?</li>
          <li onclick="cargarLeccion(2)">Lección 2: Tipos de instituciones financieras</li>
          <li onclick="cargarLeccion(3)">Lección 3: Regulación bancaria básica</li>
        </ul>
        <h4>Módulo 2</h4>
        <ul>
          <li onclick="cargarLeccion(4)">Lección 4: Cuentas de ahorro y cuentas corrientes</li>
          <li onclick="cargarLeccion(5)">Lección 5: Tarjetas de crédito y débito</li>
          <li onclick="cargarLeccion(6)">Lección 6: Seguridad bancaria y banca en línea</li>
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
      titulo: "Lección 1: ¿Qué es un banco y cómo funciona?",
      contenido: `
        <div class="row align-items-center mb-4">
          <div class="col-md-6">
            <h4 class="titulo-verde">El ecosistema bancario</h4>
            <p>Los bancos son intermediarios financieros que conectan a ahorradores con prestatarios, gestionando riesgos y facilitando transacciones.</p>
            
            <div class="card shadow-sm mt-3">
              <div class="card-body">
                <h5><i class="bi bi-arrow-repeat"></i> Ciclo básico:</h5>
                <ol>
                  <li>Clientes depositan dinero</li>
                  <li>Banco presta parte de esos fondos</li>
                  <li>Genera interés para pagar a ahorradores y obtener ganancias</li>
                </ol>
              </div>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <img src="https://th.bing.com/th/id/R.98fd1e66a0aeca5ad78fcbd809f64fce?rik=08SSCXhHqU008w&riu=http%3a%2f%2fsymcontadores.com%2fwp-content%2fuploads%2f2022%2f11%2fQue-es-el-flujo-de-caja-1024x633.jpg&ehk=KxS%2fSV51NK8QAxG66Kqurpxqlds3hweXfR9XdGcJWcs%3d&risl=&pid=ImgRaw&r=0" class="img-fluid rounded" alt="Flujo bancario" style="max-height: 250px;">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card h-100 shadow-sm">
              <div class="card-header bg-primary text-white">
                <h5>Funciones clave</h5>
              </div>
              <div class="card-body">
                <ul>
                  <li>Custodia de fondos</li>
                  <li>Facilitar pagos</li>
                  <li>Otorgar créditos</li>
                  <li>Servicios de inversión</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card h-100 shadow-sm">
              <div class="card-header bg-success text-white">
                <h5>Tipos de bancos</h5>
              </div>
              <div class="card-body">
                <ul>
                  <li><strong>Comerciales:</strong> Para público general</li>
                  <li><strong>De inversión:</strong> Operaciones complejas</li>
                  <li><strong>Cooperativas:</strong> De socios</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      `
    },
    {
      titulo: "Lección 2: Tipos de cuentas bancarias",
      contenido: `
        <h4 class="titulo-verde">Elige la cuenta adecuada</h4>
        
        <div class="table-responsive mt-4">
          <table class="table table-bordered table-hover">
            <thead class="table-primary">
              <tr>
                <th>Tipo de cuenta</th>
                <th>Ventajas</th>
                <th>Desventajas</th>
                <th>Mejor para</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Cuenta corriente</strong></td>
                <td>Cheques, acceso inmediato</td>
                <td>Generalmente sin intereses</td>
                <td>Operaciones diarias</td>
              </tr>
              <tr>
                <td><strong>Cuenta de ahorros</strong></td>
                <td>Genera intereses</td>
                <td>Límite de movimientos</td>
                <td>Fondos de emergencia</td>
              </tr>
              <tr>
                <td><strong>Cuenta a plazo fijo</strong></td>
                <td>Mayores tasas de interés</td>
                <td>Fondos inmovilizados</td>
                <td>Metas a plazo definido</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="alert alert-warning mt-4">
          <i class="bi bi-exclamation-triangle"></i> <strong>Compara antes de abrir:</strong> Comisiones, saldo mínimo, rendimientos y seguros asociados.
        </div>

        <div class="row mt-4">
          <div class="col-md-6">
            <div class="card shadow-sm">
              <div class="card-header">
                <h5><i class="bi bi-check-circle"></i> Checklist para abrir cuenta</h5>
              </div>
              <div class="card-body">
                <ul>
                  <li>Identificación oficial</li>
                  <li>Comprobante de domicilio</li>
                  <li>RFC</li>
                  <li>Depósito inicial (varía por banco)</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card shadow-sm">
              <div class="card-header">
                <h5><i class="bi bi-coin"></i> Costos ocultos</h5>
              </div>
              <div class="card-body">
                <ul>
                  <li>Comisión por saldo mínimo</li>
                  <li>Costo por reposición de tarjeta</li>
                  <li>Retiros en cajeros de otros bancos</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      `
    },
    {
      titulo: "Lección 3: Tarjetas de crédito y débito",
      contenido: `
        <div class="row">
          <div class="col-md-6">
            <div class="card shadow-sm h-100">
              <div class="card-header bg-danger text-white">
                <h5><i class="bi bi-credit-card"></i> Tarjeta de débito</h5>
              </div>
              <div class="card-body">
                <p><strong>Funcionamiento:</strong> Usa fondos disponibles en tu cuenta</p>
                <ul>
                  <li>Sin intereses (no es crédito)</li>
                  <li>Límite: saldo disponible</li>
                  <li>Generalmente sin anualidad</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card shadow-sm h-100">
              <div class="card-header bg-success text-white">
                <h5><i class="bi bi-credit-card-2-front"></i> Tarjeta de crédito</h5>
              </div>
              <div class="card-body">
                <p><strong>Funcionamiento:</strong> Dinero prestado con límite aprobado</p>
                <ul>
                  <li>Intereses si no pagas el total</li>
                  <li>Construye historial crediticio</li>
                  <li>Beneficios adicionales</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="card mt-4 shadow-sm">
          <div class="card-header bg-primary text-white">
            <h5>Comparación clave</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Aspecto</th>
                    <th>Débito</th>
                    <th>Crédito</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>Fondos</strong></td>
                    <td>Tus propios recursos</td>
                    <td>Dinero prestado</td>
                  </tr>
                  <tr>
                    <td><strong>Intereses</strong></td>
                    <td>No aplica</td>
                    <td>Hasta 60% anual</td>
                  </tr>
                  <tr>
                    <td><strong>Seguridad</strong></td>
                    <td>Menor protección</td>
                    <td>Contracargos posibles</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="alert alert-danger mt-4">
          <h5><i class="bi bi-exclamation-octagon"></i> Errores comunes con tarjetas</h5>
          <ul>
            <li>Pagar solo el mínimo en crédito</li>
            <li>Usar débito en compras online riesgosas</li>
            <li>No revisar estados de cuenta</li>
          </ul>
        </div>
      `
    },
    {
      titulo: "Lección 4: Préstamos y créditos",
      contenido: `
        <h4 class="titulo-verde">Cómo pedir dinero prestado inteligentemente</h4>
        
        <div class="row mt-4">
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="card-header">
                <h5>Préstamos personales</h5>
              </div>
              <div class="card-body">
                <p><strong>Características:</strong></p>
                <ul>
                  <li>Monto fijo</li>
                  <li>Plazo definido</li>
                  <li>Tasa fija o variable</li>
                </ul>
                <p><strong>Mejor para:</strong> Consolidar deudas, emergencias</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="card-header">
                <h5>Créditos revolventes</h5>
              </div>
              <div class="card-body">
                <p><strong>Características:</strong></p>
                <ul>
                  <li>Línea de crédito disponible</li>
                  <li>Reutilizable al pagar</li>
                  <li>Altos intereses</li>
                </ul>
                <p><strong>Ejemplo:</strong> Tarjetas de crédito</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="card-header">
                <h5>Hipotecas</h5>
              </div>
              <div class="card-body">
                <p><strong>Características:</strong></p>
                <ul>
                  <li>Plazos 15-30 años</li>
                  <li>Garantía: la propiedad</li>
                  <li>Tasas más bajas</li>
                </ul>
                <p><strong>Para:</strong> Compra de vivienda</p>
              </div>
            </div>
          </div>
        </div>

        <div class="card mt-4 shadow-sm">
          <div class="card-header bg-warning">
            <h5><i class="bi bi-calculator"></i> Calcula antes de pedir</h5>
          </div>
          <div class="card-body">
            <p><strong>Fórmula clave:</strong> Costo Total = Principal + Intereses + Comisiones</p>
            <div class="row">
              <div class="col-md-6">
                <p><strong>Ejemplo préstamo:</strong></p>
                <ul>
                  <li>$50,000 a 3 años</li>
                  <li>Tasa 15% anual</li>
                  <li>Costo total: ~$60,000</li>
                </ul>
              </div>
              <div class="col-md-6">
                <img src="https://tse2.mm.bing.net/th/id/OIP.TlejBB9mwI_DuqKyvX8w_AHaCh?cb=iwc1&w=880&h=300&rs=1&pid=ImgDetMain" class="img-fluid rounded" alt="Cálculo préstamo">
              </div>
            </div>
          </div>
        </div>
      `
    },
    {
      titulo: "Lección 5: Seguridad bancaria y fraudes",
      contenido: `
        <h4 class="titulo-verde">Protege tu dinero</h4>
        
        <div class="alert alert-danger">
          <h5><i class="bi bi-shield-exclamation"></i> Estafas comunes</h5>
          <div class="row">
            <div class="col-md-4">
              <div class="card h-100 border-danger">
                <div class="card-body">
                  <h6>Phishing</h6>
                  <p>Correos/SMS falsos que imitan tu banco</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card h-100 border-danger">
                <div class="card-body">
                  <h6>Skimming</h6>
                  <p>Clonación de tarjetas en cajeros</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card h-100 border-danger">
                <div class="card-body">
                  <h6>Fraude telefónico</h6>
                  <p>Llamadas pidiendo datos "urgentes"</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-md-6">
            <div class="card shadow-sm h-100">
              <div class="card-header bg-success text-white">
                <h5>Medidas de protección</h5>
              </div>
              <div class="card-body">
                <ul>
                  <li>Nunca compartas claves o CVV</li>
                  <li>Usa autenticación en dos pasos</li>
                  <li>Revisa movimientos semanalmente</li>
                  <li>Bloquea tarjetas no usadas</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card shadow-sm h-100">
              <div class="card-header bg-primary text-white">
                <h5>Qué hacer si eres víctima</h5>
              </div>
              <div class="card-body">
                <ol>
                  <li>Bloquea inmediatamente</li>
                  <li>Reporta a tu banco</li>
                  <li>Presenta denuncia</li>
                  <li>Cambia todas tus contraseñas</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="card mt-4 shadow-sm">
          <div class="card-body text-center">
            <img src="https://xpendor.com/wp-content/uploads/2023/05/concepto-ciberseguridad-privacidad-usuario-seguridad-encriptacion-acceso-seguro-internet-tecnologia-futura-cibernetica-candado-pantalla-scaled.jpg" class="img-fluid rounded" style="max-height: 200px;" alt="Seguridad digital">
            <p class="mt-3"><strong>Consejo:</strong> Usa apps oficiales, nunca accedas a tu banca desde links en correos.</p>
          </div>
        </div>
      `
    },
    {
      titulo: "Lección 6: Cómo elegir una institución financiera",
      contenido: `
        <h4 class="titulo-verde">Encuentra tu banco ideal</h4>
        
        <div class="card shadow-sm mt-4">
          <div class="card-header">
            <h5><i class="bi bi-check2-square"></i> Factores clave a comparar</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <ul>
                  <li><strong>Comisiones:</strong> Mantenimiento, retiros, transferencias</li>
                  <li><strong>Tasas de interés:</strong> Para créditos y ahorros</li>
                  <li><strong>Red de cajeros:</strong> Sucursales y aliados</li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul>
                  <li><strong>App móvil:</strong> Funcionalidad y seguridad</li>
                  <li><strong>Atención a clientes:</strong> Canales y horarios</li>
                  <li><strong>Seguros:</strong> Protección de fondos</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-md-6">
            <div class="card shadow-sm h-100">
              <div class="card-header bg-info text-white">
                <h5>Bancos tradicionales</h5>
              </div>
              <div class="card-body">
                <p><strong>Ventajas:</strong></p>
                <ul>
                  <li>Sucursales físicas</li>
                  <li>Amplia gama de productos</li>
                  <li>Historial estable</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card shadow-sm h-100">
              <div class="card-header bg-warning">
                <h5>Bancos digitales</h5>
              </div>
              <div class="card-body">
                <p><strong>Ventajas:</strong></p>
                <ul>
                  <li>Menores comisiones</li>
                  <li>Procesos 100% online</li>
                  <li>Tecnología innovadora</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="alert alert-success mt-4">
          <h5><i class="bi bi-lightbulb"></i> Consejo final</h5>
          <p>No necesitas un solo banco. Puedes tener:</p>
          <ul>
            <li>Cuenta principal en banco tradicional</li>
            <li>Cuenta digital para ahorros con mejor rendimiento</li>
            <li>Tarjeta de crédito con institución especializada</li>
          </ul>
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
      <h3 class="text-center mb-4">Evaluación Final - Fundamentos Bancarios</h3>
      <form id="formEvaluacion">
        <input type="hidden" name="curso" value="Fundamentos Bancarios">
      <!-- Pregunta 1 -->
      <div class="card mb-4 border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h5><i class="bi bi-bank"></i> 1. ¿Cuál es la función principal de un banco comercial?</h5>
        </div>
        <div class="card-body">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta1" id="p1a" value="a">
            <label class="form-check-label" for="p1a">a) Intermediar entre ahorradores y prestatarios</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta1" id="p1b" value="b">
            <label class="form-check-label" for="p1b">b) Imprimir billetes</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta1" id="p1c" value="c">
            <label class="form-check-label" for="p1c">c) Regular el sistema financiero</label>
          </div>
        </div>
      </div>

      <!-- Pregunta 2 -->
      <div class="card mb-4 border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h5><i class="bi bi-wallet2"></i> 2. ¿Qué tipo de cuenta es ideal para un fondo de emergencias?</h5>
        </div>
        <div class="card-body">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta2" id="p2a" value="a">
            <label class="form-check-label" for="p2a">a) Cuenta de ahorros con liquidez inmediata</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta2" id="p2b" value="b">
            <label class="form-check-label" for="p2b">b) Certificado a plazo fijo a 1 año</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta2" id="p2c" value="c">
            <label class="form-check-label" for="p2c">c) Cuenta corriente sin intereses</label>
          </div>
        </div>
      </div>

      <!-- Pregunta 3 -->
      <div class="card mb-4 border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h5><i class="bi bi-credit-card"></i> 3. La principal diferencia entre tarjeta de crédito y débito es:</h5>
        </div>
        <div class="card-body">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta3" id="p3a" value="a">
            <label class="form-check-label" for="p3a">a) La de crédito usa dinero prestado, la débito tus fondos</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta3" id="p3b" value="b">
            <label class="form-check-label" for="p3b">b) La de débito tiene mejor protección contra fraudes</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta3" id="p3c" value="c">
            <label class="form-check-label" for="p3c">c) Solo la de crédito puede usarse internacionalmente</label>
          </div>
        </div>
      </div>

      <!-- Pregunta 4 -->
      <div class="card mb-4 border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h5><i class="bi bi-piggy-bank"></i> 4. ¿Qué elemento NO deberías considerar al pedir un préstamo?</h5>
        </div>
        <div class="card-body">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta4" id="p4a" value="a">
            <label class="form-check-label" for="p4a">a) El CAT (Costo Anual Total)</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta4" id="p4b" value="b">
            <label class="form-check-label" for="p4b">b) El color de las oficinas del banco</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta4" id="p4c" value="c">
            <label class="form-check-label" for="p4c">c) Las comisiones por apertura</label>
          </div>
        </div>
      </div>

      <!-- Pregunta 5 -->
      <div class="card mb-4 border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h5><i class="bi bi-shield-lock"></i> 5. ¿Cuál es una señal segura de fraude bancario?</h5>
        </div>
        <div class="card-body">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta5" id="p5a" value="a">
            <label class="form-check-label" for="p5a">a) Un correo pidiendo tu NIP completo</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta5" id="p5b" value="b">
            <label class="form-check-label" for="p5b">b) Una llamada verificando tu nombre completo</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta5" id="p5c" value="c">
            <label class="form-check-label" for="p5c">c) Un SMS con códigos de seguridad temporales</label>
          </div>
        </div>
      </div>

      <!-- Pregunta 6 -->
      <div class="card mb-4 border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h5><i class="bi bi-geo-alt"></i> 6. Al elegir un banco, ¿qué es más importante para un usuario que viaja frecuentemente?</h5>
        </div>
        <div class="card-body">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta6" id="p6a" value="a">
            <label class="form-check-label" for="p6a">a) Red amplia de cajeros aliados internacionales</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta6" id="p6b" value="b">
            <label class="form-check-label" for="p6b">b) Sucursales físicas cerca de su casa</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta6" id="p6c" value="c">
            <label class="form-check-label" for="p6c">c) Horario extendido de atención</label>
          </div>
        </div>
      </div>

      <!-- Pregunta 7 -->
      <div class="card mb-4 border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h5><i class="bi bi-lightning"></i> 7. ¿Qué ventaja clave tienen los bancos digitales sobre los tradicionales?</h5>
        </div>
        <div class="card-body">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta7" id="p7a" value="a">
            <label class="form-check-label" for="p7a">a) Menores comisiones y requisitos</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta7" id="p7b" value="b">
            <label class="form-check-label" for="p7b">b) Atención personalizada en sucursal</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta7" id="p7c" value="c">
            <label class="form-check-label" for="p7c">c) Mayor variedad de productos complejos</label>
          </div>
        </div>
      </div>

      <!-- Pregunta 8 -->
      <div class="card mb-4 border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h5><i class="bi bi-telephone"></i> 8. Caso práctico: María recibe un SMS que parece de su banco diciendo: "Su cuenta será bloqueada, ingrese a [link] para verificar". ¿Qué debería hacer?</h5>
        </div>
        <div class="card-body">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta8" id="p8a" value="a">
            <label class="form-check-label" for="p8a">a) Hacer clic en el link e ingresar sus datos</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta8" id="p8b" value="b">
            <label class="form-check-label" for="p8b">b) Llamar al número oficial del banco para verificar</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta8" id="p8c" value="c">
            <label class="form-check-label" for="p8c">c) Reenviar el mensaje a 5 contactos para advertirles</label>
          </div>
        </div>
      </div>

      <!-- Pregunta 9 -->
      <div class="card mb-4 border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h5><i class="bi bi-person-check"></i> 9. ¿Qué información NUNCA debe compartirse por teléfono o correo?</h5>
        </div>
        <div class="card-body">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta9" id="p9a" value="a">
            <label class="form-check-label" for="p9a">a) Códigos CVV y contraseñas de banca en línea</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta9" id="p9b" value="b">
            <label class="form-check-label" for="p9b">b) El tipo de cuenta que tienes</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta9" id="p9c" value="c">
            <label class="form-check-label" for="p9c">c) Tu fecha de nacimiento</label>
          </div>
        </div>
      </div>

      <!-- Pregunta 10 -->
      <div class="card mb-4 border-success shadow-sm">
        <div class="card-header bg-success text-white">
          <h5><i class="bi bi-graph-up"></i> 10. ¿Qué característica es más importante en una cuenta para ahorro a largo plazo?</h5>
        </div>
        <div class="card-body">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta10" id="p10a" value="a">
            <label class="form-check-label" for="p10a">a) Alta tasa de interés y crecimiento</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta10" id="p10b" value="b">
            <label class="form-check-label" for="p10b">b) Acceso inmediato a fondos las 24 horas</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pregunta10" id="p10c" value="c">
            <label class="form-check-label" for="p10c">c) Tarjeta de débito con diseño personalizado</label>
          </div>
        </div>
      </div>

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-success btn-lg">
          <i class="bi bi-send-check"></i> Enviar evaluación
        </button>
      </div>
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
