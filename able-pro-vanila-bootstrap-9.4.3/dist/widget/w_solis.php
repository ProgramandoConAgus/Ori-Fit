<?php


?>

<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Solicitudes - Team Ori</title>
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
<!--<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>-->
<!-- [ Pre-loader ] End --> <!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="../pages/panel.php" class="b-brand text-primary">
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
          <a href="../../dist/widget/w_solis.php" class="pc-link">
            <span class="pc-micon">
              <img src="..//assets/images/icons-tab/icons8t.png" alt="Descripción de la imagen">  
            </span>
            <span class="pc-mtext">Solicitudes</span>
           </a>
       </li>
       <li class="pc-item">
          <a href="../../dist/recetas/index.php" class="pc-link">
            <span class="pc-micon">
              <img src="..//assets/images/icons-tab/icons8t.png" alt="Descripción de la imagen">  
            </span>
            <span class="pc-mtext">Recetas</span>
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
      <form class="form-search">
        <i class="search-icon">
          <svg class="pc-icon">
            <use xlink:href="#custom-search-normal-1"></use>
          </svg>
        </i>
        <input type="search" class="form-control" placeholder="Ctrl + K" />
      </form>
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
                    type and scrambled it to make a type</p
                  >
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
                    type and scrambled it to make a type</p
                  >
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
                    type and scrambled it to make a type</p
                  >
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
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              
            <?php
include 'db.php'; 
echo '<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background-color: rgba(0, 0, 0, 0.0);
    }

    h1 {
        text-align: center;
        color: #4CAF50;
        margin-top: 20px;
    }

    .solicitud-card {
    background-color: #AB76FF; /* Morado */
    border-radius: 20px;
    box-shadow: 0 4px 6px rgba(155, 89, 182, 0.5); /* Sombra morada */
    padding: 0px;
    cursor: pointer;
    transition: transform 0.3s, box-shadow 0.3s;
    margin-bottom: 0px;
    margin-top: 20px;
    width: 100%;
    max-width: 1500px;
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Alinea a la izquierda */
    margin-left: 0; /* Elimina el auto margen a la izquierda */
    margin-right: -10; /* Mantiene el margen derecho automático */
    background-color: rgba(AB76FF); /* Fondo morado más suave */
}

    .solicitud-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    .solicitud-card.aprobada {
        background-color: #8CFF7F; 
        color: #;

    }

    
.solicitud-card.denegada {
    background-color: #f8d7da; /* Color de fondo rojo claro */
    color: #; /* Rojo para denegada */
}

    .avatar {
    width: 70px; /* Aumentar más el ancho */
    height: 70px; /* Mantener la altura más pequeña */
    background-color: #4CAF50;
    color: white;
    border-radius: 100%; /* Mantener como círculo */
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px; /* Aumentar tamaño de texto */
    margin-right: 10px;
    background-size: cover; /* Ajustar la imagen */
    background-position: center; /* Centrar la imagen */
    position: relative;
    top: -180px;
    left: 10px;
}



    .solicitud-info {
        flex-grow: 1;
    }

    .solicitud-info p {
    margin: 5px 0;
    font-size: 21px;
    padding-left: 20px; /* Ajusta este valor según lo que necesites */
}

    .estado {
        font-size: 20px;
        margin-left: 520px;
        position: relative;
        top: -422px;
        right: -250px;
        font-weight: bold;
        
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 150px;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.0);
    }

    .modal-content {
        background-color: #AB76FF;
        margin: 5% auto;
        padding: 20px;
        border-radius: 8px;
        width: 60%; 
        max-width: 800px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .modal-content h2 {
        color: #000000;
        text-align: center;
        margin-bottom: 20px;
    }

    .modal-content .modal-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    .modal-content .modal-row strong {
        color: #000000;
        width: 40%; 
        text-align: left;
    }

    .modal-content .modal-row span {
        color: #000000;
        width: 55%; 
        text-align: right;
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
        padding: 8px 15px;
        cursor: pointer;
        border-radius: 4px;
        border: none;
        font-size: 14px;
    }

    button[name="accion"][value="aprobar"] {
        background-color: #4CAF50;
        color: white;
    }

    button[name="accion"][value="denegar"] {
        background-color: #f44336;
        color: white;
    }

    button[name="accion"][value="borrar"] {
        background-color: #f1c40f;
        color: white;
    }

    .soli{
    font-weight: bold;
    top:20px;
    
    }

    .soli2{
    color: black;
    
    }
    .fecha, .hora{
    font-weight: bold;
    }
   

</style>';

echo '<script>
    function abrirModal(id) {
        document.getElementById("modal-" + id).style.display = "block";
    }

    function cerrarModal(id) {
        document.getElementById("modal-" + id).style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target.classList.contains("modal")) {
            var modalId = event.target.id.replace("modal-", "");
            cerrarModal(modalId);
        }
    }

    function borrarSolicitud(id) {
        if (confirm("¿Estás seguro de que quieres borrar esta solicitud?")) {
            window.location.href = "borrar_solicitud.php?id=" + id;
        }
    }
</script>';

try {
    $sql = "SELECT id, nombre, peso, altura, genero, ejercicio, edad, email, objetivo, suscripcion, comidas, estres_soluciones, alimentos_excluidos, enfermedades, sentimientos_alimentacion, trabajo, dias_entrenamiento, intensidad, estado, fecha_envio FROM solicitudes";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
      echo '<div style="font-family: Arial, sans-serif; margin: 20px;">';
        echo '<h1 style="text-align: center; color: #000000;">Solicitudes Pendientes</h1>';
        echo '<div style="display: flex; flex-direction: column; gap: 10px;">';

        while ($row = $result->fetch_assoc()) {
          // Verificar el estado de la solicitud
          if ($row['estado'] == 'aprobada') {
              $estado = ' Estado de la Solicitud: Aprobada ✔️'; // Si está aprobada, mostrar el check verde
              $estadoClass = 'aprobada';
          } elseif ($row['estado'] == 'denegada') {
              $estado = ' Estado de la Solicitud: Denegada ❌'; // Si está denegada, mostrar la X roja
              $estadoClass = 'denegada';
          } else {
              $estado = ' Estado de la Solicitud: Pendiente..🕒'; // Si no tiene estado definido, mostrar un reloj de espera
              $estadoClass = '';
          }
            $avatarImg = ''; // Inicializamos la variable de la imagen

// Comprobamos el género y asignamos la ruta de la imagen correspondiente
if (strtolower($row['genero']) == 'hombre') {
    $avatarImg = '../assets/images/user/avatar-1.jpg'; // Ruta de la imagen para hombre
} elseif (strtolower($row['genero']) == 'mujer') {
    $avatarImg = '../assets/images/user/avatar-10.jpg'; // Ruta de la imagen para mujer
} else {
    // Si no se especifica el género, o es otro valor, se usará un avatar con las iniciales
    $nombreParts = explode(' ', $row['nombre']);
    $initials = strtoupper($nombreParts[0][0] . (isset($nombreParts[1]) ? $nombreParts[1][0] : '')); // Iniciales del nombre

    // Generar un avatar con las iniciales (SVG)
    $avatarImg = 'data:image/svg+xml;base64,' . base64_encode(
      '<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120"> <!-- Aumentamos el tamaño -->
          <circle cx="60" cy="60" r="55" fill="#4CAF50" /> <!-- Aumentamos el radio -->
          <text x="50%" y="50%" alignment-baseline="middle" text-anchor="middle" font-size="40" fill="white">' . $initials . '</text> <!-- Ajustamos el tamaño del texto -->
      </svg>'
  );

}





            echo '<div class="solicitud-card ' . $estadoClass . '" onclick="abrirModal(' . $row['id'] . ')">';
            echo '<div class="avatar" style="background-image: url(\'' . $avatarImg . '\');"></div>';
            echo '<div class="solicitud-info"><br><br>';
            echo '<p class="soli"<strong>Solicitud para plan personalizado</strong>';
            if (!empty($row['fecha_envio'])) {
              // Crear un objeto DateTime con la fecha y hora
              $fecha = new DateTime($row['fecha_envio']);
          
              // Mostrar la fecha y la hora separadas
              echo '<p class="fecha"><strong>Fecha:</strong> ' . $fecha->format('d/m/Y') . '</p>';
              echo '<p class="hora"><strong>Hora:</strong> ' . $fecha->format('h:i A') . '</p>';
          } else {
              echo '<p class="fecha"><strong>Fecha de Envío:</strong> No disponible</p>';
          }
            echo '<hr style="color: black">';
            echo '<p><strong>Nombre completo:</strong> ' . htmlspecialchars($row['nombre']) . '</p>';
            echo '<p><strong>Email:</strong> ' . htmlspecialchars($row['email']) . '</p>';
            echo '<p><strong>Peso:</strong> ' . htmlspecialchars($row['peso']) . ' kg</p>';
            echo '<p><strong>Altura:</strong> ' . htmlspecialchars($row['altura']) . ' cm</p>';
            echo '<p><strong>Género:</strong> ' . htmlspecialchars($row['genero']) . '</p>';
            echo '<p><strong>Su objetivo:</strong> ' . htmlspecialchars($row['objetivo']) . '</p>';
            echo '<p><strong>Suele hacer ejercicio:</strong> ' . htmlspecialchars($row['ejercicio']) . '</p>';
            echo '<hr>';
            echo '<p class="soli2">Ver detalles</p>';
            echo '<span class="estado">' . $estado . '</span>';
            echo '</div>';
            echo '</div>';
            

            echo '<div class="modal" id="modal-' . $row['id'] . '">';
            echo '<div class="modal-content">';
            echo '<span class="close" onclick="cerrarModal(' . $row['id'] . ')">&times;</span>';
            echo '<h2>Solicitud completa</h2>';

            echo '<div class="modal-row"><strong>Nombre completo</strong><span>' . htmlspecialchars($row['nombre']) . '</span></div>';
            echo '<div class="modal-row"><strong>Edad</strong><span>' . htmlspecialchars($row['edad']) . '</span></div>';
            echo '<div class="modal-row"><strong>Correo Electrónico</strong><span>' . htmlspecialchars($row['email']) . '</span></div>';
            echo '<div class="modal-row"><strong>Peso (kg)</strong><span>' . htmlspecialchars($row['peso']) . ' kg</span></div>';
            echo '<div class="modal-row"><strong>Altura (cm)</strong><span>' . htmlspecialchars($row['altura']) . ' cm</span></div>';
            echo '<div class="modal-row"><strong>Objetivo</strong><span>' . htmlspecialchars($row['objetivo']) . '</span></div>';
            echo '<div class="modal-row"><strong>¿Qué tipo de suscripción quiere?</strong><span>' . htmlspecialchars($row['suscripcion']) . '</span></div>';
            echo '<div class="modal-row"><strong>¿Cuántas comidas al día quieres hacer?</strong><span>' . htmlspecialchars($row['comidas']) . '</span></div>';
            echo '<div class="modal-row"><strong>¿Tienes alguna enfermedad o condición médica?</strong><span>' . htmlspecialchars($row['enfermedades']) . '</span></div>';
            echo '<div class="modal-row"><strong>¿Qué te genera estrés con la alimentación?</strong><span>' . htmlspecialchars($row['estres_soluciones']) . '</span></div>';
            echo '<div class="modal-row"><strong>Alimentos excluidos</strong><span>' . htmlspecialchars($row['alimentos_excluidos']) . '</span></div>';
            echo '<div class="modal-row"><strong>Sentimientos sobre la alimentación</strong><span>' . htmlspecialchars($row['sentimientos_alimentacion']) . '</span></div>';
            echo '<div class="modal-row"><strong>Trabajo</strong><span>' . htmlspecialchars($row['trabajo']) . '</span></div>';
            echo '<div class="modal-row"><strong>¿Sueles hacer ejercicio físico?</strong><span>' . htmlspecialchars($row['ejercicio']) . '</span></div>';
            echo '<div class="modal-row"><strong>¿Cuántos días a la semana entrenas?</strong><span>' . htmlspecialchars($row['dias_entrenamiento']) . '</span></div>';
            echo '<div class="modal-row"><strong>¿Qué nivel de intensidad quieres en tu rutina de ejercicio?</strong><span>' . htmlspecialchars($row['intensidad']) . '</span></div>';

            echo '<div style="text-align: center; margin-top: 40px;">';
            echo '<form method="POST" action="aprobar_o_denegar.php">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button style="margin-right: 20px;" type="submit" name="accion" value="aprobar">Aprobar</button>';
            echo '<button type="submit" name="accion" value="denegar">Denegar</button>';
            echo '</form>';
            echo '<form method="POST" action="borrar_solicitud.php" style="display:inline;">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" style="background-color: #f1c40f; color: white; margin-top: 10px;">Borrar Solicitud</button>';
            echo '</div>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div style="text-align: center; font-family: Arial, sans-serif; margin-top: 20px; color: #f44336;">';
        echo '<h3>No hay solicitudes pendientes.</h3>';
        echo '</div>';
    }
} catch (Exception $e) {
    echo '<p>Error al cargar las solicitudes: ' . $e->getMessage() . '</p>';
} finally {
    $conexion->close();
}
?>

                </div>
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
 <!-- Required Js -->
<script src="../assets/js/plugins/popper.min.js"></script>
<script src="../assets/js/plugins/simplebar.min.js"></script>
<script src="../assets/js/plugins/bootstrap.min.js"></script>
<script src="../assets/js/fonts/custom-font.js"></script>
<script src="../assets/js/pcoded.js"></script>
<script src="../assets/js/plugins/feather.min.js"></script>
<div class="floting-button">
  <a href="https://1.envato.market/zNkqj6" class="btn btn btn-danger buynowlinks d-inline-flex align-items-center gap-2" data-bs-toggle="tooltip" title="Buy Now">
    <i class="ph-duotone ph-shopping-cart"></i>
    <span>Buy Now</span>
    
  </a>
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
                        title="Light"
                      >
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
                        title="Automatically sets the theme based on user's operating system's color scheme."
                      >
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
                      title="True"
                    >
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
                      title="False"
                    >
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
                      title="Caption Show"
                    >
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
                      title="Caption Hide"
                    >
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
                        title="Full Width"
                      >
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
                        title="Fixed Width"
                      >
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