  <?php
include('db.php'); // Incluye la conexión a la base de datos
session_start();

// Realizamos la consulta a la base de datos
$query = "SELECT u.id, u.nombre, u.apellido, u.telefono, u.correo, u.acceso, u.idTipoPlan as plan, u.idRol as rol ,
s.peso, s.altura, s.objetivo, s.suscripcion, s.comidas, s.enfermedades, s.estres_soluciones, 
s.sentimientos_alimentacion, s.trabajo, s.ejercicio, s.dias_entrenamiento, s.intensidad, s.estado, s.fecha_envio
          FROM usuarios u
          LEFT JOIN solicitudes s ON u.id = s.id";
$result = $conexion->query($query);

// Verificamos si la consulta fue exitosa
if ($result && $result->num_rows > 0) {
    // Convertimos los resultados a un array asociativo
    $usuarios = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $usuarios = []; // Si no hay usuarios
}

// Verificamos si existe el parámetro 'mensaje' en la URL
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
include('../forms/UsuarioClass.php');

$usuario = new Usuario($conexion);
$datosUsuario = $usuario->obtenerPorId($_SESSION['IdUsuario']);


$sql = "SELECT n.Titulo, n.descripcion, pu.pregunta
        FROM notificaciones n
        JOIN preguntasusuarios pu ON n.idpregunta = pu.idpregunta
        WHERE n.IdUsuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $_SESSION['IdUsuario']);
$stmt->execute();
$resultadoNotificaciones = $stmt->get_result();


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
<html lang="es">
  <!-- [Head] start -->

  <head>
    <title>Panel de Administración - Team Ori</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link
  href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.css"
  rel="stylesheet"
/>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

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
<!--<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">-->

<style>
        /* Estilos personalizados */
        body {
            background-color: #f4f4f9;
            padding: 20px;
        }
        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-edit {
            background-color: #AB76FF;
            color: white;
        }
        .form-check-input {
            width: 40px;
            height: 20px;
        }
        
    </style>
<!--Para que aparezca la imagen al hacer hover al video -->
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
          <a href="#" class="pc-link">
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
        <!-- [ Header ] start -->
        <div class="header text-center py-3">
            <h1>Panel de Administración</h1>
        </div>
        <!-- [ Header ] end -->

        <!-- Barra de Navegación -->
        <div class="nav-wrapper mb-4">
    <ul class="nav nav-pills justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" id="usuarios-tab" data-bs-toggle="pill" href="#usuarios" role="tab">Gestión de Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="solicitudes-tab" data-bs-toggle="pill" href="#solicitudes" role="tab">Gestión de Solicitudes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="solicitudes-ej-tab" data-bs-toggle="pill" href="#solicitudes-ej" role="tab">Solicitudes Ejercicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="videos-tab"data-bs-toggle="pill" href="#videos" role="tab">Videos Entrenamiento</a>
        </li>
    </ul>
</div>


<!-- Modal para Videos de Entrenamiento -->
<?php

$query = "SELECT
  v.IdVideo,
  v.Nombre,
  v.Descripcion,
  v.URL,
  v.idGrupoEnfoque,
  ge.Grupo,
  v.idGrupoMuscular,
  gm.Grupo_Muscular,
  v.idDireccion,
  d.Direccion,
  v.idDificultad,
  dif.Dificultad,
  v.idLugar,
  l.Lugar,
  v.idSexo,
  s.Sexo,
  GROUP_CONCAT(e.Equipamiento ORDER BY e.Equipamiento SEPARATOR ', ') AS Equipamientos,
  GROUP_CONCAT(e.IdEquipamiento ORDER BY e.IdEquipamiento SEPARATOR ',') AS EquipamientoIds
FROM videos v
  JOIN Sexo s ON v.idSexo = s.idSexo
  JOIN grupo_muscular gm ON v.idGrupoMuscular = gm.IdGrupoMuscular
  JOIN grupo_enfoque ge ON v.idGrupoEnfoque = ge.IdGrupo
  JOIN direccion d ON v.idDireccion = d.IdDireccion
  JOIN dificultad dif ON v.idDificultad = dif.IdDificultad
  JOIN lugar l ON v.idLugar = l.idLugar
  LEFT JOIN video_equipamiento ve ON v.IdVideo = ve.idVideo
  LEFT JOIN equipamiento e ON ve.idEquipamiento = e.IdEquipamiento
GROUP BY
  v.IdVideo, v.Nombre, v.Descripcion, v.URL,
  v.idGrupoEnfoque, ge.Grupo,
  v.idGrupoMuscular, gm.Grupo_Muscular,
  v.idDireccion, d.Direccion,
  v.idDificultad, dif.Dificultad,
  v.idLugar, l.Lugar,
  v.idSexo, s.Sexo
ORDER BY v.IdVideo ASC";



$result = $conexion->query($query);

// Verificamos si la consulta fue exitosa
if ($result && $result->num_rows > 0) {
    // Convertimos los resultados a un array asociativo
    $videos = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $videos = []; // Si no hay videos
}

?>

</div>
    <hr>
     <!-- Contenido de la página -->
     <div class="container mt-4">
    <!-- Pestañas -->
    <div class="tab-content">
        <div class="tab-pane fade " id="videos" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th colspan="9" style="background-color: #f8f9fa; font-size: 1.5rem; border: none;">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                                    <!-- Buscador -->
                                    <div class="mb-2 mb-md-0">
                                        <label for="videoSearch" class="form-label" style="font-size: 1rem;">Buscador</label>
                                        <input type="text" class="form-control form-control-sm" id="videoSearch" placeholder="Buscar por nombre, correo..." style="width: 200px;">
                                    </div>

                                    <!-- Título -->
                                    <div class="text-center mb-2 mb-md-0">Gestión de videos</div>

                                    <!-- Botón Agregar Usuario -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#videosEntrenamientoModal">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        Agregar video
                                    </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th class="d-none d-md-table-cell">Descripcion</th>
                            <th>Enfoque</th>
                            <th class="d-none d-md-table-cell">Grupo Muscular</th>
                            <th>Equipamiento</th> <!-- NUEVA COLUMNA -->
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($videos as $video): ?>
                        <tr>
                            <td><?= $video['IdVideo'] ?></td>
                            <td class="video-cell">
                                <a href="<?= htmlspecialchars($video['URL'], ENT_QUOTES) ?>" target="_blank">
                                    <?= htmlspecialchars($video['Nombre'], ENT_QUOTES) ?>
                                </a>
                                <?php if ($id = getYoutubeId($video['URL'])): ?>
                                    <img
                                    class="thumbnail"
                                    src="https://img.youtube.com/vi/<?= $id ?>/hqdefault.jpg"
                                    alt="Portada de <?= htmlspecialchars($video['Nombre'], ENT_QUOTES) ?>"
                                    />
                                <?php endif; ?>
                            </td>
                            <td class="d-none d-md-table-cell limit-text"><?= $video['Descripcion'] ?></td>
                            <td><?= $video['Grupo'] ?></td>
                            <td class="d-none d-md-table-cell"><?= $video['Grupo_Muscular'] ?></td>
                            <td><?= $video['Equipamientos'] ?></td> <!-- Mostrar texto -->
                            <td>
                                <div class="d-flex flex-column flex-md-row justify-content-center gap-1">
                                    <button class="btn btn-sm btn-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModalVideos"
                                        data-idvideo="<?= $video['IdVideo'] ?>"
                                        data-nombre="<?= htmlspecialchars($video['Nombre']) ?>"
                                        data-descripcion="<?= htmlspecialchars($video['Descripcion']) ?>"
                                        data-grupoenfoque="<?= $video['idGrupoEnfoque'] ?>"
                                        data-grupomuscular="<?= $video['idGrupoMuscular'] ?>"
                                        data-sexo="<?= $video['idSexo'] ?>"
                                        data-url="<?= $video['URL'] ?>"
                                        data-equipamiento="<?= $video['EquipamientoIds'] ?>" 
                                        data-lugar="<?= $video['idLugar'] ?>"
                                        data-dificultad="<?= $video['idDificultad'] ?>"
                                        data-movimiento="<?= $video['idDireccion'] ?>">
                                        <img src="../assets/images/icons-tab/editar.png" alt="Editar" style="width: 16px; height: 16px;">
                                    </button>

                                    <form method="POST" action="borrar_video.php" style="display: inline;">
                                        <input type="hidden" name="IdVideo" value="<?= $video['IdVideo'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm w-100 w-md-auto" title="Eliminar Video">
                                            <img src="../assets/images/icons-tab/papelera.png" alt="Eliminar" style="width: 16px; height: 16px;">
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<style>
td.limit-text {
  max-width: 150px;       /* o el ancho que quieras */
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
</style>

<!--Modal de Agregar Video-->
<div class="modal fade" id="videosEntrenamientoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form method="POST" class="form" action="subir_video.php">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Agregar Video de Entrenamiento</h1>
                    </div>
<br>
                    <!-- Nombre -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Nombre del Video</span>
                        </label>
                        <input type="text" class="form-control form-control-solid" name="nombre" required>
                    </div>
<br>
                    <!-- Descripción -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Descripción</span>
                        </label>
                        <textarea class="form-control form-control-solid" rows="3" name="descripcion" required></textarea>
                    </div>
<br>
                    <!-- URL del Video -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Enlace del Video</span>
                        </label>
                        <input type="url" class="form-control form-control-solid" name="url" required>
                    </div>
<br>
                    <!-- Grupo Muscular -->
                     
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Grupo Muscular</span>
                        </label>
                        <select
                        id="nuevoGrupoMuscular"
                        name="grupo_muscular[]"
                        class="form-select form-select-solid"
                        multiple
                        required
                        placeholder="Elige uno o más grupos"
                        >
                        <option value="1">Glúteos</option>
                        <option value="2">Cuádriceps</option>
                        <option value="3">Isquiotibiales</option>
                        <option value="4">Abductores (glúteo medio)</option>
                        <option value="5">Aductores</option>
                        <option value="6">Core</option>
                        <option value="7">Espalda</option>
                        <option value="8">Pecho</option>
                        <option value="9">Hombros</option>
                        <option value="10">Bíceps</option>
                        <option value="11">Tríceps</option>
                        <option value="12">Gemelos</option>
                        <option value="13">Trapecio</option>
                        </select>
                    </div>
<br>    
                    <!-- Tipo de Moviento/direccion -->
                     
                    <div class="mb-8 fv-row">
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Movimiento/Dirección</span>
                    </label>
                    <select class="form-select form-select-solid" name="movimiento_direccion" required>
                        <option value="">Seleccione un movimiento...</option>
                        <optgroup label="Tren inferior">
                            <option value="1">Sentadilla (dominancia de rodilla)</option>
                            <option value="2">Bisagra (dominancia de cadera)</option>
                            <option value="3">Zancada</option>
                            <option value="4">Paso lateral</option>
                            <option value="5">Subida a banco</option>
                            <option value="6">Empuje de cadera</option>
                            <option value="7">Abducción / aducción</option>
                            <option value="8">Extensión de cadera (patada)</option>
                        </optgroup>
                        <optgroup label="Tren superior">
                            <option value="9">Empuje horizontal</option>
                            <option value="10">Empuje vertical</option>
                            <option value="11">Tracción horizontal</option>
                            <option value="12">Tracción vertical</option>
                        </optgroup>
                    </select>
                </div>

<br>
                    <!-- Equipamiento -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Equipamiento</span>
                        </label>
                        <select
                        id="nuevoEquipamiento"
                        name="equipamiento[]"
                        class="form-select form-select-solid"
                        multiple
                        required
                        placeholder="Elige uno o más equipos"
                        >
                        <option value="1">Ninguno (peso corporal)</option>
                        <option value="2">Mancuernas</option>
                        <option value="3">Bandas mini</option>
                        <option value="4">Pesa rusa</option>
                        <option value="5">Barra larga</option>
                        <option value="6">Discos</option>
                        <option value="7">Polea</option>
                        <option value="8">Banco</option>
                        <option value="9">Step o caja</option>
                        <option value="10">Colchoneta</option>
                        <option value="11">Máquinas de Gimnasio</option>
                        </select>
                    </div>

<br>
                    <!-- Lugar de Entrenamiento -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Lugar</span>
                        </label>
                        <select class="form-select form-select-solid" name="lugar" required>
                            <option value="">Seleccione un lugar...</option>
                            <option value="1">Gimnasio</option>
                            <option value="2">Casa</option>
                            <option value="3">Ambos</option>
                        </select>
                    </div>
<br>
                    <!-- Sexo -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Sexo</span>
                        </label>
                        <select class="form-select form-select-solid" name="sexo" required>
                            <option value="">Seleccione el sexo...</option>
                            <option value="1">Hombre</option>
                            <option value="2">Mujer</option>
                            <option value="3">Ambos</option>
                        </select>
                    </div>
<br>
                    <!-- Dificultad -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Dificultad</span>
                        </label>
                        <select class="form-select form-select-solid" name="dificultad" required>
                            <option value="">Seleccione una dificultad...</option>
                            <option value="1">Facil</option>
                            <option value="2">Medio</option>
                            <option value="3">Dificil</option>
                        </select>
                    </div>
<br>
                    
                        <!-- Grupo Ejercicio -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Grupo Enfoque</span>
                        </label>
                        <select class="form-select form-select-solid" name="grupo_enfoque" required>
                            <option value="">Seleccione un grupo...</option>
                            <option value="1">Gluteos</option>
                            <option value="2">Piernas</option>
                            <option value="3">Abdomen</option>
                            <option value="4">Tren Superior</option>
                            <option value="5">Full body</option>
                        </select>
                    </div>
<br>  
                    <!-- Botones -->
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Guardar Video</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        <!-- Modal de Edición -->
        <div class="modal fade" id="editModalVideos" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Pestañas -->
                        <ul class="nav nav-tabs" id="editTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab">Datos</button>
                            </li>
                        </ul>

                        <!-- Contenido de las pestañas -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="contact" role="tabpanel">
                                <!-- Formulario de Edición -->
                                <form action="editar_video.php" method="POST">
                                <input type="hidden" id="editIdVideo" name="IdVideo"><br>
                                <h4 style="text-align: center;">Datos del video</h4>
                                                <!-- Nombre -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Nombre del Video</span>
                        </label>
                        <input type="text" class="form-control form-control-solid" name="nombre" id="editNombreVideo" required>
                    </div>
<br>
                    <!-- Descripción -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Descripción</span>
                        </label>
                        <textarea class="form-control form-control-solid" rows="3" name="descripcion" id="editDescripcion" required></textarea>
                    </div>
<br>
                    <!-- URL del Video -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Enlace del Video</span>
                        </label>
                        <input type="url" class="form-control form-control-solid" name="url" id="editURL" required>
                    </div>
<br>
                    <!-- Grupo Muscular -->
                    <div class="mb-3">
                        <label for="editGrupoMuscular" class="form-label fw-semibold">
                        Grupo Muscular
                        </label>
                        <select id="editGrupoMuscular" name="grupo_muscular[]" class="form-select form-select-solid" multiple required placeholder="Seleccione uno o más grupos">
                        <option value="1">Glúteos</option>
                        <option value="2">Cuádriceps</option>
                        <option value="3">Isquiotibiales</option>
                        <option value="4">Abductores (glúteo medio)</option>
                        <option value="5">Aductores</option>
                        <option value="6">Core</option>
                        <option value="7">Espalda</option>
                        <option value="8">Pecho</option>
                        <option value="9">Hombros</option>
                        <option value="10">Bíceps</option>
                        <option value="11">Tríceps</option>
                        <option value="12">Gemelos</option>
                        <option value="13">Trapecio</option>
                        </select>
                    </div>

<br>    
                    <!-- Tipo de Moviento/direccion -->
                     
                    <div class="mb-8 fv-row">
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Movimiento/Dirección</span>
                    </label>
                    <select class="form-select form-select-solid" name="movimiento_direccion" id="editMovimiento" required>
                        <option value="">Seleccione un movimiento...</option>
                        <optgroup label="Tren inferior">
                            <option value="1">Sentadilla (dominancia de rodilla)</option>
                            <option value="2">Bisagra (dominancia de cadera)</option>
                            <option value="3">Zancada</option>
                            <option value="4">Paso lateral</option>
                            <option value="5">Subida a banco</option>
                            <option value="6">Empuje de cadera</option>
                            <option value="7">Abducción / aducción</option>
                            <option value="8">Extensión de cadera (patada)</option>
                        </optgroup>
                        <optgroup label="Tren superior">
                            <option value="9">Empuje horizontal</option>
                            <option value="10">Empuje vertical</option>
                            <option value="11">Tracción horizontal</option>
                            <option value="12">Tracción vertical</option>
                        </optgroup>
                    </select>
                </div>

<br>
                <div class="mb-3">
                    <label for="editEquipamiento" class="form-label fw-semibold">
                    Equipamiento 
                    </label>
                    <select id="editEquipamiento" name="equipamiento[]" class="form-select form-select-solid" multiple required placeholder="Seleccione uno o más equipos">
                    <option value="1">Mancuernas</option>
                    <option value="2">Barra olímpica</option>
                    <option value="3">Kettlebell</option>
                    <option value="4">Bandas elásticas</option>
                    <option value="5">Banco plano/inclinado</option>
                    <option value="6">Stepper</option>
                    <option value="7">Cuerda para saltar</option>
                    <option value="8">Máquina de poleas</option>
                    <option value="9">Swiss Ball</option>
                    <option value="10">Rodillo de espuma</option>
                    </select>
                </div>
<br>
                    <!-- Lugar de Entrenamiento -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Lugar</span>
                        </label>
                        <select class="form-select form-select-solid" name="lugar" id="editLugar" required>
                            <option value="">Seleccione un lugar...</option>
                            <option value="1">Gimnasio</option>
                            <option value="2">Casa</option>
                            <option value="3">Ambos</option>
                        </select>
                    </div>
<br>
                    <!-- Sexo -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Sexo</span>
                        </label>
                        <select class="form-select form-select-solid" name="sexo" id="editSexo" required>
                            <option value="">Seleccione el sexo...</option>
                            <option value="1">Hombre</option>
                            <option value="2">Mujer</option>
                            <option value="3">Ambos</option>
                        </select>
                    </div>
<br>
                    <!-- Dificultad -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Dificultad</span>
                        </label>
                        <select class="form-select form-select-solid" name="dificultad" id="editDificultad" required>
                            <option value="">Seleccione una dificultad...</option>
                            <option value="1">Facil</option>
                            <option value="2">Medio</option>
                            <option value="3">Dificil</option>
                        </select>
                    </div>
<br>
                    
                        <!-- Grupo Ejercicio -->
                    <div class="mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Grupo Enfoque</span>
                        </label>
                        <select class="form-select form-select-solid" name="grupo_enfoque" id="editGrupoEnfoque" required>
                            <option value="">Seleccione un grupo...</option>
                            <option value="1">Gluteos</option>
                            <option value="2">Piernas</option>
                            <option value="3">Abdomen</option>
                            <option value="4">Tren Superior</option>
                            <option value="5">Full body</option>
                        </select>
                    </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
    <hr>
     <!-- Contenido de la página -->
     <div class="container mt-4">
    <!-- Pestañas -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="usuarios" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th colspan="9" style="background-color: #f8f9fa; font-size: 1.5rem; border: none;">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                                    <!-- Buscador -->
                                    <div class="mb-2 mb-md-0">
                                        <label for="userSearch" class="form-label" style="font-size: 1rem;">Buscador</label>
                                        <input type="text" class="form-control form-control-sm" id="userSearch" placeholder="Buscar por nombre, correo..." style="width: 200px;">
                                    </div>

                                    <!-- Título -->
                                    <div class="text-center mb-2 mb-md-0">Gestión de Usuarios</div>

                                    <!-- Botón Agregar Usuario -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                        <img src="../assets/images/icons-tab/añadir.png" alt="añadir" style="height: 20px; width: 20px; margin-right: 5px;">
                                        Agregar usuario
                                    </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th class="d-none d-md-table-cell">Apellidos</th>
                            <th>Teléfono</th>
                            <th class="d-none d-md-table-cell">Correo</th>
                            <th>Acceso</th>
                            <th class="d-none d-lg-table-cell">Plan</th>
                            <th class="d-none d-lg-table-cell">Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?php echo $usuario['id']; ?></td>
                                <td><?php echo $usuario['nombre']; ?></td>
                                <td class="d-none d-md-table-cell"><?php echo $usuario['apellido']; ?></td>
                                <td><?php echo $usuario['telefono']; ?></td>
                                <td class="d-none d-md-table-cell"><?php echo $usuario['correo']; ?></td>
                                <td><?php echo ($usuario['acceso'] == 1 ? 'Habilitado' : 'Deshabilitado'); ?></td>
                                <td class="d-none d-lg-table-cell"><?php echo ($usuario['plan'] == 1 ? 'Solo Nutricional' : ($usuario['plan'] == 2 ? 'Solo Entrenamiento' : 'Nutricional y Entrenamiento')); ?></td>
                                <td class="d-none d-lg-table-cell"><?php echo ($usuario['rol'] == 1 ? 'Usuario' : ($usuario['rol'] == 2 ? 'Administrador' : ($usuario['rol'] == 3 ? 'Especialista en Entrenamiento' : ($usuario['rol'] == 4 ? 'Especialista en Nutrición' : 'Rol Desconocido')))); ?></td>
                                <td>
                                    <div class="d-flex flex-column flex-md-row justify-content-center gap-1">
                                    <button class="btn btn-sm btn-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal"
                                        data-id="<?= $usuario['id'] ?>"
                                        data-nombre="<?= $usuario['nombre'] ?>"
                                        data-apellido="<?= $usuario['apellido'] ?>"
                                        data-telefono="<?= $usuario['telefono'] ?>"
                                        data-correo="<?= $usuario['correo'] ?>"
                                        data-acceso="<?= $usuario['acceso'] ?>"
                                        data-plan="<?= $usuario['plan'] ?>"
                                        data-rol="<?= $usuario['rol'] ?>">
                                          <img src="../assets/images/icons-tab/editar.png" alt="Editar" style="width: 16px; height: 16px;">
                                      </button>

                                        <form method="POST" action="borrar_usuario.php" style="display: inline;">
                                            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm w-100 w-md-auto" title="Eliminar Usuario">
                                                <img src="../assets/images/icons-tab/papelera.png" alt="Eliminar" style="width: 16px; height: 16px;">
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div><!-- Modal para agregar usuario -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_user.php" method="POST">
                  
                    <h4 class="text-center">Datos de Contacto</h4>

                    <div class="mb-3">
                        <label for="addNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="addNombre" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="addApellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="addApellido" name="apellido" required>
                    </div>

                    <div class="mb-3">
                        <label for="addTelefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="addTelefono" name="telefono" required>
                    </div>

                    <div class="mb-3">
                        <label for="addCorreo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="addCorreo" name="correo" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Acceso</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="addAcceso" name="acceso" value="permitido">
                            <label class="form-check-label" for="addAcceso">Habilitado</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="addPlan" class="form-label">Plan</label>
                        <select class="form-select" id="addPlan" name="plan" required>
                            <option value="" disabled selected>Selecciona un plan</option>
                            <option value="1">Solo nutricional</option>
                            <option value="2">Solo entrenamiento</option>
                            <option value="3">Nutricional y mixto</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="addRol" class="form-label">Rol</label>
                        <select class="form-select" id="addRol" name="rol" required>
                            <option value="" disabled selected>Selecciona un rol</option>
                            <option value="1">Usuario</option>
                            <option value="2">Administrador</option>
                            <option value="3">Especialista en entrenamiento</option>
                            <option value="4">Especialista en nutrición</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Añadir Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        <!-- Modal de Edición -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar ficha</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Pestañas -->
                        <ul class="nav nav-tabs" id="editTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab">Datos</button>
                            </li>
                        </ul>

                        <!-- Contenido de las pestañas -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="contact" role="tabpanel">
                                <!-- Formulario de Edición -->
                                <form action="update_user.php" method="POST">
                                <input type="hidden" id="editId" name="id"><br>
                                <h4 style="text-align: center;">Datos de Contacto</h4>

                                <div class="mb-3">
                                    <label for="editNombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="editNombre" name="nombre">
                                </div>

                                <div class="mb-3">
                                    <label for="editApellido" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="editApellido" name="apellido">
                                </div>

                                <div class="mb-3">
                                    <label for="editTelefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="editTelefono" name="telefono">
                                </div>

                                <div class="mb-3">
                                    <label for="editCorreo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="editCorreo" name="correo">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Acceso</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="editAcceso" name="acceso" value="permitido">
                                        <label class="form-check-label" for="editAcceso">Habilitado</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="editPlan" class="form-label">Plan</label>
                                    <select class="form-select" id="editPlan" name="plan">
                                        <option value="1">Solo Nutricional</option>
                                        <option value="2">Solo Entrenamiento</option>
                                        <option value="3">Nutricional y Mixto</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="editRol" class="form-label">Rol</label>
                                    <select class="form-select" id="editRol" name="rol">
                                        <option value="1">Usuario</option>
                                        <option value="2">Administrador</option>
                                        <option value="3">Especialista en Entrenamiento</option>
                                        <option value="4">Especialista en Nutrición</option>
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Pestañas -->
<div class="tab-content">
    <div class="tab-pane fade" id="solicitudes" role="tabpanel"><br>
    <style>
    .solicitud-card {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 10px;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: flex-start; /* Alinea el contenido a la izquierda */
        height: 120px;
        width: 907px; /* Aseguramos que el ancho se mantenga constante */
        margin-left: 110px;
    }

    .solicitud-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }
    .solicitud-card.pendiente {
        background: linear-gradient(to right, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)); /* Degradado cálido y semitransparente */
        border-left: 5px solid yellow;
    }
    .solicitud-card.aprobada {
        background-color: #e0f7e9;
        background: linear-gradient(to right, rgb(255, 255, 255),rgb(255, 255, 255));
        border-left: 5px solid green;
    }

    .solicitud-card.denegada {
        background-color: #fce4e4;
        background: linear-gradient(to right, rgb(255, 255, 255),rgb(250, 247, 247));
        border-left: 5px solid red;
        width: 907px;
        margin-left: 110px;
        padding: 10px;
    }

    /* Estilos del avatar */
    .avatar {
        width: 60px; /* Tamaño del avatar */
        height: 60px;
        background-color: #ffffff;
        color: #fff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        font-size: 18px;
        margin-right: 15px;
        background-size: cover;
        background-position: center;
        margin-left: 10px; /* Mueve el avatar a la izquierda */
    }

    .solicitud-info {
        flex-grow: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .solicitud-info p {
        margin: 0 10px;
        font-size: 14px;
        color: #333;
    }

    /* Estilo del estado */
    .estado {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        margin-left: auto;
    }

    .modal-solicitudes {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(255, 255, 255, 0.5);
    }

    /* Estilo del contenido del modal */
    .modal-solicitudes-content {
        background-color:rgb(255, 255, 255);
        margin: 5% auto;
        padding: 20px;
        border-radius: 8px;
        width: 40%; 
        max-width: 800px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        position: relative;
        margin-left: 620px;
        margin-top: 200px;
           }
        .modal-content h2 {
        color: #000000;
        text-align: center;
        margin-bottom: 20px;
    }

    .modal-solicitudes-content .modal-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    .modal-solicitudes-content .modal-row strong {
        color: #000000;
        width: 40%; 
        text-align: left;
    }

    .modal-solicitudes-content .modal-row span {
        color: #000000;
        width: 35%; 
        text-align: right;
    }
    button {
        padding: 8px 16px;
        cursor: pointer;
        border-radius: 5px;
        border: none;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    

    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 35px;
        cursor: pointer;
        color: #333;
    }

    .close:hover {
        color: #f44336;
    }

    button {
        padding: 8px 16px; /* Reducción del tamaño de los botones */
        cursor: pointer;
        border-radius: 5px;
        border: none;
        font-size: 14px; /* Tamaño de fuente reducido */
        transition: background-color 0.3s;
    }

    .soli {
        font-weight: bold;
        color: #333;
    }

    .fecha, .hora {
        font-weight: bold;
        color: #555;
    }

    .botones-filtrado {
        display: flex; /* Usa flexbox para alinear elementos */
        gap: 10px; /* Espaciado entre los botones */
        margin: 20px 0; /* Margen superior e inferior para separarlos */
        justify-content: flex-start; /* Alinea los elementos a la izquierda */
        margin-left: 60px; /* Ajustar el margen izquierdo para centrar */
    }

    .botones-filtrado button {
        background-color: #4680FF; /* Azul sólido */
        color: white; /* Texto blanco */
        padding: 8px 16px; /* Espaciado interno más pequeño */
        border: none; /* Sin borde */
        border-radius: 50px; /* Totalmente redondeados */
        font-size: 12px; /* Tamaño del texto más pequeño */
        cursor: pointer; /* Cursor de puntero al pasar */
        transition: background-color 0.3s, transform 0.2s; /* Transiciones suaves */
    }


    .botones-filtrado button:hover {
        background-color: #3A6FD9; /* Azul más oscuro al pasar el ratón */
        transform: scale(1.05); /* Ligero aumento de tamaño */
    }

    #buscador-solis {
        width: 350px;
        font-size: 14px;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s ease;
        margin-left: 200px;
        
        }
       .contenedor-filtrado {
        display: flex; /* Usa flexbox para alinear los elementos */
        gap: 10px; /* Espaciado entre los elementos */
        align-items: center; /* Alinea verticalmente los elementos */
        margin-top: 30px;
        margin-left: 80px;
    }

    .labelb{
      font-size: 1rem;
      margin-right: -194px;
    }
      
      
    .botonessolis:hover {  
      transform: scale(1.1);  /* Aumentar ligeramente el tamaño al pasar el ratón */
    }
</style>
<style>
/* Media Queries para Responsive */
@media (max-width: 768px) {
    .solicitud-card {
        width: 90% !important;
        margin-left: auto !important;
        margin-right: auto !important;
        height: auto;
        flex-direction: column;
        padding: 15px;
    }

    .avatar {
        margin: 0 auto 10px;
    }

    .solicitud-info {
        flex-direction: column;
        text-align: center;
    }

    .solicitud-info p {
        margin: 5px 0;
    }

    .modal-solicitudes-content {
        width: 90% !important;
        margin: 20px auto !important;
        padding: 15px;
    }

    .contenedor-filtrado {
        flex-direction: column;
        margin-left: 15px !important;
        margin-top: 15px;
    }

    #buscador-solis {
        width: 90% !important;
        margin-left: 0 !important;
    }

    .botones-filtrado {
        flex-wrap: wrap;
        justify-content: center;
        margin-left: 0 !important;
    }

    .botones-filtrado button {
        width: 45%;
        margin: 5px;
        padding: 10px;
        font-size: 12px;
    }

    .modal-row {
        flex-direction: column;
        align-items: flex-start;
    }

    .modal-row strong,
    .modal-row span {
        width: 100% !important;
        text-align: left !important;
    }

    .botonessolis {
        width: 100%;
        margin: 5px 0 !important;
        padding: 12px !important;
    }
}

/* Modificaciones adicionales para mejor responsive */
.solicitud-card {
    max-width: 907px;
    width: 100%;
}

.modal-solicitudes-content {
    max-width: 400px;
    margin: 2% auto;
}

.contenedor-filtrado {
    flex-wrap: wrap;
    gap: 15px;
}

#buscador-solis {
    max-width: 350px;
    width: 100%;
}

.botones-filtrado button {
    flex: 1 1 150px;
}

/* Añadir esto para mejor visualización en móviles */
@media (max-width: 480px) {
    .solicitud-card.pendiente,
    .solicitud-card.aprobada,
    .solicitud-card.denegada {
        width: 95% !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }

    .modal-solicitudes-content {
        margin-top: 50px !important;
    }

    .botones-filtrado button {
        width: 100%;
    }
    
    .solicitud-info p {
        font-size: 12px;
    }
    
    .avatar {
        width: 50px;
        height: 50px;
    }
}
.modal-solicitudes {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.4);
    z-index: 9999;
}

.modal-solicitudes-content {
    background-color: #fff;
    margin: 2% auto;
    padding: 20px;
    width: 80%;
    max-width: 700px;
    border-radius: 10px;
    position: relative;
}

/* Añadir viewport meta tag en el head de tu HTML (si no lo tienes) */
</style>

<style>
.nutrition-input {
    width: 100%;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px;
    text-align: center;
    font-size: 0.9rem;
    background: #f8f9fa;
    transition: all 0.3s ease;
    -moz-appearance: textfield;
}

.nutrition-input::-webkit-outer-spin-button,
.nutrition-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.plan-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
}

.plan-table th {
    background: #ffffff;
    padding: 12px;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #dee2e6;
}

.plan-table td {
    padding: 5px;
}

/* Responsive para móviles */
@media (max-width: 767px) {
    .table-responsive {
        margin: 0 -15px;
        width: calc(100% + 30px);
    }
    
    .nutrition-input {
        padding: 8px;
        font-size: 0.8rem;
    }
    
    .plan-table th {
        font-size: 0.9rem;
        padding: 8px;
    }
    
    .plan-table td {
        min-width: 80px;
    }
}

/* En el CSS existente agrega */
.modal-tabs {
    display: flex;
    justify-content: center !important;
    margin: 20px 0;
}

.nav-pills .nav-link {
    padding: 8px 25px;
    margin: 0 5px;
    border-radius: 25px;
    transition: all 0.3s;
}

/* Modifica el contenedor de la pestaña del plan */
.tab-pane {
    padding: 15px 0;
}

</style>
<style>
/* [1] Corrección de posición de botones */
.botones-plan {
    display: flex;
    justify-content: flex-end;
}

.btn-editar-plan, .btn-guardar-plan {
    padding: 10px 25px;
    border-radius: 25px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-editar-plan {
    display: block;
    background: #4680FF;
    color: white;
}

.btn-guardar-plan {
    display: none;
    background: #4CAF50;
    color: white;
}
</style>
<h2 style="text-align: center;">Gestión de Solicitudes</h2>
    <br>
    
    <div class="contenedor-filtrado">
        <label for="buscador-solis" class="labelb">Buscador</label>
        <input type="text" class="form-control form-control-sm" id="buscador-solis" 
               onkeyup="buscarSolicitudes()" placeholder="Buscar por nombre, email..." 
               style="width: 200px; margin-bottom: 0;">
        
        <div class="botones-filtrado">
            <button id="btn-pendientes">Solicitudes Pendientes</button>
            <button id="btn-aprobadas">Solicitudes Aprobadas</button>
            <button id="btn-denegadas">Solicitudes Denegadas</button>
            <button id="btn-todas">Todas</button>
        </div>
    </div>

    <?php
    include 'db.php';
    
    try {
        $sql = "SELECT id, nombre, peso, altura, genero, ejercicio, edad, email, objetivo, 
                suscripcion, comidas, estres_soluciones, enfermedades, sentimientos_alimentacion, 
                trabajo, dias_entrenamiento, intensidad, estado, fecha_envio 
                FROM solicitudes";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            echo '<div style="font-family: Arial, sans-serif; margin: 20px;"><br>';
            echo '<div style="display: flex; flex-direction: column; gap: 15px;">';

            while ($row = $result->fetch_assoc()) {
                $estadoClass = match($row['estado']) {
                    'aprobada' => 'aprobada',
                    'denegada' => 'denegada',
                    default => 'pendiente'
                };

                // Determinar avatar
                $avatarImg = match(strtolower($row['genero'])) {
                  'hombre' => '../assets/images/user/avatar-1.jpg',
                  'mujer'  => '../assets/images/user/avatar-10.jpg',
                  default   => (function() use ($row) {
                      $nombreParts = explode(' ', $row['nombre']);
                      $initials = strtoupper(($nombreParts[0][0] ?? '') . ($nombreParts[1][0] ?? ''));
                      return 'data:image/svg+xml;base64,' . base64_encode(
                          '<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120">
                              <circle cx="60" cy="60" r="55" fill="#4CAF50"/>
                              <text x="50%" y="50%" alignment-baseline="middle" text-anchor="middle" 
                                    font-size="40" fill="white">'.$initials.'</text>
                          </svg>'
                      );
                  })(),
              };

                ?>
<script>
// Funciones para controlar modales
// Agrega este código en el script principal de la página
function abrirModal(id) {
    document.getElementById(`modal-${id}`).style.display = 'block';
}

function cerrarModal(id) {
    document.getElementById(`modal-${id}`).style.display = 'none';
}

// Cerrar al hacer clic fuera del modal
window.onclick = function(event) {
    if (event.target.classList.contains('modal-solicitudes')) {
        event.target.style.display = 'none';
    }
};
</script>

                <!-- Tarjeta de solicitud -->
                <div class="solicitud-card <?= $estadoClass ?>" onclick="abrirModal(<?= $row['id'] ?>)">
                    <div class="avatar" style="background-image: url('<?= $avatarImg ?>')"></div>
                    <div class="solicitud-info">
                        <p class="soli"><strong>Solicitud para plan personalizado</strong>
                        <?php if (!empty($row['fecha_envio'])) : 
                            $fecha = new DateTime($row['fecha_envio']); ?>
                            <p class="fecha"><strong>Fecha:</strong> <?= $fecha->format('d/m/Y h:i A') ?></p>
                        <?php else : ?>
                            <p class="fecha"><strong>Fecha de Envío:</strong> No disponible</p>
                        <?php endif; ?>
                        <p><strong>Nombre</strong> <?= htmlspecialchars($row['nombre']) ?></p>
                        <p><strong>Email</strong> <?= htmlspecialchars($row['email']) ?></p>
                        <p><strong>Género</strong> <?= htmlspecialchars($row['genero']) ?></p>
                        <p><strong>Solicitud</strong> <?= htmlspecialchars($row['estado']) ?></p>
                        <hr>
                        <p class="soli2">Ver detalles</p>
                    </div>
                </div>

                <!-- Modal -->
                <!-- *************** MODAL PARA CADA SOLICITUD *************** -->
<div class="modal-solicitudes" id="modal-<?= $row['id'] ?>">
    <div class="modal-solicitudes-content">
        
        <!-- BOTÓN CERRAR -->
        <span class="close" onclick="cerrarModal(<?= $row['id'] ?>)">&times;</span>
        
        <!-- ******** PESTAÑAS CON BOOTSTRAP ******** -->
          <ul class="nav nav-pills modal-tabs">
              <li class="nav-item">
                  <a class="nav-link active" 
                    id="detalles-tab-<?= $row['id'] ?>" 
                    data-bs-toggle="pill" 
                    href="#detalles-<?= $row['id'] ?>" 
                    role="tab">
                      Detalles
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" 
                    id="plan-tab-<?= $row['id'] ?>" 
                    data-bs-toggle="pill" 
                    href="#plan-<?= $row['id'] ?>" 
                    role="tab">
                      Plan Nutricional
                  </a>
              </li>
          </ul>
        <!-- ******** CONTENIDO PESTAÑAS ******** -->
        <div class="tab-content">
            
            <!-- PESTAÑA 1: DETALLES DE LA SOLICITUD -->
            <div class="tab-pane fade show active" id="detalles-<?= $row['id'] ?>" role="tabpanel" aria-labelledby="detalles-tab-<?= $row['id'] ?>">
              <h2 class="modal-title">Solicitud Completa</h2>
                
                <?php 
                // Campos de datos estáticos
                $modalFields = [
                    'Nombre completo'    => $row['nombre'],
                    'Edad'               => $row['edad'],
                    'Correo Electrónico' => $row['email'],
                    'Peso (kg)'          => $row['peso'] . ' kg',
                    'Altura (cm)'        => $row['altura'] . ' cm',
                    'Objetivo'           => $row['objetivo'],
                    'Suscripción'        => $row['suscripcion'],
                    'Comidas diarias'    => $row['comidas'],
                    'Soluciones buscadas'=> $row['estres_soluciones'],
                    'Enfermedades'       => $row['enfermedades'],
                    'Sentimientos alimentación' => $row['sentimientos_alimentacion'],
                    'Tipo de trabajo'    => $row['trabajo'],
                    'Ejercicio físico'   => $row['ejercicio'],
                    'Días de entrenamiento' => $row['dias_entrenamiento'],
                    'Intensidad'        => $row['intensidad']
                ];
                
                foreach ($modalFields as $label => $value) : ?>
                <div class="modal-row">
                    <strong><?= $label ?></strong>
                    <span><?= htmlspecialchars($value) ?></span>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- PESTAÑA 2: PLAN NUTRICIONAL -->
            <div class="tab-pane fade" id="plan-<?= $row['id'] ?>" role="tabpanel" aria-labelledby="plan-tab-<?= $row['id'] ?>">
            <form method="POST" action="guardar_plan.php" id="form-plan-<?= htmlspecialchars($row['id']) ?>">
    <!-- Campos ocultos para datos principales -->
    <input type="hidden" name="solicitud_id" value="<?= $row['id'] ?>">
    <input type="hidden" name="calorias" id="hiddenCalorias" value="<?= $plan['calorias'] ?? '' ?>">
    <input type="hidden" name="proteinas" id="hiddenProteinas" value="<?= $plan['proteinas'] ?? '' ?>">
    <input type="hidden" name="grasas" id="hiddenGrasas" value="<?= $plan['grasas'] ?? '' ?>">
    <input type="hidden" name="carbohidratos" id="hiddenCarbohidratos" value="<?= $plan['carbohidratos'] ?? '' ?>">

    <!-- Sección de macros -->
    <div class="table-responsive">
        <table class="plan-table">
            <thead>
                <tr>
                    <th>Calorías</th>
                    <th>Proteínas (g)</th>
                    <th>Grasas (g)</th>
                    <th>Carbohidratos (g)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $planQuery = "SELECT * FROM resumen_planes 
                            WHERE solicitud_id = ".$row['id']."
                            ORDER BY fecha_calculo DESC 
                            LIMIT 1";
                $planResult = $conexion->query($planQuery);
                
                if($planResult && $planResult->num_rows > 0): 
                    $plan = $planResult->fetch_assoc();
                ?>
                <tr>
                    <td><input type="number" name="calorias" value="<?= $plan['calorias'] ?>" class="nutrition-input" readonly></td>
                    <td><input type="number" name="proteinas" value="<?= $plan['proteinas'] ?>" class="nutrition-input" readonly></td>
                    <td><input type="number" name="grasas" value="<?= $plan['grasas'] ?>" class="nutrition-input" readonly></td>
                    <td><input type="number" name="carbohidratos" value="<?= $plan['carbohidratos'] ?>" class="nutrition-input" readonly></td>
                </tr>
                <?php else: ?>
                <tr>
                    <td colspan="4" class="text-muted">No hay datos de plan nutricional</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Sección de ingredientes -->
    <div class="ingredientes-container mb-4">
        <h4>Ingredientes del Plan</h4>
        <div class="ingredientes-list">
            <?php
            $index = 0;
            $ingredientesQuery = "SELECT pn.idIngrediente, i.Nombre, pn.porcion, pn.tiempo_comida 
                                FROM planes_nutricionales pn
                                JOIN ingredientes i ON pn.idIngrediente = i.IdIngrediente
                                WHERE pn.solicitud_id = ".$row['id'];
            $ingredientesResult = $conexion->query($ingredientesQuery);
            
            if($ingredientesResult && $ingredientesResult->num_rows > 0):
                while($ing = $ingredientesResult->fetch_assoc()): 
            ?>
            <div class="ingrediente-item mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <input type="hidden" name="ingredientes[<?= $index ?>][id]" value="<?= $ing['idIngrediente'] ?>">
                        <select class="form-select" disabled>
                            <option value="<?= $ing['idIngrediente'] ?>" selected>
                                <?= htmlspecialchars($ing['Nombre']) ?>
                            </option>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <input type="number" 
                            name="ingredientes[<?= $index ?>][porcion]" 
                            value="<?= $ing['porcion'] ?>" 
                            class="form-control" 
                            min="1" 
                            step="1"
                            placeholder="Gramos"
                            disabled>
                    </div>
                    
                    <div class="col-md-3">
                        <select name="ingredientes[<?= $index ?>][tiempo_comida]" class="form-select" disabled>
                            <option value="desayuno" <?= $ing['tiempo_comida'] == 'desayuno' ? 'selected' : '' ?>>Desayuno</option>
                            <option value="almuerzo" <?= $ing['tiempo_comida'] == 'almuerzo' ? 'selected' : '' ?>>Almuerzo</option>
                            <option value="cena" <?= $ing['tiempo_comida'] == 'cena' ? 'selected' : '' ?>>Cena</option>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                    <button type="button" 
                        class="btn btn-danger btn-sm btn-eliminar-ingrediente" 
                        onclick="this.closest('.ingrediente-item').remove()"
                        disabled>
                            <img src="../assets/images/icons-tab/papelera.png" alt="Eliminar">
                        </button>
                    </div>
                </div>
            </div>
            <?php 
                $index++;
                endwhile;
            else:
            ?>
            <div class="alert alert-info">No hay ingredientes registrados</div>
            <?php endif; ?>
        </div>
        
        <!-- Nuevo ingrediente -->
        <div class="nuevo-ingrediente mt-3">
            <div class="row g-2">
                <div class="col-md-4">
                    <select class="form-select" id="select-ingrediente-<?= $row['id'] ?>">
                        <option value="">Seleccionar ingrediente...</option>
                        <?php
                        $allIngredients = $conexion->query("SELECT * FROM ingredientes");
                        while($ing = $allIngredients->fetch_assoc()): 
                        ?>
                        <option value="<?= $ing['IdIngrediente'] ?>">
                            <?= htmlspecialchars($ing['Nombre']) ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <select class="form-select" id="nuevo-tiempo-comida-<?= $row['id'] ?>">
                        <option value="desayuno">Desayuno</option>
                        <option value="almuerzo">Almuerzo</option>
                        <option value="cena">Cena</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <button type="button" class="btn btn-success btn-sm" 
                        onclick="agregarIngrediente(<?= $row['id'] ?>)">
                        <img src="../assets/images/icons-tab/añadir.png" alt="Agregar">
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="botones-plan">
        <button type="button" 
                onclick="habilitarEdicion(<?= $row['id'] ?>)" 
                class="btn-editar-plan"
                id="btn-editar-<?= $row['id'] ?>">
            ✏️ Editar Plan
        </button>            
        <button type="submit" 
                class="btn-guardar-plan"
                id="btn-guardar-<?= $row['id'] ?>"
                style="display: none;">
            💾 Guardar Cambios
        </button>
    </div>
</form>
                        </div>
</div>

        <!-- ******** ACCIONES FINALES ******** -->
        <div class="modal-footer">
          <div class="acciones-container w-100">
              <div class="row g-2">
                  <!-- Aprobar y Denegar -->
                  <div class="col-12 col-md-6">
                      <form method="POST" action="aprobar_o_denegar.php" class="h-100">
                          <input type="hidden" name="id" value="<?= $row['id'] ?>">
                          <button class="boton-accion aprobar w-100 h-100" type="submit" name="accion" value="aprobar">
                              <img src="../assets/images/icons-tab/aprobar.png" alt="aprobar">
                              Aprobar
                          </button>
                      </form>
                  </div>
                  <div class="col-12 col-md-6">
                      <form method="POST" action="aprobar_o_denegar.php" class="h-100">
                          <input type="hidden" name="id" value="<?= $row['id'] ?>">
                          <button class="boton-accion denegar w-100 h-100" type="submit" name="accion" value="denegar">
                              <img src="../assets/images/icons-tab/rechazado.png" alt="denegar">
                              Denegar
                          </button>
                      </form>
                  </div>
                  
                  <!-- Borrar (siempre full width) -->
                  <div class="col-12 mt-2">
                      <form method="POST" action="borrar_solicitud.php" class="h-100">
                          <input type="hidden" name="id" value="<?= $row['id'] ?>">
                          <button class="boton-accion borrar w-100 h-100" type="submit">
                              <img src="../assets/images/icons-tab/papeleraa.png" alt="borrar">
                              Borrar
                          </button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>
                <?php
            }
            echo '</div></div>';
        }
    } catch (Exception $e) {
        echo "<p>Error al mostrar las solicitudes: " . $e->getMessage() . "</p>";
    }
    ?>
</div>
    </div>
</div>

<div class="tab-pane fade" id="solicitudes-ej" role="tabpanel"><br>
    <div class="contenedor-filtrado">
        <label for="buscador-solis-ej" class="labelb">Buscador</label>
        <input type="text" class="form-control form-control-sm" id="buscador-solis-ej"
               onkeyup="buscarSolicitudesEjercicios()" placeholder="Buscar por nombre, email..."
               style="width: 200px; margin-bottom: 0;">

        <div class="botones-filtrado">
            <button id="btn-pendientes-ej">Solicitudes Pendientes</button>
            <button id="btn-aprobadas-ej">Solicitudes Aprobadas</button>
            <button id="btn-denegadas-ej">Solicitudes Denegadas</button>
            <button id="btn-todas-ej">Todas</button>
        </div>
    </div>

    <?php
    try {
        $sqlEj = "SELECT id, nombre, edad, email, peso, altura, genero, objetivo, suscripcion, trabajo,
                    ejercicio, diasEntrenamiento, intensidad, nivel, lesiones, dias_disponibles,
                    lugar_entrenamiento, preferencias, estado, fecha_envio
                  FROM solicitudes_ejercicios";
        $resultEj = $conexion->query($sqlEj);

        if ($resultEj->num_rows > 0) {
            echo '<div style="font-family: Arial, sans-serif; margin: 20px;"><br>';
            echo '<div style="display: flex; flex-direction: column; gap: 15px;">';

            while ($row = $resultEj->fetch_assoc()) {
                $estadoClass = match($row['estado']) {
                    'aprobada' => 'aprobada',
                    'denegada' => 'denegada',
                    default => 'pendiente'
                };

                $avatarImg = match(strtolower($row['genero'])) {
                  'hombre' => '../assets/images/user/avatar-1.jpg',
                  'mujer'  => '../assets/images/user/avatar-10.jpg',
                  default   => (function() use ($row) {
                      $nombreParts = explode(' ', $row['nombre']);
                      $initials = strtoupper(($nombreParts[0][0] ?? '') . ($nombreParts[1][0] ?? ''));
                      return 'data:image/svg+xml;base64,' . base64_encode(
                          '<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120">'
                          .'<circle cx="60" cy="60" r="55" fill="#4CAF50"/>'
                          .'<text x="50%" y="50%" alignment-baseline="middle" text-anchor="middle" font-size="40" fill="white">'.$initials.'</text>'
                          .'</svg>'
                      );
                  })(),
                };
                ?>
                <div class="solicitud-card <?= $estadoClass ?>" onclick="abrirModal('ej-<?= $row['id'] ?>')">
                    <div class="avatar" style="background-image: url('<?= $avatarImg ?>')"></div>
                    <div class="solicitud-info">
                        <p class="soli"><strong>Solicitud de entrenamiento</strong></p>
                        <?php if (!empty($row['fecha_envio'])) :
                            $fecha = new DateTime($row['fecha_envio']); ?>
                            <p class="fecha"><strong>Fecha:</strong> <?= $fecha->format('d/m/Y h:i A') ?></p>
                        <?php else : ?>
                            <p class="fecha"><strong>Fecha de Envío:</strong> No disponible</p>
                        <?php endif; ?>
                        <p><strong>Nombre</strong> <?= htmlspecialchars($row['nombre']) ?></p>
                        <p><strong>Email</strong> <?= htmlspecialchars($row['email']) ?></p>
                        <p><strong>Género</strong> <?= htmlspecialchars($row['genero']) ?></p>
                        <p><strong>Solicitud</strong> <?= htmlspecialchars($row['estado']) ?></p>
                        <hr>
                        <p class="soli2">Ver detalles</p>
                    </div>
                </div>

                <div class="modal-solicitudes" id="modal-ej-<?= $row['id'] ?>">
                    <div class="modal-solicitudes-content">
                        <span class="close" onclick="cerrarModal('ej-<?= $row['id'] ?>')">&times;</span>
                        <ul class="nav nav-pills modal-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="detalles-ej-tab-<?= $row['id'] ?>" data-bs-toggle="pill" href="#detalles-ej-<?= $row['id'] ?>" role="tab">Detalles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="plan-ej-tab-<?= $row['id'] ?>" data-bs-toggle="pill" href="#plan-ej-<?= $row['id'] ?>" role="tab">Plan de Entrenamiento</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="detalles-ej-<?= $row['id'] ?>" role="tabpanel" aria-labelledby="detalles-ej-tab-<?= $row['id'] ?>">
                                <?php
                                $modalFields = [
                                    'Nombre completo' => $row['nombre'],
                                    'Edad' => $row['edad'],
                                    'Correo Electrónico' => $row['email'],
                                    'Peso (kg)' => $row['peso'].' kg',
                                    'Altura (cm)' => $row['altura'].' cm',
                                    'Objetivo' => $row['objetivo'],
                                    'Suscripción' => $row['suscripcion'],
                                    'Trabajo' => $row['trabajo'],
                                    'Ejercicio actual' => $row['ejercicio'],
                                    'Días de entrenamiento' => $row['diasEntrenamiento'],
                                    'Intensidad' => $row['intensidad'],
                                    'Nivel' => $row['nivel'],
                                    'Lesiones' => $row['lesiones'],
                                    'Días disponibles' => $row['dias_disponibles'],
                                    'Lugar de entrenamiento' => $row['lugar_entrenamiento'],
                                    'Preferencias' => $row['preferencias']
                                ];
                                foreach ($modalFields as $label => $value) : ?>
                                    <div class="modal-row">
                                        <strong><?= $label ?></strong>
                                        <span><?= htmlspecialchars($value) ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="tab-pane fade" id="plan-ej-<?= $row['id'] ?>" role="tabpanel" aria-labelledby="plan-ej-tab-<?= $row['id'] ?>">
                                <?php
                                $planQuery = "SELECT rr.*, ge.Grupo AS Enfoque, r.tiempo_disponible, r.dias_disponible "
                                    . "FROM resumen_rutinas rr "
                                    . "JOIN grupo_enfoque ge ON rr.idEnfoque = ge.IdGrupo "
                                    . "JOIN rutina r ON rr.idRutina = r.IdRutina "
                                    . "WHERE rr.idSolicitud = " . $row['id'] . " "
                                    . "ORDER BY rr.fecha_calculo DESC LIMIT 1";
                                $planResult = $conexion->query($planQuery);
                                if ($planResult && $planResult->num_rows > 0):
                                    $plan = $planResult->fetch_assoc();
                                    ?>
                                    <div class="modal-row">
                                        <strong>Fecha de cálculo</strong>
                                        <span><?= (new DateTime($plan['fecha_calculo']))->format('d/m/Y') ?></span>
                                    </div>
                                    <div class="modal-row">
                                        <strong>Enfoque</strong>
                                        <span><?= htmlspecialchars($plan['Enfoque']) ?></span>
                                    </div>
                                    <div class="modal-row">
                                        <strong>Días disponibles</strong>
                                        <span><?= $plan['dias_disponible'] ?></span>
                                    </div>
                                    <div class="modal-row">
                                        <strong>Tiempo disponible</strong>
                                        <span><?= $plan['tiempo_disponible'] ?> min</span>
                                    </div>
                                    <hr>
                                    <?php
                                    $ejerciciosQuery = "SELECT re.dia, v.Nombre "
                                        . "FROM rutina_ejercicio re "
                                        . "JOIN videos v ON re.idVideo = v.IdVideo "
                                        . "WHERE re.idRutina = " . $plan['idRutina'] . " "
                                        . "ORDER BY re.dia, re.orden";
                                    $ejResult = $conexion->query($ejerciciosQuery);
                                    $dias = [];
                                    if ($ejResult) {
                                        while ($ej = $ejResult->fetch_assoc()) {
                                            $dias[$ej['dia']][] = $ej['Nombre'];
                                        }
                                    }
                                    if (!empty($dias)) {
                                        foreach ($dias as $dia => $lista): ?>
                                            <div class="modal-row">
                                                <strong>Día <?= $dia ?></strong>
                                                <span><?= implode(', ', $lista) ?></span>
                                            </div>
                                        <?php endforeach;
                                    } else {
                                        echo '<div class="alert alert-info">No hay ejercicios asociados</div>';
                                    }
                                <?php
                                else:
                                    echo '<div class="alert alert-info">No hay plan registrado</div>';
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            echo '</div></div>';
        }
    } catch (Exception $e) {
        echo "<p>Error al mostrar las solicitudes: " . $e->getMessage() . "</p>";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const cfg = {
      plugins: ['remove_button'],  // permite la "×" para quitar ítems
      maxItems: null,              // sin límite
      create: false,               // NO permite crear nuevos ítems
      dropdownDirection: 'auto'
    };
    new TomSelect('#nuevoGrupoMuscular', {
      ...cfg,
      placeholder: 'Elige uno o más grupos'
    });
    new TomSelect('#nuevoEquipamiento', {
      ...cfg,
      placeholder: 'Elige uno o más equipos'
    });
  });
</script>
<script>
// Función para manejar el cambio de pestañas
function cambiarPestana(evt, tabName) {
    const tabContents = document.querySelectorAll('.tab-content');
    const tabLinks = document.querySelectorAll('.modal-tab');
    
    tabContents.forEach(content => content.classList.remove('active'));
    tabLinks.forEach(link => link.classList.remove('active'));
    
    evt.currentTarget.classList.add('active');
    document.getElementById(tabName).classList.add('active');
}

function habilitarEdicion(solicitudId) {
    const formId = `form-plan-${solicitudId}`;
    const form = document.getElementById(formId);

    if (!form) {
        console.error(`Formulario ${formId} no encontrado. Verificar:`);
        console.log('IDs de formularios existentes:', 
            [...document.querySelectorAll('form')].map(f => f.id)
        );
        return;
    }

    // Habilitar todos los campos editables
    const elementosEditables = form.querySelectorAll(`
        input[readonly], 
        select[disabled], 
        .btn-eliminar-ingrediente
    `);

    elementosEditables.forEach(elemento => {
        if (elemento.hasAttribute('readonly')) elemento.removeAttribute('readonly');
        if (elemento.disabled) elemento.disabled = false;
        elemento.style.backgroundColor = '#fff';
    });

    // Actualizar visibilidad de botones
    document.getElementById(`btn-editar-${solicitudId}`).style.display = 'none';
    document.getElementById(`btn-guardar-${solicitudId}`).style.display = 'block';
}
function agregarIngrediente(solicitudId) {
    const select = document.querySelector(`#select-ingrediente-${solicitudId}`);
    const tiempo = document.querySelector(`#nuevo-tiempo-comida-${solicitudId}`);
    const ingredientesList = document.querySelector(`.ingredientes-list`);
    
    if(select.value) {
        const nuevoIndex = document.querySelectorAll('.ingrediente-item').length;
        const nombreIngrediente = select.options[select.selectedIndex].text;
        
        const nuevoIngrediente = `
        <div class="ingrediente-item mb-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <input type="hidden" name="ingredientes[${nuevoIndex}][id]" value="${select.value}">
                    <select class="form-select" disabled>
                        <option value="${select.value}" selected>${nombreIngrediente}</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <input type="number" 
                        name="ingredientes[${nuevoIndex}][porcion]" 
                        value="100" 
                        class="form-control" 
                        min="1" 
                        step="1"
                        placeholder="Gramos">
                </div>
                
                <div class="col-md-3">
                    <select name="ingredientes[${nuevoIndex}][tiempo_comida]" class="form-select">
                        ${tiempo.innerHTML}
                    </select>
                </div>
                
                <div class="col-md-2">
                <button type="button" 
                        class="btn btn-danger btn-sm btn-eliminar-ingrediente" 
                        onclick="this.closest('.ingrediente-item').remove()">
                        <img src="../assets/images/icons-tab/papelera.png" alt="Eliminar">
                    </button>
                </div>
            </div>
        </div>`;
        
        ingredientesList.insertAdjacentHTML('beforeend', nuevoIngrediente);
        select.value = '';
    }
}

// Habilitar todos los campos antes de enviar
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function() {
        this.querySelectorAll('input, select, button').forEach(element => {
            element.disabled = false;
        });
    });
});
</script>
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
  <script>
 function buscarSolicitudes() {
    let input = document.getElementById('buscador-solis'); // Obtener el campo de búsqueda
    let filtro = input.value.toLowerCase(); // Convertir a minúsculas para búsqueda sin distinción
    let solicitudes = document.querySelectorAll('.solicitud-card'); // Seleccionar todas las tarjetas

    solicitudes.forEach(function(solicitud) {
        // Obtener todo el texto visible dentro de la tarjeta (nombre, correo, etc.)
        let texto = solicitud.textContent.toLowerCase();

        // Mostrar solo las tarjetas que incluyan el texto buscado
        if (texto.includes(filtro)) {
            solicitud.style.display = 'flex'; // Mostrar
        } else {
            solicitud.style.display = 'none'; // Ocultar
        }
    });
}
</script>
 <script>
    function toggleCards(state) {
        const cards = document.querySelectorAll('.solicitud-card');

        cards.forEach(card => {
            // Mostrar todas las tarjetas si el estado es 'todas'
            if (state === 'todas') {
                card.style.display = 'flex';
            } 
            // Filtrar por estado específico
            else if (state === 'pendiente' && card.classList.contains('pendiente')) {
                card.style.display = 'flex';
            } else if (state === 'aprobada' && card.classList.contains('aprobada')) {
                card.style.display = 'flex';
            } else if (state === 'denegada' && card.classList.contains('denegada')) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Eventos para cada botón
    document.getElementById('btn-pendientes').addEventListener('click', function() {
        toggleCards('pendiente');
    });

    document.getElementById('btn-aprobadas').addEventListener('click', function() {
        toggleCards('aprobada');
    });

    document.getElementById('btn-denegadas').addEventListener('click', function() {
        toggleCards('denegada');
    });

    // Botón para mostrar todas las solicitudes
    document.getElementById('btn-todas').addEventListener('click', function() {
        toggleCards('todas');
    });
</script>
<script>
function buscarSolicitudesEjercicios() {
    let input = document.getElementById('buscador-solis-ej');
    let filtro = input.value.toLowerCase();
    let solicitudes = document.querySelectorAll('#solicitudes-ej .solicitud-card');

    solicitudes.forEach(function(solicitud) {
        let texto = solicitud.textContent.toLowerCase();
        solicitud.style.display = texto.includes(filtro) ? 'flex' : 'none';
    });
}

function toggleCardsEjercicios(state) {
    const cards = document.querySelectorAll('#solicitudes-ej .solicitud-card');

    cards.forEach(card => {
        if (state === 'todas') {
            card.style.display = 'flex';
        } else if (state === 'pendiente' && card.classList.contains('pendiente')) {
            card.style.display = 'flex';
        } else if (state === 'aprobada' && card.classList.contains('aprobada')) {
            card.style.display = 'flex';
        } else if (state === 'denegada' && card.classList.contains('denegada')) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

document.getElementById('btn-pendientes-ej').addEventListener('click', function() {
    toggleCardsEjercicios('pendiente');
});

document.getElementById('btn-aprobadas-ej').addEventListener('click', function() {
    toggleCardsEjercicios('aprobada');
});

document.getElementById('btn-denegadas-ej').addEventListener('click', function() {
    toggleCardsEjercicios('denegada');
});

document.getElementById('btn-todas-ej').addEventListener('click', function() {
    toggleCardsEjercicios('todas');
});
</script>
<script>

// Función para cambiar pestañas dentro de cada modal
function cambiarPestana(evt, tabName, modalId) {
    const modal = document.getElementById(`modal-${modalId}`);
    const tabContents = modal.querySelectorAll('.tab-content');
    const tabLinks = modal.querySelectorAll('.modal-tab');
    
    tabContents.forEach(content => content.classList.remove('active'));
    tabLinks.forEach(link => link.classList.remove('active'));
    
    evt.currentTarget.classList.add('active');
    modal.querySelector(`#${tabName}`).classList.add('active');
}
</script>
 <script>
    // Este script se ejecutará cuando el modal se abra
    
    const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        
        // Obtener datos del botón
        const acceso = parseInt(button.dataset.acceso) === 1;
        const plan = button.dataset.plan;
        const rol = button.dataset.rol;

        // Asignar valores a los campos del formulario
        editModal.querySelector('#editId').value = button.dataset.id;
        editModal.querySelector('#editNombre').value = button.dataset.nombre;
        editModal.querySelector('#editApellido').value = button.dataset.apellido;
        editModal.querySelector('#editTelefono').value = button.dataset.telefono;
        editModal.querySelector('#editCorreo').value = button.dataset.correo;
        editModal.querySelector('#editAcceso').checked = acceso;
        
        // Seleccionar opciones en los combos
        editModal.querySelector('#editPlan').value = plan;
        editModal.querySelector('#editRol').value = rol;
    });
</script>
<script>
    // Este script se ejecutará cuando el modal se abra
    // Declaramos las instancias globales
let tsGrupo, tsEquip;

document.addEventListener('DOMContentLoaded', () => {
  // Inicializamos Tom Select y guardamos las instancias
  const baseConfig = {
    plugins: ['remove_button'],
    maxItems: null,
    dropdownDirection: 'auto'
  };
  tsEquip = new TomSelect('#editEquipamiento', {
    ...baseConfig,
    placeholder: 'Seleccione uno o más equipos'
  });
  tsGrupo = new TomSelect('#editGrupoMuscular', {
    ...baseConfig,
    placeholder: 'Seleccione uno o más grupos'
  });

  // Ahora el listener del modal
  const editModalV = document.getElementById('editModalVideos');
  editModalV.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    
    // Campos simples (inputs, selects normales)
    editModalV.querySelector('#editIdVideo').value       = button.dataset.idvideo;
    editModalV.querySelector('#editNombreVideo').value   = button.dataset.nombre;
    editModalV.querySelector('#editDescripcion').value   = button.dataset.descripcion;
    editModalV.querySelector('#editSexo').value          = button.dataset.sexo;
    editModalV.querySelector('#editGrupoEnfoque').value  = button.dataset.grupoenfoque;
    editModalV.querySelector('#editLugar').value         = button.dataset.lugar;
    editModalV.querySelector('#editURL').value           = button.dataset.url;
    editModalV.querySelector('#editDificultad').value    = button.dataset.dificultad;
    editModalV.querySelector('#editMovimiento').value    = button.dataset.movimiento;

    // Para Tom Select: grupo muscular
    const grp = button.dataset.grupomuscular
      ? button.dataset.grupomuscular.split(',').map(v => v.trim())
      : [];
    tsGrupo.clear(true);      // limpia selección anterior
    tsGrupo.setValue(grp);    // marca las opciones preseleccionadas

    // Para Tom Select: equipamiento
    const eq = button.dataset.equipamiento
      ? button.dataset.equipamiento.split(',').map(v => v.trim())
      : [];
    tsEquip.clear(true);
    tsEquip.setValue(eq);
  });
});

</script> 
<script>
document.getElementById('userSearch').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#usuarios tbody tr');
    
    rows.forEach(row => {
        const cells = row.getElementsByTagName('td');
        let rowMatches = false;
        
        // Iterar sobre las celdas para ver si alguna coincide con el término de búsqueda
        for (let i = 0; i < cells.length; i++) {
            if (cells[i].textContent.toLowerCase().includes(searchTerm)) {
                rowMatches = true;
                break;
            }
        }
        
        // Mostrar u ocultar la fila según si coincide o no
        row.style.display = rowMatches ? '' : 'none';
    });
});
</script>
<script>
document.getElementById('videoSearch').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#videos tbody tr');
    
    rows.forEach(row => {
        const cells = row.getElementsByTagName('td');
        let rowMatches = false;
        
        // Iterar sobre las celdas para ver si alguna coincide con el término de búsqueda
        for (let i = 0; i < cells.length; i++) {
            if (cells[i].textContent.toLowerCase().includes(searchTerm)) {
                rowMatches = true;
                break;
            }
        }
        
        // Mostrar u ocultar la fila según si coincide o no
        row.style.display = rowMatches ? '' : 'none';
    });
});
</script>
<script>
window.onload = function () {
    // Obtener el fragmento de la URL
    const hash = window.location.hash;

    // Verifica si el fragmento corresponde a alguna pestaña
    if (hash) {
        const tab = document.querySelector(`a[href="${hash}"]`);
        if (tab) {
            // Activa la pestaña usando Bootstrap
            const tabInstance = new bootstrap.Tab(tab);
            tabInstance.show();
        }
    }
};
</script>
<script src="../assets/js/plugins/popper.min.js"></script>
<script src="../assets/js/plugins/simplebar.min.js"></script>
<script src="../assets/js/plugins/bootstrap.min.js"></script>
<script src="../assets/js/fonts/custom-font.js"></script>
<script src="../assets/js/pcoded.js"></script>
<script src="../assets/js/plugins/feather.min.js"></script>
<div class="floting-button">
</div>

<script>
  layout_change('light');
</script>
  <!--
<script>
  change_box_container('false');
</script>
-->
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

<script>
    /*
  const edicionPlan=document.getElementById("edicionPlanNutricional");

  edicionPlan.addEventListener('submit',function(){
    
  })
*/
  async function guardarPlan(data) {
    try {
        const response = await fetch('guardar_plan.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        
        const resultado = await response.json();
        
        if (resultado.success) {
            console.log('Éxito:', resultado.message);
            // Actualizar la UI aquí
        } else {
            console.error('Error:', resultado.message);
        }
    } catch (error) {
        console.error('Error de red:', error);
    }
}
</script>

<!-- JS de Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- JS de Bootstrap-Select -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0/dist/js/bootstrap-select.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Activa bootstrap-select sobre tu <select>
    $('.selectpicker').selectpicker();
  });
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


                  