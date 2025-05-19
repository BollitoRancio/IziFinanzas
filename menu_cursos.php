<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IziFinanzas - Cursos</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 80px 20px 20px 120px; /* Ajuste por header y sidebar */
    }

    .header {
      position: fixed;
      top: 0;
      left: 100px;
      width: calc(100% - 100px);
      background-color: #ffffff;
      border-bottom: 1px solid #dcdcdc;
      padding: 15px 30px;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      z-index: 1000;
    }

    .header .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 500;
      color: #0f1f10;
    }

    .header .user-info i {
      font-size: 20px;
      color: #00c853;
    }

    h1 {
      text-align: center;
      color: #0f1f10;
      margin-bottom: 40px;
    }

    .course-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .course-card {
      background-color: #ffffff;
      border: 1px solid #e0e0e0;
      border-radius: 20px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      transition: transform 0.2s;
    }

    .course-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .course-icon {
      font-size: 40px;
      color: #00c853;
      margin-bottom: 15px;
    }

    .course-title {
      font-weight: 600;
      font-size: 18px;
      color: #0f1f10;
      margin-bottom: 10px;
    }

    .course-desc {
      font-size: 14px;
      color: #555;
      margin-bottom: 20px;
    }

    .btn-leccion {
      background-color: #00c853;
      color: white;
      border: none;
      border-radius: 25px;
      padding: 10px 20px;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-leccion:hover {
      background-color: #00b84c;
    }

    .modal-header {
      background: #28a745;
      color: white;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }

    .modal-content {
      border-radius: 15px;
      border: none;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .modal-body ul {
      list-style-type: disc;
      padding-left: 20px;
    }

    .modal-body ul ul {
      list-style-type: circle;
    }
         /* Sidebar */
         .sidebar {
            width: 100px;
            background-color: #0f1f10;
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
        .header img{
            width: 50px;
            height: auto;
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
            background-color: #1e3a1e;
        }
        
        .sidebar .menu .icon {
            font-size: 24px;
            margin-bottom: 5px;
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

  <header class="header">
    <div class="user-info">
      <i class="bi bi-person-circle"></i>
      <span><?php echo $_SESSION['nombre_usuario']; ?></span>
      <span style="color: #888;">(<?php echo $_SESSION['rol_usuario']; ?>)</span>
    </div>
  </header>

  <h1>Selecciona un curso</h1>

  <div class="course-grid">
    <div class="course-card">
        <div class="course-icon"><i class="bi bi-wallet2"></i></div>
        <div class="course-title">INTRODUCCIÓN A LAS FINANZAS</div>
        <div class="course-desc">Aprende a gestionar tus finanzas personales.</div>
        <button class="btn-leccion" data-bs-toggle="modal" data-bs-target="#cursoModal">Ver más</button>
      </div>
  
      <div class="course-card">
        <div class="course-icon"><i class="bi bi-graph-up-arrow"></i></div>
        <div class="course-title">INVERSIONES 101</div>
        <div class="course-desc">Haz crecer tu patrimonio con inversiones inteligentes.</div>
        <button class="btn-leccion" data-bs-toggle="modal" data-bs-target="#modalInversiones">Ver más</button>
      </div>
  
      <div class="course-card">
        <div class="course-icon"><i class="bi bi-cash-stack"></i></div>
        <div class="course-title">GESTIÓN DE DEUDAS</div>
        <div class="course-desc">Estrategias para eliminar deudas.</div>
        <button class="btn-leccion" data-bs-toggle="modal" data-bs-target="#modalDeudas">Ver más</button>
      </div>
  
      <div class="course-card">
        <div class="course-icon"><i class="bi bi-piggy-bank"></i></div>
        <div class="course-title">ESTRATEGIAS DE AHORRO</div>
        <div class="course-desc">Descubre cómo ahorrar de manera efectiva.</div>
        <button class="btn-leccion" data-bs-toggle="modal" data-bs-target="#modalAhorro">Ver más</button>
      </div>
  
      <div class="course-card">
        <div class="course-icon"><i class="bi bi-bank"></i></div>
        <div class="course-title">FUNDAMENTOS BANCARIOS</div>
        <div class="course-desc">Conoce los servicios bancarios disponibles.</div>
        <button class="btn-leccion" data-bs-toggle="modal" data-bs-target="#modalBancos">Ver más</button>
      </div>
  
      <div class="course-card">
        <div class="course-icon"><i class="bi bi-building"></i></div>
        <div class="course-title">PLANIFICACIÓN FINANCIERA</div>
        <div class="course-desc">Desarrolla un plan financiero sólido a largo plazo.</div>
        <button class="btn-leccion" data-bs-toggle="modal" data-bs-target="#modalPlanificacion">Ver más</button>
      </div>
    </div>
  </div>

    <!-- Modal 1  -->
<div class="modal fade" id="cursoModal" tabindex="-1" aria-labelledby="cursoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="cursoModalLabel">
          <i class="bi bi-wallet2 me-2"></i> Introducción a las Finanzas
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <!-- Encabezado con iconos -->
        <div class="row mb-4 g-3">
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-clock-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Duración</h6>
                <p class="mb-0">2 horas</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Nivel</h6>
                <p class="mb-0">Principiante</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-journal-bookmark-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Lecciones</h6>
                <p class="mb-0">6 lecciones</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Objetivo en tarjeta -->
        <div class="card border-success mb-4">
          <div class="card-header bg-light-success">
            <h6 class="mb-0 text-success"><i class="bi bi-bullseye me-2"></i> Objetivo del curso</h6>
          </div>
          <div class="card-body">
            <p class="mb-0">Brindarte las herramientas básicas para entender y gestionar tus finanzas personales con confianza.</p>
          </div>
        </div>
        <!-- Módulos en acordeón -->
        <h5 class="mb-3"><i class="bi bi-list-check text-success me-2"></i> Contenido del curso</h5>
        <div class="accordion" id="cursoAccordion">
          <!-- Módulo 1 -->
          <div class="accordion-item border-success">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#modulo1">
                <i class="bi bi-bookmark-check-fill text-success me-2"></i> Módulo 1: Fundamentos
              </button>
            </h2>
            <div id="modulo1" class="accordion-collapse collapse show" data-bs-parent="#cursoAccordion">
              <div class="accordion-body">
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">1</span>
                  <div>
                    <h6 class="mb-0">¿Qué son las finanzas personales?</h6>
                    <small class="text-muted">Conceptos básicos y componentes clave</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">2</span>
                  <div>
                    <h6 class="mb-0">Importancia de la educación financiera</h6>
                    <small class="text-muted">Por qué es esencial en tu vida diaria</small>
                  </div>
                </div>
                <div class="d-flex align-items-start">
                  <span class="badge bg-success rounded-pill me-3">3</span>
                  <div>
                    <h6 class="mb-0">Ingresos, gastos y presupuesto</h6>
                    <small class="text-muted">Cómo organizar tu dinero efectivamente</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Módulo 2 -->
          <div class="accordion-item border-success mt-2">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light-success collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#modulo2">
                <i class="bi bi-bookmark-check-fill text-success me-2"></i> Módulo 2: Hábitos Saludables
              </button>
            </h2>
            <div id="modulo2" class="accordion-collapse collapse" data-bs-parent="#cursoAccordion">
              <div class="accordion-body">
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">4</span>
                  <div>
                    <h6 class="mb-0">Identifica tus hábitos de consumo</h6>
                    <small class="text-muted">Patrones y cómo mejorarlos</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">5</span>
                  <div>
                    <h6 class="mb-0">Control del dinero y decisiones</h6>
                    <small class="text-muted">Filtros para gastos inteligentes</small>
                  </div>
                </div>
                <div class="d-flex align-items-start">
                  <span class="badge bg-success rounded-pill me-3">6</span>
                  <div>
                    <h6 class="mb-0">Errores financieros comunes</h6>
                    <small class="text-muted">Qué evitar y cómo solucionarlo</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Beneficios -->
        <div class="mt-4">
          <h5 class="mb-3"><i class="bi bi-stars text-success me-2"></i> Lo que aprenderás</h5>
          <div class="row g-2">
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Crear y mantener un presupuesto
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Identificar gastos innecesarios
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Tomar decisiones financieras informadas
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Evitar errores comunes con el dinero
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a href="cursos/curso1.php" class="btn btn-success">
          <i class="bi bi-play-circle me-2"></i> Comenzar curso
        </a>
      </div>
    </div>
  </div>
</div>
<!-- Modal 2 Rediseñado - Inversiones 101 -->
<div class="modal fade" id="modalInversiones" tabindex="-1" aria-labelledby="modalInversionesLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalInversionesLabel">
          <i class="bi bi-graph-up-arrow me-2"></i> Inversiones 101
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        
        <!-- Encabezado con iconos -->
        <div class="row mb-4 g-3">
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-clock-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Duración</h6>
                <p class="mb-0">3 horas</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-bar-chart-line-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Nivel</h6>
                <p class="mb-0">Intermedio</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-journal-bookmark-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Lecciones</h6>
                <p class="mb-0">6 lecciones</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Objetivo en tarjeta -->
        <div class="card border-success mb-4">
          <div class="card-header bg-light-success">
            <h6 class="mb-0 text-success"><i class="bi bi-bullseye me-2"></i> Objetivo del curso</h6>
          </div>
          <div class="card-body">
            <p class="mb-0">Dominar los principios básicos de inversión para tomar decisiones informadas y hacer crecer tu dinero de manera inteligente.</p>
          </div>
        </div>

        <!-- Requisitos -->
        <div class="alert alert-success bg-light-success mb-4">
          <div class="d-flex">
            <i class="bi bi-exclamation-triangle-fill text-success fs-5 me-3"></i>
            <div>
              <h6 class="text-success mb-2">Requisitos recomendados</h6>
              <p class="mb-0">Conocimientos básicos de finanzas personales o haber completado el curso "Introducción a las Finanzas".</p>
            </div>
          </div>
        </div>

        <!-- Módulos en acordeón -->
        <h5 class="mb-3"><i class="bi bi-list-check text-success me-2"></i> Contenido del curso</h5>
        <div class="accordion" id="inversionesAccordion">
          
          <!-- Módulo 1 -->
          <div class="accordion-item border-success">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#invModulo1">
                <i class="bi bi-coin text-success me-2"></i> Módulo 1: Conceptos Básicos
              </button>
            </h2>
            <div id="invModulo1" class="accordion-collapse collapse show" data-bs-parent="#inversionesAccordion">
              <div class="accordion-body">
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success text-dark rounded-pill me-3">1</span>
                  <div>
                    <h6 class="mb-0">¿Qué es invertir y por qué hacerlo?</h6>
                    <small class="text-muted">El poder del interés compuesto y objetivos de inversión</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success text-dark rounded-pill me-3">2</span>
                  <div>
                    <h6 class="mb-0">Renta fija vs. renta variable</h6>
                    <small class="text-muted">Diferencias clave y cuándo usar cada una</small>
                  </div>
                </div>
                <div class="d-flex align-items-start">
                  <span class="badge bg-success text-dark rounded-pill me-3">3</span>
                  <div>
                    <h6 class="mb-0">Perfil de inversionista</h6>
                    <small class="text-muted">Descubre tu tolerancia al riesgo</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Módulo 2 -->
          <div class="accordion-item border-success mt-2">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light-success collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#invModulo2">
                <i class="bi bi-graph-up text-success me-2"></i> Módulo 2: Mercados Financieros
              </button>
            </h2>
            <div id="invModulo2" class="accordion-collapse collapse" data-bs-parent="#inversionesAccordion">
              <div class="accordion-body">
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success text-dark rounded-pill me-3">4</span>
                  <div>
                    <h6 class="mb-0">Bolsa de valores y acciones</h6>
                    <small class="text-muted">Cómo funcionan y cómo seleccionar empresas</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success text-dark rounded-pill me-3">5</span>
                  <div>
                    <h6 class="mb-0">Fondos de inversión y ETFs</h6>
                    <small class="text-muted">Inversión diversificada para principiantes</small>
                  </div>
                </div>
                <div class="d-flex align-items-start">
                  <span class="badge bg-success text-dark rounded-pill me-3">6</span>
                  <div>
                    <h6 class="mb-0">Riesgos y rendimientos</h6>
                    <small class="text-muted">Cómo balancear seguridad y crecimiento</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Beneficios -->
        <div class="mt-4">
          <h5 class="mb-3"><i class="bi bi-stars text-success me-2"></i> Lo que lograrás</h5>
          <div class="row g-2">
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Entender los mercados financieros
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Elegir instrumentos adecuados
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Diversificar tu portafolio
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Minimizar riesgos al invertir
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a href="cursos/curso2.php" class="btn btn-success text-white">
          <i class="bi bi-play-circle me-2"></i> Comenzar curso
        </a>
      </div>
    </div>
  </div>
</div>
<!-- Modal 3 Rediseñado - Gestión de Deudas -->
<div class="modal fade" id="modalDeudas" tabindex="-1" aria-labelledby="modalDeudasLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalDeudasLabel">
          <i class="bi bi-cash-coin me-2"></i> Gestión de Deudas
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        
        <!-- Encabezado con iconos -->
        <div class="row mb-4 g-3">
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-clock-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Duración</h6>
                <p class="mb-0">2.5 horas</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-credit-card-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Nivel</h6>
                <p class="mb-0">Principiante</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-journal-bookmark-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Lecciones</h6>
                <p class="mb-0">6 lecciones</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Objetivo en tarjeta -->
        <div class="card border-success mb-4">
          <div class="card-header bg-light-success">
            <h6 class="mb-0 text-success"><i class="bi bi-bullseye me-2"></i> Objetivo del curso</h6>
          </div>
          <div class="card-body">
            <p class="mb-0">Aprender estrategias comprobadas para reducir, controlar y eliminar deudas de manera efectiva, recuperando tu salud financiera.</p>
          </div>
        </div>

        <!-- Requisitos -->
        <div class="alert alert-success bg-light-success mb-4">
          <div class="d-flex">
            <i class="bi bi-info-circle-fill text-success fs-5 me-3"></i>
            <div>
              <h6 class="text-success mb-2">Requisitos recomendados</h6>
              <p class="mb-0">Ninguno. Se recomienda haber tomado el curso "Introducción a las Finanzas" para mejor comprensión.</p>
            </div>
          </div>
        </div>

        <!-- Módulos en acordeón -->
        <h5 class="mb-3"><i class="bi bi-list-check text-success me-2"></i> Contenido del curso</h5>
        <div class="accordion" id="deudasAccordion">
          
          <!-- Módulo 1 -->
          <div class="accordion-item border-success">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#deudasModulo1">
                <i class="bi bi-file-earmark-text-fill text-success me-2"></i> Módulo 1: Comprendiendo las Deudas
              </button>
            </h2>
            <div id="deudasModulo1" class="accordion-collapse collapse show" data-bs-parent="#deudasAccordion">
              <div class="accordion-body">
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">1</span>
                  <div>
                    <h6 class="mb-0">Tipos de deuda</h6>
                    <small class="text-muted">Créditos, hipotecas, préstamos y sus diferencias</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">2</span>
                  <div>
                    <h6 class="mb-0">Tasa de interés y su impacto</h6>
                    <small class="text-muted">Cómo los intereses aumentan tu deuda total</small>
                  </div>
                </div>
                <div class="d-flex align-items-start">
                  <span class="badge bg-success rounded-pill me-3">3</span>
                  <div>
                    <h6 class="mb-0">Evitar el sobreendeudamiento</h6>
                    <small class="text-muted">Señales de alerta y prevención</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Módulo 2 -->
          <div class="accordion-item border-success mt-2">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light-success collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#deudasModulo2">
                <i class="bi bi-tools text-success me-2"></i> Módulo 2: Estrategias de Pago
              </button>
            </h2>
            <div id="deudasModulo2" class="accordion-collapse collapse" data-bs-parent="#deudasAccordion">
              <div class="accordion-body">
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">4</span>
                  <div>
                    <h6 class="mb-0">Métodos bola de nieve vs. avalancha</h6>
                    <small class="text-muted">Ventajas de cada estrategia y cómo aplicarlas</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">5</span>
                  <div>
                    <h6 class="mb-0">Negociación con acreedores</h6>
                    <small class="text-muted">Tácticas para obtener mejores condiciones</small>
                  </div>
                </div>
                <div class="d-flex align-items-start">
                  <span class="badge bg-success rounded-pill me-3">6</span>
                  <div>
                    <h6 class="mb-0">Consolidación y refinanciamiento</h6>
                    <small class="text-muted">Cuándo conviene y cómo hacerlo</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Beneficios -->
        <div class="mt-4">
          <h5 class="mb-3"><i class="bi bi-stars text-success me-2"></i> Lo que lograrás</h5>
          <div class="row g-2">
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Identificar y clasificar tus deudas
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Aplicar el mejor método de pago
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Negociar con bancos y acreedores
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Prevenir futuros sobreendeudamientos
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a href="cursos/curso3.php" class="btn btn-success">
          <i class="bi bi-play-circle me-2"></i> Comenzar curso
        </a>
      </div>
    </div>
  </div>
</div><!-- Modal Rediseñado 4 - Estrategias de Ahorro -->
<div class="modal fade" id="modalAhorro" tabindex="-1" aria-labelledby="modalAhorroLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalAhorroLabel">
          <i class="bi bi-piggy-bank me-2"></i> Estrategias de Ahorro
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        
        <!-- Encabezado con iconos -->
        <div class="row mb-4 g-3">
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-clock-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Duración</h6>
                <p class="mb-0">2 horas</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-coin text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Nivel</h6>
                <p class="mb-0">Principiante</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-journal-bookmark-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Lecciones</h6>
                <p class="mb-0">6 lecciones</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Objetivo en tarjeta -->
        <div class="card border-success mb-4">
          <div class="card-header bg-light-success">
            <h6 class="mb-0 text-success"><i class="bi bi-bullseye me-2"></i> Objetivo del curso</h6>
          </div>
          <div class="card-body">
            <p class="mb-0">Dominar técnicas efectivas para desarrollar hábitos de ahorro consistentes y alcanzar tus metas financieras sin sacrificar tu calidad de vida.</p>
          </div>
        </div>

        <!-- Requisitos -->
        <div class="alert alert-success bg-light-success mb-4">
          <div class="d-flex">
            <i class="bi bi-info-circle-fill text-success fs-5 me-3"></i>
            <div>
              <h6 class="text-success mb-2">Requisitos</h6>
              <p class="mb-0">No se requieren conocimientos previos. Ideal para quienes comienzan su camino en el ahorro.</p>
            </div>
          </div>
        </div>

        <!-- Módulos en acordeón -->
        <h5 class="mb-3"><i class="bi bi-list-check text-success me-2"></i> Contenido del curso</h5>
        <div class="accordion" id="ahorroAccordion">
          
          <!-- Módulo 1 -->
          <div class="accordion-item border-success">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#ahorroModulo1">
                <i class="bi bi-bookmark-check-fill text-success me-2"></i> Módulo 1: Bases del Ahorro
              </button>
            </h2>
            <div id="ahorroModulo1" class="accordion-collapse collapse show" data-bs-parent="#ahorroAccordion">
              <div class="accordion-body">
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">1</span>
                  <div>
                    <h6 class="mb-0">Importancia del ahorro</h6>
                    <small class="text-muted">Beneficios y seguridad financiera</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">2</span>
                  <div>
                    <h6 class="mb-0">Tipos de ahorro</h6>
                    <small class="text-muted">Corto, mediano y largo plazo</small>
                  </div>
                </div>
                <div class="d-flex align-items-start">
                  <span class="badge bg-success rounded-pill me-3">3</span>
                  <div>
                    <h6 class="mb-0">Establecer metas</h6>
                    <small class="text-muted">Cómo definir objetivos alcanzables</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Módulo 2 -->
          <div class="accordion-item border-success mt-2">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light-success collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ahorroModulo2">
                <i class="bi bi-tools text-success me-2"></i> Módulo 2: Técnicas Avanzadas
              </button>
            </h2>
            <div id="ahorroModulo2" class="accordion-collapse collapse" data-bs-parent="#ahorroAccordion">
              <div class="accordion-body">
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">4</span>
                  <div>
                    <h6 class="mb-0">Presupuestos y control</h6>
                    <small class="text-muted">Identificar gastos prescindibles</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">5</span>
                  <div>
                    <h6 class="mb-0">Automatización</h6>
                    <small class="text-muted">Configurar transferencias automáticas</small>
                  </div>
                </div>
                <div class="d-flex align-items-start">
                  <span class="badge bg-success rounded-pill me-3">6</span>
                  <div>
                    <h6 class="mb-0">Ahorro para emergencias</h6>
                    <small class="text-muted">Diferencias con ahorro para objetivos</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Beneficios -->
        <div class="mt-4">
          <h5 class="mb-3"><i class="bi bi-stars text-success me-2"></i> Lo que lograrás</h5>
          <div class="row g-2">
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Crear un plan de ahorro personalizado
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Automatizar tus procesos de ahorro
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Diferenciar entre tipos de ahorro
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Construir un fondo de emergencias
              </div>
            </div>
          </div>
        </div>

        <!-- Consejo rápido -->
        <div class="card border-success mt-4">
          <div class="card-body">
            <div class="d-flex">
              <i class="bi bi-lightbulb-fill text-success fs-3 me-3"></i>
              <div>
                <h6 class="text-success">Consejo rápido</h6>
                <p class="mb-0">Comienza ahorrando aunque sea el 5% de tus ingresos. Lo importante es crear el hábito, luego puedes aumentar el porcentaje gradualmente.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a href="cursos/curso4.php" class="btn btn-success">
          <i class="bi bi-play-circle me-2"></i> Comenzar curso
        </a>
      </div>
    </div>
  </div>
</div>
<!-- Modal  5 - Fundamentos Bancarios -->
<div class="modal fade" id="modalBancos" tabindex="-1" aria-labelledby="modalBancosLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalBancosLabel">
          <i class="bi bi-bank me-2"></i> Fundamentos Bancarios
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        
        <!-- Encabezado con iconos -->
        <div class="row mb-4 g-3">
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-clock-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Duración</h6>
                <p class="mb-0">2 horas</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-cash-stack text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Nivel</h6>
                <p class="mb-0">Principiante</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-journal-bookmark-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Lecciones</h6>
                <p class="mb-0">6 lecciones</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Objetivo en tarjeta -->
        <div class="card border-success mb-4">
          <div class="card-header bg-light-success">
            <h6 class="mb-0 text-success"><i class="bi bi-bullseye me-2"></i> Objetivo del curso</h6>
          </div>
          <div class="card-body">
            <p class="mb-0">Entender el funcionamiento del sistema bancario y aprender a utilizar productos financieros de forma segura e inteligente en tu vida diaria.</p>
          </div>
        </div>

        <!-- Requisitos -->
        <div class="alert alert-success bg-light-success mb-4">
          <div class="d-flex">
            <i class="bi bi-info-circle-fill text-success fs-5 me-3"></i>
            <div>
              <h6 class="text-success mb-2">Requisitos</h6>
              <p class="mb-0">No se requiere experiencia previa. Ideal para quienes desean familiarizarse con la banca moderna.</p>
            </div>
          </div>
        </div>

        <!-- Módulos en acordeón -->
        <h5 class="mb-3"><i class="bi bi-list-check text-success me-2"></i> Contenido del curso</h5>
        <div class="accordion" id="bancosAccordion">
          
          <!-- Módulo 1 -->
          <div class="accordion-item border-success">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#bancosModulo1">
                <i class="bi bi-building text-success me-2"></i> Módulo 1: Sistema Bancario
              </button>
            </h2>
            <div id="bancosModulo1" class="accordion-collapse collapse show" data-bs-parent="#bancosAccordion">
              <div class="accordion-body">
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">1</span>
                  <div>
                    <h6 class="mb-0">¿Qué es un banco?</h6>
                    <small class="text-muted">Funciones básicas y operaciones clave</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">2</span>
                  <div>
                    <h6 class="mb-0">Instituciones financieras</h6>
                    <small class="text-muted">Diferencias entre bancos, sofipos y otras entidades</small>
                  </div>
                </div>
                <div class="d-flex align-items-start">
                  <span class="badge bg-success rounded-pill me-3">3</span>
                  <div>
                    <h6 class="mb-0">Regulación bancaria</h6>
                    <small class="text-muted">Protecciones al usuario y normas básicas</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Módulo 2 -->
          <div class="accordion-item border-success mt-2">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light-success collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bancosModulo2">
                <i class="bi bi-credit-card text-success me-2"></i> Módulo 2: Productos Bancarios
              </button>
            </h2>
            <div id="bancosModulo2" class="accordion-collapse collapse" data-bs-parent="#bancosAccordion">
              <div class="accordion-body">
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">4</span>
                  <div>
                    <h6 class="mb-0">Cuentas bancarias</h6>
                    <small class="text-muted">Ahorro vs. corriente y sus características</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">5</span>
                  <div>
                    <h6 class="mb-0">Tarjetas</h6>
                    <small class="text-muted">Diferencias entre crédito y débito</small>
                  </div>
                </div>
                <div class="d-flex align-items-start">
                  <span class="badge bg-success rounded-pill me-3">6</span>
                  <div>
                    <h6 class="mb-0">Seguridad digital</h6>
                    <small class="text-muted">Protección en banca en línea y móvil</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Beneficios -->
        <div class="mt-4">
          <h5 class="mb-3"><i class="bi bi-stars text-success me-2"></i> Lo que lograrás</h5>
          <div class="row g-2">
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Elegir la mejor cuenta bancaria
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Usar tarjetas inteligentemente
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Operar con seguridad en línea
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Conocer tus derechos como cliente
              </div>
            </div>
          </div>
        </div>

        <!-- Consejo rápido -->
        <div class="card border-success mt-4">
          <div class="card-body">
            <div class="d-flex">
              <i class="bi bi-shield-check text-success fs-3 me-3"></i>
              <div>
                <h6 class="text-success">Consejo de seguridad</h6>
                <p class="mb-0">Nunca compartas tus contraseñas bancarias. Los bancos legítimos nunca te las pedirán por teléfono o correo electrónico.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a href="cursos/curso5.php" class="btn btn-success">
          <i class="bi bi-play-circle me-2"></i> Comenzar curso
        </a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Rediseñado - Planificación Financiera -->
<div class="modal fade" id="modalPlanificacion" tabindex="-1" aria-labelledby="modalPlanificacionLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalPlanificacionLabel">
          <i class="bi bi-calendar-check me-2"></i> Planificación Financiera
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        
        <!-- Encabezado con iconos -->
        <div class="row mb-4 g-3">
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-clock-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Duración</h6>
                <p class="mb-0">3 horas</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-graph-up text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Nivel</h6>
                <p class="mb-0">Intermedio</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-journal-bookmark-fill text-success fs-4 me-3"></i>
              <div>
                <h6 class="mb-0">Lecciones</h6>
                <p class="mb-0">6 lecciones</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Objetivo en tarjeta -->
        <div class="card border-success mb-4">
          <div class="card-header bg-light-success">
            <h6 class="mb-0 text-success"><i class="bi bi-bullseye me-2"></i> Objetivo del curso</h6>
          </div>
          <div class="card-body">
            <p class="mb-0">Crear un plan financiero personalizado que integre gestión de ingresos, control de gastos, estrategias de ahorro e inversión, con metas claras a corto, mediano y largo plazo.</p>
          </div>
        </div>

        <!-- Requisitos -->
        <div class="alert alert-success bg-light-success mb-4">
          <div class="d-flex">
            <i class="bi bi-lightbulb-fill text-success fs-5 me-3"></i>
            <div>
              <h6 class="text-success mb-2">Recomendación</h6>
              <p class="mb-0">Haber completado el curso "Introducción a las Finanzas" para mejor comprensión de los conceptos.</p>
            </div>
          </div>
        </div>

        <!-- Módulos en acordeón -->
        <h5 class="mb-3"><i class="bi bi-list-check text-success me-2"></i> Estructura del curso</h5>
        <div class="accordion" id="planificacionAccordion">
          
          <!-- Módulo 1 -->
          <div class="accordion-item border-success">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#planModulo1">
                <i class="bi bi-clipboard2-check text-success me-2"></i> Módulo 1: Preparación
              </button>
            </h2>
            <div id="planModulo1" class="accordion-collapse collapse show" data-bs-parent="#planificacionAccordion">
              <div class="accordion-body">
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">1</span>
                  <div>
                    <h6 class="mb-0">Diagnóstico financiero</h6>
                    <small class="text-muted">Evaluación de tu situación actual</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">2</span>
                  <div>
                    <h6 class="mb-0">Metas SMART</h6>
                    <small class="text-muted">Definición de objetivos alcanzables</small>
                  </div>
                </div>
                <div class="d-flex align-items-start">
                  <span class="badge bg-success rounded-pill me-3">3</span>
                  <div>
                    <h6 class="mb-0">Análisis de flujo</h6>
                    <small class="text-muted">Ingresos, gastos y capacidad de ahorro</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Módulo 2 -->
          <div class="accordion-item border-success mt-2">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light-success collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#planModulo2">
                <i class="bi bi-graph-up-arrow text-success me-2"></i> Módulo 2: Implementación
              </button>
            </h2>
            <div id="planModulo2" class="accordion-collapse collapse" data-bs-parent="#planificacionAccordion">
              <div class="accordion-body">
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">4</span>
                  <div>
                    <h6 class="mb-0">Herramientas de monitoreo</h6>
                    <small class="text-muted">Apps y métodos para seguimiento</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mb-2">
                  <span class="badge bg-success rounded-pill me-3">5</span>
                  <div>
                    <h6 class="mb-0">Ajustes mensuales</h6>
                    <small class="text-muted">Cómo adaptar tu plan a cambios</small>
                  </div>
                </div>
                <div class="d-flex align-items-start">
                  <span class="badge bg-success rounded-pill me-3">6</span>
                  <div>
                    <h6 class="mb-0">Evaluación anual</h6>
                    <small class="text-muted">Revisión integral y reajustes</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Beneficios -->
        <div class="mt-4">
          <h5 class="mb-3"><i class="bi bi-stars text-success me-2"></i> Beneficios clave</h5>
          <div class="row g-2">
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Visión clara de tus finanzas
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Toma de decisiones informada
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Adaptación a cambios económicos
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded">
                <i class="bi bi-check2-circle text-success me-2"></i> Alineación con metas de vida
              </div>
            </div>
          </div>
        </div>

        <!-- Consejo rápido -->
        <div class="card border-success mt-4">
          <div class="card-body">
            <div class="d-flex">
              <i class="bi bi-calendar2-range text-success fs-3 me-3"></i>
              <div>
                <h6 class="text-success">Tip profesional</h6>
                <p class="mb-0">Revisa tu plan financiero cada 3 meses. Los ajustes oportunos evitan desviaciones mayores.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a href="cursos/curso6.php" class="btn btn-success">
          <i class="bi bi-play-circle me-2"></i> Comenzar curso</a>
      </div>
    </div>
  </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
