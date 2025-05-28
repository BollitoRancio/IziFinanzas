<?php
session_start();

// Simulamos valores de sesion si no existen (para pruebas)
if (!isset($_SESSION['nombre_usuario'])) {
    $_SESSION['nombre_usuario'] = 'Nombre';
    $_SESSION['rol_usuario'] = 'Rol';
}

// API Banxico - Tipo de cambio FIX
$token_banxico = "18d06cb7b0fb758b194f12ad97a459f59dc645cdbee9d0c99a68bfbafb6dda57";
$url_banxico = "https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/oportuno";

$opts = [
    "http" => [
        "method" => "GET",
        "header" => "Bmx-Token: $token_banxico\r\nAccept: application/json\r\n"
    ]
];

$context = stream_context_create($opts);
$response = file_get_contents($url_banxico, false, $context);

$dolar = "-";
$fecha_dolar = "-";

if ($response !== false) {
    $data = json_decode($response, true);
    if (isset($data["bmx"]["series"][0]["datos"][0])) {
        $dato = $data["bmx"]["series"][0]["datos"][0];
        $dolar = $dato["dato"];
        $fecha_dolar = $dato["fecha"];
    }
}

// Gráfico histórico del dólar (últimos 7 días)
$dolar_hist_labels = [];
$dolar_hist_data = [];

$fecha_actual = date("Y-m-d");
$fecha_inicio = date("Y-m-d", strtotime("-7 days"));

$url_dolar_hist = "https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/$fecha_inicio/$fecha_actual";

$response_dolar_hist = file_get_contents($url_dolar_hist, false, $context);

if ($response_dolar_hist !== false) {
    $data_hist = json_decode($response_dolar_hist, true);
    $datos = $data_hist["bmx"]["series"][0]["datos"];

    foreach ($datos as $item) {
        $dolar_hist_labels[] = $item["fecha"];
        $dolar_hist_data[] = floatval($item["dato"]);
    }
}

// Euro API - Banxico
$url_euro = "https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF46410/datos/oportuno";
$response_euro = file_get_contents($url_euro, false, $context);

$euro = "-";
$fecha_euro = "-";

if ($response_euro !== false) {
    $data_euro = json_decode($response_euro, true);
    if (isset($data_euro["bmx"]["series"][0]["datos"][0])) {
        $dato_euro = $data_euro["bmx"]["series"][0]["datos"][0];
        $euro = $dato_euro["dato"];
        $fecha_euro = $dato_euro["fecha"];
    }
}

// Bitcoin (CoinGecko)
$bitcoin = "-";
$btc_url = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd";

$ch_btc = curl_init();
curl_setopt($ch_btc, CURLOPT_URL, $btc_url);
curl_setopt($ch_btc, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_btc, CURLOPT_FAILONERROR, true);

$btc_response = curl_exec($ch_btc);

if ($btc_response !== false) {
    $btc_data = json_decode($btc_response, true);
    if (isset($btc_data['bitcoin']['usd'])) {
        $bitcoin = number_format($btc_data['bitcoin']['usd'], 2);
    }
} else {
    $btc_error = curl_error($ch_btc);
}
curl_close($ch_btc);
$btc_hist_url = "https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=7&interval=daily";
$btc_hist_data = [];
$btc_hist_labels = [];

$ch_hist = curl_init();
curl_setopt($ch_hist, CURLOPT_URL, $btc_hist_url);
curl_setopt($ch_hist, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_hist, CURLOPT_FAILONERROR, true);
$btc_hist_response = curl_exec($ch_hist);
curl_close($ch_hist);

if ($btc_hist_response !== false) {
    $hist = json_decode($btc_hist_response, true);
    if (isset($hist['prices'])) {
        foreach ($hist['prices'] as $entry) {
            $btc_hist_labels[] = date("d M", $entry[0] / 1000);
            $btc_hist_data[] = round($entry[1], 2);
        }
    }
}
// Gráfico histórico del euro (últimos 7 días)
$euro_hist_labels = [];
$euro_hist_data = [];
$url_euro_hist = "https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF46410/datos/$fecha_inicio/$fecha_actual";
$response_euro_hist = file_get_contents($url_euro_hist, false, $context);

if ($response_euro_hist !== false) {
    $data_hist_euro = json_decode($response_euro_hist, true);
    $datos_euro = $data_hist_euro["bmx"]["series"][0]["datos"];

    foreach ($datos_euro as $item) {
        $euro_hist_labels[] = $item["fecha"];
        $euro_hist_data[] = floatval($item["dato"]);
    }
}
// Tip financiero del día
$tips = [
  "Ahorra al menos el 10% de tus ingresos cada mes.",
  "Evita usar tarjetas de crédito para gastos innecesarios.",
  "Lleva un control mensual de tus gastos fijos y variables.",
  "Invierte en tu educación financiera constantemente.",
  "No pongas todos tus ahorros en un solo lugar.",
  "Revisa tus suscripciones y elimina las que no usas.",
  "Crea un fondo de emergencia equivalente a 3 meses de gastos."
];
$tip_del_dia = $tips[array_rand($tips)];


// API de noticias económicas con GNews
$gnews_api_key = "cba4546c14c5128882aba37dc8a32c44";
$gnews_url = "https://gnews.io/api/v4/top-headlines?lang=es&topic=business&token={$gnews_api_key}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $gnews_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FAILONERROR, true); // Evita errores silenciosos
$news_response = curl_exec($ch);
$articles = [];
if ($news_response !== false) {
    $news_data = json_decode($news_response, true);
    if (isset($news_data['articles']) && count($news_data['articles']) > 0) {
        $articles = array_slice($news_data['articles'], 0, 3);
    }
}
if ($news_response === false) {
  echo "Error al obtener noticias: " . curl_error($ch);
}
curl_close($ch);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>IziFinanzas - Panel</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
    
    body {
        display: flex;
        min-height: 100vh;
        background-color: #f5f5f5;
        position: relative;
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
        transition: all 0.3s ease;
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
    
    .menu-toggle {
        display: none;
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1200;
        background: #0f1f10;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 8px 12px;
        font-size: 20px;
        cursor: pointer;
    }
    
    .main {
        margin-left: 100px;
        flex-grow: 1;
        transition: all 0.3s ease;
    }
    
    .topbar {
        background-color: #ffffff;
        padding: 15px 30px;
        display: flex;
        justify-content:space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .user-info-text {
        display: flex;
        flex-direction: column;
    }
    
    .username {
        font-weight: bold;
        color: #0f1f10;
        font-size: 18px;
    }
    
    .role {
        font-size: 14px;
        color: #00c853;
    }
    
    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
    .logo img{
          width: 200px;
          height: auto;
          display: block;
        }
    
    .content {
        padding: 20px;
    }
    
    .content h1 {
        font-size: 200px;
        margin-bottom: 20px;
        color: #1e3a1e;
        font-weight: bold;
    }
    
    /* Widget Grid */
    .widget-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .widget {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    
    .widget h2 {
        margin-bottom: 15px;
        font-size: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .widget p {
        font-size: 24px;
        font-weight: bold;
        color: #0f1f10;
        margin-bottom: 5px;
    }
    
    .widget small {
        color: #777;
        font-size: 12px;
    }
    
    .chart-container {
        position: relative;
        height: 200px;
        width: 100%;
    }
    
    .news-widget {
        margin-top: 20px;
    }
    
    .news-item {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    
    .news-item h3 {
        margin: 0;
        font-size: 16px;
    }
    
    .news-item h3 a {
        text-decoration: none;
        color: #333;
    }
    
    .news-item p {
        margin: 5px 0;
        color: #666;
        font-size: 14px;
    }
    
    .news-item small {
        color: #999;
        font-size: 12px;
    }
    
    .tip-widget {
        margin-top: 20px;
    }
    
    .tip-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }
    
    .tip-widget h2 {
        font-size: 18px;
        margin-bottom: 10px;
    }
    
    .tip-widget p {
        font-size: 16px;
        color: #333;
        margin-bottom: 0;
    }
    
    .tip-widget img {
        width: 60px;
        height: auto;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }
        
        .sidebar.active {
            transform: translateX(0);

        .main {
            margin-left: 0;
        }
        
        .main.shifted {
            margin-left: 100px;
        }
        
        .menu-toggle {
            display: block;
        }
        
        .topbar {
            justify-content: center;
            padding: 15px;
        }
        
        .content {
            padding: 15px;
        }
        
      }
      @media (max-width: 768px) {
        .fila > .widget {
          flex: 1 1 100%;
        }
      }
    }
    
    @media (min-width: 769px) and (max-width: 1024px) {
        .widget-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    .widget-grid {
          display: flex;
          flex-direction: column;
          gap: 20px;
          margin-bottom: 20px;
        }

        .fila {
          display: flex;
          justify-content: space-between;
          gap: 20px;
          flex-wrap: wrap;
        }

        .fila > .widget {
          flex: 1 1 calc(33.333% - 20px); /* 3 widgets por fila */
        }

        .content h1 {
            font-size: 20px;
            text-align: center;
            margin-top: 20px;
        }

  </style>
</head>
<body>
  <button class="menu-toggle" id="menuToggle"><i class="bi bi-list"></i></button>
  
  <div class="sidebar" id="sidebar">
      <ul class="menu">
          <li><a href="inicio.php"><i class="bi bi-house-fill icon"></i> Inicio</a></li>
          <li><a href="menu_cursos.php"><i class="bi bi-journal-text icon"></i> Cursos</a></li>
          <li><a href="menu_herramientas.php"><i class="bi bi-calculator-fill icon"></i> Herramientas</a></li>
          <li><a href="articulos/articulos.php"><i class="bi bi-paperclip icon"></i> Artículos</a></li>
          <li><a href="logout.php"><i class="bi bi-box-arrow-left icon"></i> Salir</a></li>
      </ul>
  </div>

  <div class="main" id="main">
    <div class="topbar">
      <div class="logo">
      <a href="inicio.php">
        <img src="img/iz.png" alt="logo" class="izifinanzas" />
        </a>
      </div>
      <div class="user-info">
      <a href="dashboard.php">
        <img src="img/avatar.png" alt="Avatar" class="avatar" />
      </a>
        <div class="user-info-text">
          <span class="username"><?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></span>
          <span class="role"><?php echo htmlspecialchars($_SESSION['rol_usuario']); ?></span>
        </div>
        
      </div>
    </div>

    <div class="content">
      <h1>Hola de nuevo, <?php echo htmlspecialchars($_SESSION['Nombre']); ?> <i class="bi bi-emoji-laughing"></i></h1>
      
      <div class="widget-grid">
      <div class="fila fila-precios">
        <div class="widget">
          <h2><i class="bi bi-currency-dollar"></i> Precio del Dólar (FIX)</h2>
          <p><strong>
              <?php
              echo is_numeric($dolar) ? '$' . number_format((float)$dolar, 4) . ' MXN' : 'No disponible';  ?>
              </strong></p> <small>Fecha de actualización: <?php echo $fecha_dolar; ?></small>
        </div>
        
        <div class="widget">
          <h2><i class="bi bi-currency-euro"></i> Precio del Euro (FIX)</h2>
          <p><strong>
            <?php echo is_numeric($euro) ? '$' . number_format((float)$euro, 4) . ' MXN' : 'No disponible'; ?>
          </strong></p>
          <small>Fecha de actualización: <?php echo $fecha_euro; ?></small>
        </div>
        
        <div class="widget">
          <h2><i class="bi bi-currency-bitcoin"></i> Bitcoin (USD)</h2>
          <p><strong>
          <?php echo is_numeric(str_replace(',', '', $bitcoin)) ? '$' . $bitcoin . ' USD' : 'No disponible'; ?>
          </strong></p>
          <?php if (isset($btc_error)): ?>
            <small style="color: red;">Error al obtener el precio: <?= htmlspecialchars($btc_error) ?></small>
          <?php else: ?>
            <small>Fuente: CoinGecko</small>
          <?php endif; ?>
        </div>
        </div>
        <div class="fila fila-graficas">
        <div class="widget">
          <h2><i class="bi bi-graph-up-arrow"></i> Dólar (últimos 7 días)</h2>
          <div class="chart-container">
            <canvas id="dolarChart"></canvas>
          </div>
        </div>
        
        <div class="widget">
          <h2><i class="bi bi-graph-up"></i> Euro (últimos 7 días)</h2>
          <div class="chart-container">
            <canvas id="euroChart"></canvas>
          </div>
        </div>
        
        <div class="widget">
          <h2><i class="bi bi-graph-up"></i> Precio Bitcoin (últimos 7 días)</h2>
          <div class="chart-container">
            <canvas id="btcChart"></canvas>
          </div>
        </div>
        </div>
      </div>
      
      <div class="widget news-widget">
        <h2><i class="bi bi-newspaper"></i> Últimas Noticias</h2>
        <?php if (!empty($articles)): ?>
          <?php foreach ($articles as $article): ?>
            <div class="news-item">
              <h3><a href="<?= htmlspecialchars($article['url']) ?>" target="_blank">
                <?= htmlspecialchars($article['title']) ?>
              </a></h3>
              <p><?= htmlspecialchars($article['description']) ?></p>
              <small>Fuente: <?= htmlspecialchars($article['source']['name']) ?> - <?= date('d/m/Y H:i', strtotime($article['publishedAt'])) ?></small>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No hay noticias disponibles en este momento.</p>
        <?php endif; ?>
      </div>
      <div class="widget tip-widget">
        <div class="tip-content">
          <div class="text">
            <h2><i class="bi bi-lightbulb-fill"></i> Tip financiero del día</h2>
            <p><?= $tip_del_dia ?></p>
          </div>
        </div>
      </div>
    </di>
  </div>

  <script>
    // Gráficos
    const dolarLabels = <?= json_encode($dolar_hist_labels) ?>;
    const dolarData = <?= json_encode($dolar_hist_data) ?>;
    
    const ctxDolar = document.getElementById('dolarChart').getContext('2d');
    const dolarChart = new Chart(ctxDolar, {
      type: 'line',
      data: {
        labels: dolarLabels,
        datasets: [{
          label: 'Dólar FIX (MXN)',
          data: dolarData,
          fill: true,
          borderColor: '#007bff',
          backgroundColor: 'rgba(0, 123, 255, 0.2)',
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true
          },
          tooltip: {
            mode: 'index',
            intersect: false
          }
        },
        scales: {
          y: {
            beginAtZero: false
          }
        }
      }
    });
    
    const euroLabels = <?= json_encode($euro_hist_labels) ?>;
    const euroData = <?= json_encode($euro_hist_data) ?>;
    
    const ctxEuro = document.getElementById('euroChart').getContext('2d');
    const euroChart = new Chart(ctxEuro, {
      type: 'line',
      data: {
        labels: euroLabels,
        datasets: [{
          label: 'Euro FIX (MXN)',
          data: euroData,
          fill: true,
          borderColor: '#28a745',
          backgroundColor: 'rgba(40, 167, 69, 0.2)',
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true
          },
          tooltip: {
            mode: 'index',
            intersect: false
          }
        },
        scales: {
          y: {
            beginAtZero: false
          }
        }
      }
    });
    
    const btcLabels = <?= json_encode($btc_hist_labels) ?>;
    const btcData = <?= json_encode($btc_hist_data) ?>;
    
    const ctx = document.getElementById('btcChart').getContext('2d');
    const btcChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: btcLabels,
        datasets: [{
          label: 'Precio USD',
          data: btcData,
          fill: true,
          borderColor: '#f7931a',
          backgroundColor: 'rgba(247, 147, 26, 0.2)',
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true
          },
          tooltip: {
            mode: 'index',
            intersect: false
          }
        },
        scales: {
          y: {
            beginAtZero: false
          }
        }
      }
    });
    
    // Menú móvil
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main');
    
    menuToggle.addEventListener('click', () => {
      sidebar.classList.toggle('active');
      main.classList.toggle('shifted');
    });
    
    // Cerrar menú al hacer clic fuera en móviles
    document.addEventListener('click', (e) => {
      if (window.innerWidth <= 768) {
        if (!sidebar.contains(e.target) && !menuToggle.contains(e.target) ){
          sidebar.classList.remove('active');
          main.classList.remove('shifted');
        }
      }
    });
  </script>
</body>
</html>