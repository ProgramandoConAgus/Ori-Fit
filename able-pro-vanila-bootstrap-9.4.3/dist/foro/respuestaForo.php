<?php
session_start();
$IdUsuario = $_SESSION['IdUsuario'];
require_once __DIR__.'/../db.php';
include('../forms/UsuarioClass.php');

$usuario = new Usuario($conexion);
$datosUsuario = $usuario->obtenerPorId($_SESSION['IdUsuario']);


$usuarioPreguntaId = filter_input(INPUT_GET, 'idpregunta', FILTER_VALIDATE_INT);
if (!$usuarioPreguntaId) {
    die("ID de pregunta no válido.");
}

// Preparamos la consulta para obtener la ID del usuario y la pregunta desde la tabla "preguntaUsuarios"
$stmt = $conexion->prepare("SELECT IdUsuario, pregunta FROM preguntasUsuarios WHERE IdPregunta = ?");
$stmt->bind_param("i", $usuarioPreguntaId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $idUsuario = $row['IdUsuario'];
    $pregunta  = $row['pregunta'];
    // Ahora puedes usar $idUsuario y $pregunta en tu formulario o lógica
} else {
    echo "No se encontró la pregunta con el ID especificado.";
}
?>
<!doctype html>
<html lang="es">
  <head>
    <title>Recomendaciones - Team Ori</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Página de recomendaciones de Team Ori." />
    <meta name="keywords" content="Recomendaciones, ACLARACIONES, TIPS, Team Ori" />
    <meta name="author" content="Team Ori" />

    <!-- Favicon -->
    <link rel="icon" href="../assets/images/LOGO SIN FONDO-02.png" type="image/x-icon" />

    <!-- Fuentes e íconos -->
    <link rel="stylesheet" href="../assets/fonts/inter/inter.css" id="main-font-link" />
    <link rel="stylesheet" href="../assets/fonts/phosphor/duotone/style.css" />
    <link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css" />
    <link rel="stylesheet" href="../assets/fonts/feather.css" />
    <link rel="stylesheet" href="../assets/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../assets/fonts/material.css" />

    <!-- CSS principal -->
    <link rel="stylesheet" href="../assets/css/style.css" id="main-style-link" />
    <link rel="stylesheet" href="../assets/css/style-preset.css" />
    <script src="../assets/js/tech-stack.js"></script>
  </head>
  <body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
    <!-- Pre-loader -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="pc-sidebar">
      <div class="navbar-wrapper">
        <div class="m-header">
          <a href="../pages/panel.php" class="b-brand text-primary">
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
                  <img src="../assets/images/icons-tab/icons9.png" alt="Panel de Administración">  
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
              <a href="recomendations.php" class="pc-link active">
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
          <h5 class="m-0">Notifications</h5>
          <a href="#!" class="btn btn-link btn-sm">Mark all read</a>
        </div>
        <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
          <p class="text-span">Today</p>
          <div class="card mb-2">
            <div class="card-body">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <svg class="pc-icon text-primary">
                    <use xlink:href="#custom-layer"></use>
                  </svg>
                </div>
                <div class="flex-grow-1 ms-3">
                  <span class="float-end text-sm text-muted">2 min ago</span>
                  <h5 class="text-body mb-2">UI/UX Design</h5>
                  <p class="mb-0"
                    >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                    type and scrambled it to make a type</p>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-2">
            <div class="card-body">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <svg class="pc-icon text-primary">
                    <use xlink:href="#custom-sms"></use>
                  </svg>
                </div>
                <div class="flex-grow-1 ms-3">
                  <span class="float-end text-sm text-muted">1 hour ago</span>
                  <h5 class="text-body mb-2">Message</h5>
                  <p class="mb-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</p>
                </div>
              </div>
            </div>
          </div>
          <p class="text-span">Yesterday</p>
          <div class="card mb-2">
            <div class="card-body">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <svg class="pc-icon text-primary">
                    <use xlink:href="#custom-document-text"></use>
                  </svg>
                </div>
                <div class="flex-grow-1 ms-3">
                  <span class="float-end text-sm text-muted">2 hour ago</span>
                  <h5 class="text-body mb-2">Forms</h5>
                  <p class="mb-0"
                    >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                    type and scrambled it to make a type</p>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-2">
            <div class="card-body">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <svg class="pc-icon text-primary">
                    <use xlink:href="#custom-user-bold"></use>
                  </svg>
                </div>
                <div class="flex-grow-1 ms-3">
                  <span class="float-end text-sm text-muted">12 hour ago</span>
                  <h5 class="text-body mb-2">Challenge invitation</h5>
                  <p class="mb-2"><span class="text-dark">Jonny aber</span> invites to join the challenge</p>
                  <button class="btn btn-sm btn-outline-secondary me-2">Decline</button>
                  <button class="btn btn-sm btn-primary">Accept</button>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-2">
            <div class="card-body">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <svg class="pc-icon text-primary">
                    <use xlink:href="#custom-security-safe"></use>
                  </svg>
                </div>
                <div class="flex-grow-1 ms-3">
                  <span class="float-end text-sm text-muted">5 hour ago</span>
                  <h5 class="text-body mb-2">Security</h5>
                  <p class="mb-0"
                    >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                    type and scrambled it to make a type</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center py-2">
          <a href="#!" class="link-danger">Clear all Notifications</a>
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

    <!-- Main Content -->
    <div class="pc-container">
      <div class="pc-content">
        <div class="row">
          <div class="col-12">
            <div class="card">
            <div class="card-body">
                <!-- Formulario para notificar respuesta -->
                <h3 class="mb-4">Enviar Respuesta a Notificación</h3>
                <form id="notificacionForm">
                  <!-- Campo oculto con la ID del usuario (recibido vía GET) -->
                  <input type="hidden" name="idUsuario" value="<?= $idUsuario ?>">
                  <!-- Mostrar la pregunta del usuario -->
                  <div class="mb-3">
                    <label for="userQuestion" class="form-label">Pregunta del Usuario</label>
                    <textarea id="userQuestion" class="form-control" rows="3" readonly><?= htmlspecialchars($pregunta) ?></textarea>
                  </div>
                  <!-- Ingresar respuesta del admin -->
                  <div class="mb-3">
                    <label for="adminResponse" class="form-label">Respuesta del Administrador</label>
                    <textarea name="adminResponse" id="adminResponse" rows="4" class="form-control" placeholder="Escribe aquí la respuesta..." required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Enviar Respuesta</button>
                </form>
              </div>
              <div id="notificationAlert" class="mt-3"></div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="pc-footer">
      <div class="footer-wrapper container-fluid">
        <div class="row">
          <div class="col my-1">
            <p class="m-0">PCA - 2024</p>
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
                        <textarea class="form-control" 
                                  rows="3" 
                                  placeholder="Escribe tu pregunta aquí..."
                                  required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar pregunta</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- Scripts -->
    <script src="../assets/js/plugins/apexcharts.min.js"></script>
    <script src="../assets/js/pages/dashboard-default.js"></script>
    <script src="../assets/js/plugins/popper.min.js"></script>
    <script src="../assets/js/plugins/simplebar.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/fonts/custom-font.js"></script>
    <script src="../assets/js/pcoded.js"></script>
    <script src="../assets/js/plugins/feather.min.js"></script>
    <script>
      layout_change('light');
      change_box_container('false');
      layout_caption_change('true');
      layout_rtl_change('false');
      preset_change('preset-1');
      main_layout_change('vertical');
    </script>
<script>
document.getElementById('notificacionForm').addEventListener('submit', function(e) {
          e.preventDefault();
          const form = e.target;
          const submitBtn = form.querySelector('button[type="submit"]');
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Enviando...';
          const formData = new FormData(form);

          fetch('guardarNotificacion.php', {
              method: 'POST',
              body: formData
          })
          .then(response => {
              if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
              return response.json();
          })
          .then(data => {
              const alertContainer = document.getElementById('notificationAlert');
              const alertType = data.success ? 'success' : 'danger';
              const message = data.message || (data.success ? 'Respuesta enviada correctamente.' : 'Error al enviar la respuesta.');
              alertContainer.innerHTML = `<div class="alert alert-${alertType}" role="alert">${message}</div>`;
              if (data.success) {
                  form.reset();
              }
          })
          .catch(error => {
              document.getElementById('notificationAlert').innerHTML = `<div class="alert alert-danger" role="alert">Error de conexión: ${error.message}</div>`;
          })
          .finally(() => {
              submitBtn.disabled = false;
              submitBtn.innerHTML = 'Enviar Respuesta';
          });
      });
    </script>
  </body>
</html>
