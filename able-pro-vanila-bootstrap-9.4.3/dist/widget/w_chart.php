<?php

// Conectar a la base de datos
include 'db.php';

// Iniciar la sesión para obtener datos de usuario
session_start();

// $usuario_id = $_SESSION['usuario_id']; // Captura el id de la sesión del usuario (para pruebas está hardcodeado)
//$usuario_id = 1;  ID de usuario hardcodeado para pruebas
$usuario_id = $_SESSION['IdUsuario']; // ID de usuario hardcodeado para pruebas

// Obtener el ID de la solicitud
//$solicitud_id = $_GET['solicitud_id'] ?? null;
$sql = "SELECT solicitud_id FROM resumen_planes WHERE idUsuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Obtiene la fila como un array asociativo
    $solicitud_id = $row["solicitud_id"]; // Accede al valor de solicitud_id
} else {
    $solicitud_id = null; // Asignar null si no hay resultados
}
if ($solicitud_id) {
    // Recuperar el resumen del plan
    $sql_resumen = "SELECT calorias, proteinas, grasas, carbohidratos 
                    FROM resumen_planes 
                    WHERE solicitud_id = ?";
    $stmt = $conexion->prepare($sql_resumen);
    $stmt->bind_param("i", $solicitud_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resumen = $result->fetch_assoc();
        $calorias = $resumen['calorias'];
        $proteinas = $resumen['proteinas'];
        $grasas = $resumen['grasas'];
        $carbohidratos = $resumen['carbohidratos'];
    } else {
        echo "No se encontraron datos para esta solicitud.";
        $calorias = $proteinas = $grasas = $carbohidratos = 0;
    }

    // Recuperar los alimentos del plan
    // Recuperar los alimentos del plan con todos los campos necesarios
// Consulta mejorada para recuperar los alimentos del plan con nombre, categoría y detalles
      $sql_alimentos = "
          SELECT 
              pn.idIngrediente,
              i.Nombre AS NombreIngrediente,
              c.Nombre AS Categoria,
              pn.porcion,
              pn.calorias,
              i.tiempoComidas
          FROM 
              planes_nutricionales pn
          INNER JOIN 
              ingredientes i ON pn.idIngrediente = i.idIngrediente
          INNER JOIN 
              categorias c ON i.idCategoria = c.idCategoria
          WHERE 
              pn.solicitud_id = ?";
      $stmt_alimentos = $conexion->prepare($sql_alimentos);
      $stmt_alimentos->bind_param("i", $solicitud_id);
      $stmt_alimentos->execute();
      $result_alimentos = $stmt_alimentos->get_result();

      $alimentos = [];
      if ($result_alimentos->num_rows > 0) {
          while ($row = $result_alimentos->fetch_assoc()) {
              $alimentos[] = $row;
          }
      } else {
          echo "No se encontraron alimentos para esta solicitud.";
      }
} else {
    header('Location: ../pages/Panel.php');
    $calorias = $proteinas = $grasas = $carbohidratos = 0;
    $alimentos = [];
}

include('../forms/UsuarioClass.php');

$usuario = new Usuario($conexion);
$datosUsuario = $usuario->obtenerPorId($_SESSION['IdUsuario']);


$solicitud=$usuario->ObtenerSolicitud($_SESSION['IdUsuario']);

$comidas=explode("-",$solicitud[0]["comidas"]);


$sql56 = "SELECT n.Titulo, n.descripcion, pu.pregunta
        FROM notificaciones n
        JOIN preguntasusuarios pu ON n.idpregunta = pu.idpregunta
        WHERE n.IdUsuario = ?";
$stmt23 = $conexion->prepare($sql56);
$stmt23->bind_param("i", $_SESSION['IdUsuario']);
$stmt23->execute();
$resultadoNotificaciones = $stmt23->get_result();
?>

<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Mi plan de Alimentación - Team Ori</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Able Pro is trending dashboard template made using Bootstrap 5 design framework. Able Pro is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies."
    />
    <meta
      name="keywords"
      content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard"
    />
    <meta name="author" content="Phoenixcoded" />

   <!-- [Favicon] icon -->
   <link rel="icon" href="../assets/images/LOGO SIN FONDO-02.png" type="image/x-icon" />
 <!-- [Font] Family -->
<link rel="stylesheet" href="../assets/fonts/inter/inter.css" id="main-font-link" />
<!-- [phosphor Icons] https://phosphoricons.com/ -->
<link rel="stylesheet" href="../assets/fonts/phosphor/duotone/style.css" />
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css" />
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="../assets/fonts/feather.css" />
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="../assets/fonts/fontawesome.css" />
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="../assets/fonts/material.css" />
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="../assets/css/style.css" id="main-style-link" />
<script src="../assets/js/tech-stack.js"></script>
<link rel="stylesheet" href="../assets/css/style-preset.css" />

  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->

  <body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
  <!-- [ Sidebar Menu ] start -->
 <nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="../pages/panel.php" class="b-brand text-primary">
        <!-- ========   Change your logo from here   ============ -->
        <img src="../assets/images/LOGO SIN FONDO-02.png" class="img-fluid" alt="logo" height="95px" width="95px"/>
      </a>
    </div>
    <div class="navbar-content">
      <div class="card pc-user-card">
         <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <img src="../assets/images/user/avatar-9.jpg" alt="user-image" class="user-avtar wid-45 rounded-circle" />
            </div>
            <div class="flex-grow-1 ms-3 me-2">
            <h6 class="mb-0"><?= ucwords($datosUsuario['nombre']) ?> <?= ucwords($datosUsuario['apellido']) ?></h6>
            <small>Administrador</small>
            </div>
            <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse" href="#pc_sidebar_userlink">
              <svg class="pc-icon">
                <use xlink:href="#custom-sort-outline"></use>
              </svg>
            </a>
          </div>
          <div class="collapse pc-user-links" id="pc_sidebar_userlink">
            <div class="pt-3">
              <a href="../../dist/widget/w_chart.php">
                <i class="ph-duotone ph-cooking-pot f-28"></i>
                <span>Plan de Alimentación</span>
              </a>
              <a href="#!">
                <i class="ph-duotone ph-sneaker-move f-28"></i>
                <span>Plan de entrenamiento</span>
              </a>
              <a href="#!">
                <i class="ti ti-power"></i>
                <span>Cerrar Sesión</span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <ul class="pc-navbar">
      

        <li class="pc-item pc-caption">
          <label>Mi espacio</label>
          <svg class="pc-icon">
            <use xlink:href="#custom-presentation-chart"></use>
          </svg>
        </li>
        <li class="pc-item">
          <a href="../../dist/widget/w_chart.php" class="pc-link">
            <span class="pc-micon">
              <svg class="pc-icon">
                <use xlink:href="#custom-story"></use>
              </svg>
            </span>
            <span class="pc-mtext">Mi Alimentación</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="panelrutina.php" class="pc-link">
            <span class="pc-micon">
              <svg class="pc-icon">
                <use xlink:href="#custom-fatrows"></use>
              </svg>
            </span>
            <span class="pc-mtext">Mi Entrenamiento</span>
          </a>
        </li>
         <li class="pc-item">
          <a href="#" class="pc-link">
            <span class="pc-micon">
              <svg class="pc-icon">
                <use xlink:href="#custom-fatrows"></use>
              </svg>
            </span>
            <span class="pc-mtext">Mi Progreso</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="../../dist/widget/w_paneladm.php" class="pc-link">
            <span class="pc-micon">
              <img src="../assets/images/icons-tab/icons9.png" alt="Recetas">  
            </span>
            <span class="pc-mtext">Panel de Administración</span>
          </a>
       </li>
       <li class="pc-item">
          <a href="../../dist/recetas/index.php" class="pc-link">
            <span class="pc-micon">
              <img src="../assets/images/icons-tab/icons8c.png" alt="Recetas">  
            </span>
            <span class="pc-mtext">Recetas</span>
           </a>
       </li>
       <li class="pc-item">
          <a href="../pages/recomendations.php" class="pc-link">
              <span class="pc-micon">
                  <i class="ph-duotone ph-book-open-text"></i>
              </span>
              <span class="pc-mtext">Recomendaciones</span>
          </a>
      </li>
      </ul>
    </div>
  </div>
</nav>
<!-- [ Sidebar Menu ] end -->
 <!-- [ Header Topbar ] start -->
<header class="pc-header">
  <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
<div class="me-auto pc-mob-drp">
  <ul class="list-unstyled">
    <!-- ======= Menu collapse Icon ===== -->
    <li class="pc-h-item pc-sidebar-collapse">
      <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
        <i class="ti ti-menu-2"></i>
      </a>
    </li>
    <li class="pc-h-item pc-sidebar-popup">
      <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
        <i class="ti ti-menu-2"></i>
      </a>
    </li>
    
  </ul>
</div>
<!-- [Mobile Media Block end] -->
<div class="ms-auto">
  <ul class="list-unstyled">
    <li class="dropdown pc-h-item">
      <a
        class="pc-head-link dropdown-toggle arrow-none me-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        aria-expanded="false"
      >
        <svg class="pc-icon">
          <use xlink:href="#custom-sun-1"></use>
        </svg>
      </a>
      <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
        <a href="#!" class="dropdown-item" onclick="layout_change('dark')">
          <svg class="pc-icon">
            <use xlink:href="#custom-moon"></use>
          </svg>
          <span>Dark</span>
        </a>
        <a href="#!" class="dropdown-item" onclick="layout_change('light')">
          <svg class="pc-icon">
            <use xlink:href="#custom-sun-1"></use>
          </svg>
          <span>Light</span>
        </a>
        <a href="#!" class="dropdown-item" onclick="layout_change_default()">
          <svg class="pc-icon">
            <use xlink:href="#custom-setting-2"></use>
          </svg>
          <span>Default</span>
        </a>
      </div>
    </li>
    <li class="dropdown pc-h-item">
      <a
        class="pc-head-link dropdown-toggle arrow-none me-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        aria-expanded="false"
      >
        <svg class="pc-icon">
          <use xlink:href="#custom-setting-2"></use>
        </svg>
      </a>
      <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
        <a href="#!" class="dropdown-item">
          <i class="ti ti-user"></i>
          <span>Mis Planes</span>
        </a>
        <a href="#!" class="dropdown-item">
          <i class="ti ti-power"></i>
          <span>Cerrar Sesión</span>
        </a>
      </div>
    </li>
    
    <li class="dropdown pc-h-item">
      <a
        class="pc-head-link dropdown-toggle arrow-none me-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        aria-expanded="false"
      >
        <svg class="pc-icon">
          <use xlink:href="#custom-notification"></use>
        </svg>
        <span class="badge bg-success pc-h-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
      <div class="dropdown-header d-flex align-items-center justify-content-between">
    <h5 class="m-0">Notificaciones</h5>
    <a href="#!" class="btn btn-link btn-sm">Marcar como leidas</a>
  </div>
  <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
    <?php if($resultadoNotificaciones->num_rows > 0): ?>
      <?php while($notificacion = $resultadoNotificaciones->fetch_assoc()): ?>
        <div class="card mb-2">
          <div class="card-body">
            <div class="d-flex">
              <div class="flex-shrink-0">
                <svg class="pc-icon text-primary">
                  <use xlink:href="#custom-layer"></use>
                </svg>
              </div>
              <div class="flex-grow-1 ms-3">
                <span class="float-end text-sm text-muted">
                </span>
                <h4 class="text-body mb-2"><?= htmlspecialchars($notificacion['Titulo']); ?></h4>
                <p>Pregunta:<?=$notificacion['pregunta']?></p>
                <h5 class="mb-0"><?= htmlspecialchars($notificacion['descripcion']); ?></h5>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center">No hay notificaciones</p>
    <?php endif; ?>
  </div>
  <div class="text-center py-2">
    <a href="#!" class="link-danger">Borrar todas las Notificaciones</a>
  </div>
</div>

    </li>
    <li class="dropdown pc-h-item header-user-profile">
      <a
        class="pc-head-link dropdown-toggle arrow-none me-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        data-bs-auto-close="outside"
        aria-expanded="false">
        <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar" />
      </a>
      <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
        <div class="dropdown-header d-flex align-items-center justify-content-between">
          <h5 class="m-0">Profile</h5>
        </div>
        <div class="dropdown-body">
          <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
            <div class="d-flex mb-1">
              <div class="flex-shrink-0">
                <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar wid-35" />
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1"><?= ucwords($datosUsuario['nombre']) ?> <?= ucwords($datosUsuario['apellido']) ?></h6>
                <span><?=$datosUsuario['correo']?></span>
              </div>
            </div>
            <hr class="border-secondary border-opacity-50" />
            <div class="card">
              <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                  <h5 class="mb-0 d-inline-flex align-items-center"><svg class="pc-icon text-muted me-2">
                      <use xlink:href="#custom-notification-outline"></use></svg>Notificaciones</h5>
                  <div class="form-check form-switch form-check-reverse m-0">
                    <input class="form-check-input f-18" type="checkbox" role="switch" />
                  </div>
                </div>
              </div>
            </div>
            <p class="text-span">Administrar</p>
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-setting-outline"></use>
                </svg>
                <span>Configuraciones</span>
              </span>
            </a>
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-share-bold"></use>
                </svg>
                <span>Compartir</span>
              </span>
            </a>
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-lock-outline"></use>
                </svg>
                <span>Cambiar Contraseña</span>
              </span>
            </a>
            <hr class="border-secondary border-opacity-50" />
            <div class="d-grid mb-3">
              <button class="btn btn-primary">
                <svg class="pc-icon me-2">  
                  <use xlink:href="#custom-logout-1-outline"></use></svg>Logout
              </button>
            </div>
            
          </div>
        </div>
      </div>
    </li>
  </ul>
</div>
 </div>
</header>

<!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Mi plan de alimentación</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="row">
          <div class="col-md-12 col-xxl-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-shrink-0">
                    <div class="avtar avtar-s bg-light-primary">
                      <i class="ti ti-wallet f-20"></i>
                    </div>
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h6 class="mb-0">Total Calorias</h6>
                  </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                  <div class="mt-3 row align-items-center">
                    <div class="col-7">
                      <div id="all-earnings-graph"></div>
                    </div>
                    <div class="col-5">
                      <h5 class="mb-1"><?= ($calorias) ?></h5> <!-- varible calorias -->
                      <p class="text-primary mb-0"><i class="ti ti-arrow-up-right"></i> 30.6%</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xxl-4 col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 me-3">
                    <p class="mb-1 fw-medium text-muted">Proteinas</p>
                    <h4 class="mb-1"><?= ($proteinas) ?></h4> <!-- varible prote -->
                    <p class="mb-0 text-sm">En Calorias</p>
                  </div>
                  <div class="flex-shrink-0">
                    <div class="avtar avtar-l bg-light-warning rounded-circle">
                      <i class="ph-duotone ph-hand-fist f-28"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-4 col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 me-3">
                    <p class="mb-1 fw-medium text-muted">Grasas</p>
                    <h4 class="mb-1"><?= ($grasas) ?></h4> <!-- varible grasas -->
                    <p class="mb-0 text-sm">En Calorias</p>
                  </div>
                  <div class="flex-shrink-0">
                    <div class="avtar avtar-l bg-light-success rounded-circle">
                      <i class="ph-duotone ph-voicemail f-28"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-4 col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 me-3">
                    <p class="mb-1 fw-medium text-muted">Carbohidratos</p>
                    <h4 class="mb-1"><?= ($carbohidratos) ?></h4> <!-- varible carbo -->
                    <p class="mb-0 text-sm">En Calorias</p>
                  </div>
                  <div class="flex-shrink-0">
                    <div class="avtar avtar-l bg-light-info rounded-circle">
                      <i class="ph-duotone ph-wave-sine f-28"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>Lista de Ingredientes</h5>
                <span class="d-block m-t-5">Debajo encontraras los ingredientes que tendras que incluir en tu dieta para una mayor efectividad del plan según tus objetivos.</span>
                <p class="mb-0 mt-2 text-muted">Elige <strong>una sola opción de cada macronutriente</strong> para armar tu plato. La pieza de fruta o verdura indicada ya está incluida en cada comida.</p>
              </div>
              <?php
if (!empty($alimentos)) {
    // 1. Definir orden personalizado de comidas
    $orden_comidas = ['desayuno', 'almuerzo', 'merienda', 'cena', 'snack'];
    
    // 2. Obtener tiempos de comida desde planes_nutricionales
    $sql_tiempos = "SELECT DISTINCT tiempo_comida 
                   FROM planes_nutricionales 
                   WHERE solicitud_id = ?
                   ORDER BY FIELD(tiempo_comida, 'desayuno', 'almuerzo', 'merienda', 'cena', 'snack')";
    $stmt = $conexion->prepare($sql_tiempos);
    $stmt->bind_param("i", $solicitud_id);
    $stmt->execute();
    $result_tiempos = $stmt->get_result();
    $comidas_usuario = $result_tiempos->fetch_all(MYSQLI_ASSOC);
    $comidas_usuario = array_column($comidas_usuario, 'tiempo_comida');

    // 3. Obtener requerimientos nutricionales
    $sql_requerimientos = "SELECT proteinas, grasas, carbohidratos 
                          FROM resumen_planes 
                          WHERE solicitud_id = ?";
    $stmt = $conexion->prepare($sql_requerimientos);
    $stmt->bind_param("i", $solicitud_id);
    $stmt->execute();
    $requerimientos = $stmt->get_result()->fetch_assoc();

    // 4. Consulta optimizada con ordenamiento personalizado
    $sql_alimentos = "
        SELECT 
            pn.tiempo_comida,
            pn.idIngrediente,
            i.Nombre AS NombreIngrediente,
            i.IdCategoria,
            i.Gramos_Proteina,
            i.Gramos_Carbohidratos,
            i.Gramos_Grasas,
            i.Calorias,
            c.Nombre AS Categoria
        FROM planes_nutricionales pn
        INNER JOIN ingredientes i ON pn.idIngrediente = i.IdIngrediente
        INNER JOIN categorias c ON i.IdCategoria = c.IdCategoria
        WHERE pn.solicitud_id = ?
        ORDER BY 
            FIELD(pn.tiempo_comida, 'desayuno', 'almuerzo', 'merienda', 'cena', 'snack'),
            i.IdCategoria";

    $stmt_alimentos = $conexion->prepare($sql_alimentos);
    $stmt_alimentos->bind_param("i", $solicitud_id);
    $stmt_alimentos->execute();
    $alimentos = $stmt_alimentos->get_result()->fetch_all(MYSQLI_ASSOC);

    // 5. Validar y ajustar requerimientos
    $requerimientos_validados = [
        'proteinas' => max($requerimientos['proteinas'] ?? 0, 1), // Evitar división por cero
        'grasas' => max($requerimientos['grasas'] ?? 0, 1),
        'carbohidratos' => max($requerimientos['carbohidratos'] ?? 0, 1)
    ];

    // 6. Calcular distribución por comida
    $num_comidas = max(count($comidas_usuario), 1); // Nunca dividir por cero
    $distribucion = [
        'proteinas' => $requerimientos_validados['proteinas'] / $num_comidas,
        'grasas' => $requerimientos_validados['grasas'] / $num_comidas,
        'carbohidratos' => $requerimientos_validados['carbohidratos'] / $num_comidas
    ];

    // 7. Procesar y agrupar alimentos
    $plan_final = [];
    foreach ($alimentos as $alimento) {
        $tiempo = strtolower($alimento['tiempo_comida']);
        $categoria = $alimento['IdCategoria'];
        
        // Calcular porción con límites
        $nutriente = match($categoria) {
            1 => ['tipo' => 'proteinas', 'gramos' => $alimento['Gramos_Proteina']],
            2 => ['tipo' => 'carbohidratos', 'gramos' => $alimento['Gramos_Carbohidratos']],
            3 => ['tipo' => 'grasas', 'gramos' => $alimento['Gramos_Grasas']],
            default => null
        };

        if ($nutriente && $nutriente['gramos'] > 0) {
            $porcion = ($distribucion[$nutriente['tipo']] * 100) / $nutriente['gramos'];

            // Aplicar límite máximo de 400g por ingrediente y redondear a múltiplos de 5
            $porcion = min(round($porcion / 5) * 5, 400);

            $plan_final[$tiempo][] = [
                'nombre' => $alimento['NombreIngrediente'],
                'categoria' => $alimento['Categoria'],
                'categoriaId' => $categoria,
                'porcion' => $porcion,
                'calorias' => round(($alimento['Calorias'] * $porcion) / 100, 1)
            ];
        }
    }

    // 8. Ordenar final según estructura deseada
    $plan_ordenado = [];
    foreach ($orden_comidas as $comida) {
        if (isset($plan_final[$comida])) {
            $plan_ordenado[$comida] = $plan_final[$comida];
        }
    }
    $plan_ordenado = [];
    foreach ($comidas_usuario as $comida) {
        $comida_lower = strtolower($comida);
        $plan_ordenado[$comida_lower] = $plan_final[$comida_lower] ?? [];
    }

    // 8.1 Añadir elementos obligatorios - NUEVA SECCIÓN
    foreach ($plan_ordenado as $tiempo => &$items) {
        if (in_array($tiempo, ['desayuno', 'merienda'])) {
            $items[] = [
                'nombre' => 'Una Pieza de fruta',
                'categoria' => 'Fruta',
                'porcion' => 100,
                'calorias' => 50
            ];
        } elseif (in_array($tiempo, ['almuerzo', 'cena'])) {
            $items[] = [
                'nombre' => 'Una pieza de verdura verde',
                'categoria' => 'Verdura',
                'porcion' => 100,
                'calorias' => 30
            ];
        }
    }
?>

<!-- 9. Mostrar resultados -->
<div class="card-body">
    <?php if (!empty($plan_ordenado)): ?>
        <div class="accordion" id="accordionComidas">
            <?php foreach ($plan_ordenado as $tiempo => $items): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#collapse<?= htmlspecialchars($tiempo) ?>">
                            <?= ucfirst($tiempo) ?>
                        </button>
                    </h2>
                    <div id="collapse<?= htmlspecialchars($tiempo) ?>" 
                         class="accordion-collapse collapse" 
                         data-bs-parent="#accordionComidas">
                        <div class="accordion-body">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th class="d-none d-md-table-cell">#</th>
                                        <th>Ingrediente</th>
                                        <th class="d-none d-md-table-cell">Tipo</th>
                                        <th>Cantidad (g)</th>
                                        <th class="d-none d-md-table-cell">Calorías</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $contador = 1; ?>
                                    <?php foreach ($items as $item): ?>
                                    <tr class="macro-<?= $item['categoriaId'] ?>">
                                        <td class="d-none d-md-table-cell"><?= $contador++ ?></td>
                                        <td><?= htmlspecialchars($item['nombre']) ?></td>
                                        <td class="d-none d-md-table-cell"><?= $item['categoria'] ?></td>
                                        <td><?= number_format($item['porcion'], 0) ?></td>
                                        <td class="d-none d-md-table-cell"><?= number_format($item['calorias'], 1) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning mb-0">No se encontraron alimentos en el plan.</div>
    <?php endif; 
    }?>
</div>

<style>
    @media (max-width: 767.98px) {
        .accordion-body {
            padding: 0  ;
            overflow-x: auto;
        }
        .table {
            font-size: 0.85rem;
            min-width: 300px;
        }
        .table td, .table th {
            padding: 0.5rem;
            white-space: nowrap;
        }
        .table th:nth-child(1),
        .table td:nth-child(1),
        .table th:nth-child(3),
        .table td:nth-child(3),
        .table th:nth-child(5),
        .table td:nth-child(5) {
            display: none;
        }
    }
    /* Colores por macronutriente */
    .macro-1 td { background-color: #fff3e0 !important; }
    .macro-2 td { background-color: #e0f7fa !important; }
    .macro-3 td { background-color: #e8f5e9 !important; }
</style>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ Main Content ] end -->
    </div>
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
      <div class="footer-wrapper container-fluid">
        <div class="row">
          <div class="col my-1">
            <p class="m-0"
              >PCA - 2024</p
            >
          </div>
         
        </div>
      </div>
    </footer>



    <!-- Botón flotante de ayuda -->
<button type="button" 
        class="btn btn-primary rounded-circle shadow-lg p-0"
        style="
            position: fixed; 
            bottom: 30px; 
            right: 30px; 
            z-index: 1000;
            width: 58px;
            height: 58px;
        " 
        data-bs-toggle="modal" 
        data-bs-target="#helpModal">
    <i class="ph-duotone ph-question" style="font-size: 2rem"></i>  <!-- Ícono agrandado -->
</button>
<!-- Modal de ayuda -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="helpModalLabel">¿Necesitas ayuda?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="helpForm">
                    <div class="mb-3">
                        <label class="form-label">¡Envíanos tu consulta!</label>
                        <textarea 
                            name="mensaje" 
                            class="form-control" 
                            rows="4" 
                            placeholder="Describe tu problema o duda..."
                            required
                            maxlength="500"
                        ></textarea>
                        <small class="text-muted">Máximo 500 caracteres</small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Enviar consulta
                    </button>
                </form>
          </div>
        </div>
    </div>
</div>
<script>
document.getElementById('helpForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const alertContainer = document.querySelector('#helpModal .modal-body');
    
    // Resetear alertas anteriores
    alertContainer.querySelectorAll('.alert').forEach(alert => alert.remove());

    // Estado de carga
    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <span class="spinner-border spinner-border-sm" role="status"></span>
        Enviando...
    `;

    fetch('../foro/envioPreguntasForo.php', {
        method: 'POST',
        body: new FormData(form)
    })
    .then(async response => {
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new TypeError('Respuesta no es JSON');
        }
        
        return response.json();
    })
    .then(data => {
        const alertType = data.success ? 'success' : 'danger';
        const message = data.message || (data.success 
            ? '¡Consulta enviada! Te responderemos a la brevedad.'
            : 'Error al enviar la consulta');

        const alertHTML = `
            <div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        alertContainer.insertAdjacentHTML('afterbegin', alertHTML);
        if (data.success) form.reset();
    })
    .catch(error => {
        console.error('Fetch Error:', error);
        const alertHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Error de conexión: ${error.message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        alertContainer.insertAdjacentHTML('afterbegin', alertHTML);
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Enviar consulta';
    });
});
</script>
 <!-- Required Js -->
<script src="../assets/js/plugins/popper.min.js"></script>
<script src="../assets/js/plugins/simplebar.min.js"></script>
<script src="../assets/js/plugins/bootstrap.min.js"></script>
<script src="../assets/js/fonts/custom-font.js"></script>
<script src="../assets/js/pcoded.js"></script>
<script src="../assets/js/plugins/feather.min.js"></script>


<script>
  layout_change('light');
</script>
  
<script>
  change_box_container('false');
</script>
 
<script>
  layout_caption_change('true');
</script>
 
<script>
  layout_rtl_change('false');
</script>
 
<script>
  preset_change('preset-1');
</script>
 
<script>
  main_layout_change('vertical');
</script>


    <!-- [Page Specific JS] start -->
    <!-- Apex Chart -->
    <script src="../assets/js/plugins/apexcharts.min.js"></script>
    <script src="../assets/js/pages/w-chart.js"></script>
    <!-- [Page Specific JS] end -->
    

  </body>
  <!-- [Body] end -->
</html>


<?php

?>