<?php
include('db.php'); // Incluye la conexión a la base de datos


// Realizamos la consulta a la base de datos
$query = "SELECT u.id, u.nombre, u.apellido, u.edad, u.telefono, u.correo, u.acceso, s.peso, s.altura, s.objetivo, s.suscripcion, s.comidas, s.enfermedades, s.estres_soluciones, s.alimentos_excluidos, s.sentimientos_alimentacion, s.trabajo, s.ejercicio, s.dias_entrenamiento, s.intensidad, s.estado, s.fecha_envio
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
?>

<!doctype html>
<html lang="es">
  <!-- [Head] start -->

  <head>
    <title>Panel de Administración - Team Ori</title>
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
      <a href="../dashboard/index.html" class="b-brand text-primary">
        <!-- ========   Change your logo from here   ============ -->
        <img src="../assets/images/LOGO SIN FONDO-02.png" class="img-fluid" alt="logo" height="95px" width="95px"/>
        <span class="badge bg-light-success rounded-pill ms-2 theme-version">v1.0.0</span>
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
              <h6 class="mb-0">Oriana Cristiano</h6>
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
              <a href="../../widget/w_chart.php">
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
      <img src="..//assets/images/icons-tab/icons9.png" alt="Descripción de la imagen">  
    </span>
    <span class="pc-mtext" >Panel de Administración</span><br><br>
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
    <li class="pc-h-item d-none d-md-inline-flex">
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
        aria-expanded="false">
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
        aria-expanded="false">
        <svg class="pc-icon">
          <use xlink:href="#custom-setting-2"></use>
        </svg>
      </a>
      <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
        <a href="#!" class="dropdown-item">
          <i class="ti ti-user"></i>
          <span>My Account</span>
        </a>
        <a href="#!" class="dropdown-item">
          <i class="ti ti-settings"></i>
          <span>Settings</span>
        </a>
        <a href="#!" class="dropdown-item">
          <i class="ti ti-headset"></i>
          <span>Support</span>
        </a>
        <a href="#!" class="dropdown-item">
          <i class="ti ti-lock"></i>
          <span>Lock Screen</span>
        </a>
        <a href="#!" class="dropdown-item">
          <i class="ti ti-power"></i>
          <span>Logout</span>
        </a>
      </div>
    </li>
    <li class="pc-h-item">
      <a href="#" class="pc-head-link me-0" data-bs-toggle="offcanvas" data-bs-target="#announcement" aria-controls="announcement">
        <svg class="pc-icon">
          <use xlink:href="#custom-flash"></use>
        </svg>
      </a>
    </li>
    <li class="dropdown pc-h-item">
      <a
        class="pc-head-link dropdown-toggle arrow-none me-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        aria-expanded="false">
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
        aria-expanded="false"
      >
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
                <h6 class="mb-1">Carson Darrin 🖖</h6>
                <span>carson.darrin@company.io</span>
              </div>
            </div>
            <hr class="border-secondary border-opacity-50" />
            <div class="card">
              <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                  <h5 class="mb-0 d-inline-flex align-items-center"
                    ><svg class="pc-icon text-muted me-2">
                      <use xlink:href="#custom-notification-outline"></use></svg>Notification</h5>
                  <div class="form-check form-switch form-check-reverse m-0">
                    <input class="form-check-input f-18" type="checkbox" role="switch" />
                  </div>
                </div>
              </div>
            </div>
            <p class="text-span">Manage</p>
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-setting-outline"></use>
                </svg>
                <span>Settings</span>
              </span>
            </a>
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-share-bold"></use>
                </svg>
                <span>Share</span>
              </span>
            </a>
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-lock-outline"></use>
                </svg>
                <span>Change Password</span>
              </span>
            </a>
            <hr class="border-secondary border-opacity-50" />
            <p class="text-span">Team</p>
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-profile-2user-outline"></use>
                </svg>
                <span>UI Design team</span>
              </span>
              <div class="user-group">
                <img src="../assets/images/user/avatar-1.jpg" alt="user-image" class="avtar" />
                <span class="avtar bg-danger text-white">K</span>
                <span class="avtar bg-success text-white">
                  <svg class="pc-icon m-0">
                    <use xlink:href="#custom-user"></use>
                  </svg>
                </span>
                <span class="avtar bg-light-primary text-primary">+2</span>
              </div>
            </a>
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-profile-2user-outline"></use>
                </svg>
                <span>Friends Groups</span>
              </span>
              <div class="user-group">
                <img src="../assets/images/user/avatar-1.jpg" alt="user-image" class="avtar" />
                <span class="avtar bg-danger text-white">K</span>
                <span class="avtar bg-success text-white">
                  <svg class="pc-icon m-0">
                    <use xlink:href="#custom-user"></use>
                  </svg>
                </span>
              </div>
            </a>
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-add-outline"></use>
                </svg>
                <span>Add new</span>
              </span>
              <div class="user-group">
                <span class="avtar bg-primary text-white">
                  <svg class="pc-icon m-0">
                    <use xlink:href="#custom-add-outline"></use>
                  </svg>
                </span>
              </div>
            </a>
            <hr class="border-secondary border-opacity-50" />
            <div class="d-grid mb-3">
              <button class="btn btn-primary">
                <svg class="pc-icon me-2">
                  <use xlink:href="#custom-logout-1-outline"></use></svg>Logout
              </button>
            </div>
            <div
              class="card border-0 shadow-none drp-upgrade-card mb-0"
              style="background-image: url(../assets/images/layout/img-profile-card.jpg)">
              <div class="card-body">
                <div class="user-group">
                  <img src="../assets/images/user/avatar-1.jpg" alt="user-image" class="avtar" />
                  <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="avtar" />
                  <img src="../assets/images/user/avatar-3.jpg" alt="user-image" class="avtar" />
                  <img src="../assets/images/user/avatar-4.jpg" alt="user-image" class="avtar" />
                  <img src="../assets/images/user/avatar-5.jpg" alt="user-image" class="avtar" />
                  <span class="avtar bg-light-primary text-primary">+20</span>
                </div>
                <h3 class="my-3 text-dark">245.3k <small class="text-muted">Followers</small></h3>
                <a href="#" class="btn btn btn-warning buynowlinks">
                  <svg class="pc-icon me-2">
                    <use xlink:href="#custom-logout-1-outline"></use>
                  </svg>
                  Upgrade to Business
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </li>
  </ul>
</div>
 </div>
</header>
<div class="offcanvas pc-announcement-offcanvas offcanvas-end" tabindex="-1" id="announcement" aria-labelledby="announcementLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="announcementLabel">What's new announcement?</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p class="text-span">Today</p>
    <div class="card mb-3">
      <div class="card-body">
        <div class="align-items-center d-flex flex-wrap gap-2 mb-3">
          <div class="badge bg-light-success f-12">Big News</div>
          <p class="mb-0 text-muted">2 min ago</p>
          <span class="badge dot bg-warning"></span>
        </div>
        <h5 class="mb-3">Able Pro is Redesigned</h5>
        <p class="text-muted">Able Pro is completely renowed with high aesthetics User Interface.</p>
        <img src="../assets/images/layout/img-announcement-1.png" alt="img" class="img-fluid mb-3" />
        <div class="row">
          <div class="col-12">
            <div class="d-grid"
              ><a class="btn btn-outline-secondary" href="https://1.envato.market/zNkqj6" target="_blank">Check Now</a></div
            >
          </div>
        </div>
      </div>
    </div>
    <div class="card mb-3">
      <div class="card-body">
        <div class="align-items-center d-flex flex-wrap gap-2 mb-3">
          <div class="badge bg-light-warning f-12">Offer</div>
          <p class="mb-0 text-muted">2 hour ago</p>
          <span class="badge dot bg-warning"></span>
        </div>
        <h5 class="mb-3">Able Pro is in best offer price</h5>
        <p class="text-muted">Download Able Pro exclusive on themeforest with best price. </p>
        <a href="https://1.envato.market/zNkqj6" target="_blank"
          ><img src="../assets/images/layout/img-announcement-2.png" alt="img" class="img-fluid"
        /></a>
      </div>
    </div>

    <p class="text-span mt-4">Yesterday</p>
    <div class="card mb-3">
      <div class="card-body">
        <div class="align-items-center d-flex flex-wrap gap-2 mb-3">
          <div class="badge bg-light-primary f-12">Blog</div>
          <p class="mb-0 text-muted">12 hour ago</p>
          <span class="badge dot bg-warning"></span>
        </div>
        <h5 class="mb-3">Featured Dashboard Template</h5>
        <p class="text-muted">Do you know Able Pro is one of the featured dashboard template selected by Themeforest team.?</p>
        <img src="../assets/images/layout/img-announcement-3.png" alt="img" class="img-fluid" />
      </div>
    </div>
    <div class="card mb-3">
      <div class="card-body">
        <div class="align-items-center d-flex flex-wrap gap-2 mb-3">
          <div class="badge bg-light-primary f-12">Announcement</div>
          <p class="mb-0 text-muted">12 hour ago</p>
          <span class="badge dot bg-warning"></span>
        </div>
        <h5 class="mb-3">Buy Once - Get Free Updated lifetime</h5>
        <p class="text-muted">Get the lifetime free updates once you purchase the Able Pro.</p>
        <img src="../assets/images/layout/img-announcement-4.png" alt="img" class="img-fluid" />
      </div>
    </div>
  </div>
</div>
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
            </ul>
        </div>
    <hr>
     <!-- Contenido de la página -->
<div class="container mt-4">
    <!-- Pestañas -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="usuarios" role="tabpanel">
            <table class="table table-bordered text-center">
            <thead>
            <tr>
    <th colspan="8" style="background-color: #f8f9fa; font-size: 1.5rem; border: none;">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Buscador -->
            <div class="d-flex flex-column">
                <label for="userSearch" class="form-label" style="margin-bottom: 5px; font-size: 1rem;">Buscador</label>
                <input type="text" class="form-control form-control-sm" id="userSearch" placeholder="Buscar por nombre, correo..." style="width: 200px;">
            </div>

            <!-- Título -->
            <div style="font-size: 1.5rem;">Gestión de Usuarios</div>

            <!-- Botón Agregar Usuario -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal" style="background-color: white; color: black; border: 1px solid #ced4da;">
            <img src="../assets/images/icons-tab/añadir.png" alt="añadir" style="margin-right: 0px; height: 20px; width: 20px;">
             Agregar usuario
            </button>
        </div>
     </th>
          </tr>
                     <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Acceso</th>
                        <th>Acciones</th>
                    </tr>
          </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?php echo $usuario['id']; ?></td>
                                    <td><?php echo $usuario['nombre']; ?></td>
                                    <td><?php echo $usuario['apellido']; ?></td>
                                    <td><?php echo $usuario['edad']; ?></td>
                                    <td><?php echo $usuario['telefono']; ?></td>
                                    <td><?php echo $usuario['correo']; ?></td>
                                    <td><?php echo $usuario['acceso']; ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                            data-id="<?php echo $usuario['id']; ?>"
                                            data-nombre="<?php echo $usuario['nombre']; ?>"
                                            data-apellido="<?php echo $usuario['apellido']; ?>"
                                            data-edad="<?php echo $usuario['edad']; ?>"
                                            data-telefono="<?php echo $usuario['telefono']; ?>"
                                            data-correo="<?php echo $usuario['correo']; ?>"
                                            data-acceso="<?php echo ($usuario['acceso'] == 'Habilitado' ? 'Habilitado' : 'Deshabilitado'); ?>"
                                            data-peso="<?php echo $usuario['peso']; ?>"
                                            data-altura="<?php echo $usuario['altura']; ?>"
                                            data-objetivo="<?php echo $usuario['objetivo']; ?>"
                                            data-suscripcion="<?php echo $usuario['suscripcion']; ?>"
                                            data-comidas="<?php echo $usuario['comidas']; ?>"
                                            data-enfermedades="<?php echo $usuario['enfermedades']; ?>"
                                            data-estres_soluciones="<?php echo $usuario['estres_soluciones']; ?>"
                                            data-alimentos_excluidos="<?php echo $usuario['alimentos_excluidos']; ?>"
                                            data-sentimientos_alimentacion="<?php echo $usuario['sentimientos_alimentacion']; ?>"
                                            data-trabajo="<?php echo $usuario['trabajo']; ?>"
                                            data-ejercicio="<?php echo $usuario['ejercicio']; ?>"
                                            data-dias_entrenamiento="<?php echo $usuario['dias_entrenamiento']; ?>"
                                            data-intensidad="<?php echo $usuario['intensidad']; ?>"
                                            data-estado="<?php echo $usuario['estado']; ?>"
                                            data-fecha_envio="<?php echo $usuario['fecha_envio']; ?>"
                                            title="Editar Usuario">
                                            <img src="..//assets/images/icons-tab/editar.png" alt="Editar" style="width: 16px; height: 16px; margin-center; 5px; text-align: center;"></button>
                                            <form method="POST" action="borrar_usuario.php" style="display: inline;">
                                            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Usuario">
                                                <img src="../assets/images/icons-tab/papelera.png" alt="Eliminar" style="width: 16px; height: 16px; text-align: center;">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
          </div>
        <!-- Modal para agregar usuario -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-left: 130px; margin-top: 100px;">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_user.php" method="POST">
                    <h4 style="text-align: center;">Datos de Contacto</h4>
                    <div class="mb-3">
                        <label for="addNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="addNombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="addApellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="addApellido" name="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="addEdad" class="form-label">Edad</label>
                        <input type="number" class="form-control" id="addEdad" name="edad" required>
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
            <div class="modal-dialog">
                <div class="modal-content" style="margin-left: 130px; margin-top: 60px;">
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
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="form-tab" data-bs-toggle="tab" data-bs-target="#form" type="button" role="tab">Formulario</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nutrition-tab" data-bs-toggle="tab" data-bs-target="#nutrition" type="button" role="tab">P. Alimentación</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="exercise-tab" data-bs-toggle="tab" data-bs-target="#exercise" type="button" role="tab">P. Ejercicio</button>
                            </li>
                        </ul>

                        <!-- Contenido de las pestañas -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="contact" role="tabpanel">
                                <!-- Formulario de Edición -->
                                <form action="update_user.php" method="POST">
                                    <input type="hidden" id="editId" name="id"><br>
                                    <h4 style= "text-align: center;">Datos de Contacto</h4>
                                    <div class="mb-3">
                                        <label for="editNombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="editNombre" name="nombre">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editApellido" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" id="editApellido" name="apellido">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEdad" class="form-label">Edad</label>
                                        <input type="number" class="form-control" id="editEdad" name="edad">
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                            <!-- Formulario de Edición de Datos del Formulario -->
                            <div class="tab-pane fade" id="form" role="tabpanel">
                                <form action="update_formulario.php" method="POST">
                                <input type="hidden" name="id" id="editFormId"><br>
                                <h4 style= "text-align: center;">Respuestas del Formulario</h4>
                                    <div class="mb-3">
                                        <label for="editPeso" class="form-label">Peso (Kg)</label>
                                        <input type="number" class="form-control" id="editPeso" name="peso">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editAltura" class="form-label">Altura (Cm)</label>
                                        <input type="number" class="form-control" id="editAltura" name="altura">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editObjetivo" class="form-label">Objetivo</label>
                                        <input type="text" class="form-control" id="editObjetivo" name="objetivo">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editSuscripcion" class="form-label">¿Qué tipo de suscripción quiere?</label>
                                        <input type="text" class="form-control" id="editSuscripcion" name="suscripcion">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editComidas" class="form-label">¿Cuántas comidas al día quieres hacer?</label>
                                        <input type="text" class="form-control" id="editComidas" name="comidas">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEnfermedades" class="form-label">¿Tienes alguna enfermedad o condición médica?</label>
                                        <input type="text" class="form-control" id="editEnfermedades" name="enfermedades">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEstres_soluciones" class="form-label">Si tuvieses una situación de estrés/angustia. ¿Qué te ayuda a salir de eso?</label>
                                        <input type="text" class="form-control" id="editEstres_soluciones" name="estres_soluciones">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editAlimentos_excluidos" class="form-label">¿Hay algún alimento que no te guste o seas alérgico?</label>
                                        <input type="text" class="form-control" id="editAlimentos_excluidos" name="alimentos_excluidos">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editSentimientos_alimentacion" class="form-label">¿Cómo te sientes cuando comes?</label>
                                        <input type="text" class="form-control" id="editSentimientos_alimentacion" name="sentimientos_alimentacion">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editTrabajo" class="form-label">¿Tu trabajo es sedentario o activo?</label>
                                        <input type="text" class="form-control" id="editTrabajo" name="trabajo">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEjercicio" class="form-label">¿Sueles hacer ejercicio físico?</label>
                                        <input type="text" class="form-control" id="editEjercicio" name="ejercicio">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editDias_entrenamiento" class="form-label">¿Cuántos días a la semana entrenas? (1-7)</label>
                                        <input type="text" class="form-control" id="editDias_entrenamiento" name="dias_entrenamiento">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editIntensidad" class="form-label">¿Qué nivel de intensidad quieres en tu rutina de ejercicio? (1-6)</label>
                                        <input type="number" class="form-control" id="editIntensidad" name="intensidad">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEstado" class="form-label">Estado de la solicitud</label>
                                        <input type="text" class="form-control" id="editEstado" name="estado">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editFecha_envio" class="form-label">Fecha de envío</label>
                                        <input type="text" class="form-control" id="editFecha_envio" name="fecha_envio">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="nutrition" role="tabpanel">
                                <form action="" method="POST">
                                <input type="hidden" name="id" id="editPlanId"><br>
                                    <h4 style= "text-align: center;">Plan actual de Alimentación</h4>
                                    <div class="mb-3">
                                        <label for="editPorciones" class="form-label">Porciones</label>
                                        <input type="number" class="form-control" id="editPorciones" name="porciones">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editCalorias" class="form-label">Calorías</label>
                                        <input type="text" class="form-control" id="editCalorias" name="calorias">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editProteinas" class="form-label">Proteinas</label>
                                        <input type="text" class="form-control" id="editProteinas" name="proteinas">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editGrasas" class="form-label">Grasas</label>
                                        <input type="text" class="form-control" id="editGrasas" name="grasas">
                                    </div>   
                                    <div class="mb-3">
                                        <label for="editCarbohidratos" class="form-label">Carbohidratos</label>
                                        <input type="text" class="form-control" id="editCarbohidratos" name="carbohidratos">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editIngredientes" class="form-label">Ingredientes</label>
                                        <input type="text" class="form-control" id="editIngredientes" name="ingredientes">
                                    </div> 
                                    <div class="mb-3">
                                        <label for="editAlimentos_excluidos" class="form-label">Alimentos excluidos por el cliente</label>
                                        <input type="text" class="form-control" id="editAlimentos_excluidoss" name="alimentos_excluidos">
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

    <?php
    include 'db.php'; 

    echo '<style>
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
        
       
   
   
}

.botonessolis:hover {
    
    transform: scale(1.1);  /* Aumentar ligeramente el tamaño al pasar el ratón */
}
</style>';

    try {
      echo '<h2 style="text-align: center;">Gestión de Solicitudes</h2>';
echo '<br>';
echo '<div class="contenedor-filtrado">';
echo '<label for="buscador-solis" class="labelb">Buscador</label>';
echo '<input type="text" class="form-control form-control-sm" id="buscador-solis" onkeyup="buscarSolicitudes()" placeholder="Buscar por nombre, email..." style="width: 200px; margin-bottom: 0;">';
echo '<div class="botones-filtrado">';
echo '<button id="btn-pendientes">Solicitudes Pendientes</button>';
echo '<button id="btn-aprobadas">Solicitudes Aprobadas</button>';
echo '<button id="btn-denegadas">Solicitudes Denegadas</button>';
echo '<button id="btn-todas">Todas</button>';
echo '</div>';
echo '</div>';
      
        $sql = "SELECT id, nombre, peso, altura, genero, ejercicio, edad, email, objetivo, suscripcion, comidas, estres_soluciones, alimentos_excluidos, enfermedades, sentimientos_alimentacion, trabajo, dias_entrenamiento, intensidad, estado, fecha_envio FROM solicitudes";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            echo '<div style="font-family: Arial, sans-serif; margin: 20px;"><br>';
            echo '<div style="display: flex; flex-direction: column; gap: 15px;">';

            while ($row = $result->fetch_assoc()) {
              
              $estadoClass = 'pendiente'; 
              if ($row['estado'] == 'aprobada') {
                  $estadoClass = 'aprobada';
              } elseif ($row['estado'] == 'denegada') {
                  $estadoClass = 'denegada';
              }

                $avatarImg = '';
                if (strtolower($row['genero']) == 'hombre') {
                    $avatarImg = '../assets/images/user/avatar-1.jpg';
                } elseif (strtolower($row['genero']) == 'mujer') {
                    $avatarImg = '../assets/images/user/avatar-10.jpg';
                } else {
                    $nombreParts = explode(' ', $row['nombre']);
                    $initials = strtoupper($nombreParts[0][0] . (isset($nombreParts[1]) ? $nombreParts[1][0] : ''));
                    $avatarImg = 'data:image/svg+xml;base64,' . base64_encode(
                        '<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120">
                            <circle cx="60" cy="60" r="55" fill="#4CAF50" />
                            <text x="50%" y="50%" alignment-baseline="middle" text-anchor="middle" font-size="40" fill="white">' . $initials . '</text>
                        </svg>'
                    );
                }

                echo '<div class="solicitud-card ' . $estadoClass . '" onclick="abrirModal(' . $row['id'] . ')">';
                echo '<div class="avatar" style="background-image: url(\'' . $avatarImg . '\');"></div>';
                echo '<div class="solicitud-info">';
                echo '<p class="soli"><strong>Solicitud para plan personalizado</strong>';
                if (!empty($row['fecha_envio'])) {
                    $fecha = new DateTime($row['fecha_envio']);
                    echo '<p class="fecha"><strong>Fecha:</strong> ' . $fecha->format('d/m/Y h:i A') . '</p>';
                } else {
                    echo '<p class="fecha"><strong>Fecha de Envío:</strong> No disponible</p>';
                }
                echo '<p><strong>Nombre</strong> ' . htmlspecialchars($row['nombre']) . '</p>';
                echo '<p><strong>Email</strong> ' . htmlspecialchars($row['email']) . '</p><br><br>';
                echo '<p><strong>Género</strong> ' . htmlspecialchars($row['genero']) . '</p>';
                echo '<p><strong>Solicitud</strong> ' . htmlspecialchars($row['estado']) . '</p>';
                echo '<hr>';
                echo '<p class="soli2">Ver detalles</p>';
                echo '</div>';
                echo '</div>';
                echo '<div class="modal-solicitudes" id="modal-solicitudes-' . $row['id'] . '">';
                echo '<div class="modal-solicitudes-content" style="margin-left: 610px; margin-top: 100px;">';
                echo '<span class="close" onclick="cerrarModal(' . $row['id'] . ')">&times;</span>';
                echo '<h2 style="text-align: center;">Solicitud completa</h2>';
                echo '<div class="modal-row"><strong>Nombre completo</strong><span>' . htmlspecialchars($row['nombre']) . '</span></div>';
                echo '<div class="modal-row"><strong>Edad</strong><span>' . htmlspecialchars($row['edad']) . '</span></div>';
                echo '<div class="modal-row"><strong>Correo Electrónico</strong><span>' . htmlspecialchars($row['email']) . '</span></div>';
                echo '<div class="modal-row"><strong>Peso (kg)</strong><span>' . htmlspecialchars($row['peso']) . ' kg</span></div>';
                echo '<div class="modal-row"><strong>Altura (cm)</strong><span>' . htmlspecialchars($row['altura']) . ' cm</span></div>';
                echo '<div class="modal-row"><strong>Objetivo</strong><span>' . htmlspecialchars($row['objetivo']) . '</span></div>';
                echo '<div class="modal-row"><strong>¿Qué tipo de suscripción quiere?</strong><span>' . htmlspecialchars($row['suscripcion']) . '</span></div>';
                echo '<div class="modal-row"><strong>¿Cuántas comidas al día quieres hacer?</strong><span>' . htmlspecialchars($row['comidas']) . '</span></div>';
                echo '<div class="modal-row"><strong>¿Qué soluciones busca?</strong><span>' . htmlspecialchars($row['estres_soluciones']) . '</span></div>';
                echo '<div class="modal-row"><strong>¿Hay algún alimento que no te guste o seas alérgico?</strong><span>' . htmlspecialchars($row['alimentos_excluidos']) . '</span></div>';
                echo '<div class="modal-row"><strong>¿Tiene alguna enfermedad o condición médica?</strong><span>' . htmlspecialchars($row['enfermedades']) . '</span></div>';
                echo '<div class="modal-row"><strong>¿Cómo te sientes cuándo comes?</strong><span>' . htmlspecialchars($row['sentimientos_alimentacion']) . '</span></div>';
                echo '<div class="modal-row"><strong>¿Tú trabajo es sedentario o activo?</strong><span>' . htmlspecialchars($row['trabajo']) . '</span></div>';
                echo '<div class="modal-row"><strong>¿Sueles hacer ejercicio físico?</strong><span>' . htmlspecialchars($row['ejercicio']) . '</span></div>';
                echo '<div class="modal-row"><strong>¿Cuántos días a la semana entrenas</strong><span>' . htmlspecialchars($row['dias_entrenamiento']) . '</span></div>';
                echo '<div class="modal-row"><strong>¿Qué nivel de intensidad quieres en tu rutina de ejercicio? (1-6)</strong><span>' . htmlspecialchars($row['intensidad']) . '</span></div>';
                echo '<div>';
                echo '<form method="POST" action="aprobar_o_denegar.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<button class="botonessolis" type="submit" name="accion" value="aprobar" style="margin-left: 100px;">
                      <img src="../assets/images/icons-tab/aprobar.png" alt="aprobar"> Aprobar</button>';
                echo '<button class="botonessolis" type="submit" name="accion" value="denegar" style="margin-left: 150px;"><img src="..//assets/images/icons-tab/rechazado.png" alt="denegar"> Denegar</button><br>';
                echo '</form>';
                echo '<form method="POST" action="borrar_solicitud.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<button class="botonessolis" type="submit" style="margin-left: 240px; margin-top: 0px;"><img src="..//assets/images/icons-tab/papeleraa.png" alt="borrar"> Borrar</button>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
               echo '</div>';
               echo '</div>';
        }
    } catch (Exception $e) {
        echo "Error al mostrar las solicitudes: " . $e->getMessage();
    }
    ?>
    </div>
</div>




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
function abrirModal(id) {
    const modal = document.getElementById('modal-solicitudes-' + id);
    if (modal) {
        modal.style.display = 'block';
    }
}

function cerrarModal(id) {
    const modal = document.getElementById('modal-solicitudes-' + id);
    if (modal) {
        modal.style.display = 'none';
    }
}

// Cierra el modal si se hace clic fuera de él
window.onclick = function(event) {
    document.querySelectorAll('.modal-solicitudes').forEach(modal => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
};
</script>
 <script>
    // Este script se ejecutará cuando el modal se abra
    const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // El botón que activó el modal
        const modal = editModal;

        // Rellenar los campos del formulario con los datos del botón
        modal.querySelector('#editId').value = button.getAttribute('data-id');
        modal.querySelector('#editFormId').value = button.getAttribute('data-id');
        modal.querySelector('#editFormId').value = button.getAttribute('data-id');
        modal.querySelector('#editNombre').value = button.getAttribute('data-nombre');
        modal.querySelector('#editApellido').value = button.getAttribute('data-apellido');
        modal.querySelector('#editEdad').value = button.getAttribute('data-edad');
        modal.querySelector('#editTelefono').value = button.getAttribute('data-telefono');
        modal.querySelector('#editCorreo').value = button.getAttribute('data-correo');
        modal.querySelector('#editAcceso').checked = button.getAttribute('data-acceso') === 'Habilitado';
        modal.querySelector('#editPeso').value = button.getAttribute('data-peso');
        modal.querySelector('#editAltura').value = button.getAttribute('data-altura');
        modal.querySelector('#editObjetivo').value = button.getAttribute('data-objetivo');
        modal.querySelector('#editSuscripcion').value = button.getAttribute('data-suscripcion');
        modal.querySelector('#editComidas').value = button.getAttribute('data-comidas');
        modal.querySelector('#editEnfermedades').value = button.getAttribute('data-enfermedades');
        modal.querySelector('#editEstres_soluciones').value = button.getAttribute('data-estres_soluciones');
        modal.querySelector('#editAlimentos_excluidos').value = button.getAttribute('data-alimentos_excluidos');
        modal.querySelector('#editAlimentos_excluidoss').value = button.getAttribute('data-alimentos_excluidos');
        modal.querySelector('#editSentimientos_alimentacion').value = button.getAttribute('data-sentimientos_alimentacion');
        modal.querySelector('#editTrabajo').value = button.getAttribute('data-trabajo');
        modal.querySelector('#editEjercicio').value = button.getAttribute('data-ejercicio');
        modal.querySelector('#editDias_entrenamiento').value = button.getAttribute('data-dias_entrenamiento');
        modal.querySelector('#editIntensidad').value = button.getAttribute('data-intensidad');
        modal.querySelector('#editEstado').value = button.getAttribute('data-estado');
        modal.querySelector('#editFecha_envio').value = button.getAttribute('data-fecha_envio');
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
    <div class="pct-c-btn">
      <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_pc_layout">
        <i class="ph-duotone ph-gear-six"></i>
      </a>
    </div>
    <div class="offcanvas border-0 pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title">Settings</h5>
        <button type="button" class="btn btn-icon btn-link-danger ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"
          ><i class="ti ti-x"></i
        ></button>
      </div>
      <div class="pct-body customizer-body">
        <div class="offcanvas-body py-0">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <div class="pc-dark">
                <h6 class="mb-1">Theme Mode</h6>
                <p class="text-muted text-sm">Choose light or dark mode or Auto</p>
                <div class="row theme-color theme-layout">
                  <div class="col-4">
                    <div class="d-grid">
                      <button
                        class="preset-btn btn active"
                        data-value="true"
                        onclick="layout_change('light');"
                        data-bs-toggle="tooltip"
                        title="Light">
                        <svg class="pc-icon text-warning">
                          <use xlink:href="#custom-sun-1"></use>
                        </svg>
                      </button>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="d-grid">
                      <button class="preset-btn btn" data-value="false" onclick="layout_change('dark');" data-bs-toggle="tooltip" title="Dark">
                        <svg class="pc-icon">
                          <use xlink:href="#custom-moon"></use>
                        </svg>
                      </button>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="d-grid">
                      <button
                        class="preset-btn btn"
                        data-value="default"
                        onclick="layout_change_default();"
                        data-bs-toggle="tooltip"
                        title="Automatically sets the theme based on user's operating system's color scheme.">
                        <span class="pc-lay-icon d-flex align-items-center justify-content-center">
                          <i class="ph-duotone ph-cpu"></i>
                        </span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <h6 class="mb-1">Theme Contrast</h6>
              <p class="text-muted text-sm">Choose theme contrast</p>
              <div class="row theme-contrast">
                <div class="col-6">
                  <div class="d-grid">
                    <button
                      class="preset-btn btn"
                      data-value="true"
                      onclick="layout_theme_contrast_change('true');"
                      data-bs-toggle="tooltip"
                      title="True">
                      <svg class="pc-icon">
                        <use xlink:href="#custom-mask"></use>
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="col-6">
                  <div class="d-grid">
                    <button
                      class="preset-btn btn active"
                      data-value="false"
                      onclick="layout_theme_contrast_change('false');"
                      data-bs-toggle="tooltip"
                      title="False">
                      <svg class="pc-icon">
                        <use xlink:href="#custom-mask-1-outline"></use>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <h6 class="mb-1">Custom Theme</h6>
              <p class="text-muted text-sm">Choose your primary theme color</p>
              <div class="theme-color preset-color">
                <a href="#!" data-bs-toggle="tooltip" title="Blue" class="active" data-value="preset-1"><i class="ti ti-checks"></i></a>
                <a href="#!" data-bs-toggle="tooltip" title="Indigo" data-value="preset-2"><i class="ti ti-checks"></i></a>
                <a href="#!" data-bs-toggle="tooltip" title="Purple" data-value="preset-3"><i class="ti ti-checks"></i></a>
                <a href="#!" data-bs-toggle="tooltip" title="Pink" data-value="preset-4"><i class="ti ti-checks"></i></a>
                <a href="#!" data-bs-toggle="tooltip" title="Red" data-value="preset-5"><i class="ti ti-checks"></i></a>
                <a href="#!" data-bs-toggle="tooltip" title="Orange" data-value="preset-6"><i class="ti ti-checks"></i></a>
                <a href="#!" data-bs-toggle="tooltip" title="Yellow" data-value="preset-7"><i class="ti ti-checks"></i></a>
                <a href="#!" data-bs-toggle="tooltip" title="Green" data-value="preset-8"><i class="ti ti-checks"></i></a>
                <a href="#!" data-bs-toggle="tooltip" title="Teal" data-value="preset-9"><i class="ti ti-checks"></i></a>
                <a href="#!" data-bs-toggle="tooltip" title="Cyan" data-value="preset-10"><i class="ti ti-checks"></i></a>
              </div>
            </li>
            <li class="list-group-item">
              <h6 class="mb-1">Theme layout</h6>
              <p class="text-muted text-sm">Choose your layout</p>
              <div class="theme-main-layout d-flex align-center gap-1 w-100">
                <a href="#!" data-bs-toggle="tooltip" title="Vertical" class="active" data-value="vertical">
                  <img src="../assets/images/customizer/caption-on.svg" alt="img" class="img-fluid" />
                </a>
                <a href="#!" data-bs-toggle="tooltip" title="Horizontal" data-value="horizontal">
                  <img src="../assets/images/customizer/horizontal.svg" alt="img" class="img-fluid" />
                </a>
                <a href="#!" data-bs-toggle="tooltip" title="Color Header" data-value="color-header">
                  <img src="../assets/images/customizer/color-header.svg" alt="img" class="img-fluid" />
                </a>
                <a href="#!" data-bs-toggle="tooltip" title="Compact" data-value="compact">
                  <img src="../assets/images/customizer/compact.svg" alt="img" class="img-fluid" />
                </a>
                <a href="#!" data-bs-toggle="tooltip" title="Tab" data-value="tab">
                  <img src="../assets/images/customizer/tab.svg" alt="img" class="img-fluid" />
                </a>
              </div>
            </li>
            <li class="list-group-item">
              <h6 class="mb-1">Sidebar Caption</h6>
              <p class="text-muted text-sm">Sidebar Caption Hide/Show</p>
              <div class="row theme-color theme-nav-caption">
                <div class="col-6">
                  <div class="d-grid">
                    <button
                      class="preset-btn btn-img btn active"
                      data-value="true"
                      onclick="layout_caption_change('true');"
                      data-bs-toggle="tooltip"
                      title="Caption Show">
                      <img src="../assets/images/customizer/caption-on.svg" alt="img" class="img-fluid" />
                    </button>
                  </div>
                </div>
                <div class="col-6">
                  <div class="d-grid">
                    <button
                      class="preset-btn btn-img btn"
                      data-value="false"
                      onclick="layout_caption_change('false');"
                      data-bs-toggle="tooltip"
                      title="Caption Hide">
                      <img src="../assets/images/customizer/caption-off.svg" alt="img" class="img-fluid" />
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="pc-rtl">
                <h6 class="mb-1">Theme Layout</h6>
                <p class="text-muted text-sm">LTR/RTL</p>
                <div class="row theme-color theme-direction">
                  <div class="col-6">
                    <div class="d-grid">
                      <button
                        class="preset-btn btn-img btn active"
                        data-value="false"
                        onclick="layout_rtl_change('false');"
                        data-bs-toggle="tooltip"
                        title="LTR"
                      >
                        <img src="../assets/images/customizer/ltr.svg" alt="img" class="img-fluid" />
                      </button>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="d-grid">
                      <button
                        class="preset-btn btn-img btn"
                        data-value="true"
                        onclick="layout_rtl_change('true');"
                        data-bs-toggle="tooltip"
                        title="RTL"
                      >
                        <img src="../assets/images/customizer/rtl.svg" alt="img" class="img-fluid" />
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="list-group-item pc-box-width">
              <div class="pc-container-width">
                <h6 class="mb-1">Layout Width</h6>
                <p class="text-muted text-sm">Choose Full or Container Layout</p>
                <div class="row theme-color theme-container">
                  <div class="col-6">
                    <div class="d-grid">
                      <button
                        class="preset-btn btn-img btn active"
                        data-value="false"
                        onclick="change_box_container('false')"
                        data-bs-toggle="tooltip"
                        title="Full Width">
                        <img src="../assets/images/customizer/full.svg" alt="img" class="img-fluid" />
                      </button>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="d-grid">
                      <button
                        class="preset-btn btn-img btn"
                        data-value="true"
                        onclick="change_box_container('true')"
                        data-bs-toggle="tooltip"
                        title="Fixed Width">
                        <img src="../assets/images/customizer/fixed.svg" alt="img" class="img-fluid" />
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="d-grid">
                <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>

  </body>
  <!-- [Body] end -->
</html>


<?php


?>