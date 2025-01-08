<button?php


?>

<!doctype html>
<html lang="es">
  <!-- [Head] start -->

  <head>
    <title>Cuestionario Nutricional</title>
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
              <a href="../dist/widget/w_chart.php">
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
    <span class="pc-mtext">Panel de Administración</span><br><br>
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
                      <use xlink:href="#custom-notification-outline"></use></svg>
                      <h5>Notification</h5>
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
            <div class="d-grid"><a class="btn btn-outline-secondary" href="https://1.envato.market/zNkqj6" target="_blank">Check Now</a>
            </div>
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


        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-12">
           
            <div id="basicwizard" class="form-wizard row justify-content-center">
              
            <div class="col-12">
          <div class="card">
         <div class="card-body p-3">
        <ul class="nav nav-pills nav-justified">
        <li class="nav-item" data-target-form="#contactDetailForm">
          <a href="#contactDetail" class="nav-link active">
          <img src="..//assets/images/icons-tab/icons8n.png" alt="Descripción de la imagen">
            <span class="d-none d-sm-inline">Datos Personales</span>
          </a>
        </li>
        <!-- end nav item -->
        <li class="nav-item" data-target-form="#jobDetailForm">
          <a href="#jobDetail" class="nav-link icon-btn">
          <img src="..//assets/images/icons-tab/icons8c.png" alt="Descripción de la imagen">
            <span class="d-none d-sm-inline">Alimentación</span>
          </a>
        </li>
        <!-- end nav item -->
          <li class="nav-item" data-target-form="#educationDetailForm">
            <a href="#educationDetail" class="nav-link icon-btn">
            <img src="..//assets/images/icons-tab/icon8b.png" alt="Descripción de la imagen">
            <span class="d-none d-sm-inline">Actividad Física</span>
          </a>
        </li>
        <!-- end nav item -->
        <li class="nav-item">
          <a href="#finish" class="nav-link icon-btn">
          <img src="..//assets/images/icons-tab/icons8h.png" alt="Descripción de la imagen">
            <span class="d-none d-sm-inline">¡Listo!</span>
          </a>
        </li>
            <div class="col-12">
          <div class="card">
         <div class="card-body p-3">
        <ul class="nav nav-pills nav-justified">
        <li class="nav-item" data-target-form="#contactDetailForm">
          <a href="#contactDetail" class="nav-link active">
          <img src="..//assets/images/icons-tab/icons8n.png" alt="Descripción de la imagen">
            <span class="d-none d-sm-inline">Datos Personales</span>
          </a>
        </li>
        <!-- end nav item -->
        <li class="nav-item" data-target-form="#jobDetailForm">
          <a href="#jobDetail" class="nav-link icon-btn">
          <img src="..//assets/images/icons-tab/icons8c.png" alt="Descripción de la imagen">
            <span class="d-none d-sm-inline">Alimentación</span>
          </a>
        </li>
        <!-- end nav item -->
          <li class="nav-item" data-target-form="#educationDetailForm">
            <a href="#educationDetail" class="nav-link icon-btn">
            <img src="..//assets/images/icons-tab/icon8b.png" alt="Descripción de la imagen">
            <span class="d-none d-sm-inline">Actividad Física</span>
          </a>
        </li>
        <!-- end nav item -->
        <li class="nav-item">
          <a href="#finish" class="nav-link icon-btn">
          <img src="..//assets/images/icons-tab/icons8h.png" alt="Descripción de la imagen">
            <span class="d-none d-sm-inline">¡Listo!</span>
          </a>
        </li>
                      <!-- end nav item -->
                    </ul>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                      <!-- START: Define your progress bar here -->
                      <div id="bar" class="progress mb-3" style="height: 7px;">
  <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>
                      <div id="bar" class="progress mb-3" style="height: 7px;">
  <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>
                      <!-- END: Define your progress bar here -->
                      <!-- START: Define your tab pans here -->
                      <div class="tab-pane show active" id="contactDetail">
                      <form id="contactForm" action="./guardar_datos.php" method="POST">
    <div class="text-center">
        <h3 class="mb-2">Datos personales</h3>
        <small class="text-muted">Tus datos personales nos ayudarán a generar un plan único y adecuado a tu situación.</small>
        <small class="text-muted">Tus datos personales nos ayudarán a generar un plan único y adecuado a tu situación.</small>
    </div>
    <div class="row mt-4">
        <div class="col-sm-auto text-center">
            <div class="position-relative me-3 d-inline-flex">
                <div class="position-absolute top-50 start-100 translate-middle">
                    <button class="btn btn-sm btn-primary btn-icon">
                        <i class="ti ti-pencil"></i>
                    </button>
                </div>
                <img src="../assets/images/icons-tab/orii.png" alt="user-image" class="wid-150 rounded img-fluid ms-2" />
                <img src="../assets/images/icons-tab/orii.png" alt="user-image" class="wid-150 rounded img-fluid ms-2" />
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre completo</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Introduzca su nombre completo" required />
                        <label class="form-label" for="nombre">Nombre completo</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Introduzca su nombre completo" required />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="edad">Edad</label>
                        <input type="number" id="edad" name="edad" class="form-control" placeholder="Introduzca su edad" required />
                        <label class="form-label" for="edad">Edad</label>
                        <input type="number" id="edad" name="edad" class="form-control" placeholder="Introduzca su edad" required />
                    </div>
<<<<<<< HEAD
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="peso">Peso(kg)</label>
                        <input type="number" id="peso" name="peso" class="form-control" step="0.01" placeholder="Introduzca su peso en kilogramos" required />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="altura">Altura(cm)</label>
                        <input type="number" id="altura" name="altura" class="form-control" placeholder="Introduzca su altura en centímetros" required />
                    </div>
                </div>
                <div class="col-sm-6">
=======
               </div>
                    <div class="col-sm-6">
>>>>>>> 8142f035ef586b5ed5d45ead9a1ad33ecbfd4aad
                    <div class="mb-3">
                        <label class="form-label">Género</label>
                        <select name="genero" id="genero" class="form-control" required>
                            <option value="default" disabled selected>Seleccionar</option>
                            <option value="mujer">Mujer</option>
                            <option value="hombre">Hombre</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
<<<<<<< HEAD
                        <label class="form-label" for="objetivo">Objetivo</label>
                        <select id="objetivo" name="objetivo" class="form-control" required>
                            <option value="default" disabled selected>Elige tu objetivo</option>
                            <option value="perderpeso">Perder peso</option>
                            <option value="aumentomasa">Aumentar masa muscular</option>
                            <option value="alimentacionsaludable">Alimentación saludable</option>
=======
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Introduzca su email" required />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="peso">Peso(kg)</label>
                        <input type="number" id="peso" name="peso" class="form-control" step="0.01" placeholder="Introduzca su peso en kilogramos" required />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="altura">Altura(cm)</label>
                        <input type="number" id="altura" name="altura" class="form-control" placeholder="Introduzca su altura en centímetros" required />
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label class="form-label" for="objetivo">Objetivo</label>
                        <select id="objetivo" name="objetivo" class="form-control" required>
                            <option value="default" disabled selected>Seleccionar</option>
                            <option value="perder_peso">Perder peso</option>
                            <option value="ganar_peso">Aumentar masa muscular</option>
                            <option value="mantener_peso">Alimentación saludable</option>
                        </select>
                     </div>
                 </div>
                    <div class="col-sm-12">
                    <div class="mb-3">
                        <label class="form-label" for="suscripcion">¿Qué tipo de suscripción quiere?</label>
                        <select id="suscripcion" name="suscripcion" class="form-control" required>
                            <option value="default" disabled selected>Seleccionar</option>
                            <option value="Mensual">Suscripción Mensual</option>
                            <option value="Anual">Suscripción Anual</option>
>>>>>>> 8142f035ef586b5ed5d45ead9a1ad33ecbfd4aad
                        </select>
                      </div>
                  </div>
               </div>
             </div>
                </div>
                  </div>
                      </div>
                  </div>
               </div>
             </div>
                </div>
                  </div>
                      <!-- end contact detail tab pane -->
                      <div class="tab-pane" id="jobDetail">
                          <div class="text-center">
<<<<<<< HEAD
                            <h3 class="mb-2">Preguntas sobre tu alimentación</h3>
                            <small class="text-muted">Esto servira para saber desde que punto partes</small>
                          </div> 
=======
                            <h3 class="mb-2">Alimentación</h3>
                            <small class="text-muted">Estas preguntas nos ayudarán a entender tus hábitos alimenticios y a personalizar tus planes según tus necesidades.</small>
                          </div>
                          
>>>>>>> 8142f035ef586b5ed5d45ead9a1ad33ecbfd4aad
                          <div class="row mt-4">
                            <div class="col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">¿Cuántas comidas al día quieres hacer?</label>
                                <select name="comidas" class="form-control" required>
                                    <option value="default" disabled selected>Seleccionar</option>
                                      <option value="Tres comidas"> Tres comidas</option>
                                      <option value="Cuatro comidas">Cuatro comidas</option>
                                      <option value="Cinco comidas">Cinco comidas</option>
                                    <option value="default" disabled selected>Seleccionar</option>
                                      <option value="Tres comidas"> Tres comidas</option>
                                      <option value="Cuatro comidas">Cuatro comidas</option>
                                      <option value="Cinco comidas">Cinco comidas</option>
                                      </select>
                              </div>
                            </div>
                          </div>
                            <div class="col-sm-6">
                              <div class="mb-3">
                                <label class="form-label"> ¿Hay algún alimento que no te guste o seas alérgico?</label>
                                <input type="text" id="alergias-input" name="alimentos_excluidos" class="form-control" placeholder="Introduzca los alimentos que desea que se excluyan" required />
                                <input type="text" id="alergias-input" name="alimentos_excluidos" class="form-control" placeholder="Introduzca los alimentos que desea que se excluyan" required />
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="mb-3">
                                <label class="form-label"> ¿Tienes alguna enfermedad o patología alimenticia?</label>
                                <label class="form-label"> ¿Tienes alguna enfermedad o patología alimenticia?</label>
                                <input type="text" name="enfermedades" class="form-control" placeholder="" required />
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">¿Cómo te sientes cuando comes?</label>
                                <input type="text" name="sentimientos_alimentacion" class="form-control" placeholder="" required />
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label class="form-label">Si tuvieses una situación de estrés/angustia. ¿Qué te ayuda a salir de eso?</label>
                                <input type="text" name="estres_soluciones" class="form-control" placeholder="" required />
                                <input type="text" name="estres_soluciones" class="form-control" placeholder="" required />
                              </div>
                            </div>
                          </div>
                      </div>
                      <!-- end job detail tab pane -->
                      <div class="tab-pane" id="educationDetail">
                          <div class="text-center">
                            <h3 class="mb-2">Actividad Física</h3>
                            <small class="text-muted">La información sobre tu rutina de ejercicio es esencial para adaptar tu plan a tu actividad física habitual.</small>
                            <small class="text-muted">La información sobre tu rutina de ejercicio es esencial para adaptar tu plan a tu actividad física habitual.</small>
                          </div>
                          <div class="row mt-4">
                             <div class="col-md-12">
                               <div class="mb-3">
                                 <label class="form-label" for="actividadtrabajo">¿Tu trabajo es sedentario o activo?</label>
                                 <select name="trabajo" class="form-control" required>
                                   <option value="default" disabled selected>Seleccionar</option>
                                   <option value="default" disabled selected>Seleccionar</option>
                                   <option value="sedentario">Sedentario</option>
                                   <option value="activo">Activo</option>
                                 </select>
                               </div>
                             </div>
<<<<<<< HEAD
                            </div>

=======
>>>>>>> 8142f035ef586b5ed5d45ead9a1ad33ecbfd4aad
                              <div class="col-md-12">
                                <div class="mb-3">
                                  <label class="form-label" for="ejercicio">¿Sueles hacer ejercicio físico?</label>
                                  <select name="ejercicio" id="ejercicio" class="form-control" required>
                                    <option value="default" disabled selected>Seleccionar</option>
                                    <option value="default" disabled selected>Seleccionar</option>
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                  </select>
                                </div>
                              </div>

                            <!-- Campos adicionales ocultos inicialmente -->
                            <div id="extraFields" style="display: none; gap: 20px; margin-top: 10px;">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                  <label class="form-label" for="diasEntrenamiento">Días de entrenamiento (1-7)</label>
                                  <input name="dias_entrenamiento" type="number" id="diasEntrenamiento" class="form-control" min="1" max="7" placeholder="Días de entrenamiento" required />
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="mb-3">
                                  <label class="form-label" for="intensidad">Intensidad (1-6)</label>
                                  <input name="intensidad" type="number" id="intensidad" class="form-control" min="1" max="6" placeholder="Intensidad" required />
                                </div>
                              </div>
                            </div>
                          </div>
<<<<<<< HEAD
                        
=======
>>>>>>> 8142f035ef586b5ed5d45ead9a1ad33ecbfd4aad
                      </div>
                      <!-- end education detail tab pane -->
                      <div class="tab-pane" id="finish">
                        <div class="row d-flex justify-content-center">
                          <div class="col-lg-6">
                            <div class="text-center">
                              <i class="ph-duotone ph-gift f-50 text-danger"></i>
                              <h3 class="mt-4 mb-3">Muy bien !</h3>
                              <div class="mb-3">
                                <div class="form-check d-inline-block">
                                  <label class="form-check-label" for="customCheck1">Recibiras un email en las próximas 72 hs con tu plan personalizado</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end col -->
                        </div>
                        <!-- end row -->
                      </div>
                      <!-- END: Define your tab pans here -->
                      <!-- START: Define your controller buttons here-->
<<<<<<< HEAD
                      <div class="d-flex wizard justify-content-between flex-wrap gap-2 mt-3">
                        <div class="first">
                          <button class="btn btn-secondary"> Inicio </button>
                        </div>
                        <div class="d-flex">
                          <div class="previous me-2">
                            <button class="btn btn-secondary"> Atrás </button>
                          </div>
                          <div class="next">
                            <button id="nextButton" class="btn btn-secondary"> Siguiente </button>
                          </div>
                        </div>
                        <div class="last">
                          <button type="submit" class="btn btn-secondary"> Enviar </button>
                        </div>
                      </div> 
=======
                     <!-- Controles de Navegación -->
                          <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="btnAnterior" style="display: none;">Anterior</button>
                            <button type="button" class="btn btn-primary" id="btnSiguiente">Siguiente</button>
                            <button type="submit" class="btn btn-success" id="btnTerminar" style="display: none;">Terminar</button>
                          </div>
>>>>>>> 8142f035ef586b5ed5d45ead9a1ad33ecbfd4aad
                    </form>
                      <!-- END: Define your controller buttons here-->
                    </div>
                  </div>
                </div>
                <!-- end tab content-->
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
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
<script>
  document.getElementById("ejercicio").addEventListener("change", function() {
    const extraFields = document.getElementById("extraFields");
    const diasEntrenamiento = document.getElementById("diasEntrenamiento");
    const intensidad = document.getElementById("intensidad");

    if (this.value === "si") {
      extraFields.style.display = "flex"; 
      diasEntrenamiento.required = true; // Establece los campos como obligatorios
      intensidad.required = true;
    } else {
      extraFields.style.display = "none";
      diasEntrenamiento.required = false; // Desactiva el requisito de campos obligatorios
      intensidad.required = false;
      diasEntrenamiento.value = ""; // Limpia el campo
      intensidad.value = ""; // Limpia el campo
    }
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const btnSiguiente = document.getElementById("btnSiguiente");
    const btnAnterior = document.getElementById("btnAnterior");
    const btnTerminar = document.getElementById("btnTerminar");
    const barraProgreso = document.querySelector("#bar .bar");
    const progreso = barraProgreso;

    function validarCampos(seccion) {
      const campos = seccion.querySelectorAll("input[required], select[required]");
      for (let campo of campos) {
        if (campo.value === "" || campo.value === "default") {
          return false;
        }
      }
      return true;
    }

    function actualizarProgreso() {
      const secciones = document.querySelectorAll(".tab-pane");
      const seccionActual = document.querySelector(".tab-pane.show");
      const indexActual = Array.from(secciones).indexOf(seccionActual);
      const porcentaje = ((indexActual + 1) / secciones.length) * 100;
      progreso.style.width = porcentaje + "%";
      progreso.setAttribute("aria-valuenow", porcentaje);
    }

    btnSiguiente.addEventListener("click", function () {
      const seccionActual = document.querySelector(".tab-pane.show");
      if (validarCampos(seccionActual)) {
        const siguienteTab = seccionActual.nextElementSibling;
        if (siguienteTab) {
          const idSiguienteTab = siguienteTab.id;
          const navLink = document.querySelector(`a[href="#${idSiguienteTab}"]`);
          if (navLink) {
            const bootstrapTab = new bootstrap.Tab(navLink);
            bootstrapTab.show();
          }
        }
        actualizarProgreso();
        actualizarBotones();
      } else {
        alert("Por favor, rellene todos los campos antes de continuar.");
      }
    });

    btnAnterior.addEventListener("click", function () {
      const seccionActual = document.querySelector(".tab-pane.show");
      const tabAnterior = seccionActual.previousElementSibling;
      if (tabAnterior) {
        const idTabAnterior = tabAnterior.id;
        const navLink = document.querySelector(`a[href="#${idTabAnterior}"]`);
        if (navLink) {
          const bootstrapTab = new bootstrap.Tab(navLink);
          bootstrapTab.show();
        }
      }
      actualizarProgreso();
      actualizarBotones();
    });

    function actualizarBotones() {
      const seccionActual = document.querySelector(".tab-pane.show");

      if (seccionActual.id === "finish") {
        btnSiguiente.style.display = "none";
        btnTerminar.style.display = "none";
      } else {
        btnSiguiente.style.display = "inline-block";
        btnTerminar.style.display = "none";
      }

      if (seccionActual.id === "contactDetail") {
        btnAnterior.style.display = "none";
        btnSiguiente.style.marginLeft = "auto"; // Mueve el botón a la derecha
        btnSiguiente.style.marginRight = "0";
        btnSiguiente.style.display = "inline-block";
      } else {
        btnAnterior.style.display = "inline-block";
        btnSiguiente.style.marginLeft = ""; // Restablece el margen para otras secciones
        btnSiguiente.style.marginRight = "";
      }

      if (seccionActual.id === "educationDetail") {
        btnSiguiente.style.display = "inline-block";
        btnSiguiente.style.display = "none";
        btnTerminar.style.display = "inline-block";
      }
    }

    function terminarFormulario() {
      const seccionActual = document.querySelector(".tab-pane.show");
      const tabFinal = document.querySelector("#finish");
      if (tabFinal) {
        const navLink = document.querySelector(`a[href="#${tabFinal.id}"]`);
        if (navLink) {
          const bootstrapTab = new bootstrap.Tab(navLink);
          bootstrapTab.show();
        }
      }
      actualizarProgreso();
      actualizarBotones();
    }

    actualizarProgreso();
    actualizarBotones();
  });
</script>



<script>
  document.addEventListener("DOMContentLoaded", function () {
    const btnSiguiente = document.getElementById("btnSiguiente");
    const btnAnterior = document.getElementById("btnAnterior");
    const btnTerminar = document.getElementById("btnTerminar");
    const barraProgreso = document.querySelector("#bar .bar");
    const progreso = barraProgreso;

    function validarCampos(seccion) {
      const campos = seccion.querySelectorAll("input[required], select[required]");
      for (let campo of campos) {
        if (campo.value === "" || campo.value === "default") {
          return false;
        }
      }
      return true;
    }

    function actualizarProgreso() {
      const secciones = document.querySelectorAll(".tab-pane");
      const seccionActual = document.querySelector(".tab-pane.show");
      const indexActual = Array.from(secciones).indexOf(seccionActual);
      const porcentaje = ((indexActual + 1) / secciones.length) * 100;
      progreso.style.width = porcentaje + "%";
      progreso.setAttribute("aria-valuenow", porcentaje);
    }

    btnSiguiente.addEventListener("click", function () {
      const seccionActual = document.querySelector(".tab-pane.show");
      if (validarCampos(seccionActual)) {
        const siguienteTab = seccionActual.nextElementSibling;
        if (siguienteTab) {
          const idSiguienteTab = siguienteTab.id;
          const navLink = document.querySelector(`a[href="#${idSiguienteTab}"]`);
          if (navLink) {
            const bootstrapTab = new bootstrap.Tab(navLink);
            bootstrapTab.show();
          }
        }
        actualizarProgreso();
        actualizarBotones();
      } else {
        alert("Por favor, rellene todos los campos antes de continuar.");
      }
    });

    btnAnterior.addEventListener("click", function () {
      const seccionActual = document.querySelector(".tab-pane.show");
      const tabAnterior = seccionActual.previousElementSibling;
      if (tabAnterior) {
        const idTabAnterior = tabAnterior.id;
        const navLink = document.querySelector(`a[href="#${idTabAnterior}"]`);
        if (navLink) {
          const bootstrapTab = new bootstrap.Tab(navLink);
          bootstrapTab.show();
        }
      }
      actualizarProgreso();
      actualizarBotones();
    });

    function actualizarBotones() {
      const seccionActual = document.querySelector(".tab-pane.show");

      if (seccionActual.id === "finish") {
        btnSiguiente.style.display = "none";
        btnTerminar.style.display = "none";
      } else {
        btnSiguiente.style.display = "inline-block";
        btnTerminar.style.display = "none";
      }

      if (seccionActual.id === "contactDetail") {
        btnAnterior.style.display = "none";
        btnSiguiente.style.marginLeft = "auto"; // Mueve el botón a la derecha
        btnSiguiente.style.marginRight = "0";
        btnSiguiente.style.display = "inline-block";
      } else {
        btnAnterior.style.display = "inline-block";
        btnSiguiente.style.marginLeft = ""; // Restablece el margen para otras secciones
        btnSiguiente.style.marginRight = "";
      }

      if (seccionActual.id === "educationDetail") {
        btnSiguiente.style.display = "inline-block";
        btnSiguiente.style.display = "none";
        btnTerminar.style.display = "inline-block";
      }
    }

    function terminarFormulario() {
      const seccionActual = document.querySelector(".tab-pane.show");
      const tabFinal = document.querySelector("#finish");
      if (tabFinal) {
        const navLink = document.querySelector(`a[href="#${tabFinal.id}"]`);
        if (navLink) {
          const bootstrapTab = new bootstrap.Tab(navLink);
          bootstrapTab.show();
        }
      }
      actualizarProgreso();
      actualizarBotones();
    }

    actualizarProgreso();
    actualizarBotones();
  });
</script>



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


    <script src="../assets/js/plugins/wizard.min.js"></script>
    <script>
      new Wizard('#basicwizard', {
        validate: true,
        progress: true
      });
    </script>
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
                        title="LTR">
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
                        title="RTL">
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