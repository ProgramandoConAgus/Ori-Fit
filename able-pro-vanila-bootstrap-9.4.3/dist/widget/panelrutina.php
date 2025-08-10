<?php

// Conectar a la base de datos
include 'db.php';

// Iniciar la sesión para obtener datos de usuario
require_once '../auth/check_session.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// $usuario_id = $_SESSION['usuario_id']; // Captura el id de la sesión del usuario (para pruebas está hardcodeado)
//$usuario_id = 1;  ID de usuario hardcodeado para pruebas
$usuario_id = $_SESSION['IdUsuario']; // ID de usuario hardcodeado para pruebas

// Obtener el ID de la solicitud
//$solicitud_id = $_GET['solicitud_id'] ?? null;
$sql = "
  SELECT r.idSolicitud
  FROM resumen_rutinas r
  INNER JOIN solicitudes_ejercicios s 
      ON r.idSolicitud = s.id
  WHERE r.idUsuario = ? 
    AND s.estado = 'aprobada'
";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();


if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Obtiene la fila como un array asociativo
    $solicitud_id = $row["idSolicitud"]; // Accede al valor de solicitud_id
} else {
    $solicitud_id = null; // Asignar null si no hay resultados
}
if ($solicitud_id) {

    $sql_resumen = "SELECT 
                    r.dias_disponible, 
                    r.tiempo_disponible, 
                    se.usuario_id, 
                    se.nombre, 
                    se.lugar_entrenamiento, 
                    se.sexo,
                    se.nivel,
                    v.Nombre AS videoNombre,
                    v.Descripcion,
                    v.URL,
                    re.dia,
                    re.orden
                FROM solicitudes_ejercicios se
                JOIN rutina r ON se.usuario_id = r.idUsuario
                JOIN rutina_ejercicio re ON re.idRutina = r.IdRutina
                JOIN videos v ON re.idVideo = v.IdVideo
                WHERE se.usuario_id = ?
                ORDER BY re.dia ASC, re.orden ASC";

$stmt = $conexion->prepare($sql_resumen);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result_solicitud= $stmt->get_result();
$resumen = [];  // inicializar antes de leer resultados
if ($result_solicitud && $result_solicitud->num_rows > 0) {
    while ($row = $result_solicitud->fetch_assoc()) {
        $resumen[] = $row;
    }

    $agrupado_por_dia = [];
    foreach ($resumen as $fila) {
        $dia = "Día " . $fila['dia'];
        $agrupado_por_dia[$dia][] = $fila;
    }
    // Obtener valores base desde la primera fila
        $nivel = $resumen[0]['nivel'];
        $tiempo_disponible = $resumen[0]['tiempo_disponible'];
        $dias_disponible = $resumen[0]['dias_disponible'];

        // Generar series y repeticiones
        list($series, $repeticiones) = generarSeriesYRepeticiones($nivel, $tiempo_disponible, $dias_disponible);

  } else {
    echo "❌ No se encontró ninguna coincidencia entre las tablas.<br>";
    $agrupado_por_dia = [];
  }
}else {
  header('Location: ../pages/Panel.php');
  $calorias = $proteinas = $grasas = $carbohidratos = 0;
  $alimentos = [];
}

function generarSeriesYRepeticiones($nivel, $tiempo, $dias) {
    $series = 0;
    $reps = '';

    if ($nivel == 1) { // Principiante
        if ($tiempo == 30) {
            $series = 2;
            $reps = '12-15';
        } elseif ($tiempo == 45) {
            $series = 3;
            $reps = '12-15';
        } elseif($tiempo == 60) {
            $series = 3;
            $reps = '10-12';
        }
    } elseif ($nivel == 2) { // Intermedio
        if ($tiempo == 30) {
            $series = 3;
            $reps = '10-12';
        } elseif ($tiempo == 45) {
            $series = 4;
            $reps = '8-12';
        } elseif($tiempo == 60) {
            $series = 4;
            $reps = '8-10';
        }
    } elseif ($nivel == 3) { // Avanzado
        if ($tiempo == 30) {
            $series = 4;
            $reps = '8-10';
        } elseif ($tiempo == 45) {
            $series = 4;
            $reps = '6-10';
        } elseif ($tiempo == 60) {
            $series = 4;
            $reps = '6-8';
        }
    }

    return [$series, $reps];
}



include('../forms/UsuarioClass.php');

$usuario = new Usuario($conexion);
$datosUsuario = $usuario->obtenerPorId($_SESSION['IdUsuario']);


$solicitud=$usuario->ObtenerSolicitud($_SESSION['IdUsuario']);

require_once 'notifications.php';
$notificaciones = get_notifications($conexion);
$notificationCount = count($notificaciones);
function getYoutubeId(string $url): ?string {
    // soporta youtu.be/, watch?v=, embed/
    if (preg_match(
      '/(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/))([^\?&"\'>]+)/',
      $url,
      $m
    )) {
        return $m[1];
    }
    return null;
}
?>

<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Mi plan de Entrenamiento - Team Ori</title>
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!-- Font Awesome 4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font Awesome 6 (recomendado si usás íconos nuevos como fa-solid, etc.) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
      .video-cell {
        position: relative;
      }
      .video-cell .thumbnail {
        display: none;
        position: absolute;
        top: -70px;
        left: 100%;
        width: 300px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        border-radius: 4px;
        z-index: 10;
      }
      .video-cell:hover .thumbnail {
        display: block;
      }
    </style>
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
              <a href="../auth/logout.php">
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
        <?php if(isset($_SESSION['IdRol']) && $_SESSION['IdRol'] == 2): ?>
        <li class="pc-item">
          <a href="../../dist/widget/w_paneladm.php" class="pc-link">
            <span class="pc-micon">
              <img src="../assets/images/icons-tab/icons9.png" alt="Recetas">
            </span>
            <span class="pc-mtext">Panel de Administración</span>
          </a>
       </li>
        <?php endif; ?>
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
        <a href="../auth/logout.php" class="dropdown-item">
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
        <span class="badge bg-success pc-h-badge"><?=$notificationCount?></span>
      </a>
      <?php render_notifications_dropdown($notificaciones); ?>

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
              <a href="../auth/logout.php" class="btn btn-primary">
                <svg class="pc-icon me-2">
                  <use xlink:href="#custom-logout-1-outline"></use></svg>Logout
              </a>
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
                  <h2 class="mb-0">Mi plan de entrenamiento</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <div class="row">


          <div class="col-xxl-6 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 me-3">
                    <p class="mb-1 fw-medium text-muted">Dias de Entrenamiento</p>
                    <h4 class="mb-1"><?= ($dias_disponible) ?>: Dias</h4> <!-- varible grasas -->
                  </div>
                  <div class="flex-shrink-0">
                    <div class="avtar avtar-l bg-light-info rounded-circle">
                      <i class="fa fa-calendar-o" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-6 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 me-3">
                    <p class="mb-1 fw-medium text-muted">Tiempo de Entrenamiento</p>
                    <h4 class="mb-1"><?= ($tiempo_disponible) ?> Minutos</h4> <!-- varible prote -->
                  </div>
                  <div class="flex-shrink-0">
                    <div class="avtar avtar-l bg-light-warning rounded-circle">
                      <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-6 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 me-3">
                    <p class="mb-1 fw-medium text-muted">Series</p>
                    <h4 class="mb-1"><?= ($series) ?>: Por Ejercicio</h4> <!-- varible grasas -->
                  </div>
                  <div class="flex-shrink-0">
                    <div class="avtar avtar-l bg-light-success rounded-circle">
                      <i class="fa fa-hashtag" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-6 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 me-3">
                    <p class="mb-1 fw-medium text-muted">Repeticiones</p>
                    <h4 class="mb-1"><?= ($repeticiones) ?>: Por Serie</h4> <!-- varible grasas -->
                  </div>
                  <div class="flex-shrink-0">
                    <div class="avtar avtar-l bg-light-info rounded-circle">
                      <i class="fa fa-repeat" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>Lista de Ejercicios</h5>
                <span class="d-block m-t-5">Debajo encontraras los ejercicios de tu plan de entrenamiento, segun los datos que proporcionaste</span>
              </div>
            <?php

?>

<?php if (!empty($agrupado_por_dia)): ?>
    <div class="accordion" id="accordionComidas">
        <?php foreach ($agrupado_por_dia as $dias => $videos):
            $dia=str_replace(' ', '', $dias);
          ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapse<?=htmlspecialchars($dia) ?>">
                        <?= ucfirst($dia) ?>
                    </button>
                </h2>
                <div id="collapse<?= htmlspecialchars($dia)?>" 
                     class="accordion-collapse collapse" 
                     data-bs-parent="#accordionComidas">
                    <div class="accordion-body">
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th class="d-none d-md-table-cell">Día</th>
                                    <th>Orden Ejercicio</th>
                                    <th>Ejercicio</th>
                                    <th>Descripción</th>
                                    <th class="d-none d-md-table-cell">Lugar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($videos as $video): ?>
                                <tr>
                                    <td class="d-none d-md-table-cell"><?= $video['dia'] ?></td>
                                    <td><?= htmlspecialchars($video['orden']) ?></td>
                                    <td class="video-cell">
                                        <a href="<?= htmlspecialchars($video['URL'], ENT_QUOTES) ?>" target="_blank">
                                            <?= htmlspecialchars($video['videoNombre'], ENT_QUOTES) ?>
                                        </a>
                                        <?php if ($id = getYoutubeId($video['URL'])): ?>
                                            <img
                                            class="thumbnail"
                                            src="https://img.youtube.com/vi/<?= $id ?>/hqdefault.jpg"
                                            alt="Portada de <?= htmlspecialchars($video['videoNombre'], ENT_QUOTES) ?>"
                                            />
                                        <?php endif; ?>
                                    </td>
                                    <td class="d-none d-md-table-cell limit-text"><?= htmlspecialchars($video['Descripcion']) ?></td>
                                    <td class="d-none d-md-table-cell"><?= htmlspecialchars($video['lugar_entrenamiento']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-warning mb-0">No se encontró una rutina.</div>
<?php endif; ?>


<style>
td.limit-text {
  max-width: 150px;       /* o el ancho que quieras */
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
</style>
<style>
    @media (max-width: 767.98px) {
        .accordion-body {
            padding: 0;
            overflow-x: auto;
        }
        .table {
            font-size: 0.85rem;
            min-width: 480px;
        }
        .table td, .table th {
            padding: 0.5rem;
            white-space: nowrap;
        }
        /* Mostrar columnas ocultas para que toda la información
           esté disponible en pantallas pequeñas */
        .table .d-md-table-cell {
            display: table-cell !important;
        }
    }
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
    <!--<script src="../assets/js/pages/w-chart.js"></script> -->
    <!-- [Page Specific JS] end -->
    

  </body>
  <!-- [Body] end -->
</html>

<?php

?>