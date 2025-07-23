<?php
include('db.php');
include('UsuarioClass.php');
require_once '../auth/check_session.php';

$usuario = new Usuario($conexion);
$datosUsuario = $usuario->obtenerPorId($_SESSION['IdUsuario']);

// Determinar si se debe saltar la primera pestaña en caso de plan mixto
$saltarDatosPersonales = ($datosUsuario["idTipoPlan"] == 3);
require_once '../widget/notifications.php';
$notificaciones = get_notifications($conexion);
$notificationCount = count($notificaciones);
?>

<!doctype html>
<html lang="es">
  <!-- [Head] start -->

  <head>
    <title>Cuestionario Entrenamiento</title>
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
          <a href="../widget/panelrutina.php" class="pc-link">
            <span class="pc-micon">
              <svg class="pc-icon">
                <use xlink:href="#custom-fatrows"></use>
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
        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-12">
           
            <div id="basicwizard" class="form-wizard row justify-content-center">
              
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <form id="contactForm" action="./guardar_ejercicios.php" method="POST">
                      <!-- PROGRESS BAR -->
                      <div id="bar" class="progress mb-3" style="height: 7px;">
                        <div
                          class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"
                          role="progressbar"
                          style="width: 0%"
                          aria-valuenow="0"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>

                      <!-- NAV DE PESTAÑAS -->
                      <ul class="nav nav-pills nav-justified mb-4">
                        <li class="nav-item">
                          <a class="nav-link active" data-bs-toggle="pill" href="#contactDetail">
                            Datos Personales
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-bs-toggle="pill" href="#educationDetail">
                            Actividad Física
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-bs-toggle="pill" href="#finish">
                            Finish
                          </a>
                        </li>
                      </ul>

                      <!-- CONTENIDO DE PESTAÑAS -->
                      <div class="tab-content">
                        <!-- PESTAÑA 1: DATOS PERSONALES -->
                        <div class="tab-pane fade show active" id="contactDetail">
                          <div class="text-center">
                            <h3 class="mb-2">Datos personales</h3>
                            <small class="text-muted">
                              Tus datos personales nos ayudarán a generar un plan único y adecuado a tu situación.
                            </small>
                          </div>
                          <div class="row mt-4">
                            <div class="col-sm-auto text-center">
                              <div class="position-relative me-3 d-inline-flex">
                                <div class="position-absolute top-50 start-100 translate-middle">
                                  <button class="btn btn-sm btn-primary btn-icon">
                                    <i class="ti ti-pencil"></i>
                                  </button>
                                </div>
                                <img src="../assets/images/icons-tab/orii.png" alt="user-image"
                                    class="wid-150 rounded img-fluid ms-2" />
                              </div>
                            </div>
                            <div class="col">
                              <div class="row">
                                <div class="col-sm-6 mb-3">
                                  <label class="form-label" for="nombre">Nombre completo</label>
                                  <input type="text" id="nombre" name="nombre"
                                        class="form-control"
                                        placeholder="Introduzca su nombre completo" required />
                                </div>
                                <div class="col-sm-6 mb-3">
                                  <label class="form-label" for="edad">Edad</label>
                                  <input type="number" id="edad" name="edad"
                                        class="form-control"
                                        placeholder="Introduzca su edad" required />
                                </div>
                                <div class="col-sm-6 mb-3">
                                  <label class="form-label" for="genero">Género</label>
                                  <select id="genero" name="genero"
                                          class="form-control" required>
                                    <option value="default" disabled selected>Seleccionar</option>
                                    <option value="2">Mujer</option>
                                    <option value="1">Hombre</option>
                                  </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                  <label class="form-label" for="email">Email</label>
                                  <input type="email" id="email" name="email"
                                        class="form-control"
                                        placeholder="Introduzca su email" required />
                                </div>
                                <div class="col-sm-6 mb-3">
                                  <label class="form-label" for="peso">Peso (kg)</label>
                                  <input type="number" id="peso" name="peso"
                                        class="form-control" step="0.01"
                                        placeholder="Introduzca su peso en kilogramos" required />
                                </div>
                                <div class="col-sm-6 mb-3">
                                  <label class="form-label" for="altura">Altura (cm)</label>
                                  <input type="number" id="altura" name="altura"
                                        class="form-control"
                                        placeholder="Introduzca su altura en centímetros" required />
                                </div>
                                <div class="col-sm-12 mb-3">
                                  <label class="form-label" for="objetivo">Objetivo</label>
                                  <select id="objetivo" name="objetivo"
                                          class="form-control" required>
                                    <option value="default" disabled selected>Seleccionar</option>
                                    <option value="perder_peso">Perder peso</option>
                                    <option value="ganar_peso">Aumentar masa muscular</option>
                                    <option value="mantener_peso">Alimentación saludable</option>
                                  </select>
                                </div>
                                <div class="col-sm-12 mb-3">
                                  <label class="form-label" for="suscripcion">
                                    ¿Qué tipo de suscripción quiere?
                                  </label>
                                  <select id="suscripcion" name="suscripcion"
                                          class="form-control" required>
                                    <option value="default" disabled selected>Seleccionar</option>
                                    <option value="Mensual">Suscripción Mensual</option>
                                    <option value="Anual">Suscripción Anual</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- PESTAÑA 2: ACTIVIDAD FÍSICA -->
                        <div class="tab-pane fade" id="educationDetail">
                          <div class="text-center">
                            <h3 class="mb-2">Actividad Física</h3>
                            <small class="text-muted">
                              La información sobre tu rutina de ejercicio es esencial para adaptar tu plan a tu actividad física habitual.
                            </small>
                          </div>
                          <div class="row mt-4">
                            <div class="col-md-12 mb-3">
                              <label class="form-label" for="trabajo">
                                ¿Tu trabajo es sedentario o activo?
                              </label>
                              <select id="trabajo" name="trabajo"
                                      class="form-control" required>
                                <option value="default" disabled selected>Seleccionar</option>
                                <option value="sedentario">Sedentario</option>
                                <option value="activo">Activo</option>
                              </select>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label class="form-label" for="ejercicio">
                                ¿Haces o empezarás a hacer ejercicio físico?
                              </label>
                              <select id="ejercicio" name="ejercicio"
                                      class="form-control" required>
                                <option value="default" disabled selected>Seleccionar</option>
                                <option value="si">Sí</option>
                                <option value="no">No</option>
                              </select>
                            </div>

                            <!-- Campos adicionales ocultos -->
                            <div id="extraFields" class="row" style="display: none; gap: 20px; margin-top: 10px;">
                              <div class="col-sm-6 mb-3">
                                <label class="form-label" for="diasEntrenamiento">
                                  Días de entrenamiento (1-7)
                                </label>
                                <input id="diasEntrenamiento" name="dias_entrenamiento"
                                      type="number" class="form-control"
                                      min="1" max="7"
                                      placeholder="Días de entrenamiento" />
                              </div>
                              <div class="col-sm-6 mb-3">
                                <label class="form-label" for="intensidad">
                                  Intensidad (1-6)
                                </label>
                                <input id="intensidad" name="intensidad"
                                      type="number" class="form-control"
                                      min="1" max="6"
                                      placeholder="Intensidad" />
                              </div>
                            </div>


                            <div class="col-md-12 mb-3">
                              <label class="form-label" for="lesiones">
                                ¿Tenés o tuviste alguna lesión?
                              </label>
                              <input id="lesiones" name="lesiones"
                                    type="text" class="form-control" required />
                            </div>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label class="form-label" for="dias_disponibles">
                                ¿De cuántos días de la semana dispones para entrenar? (3, 4 o 5)
                              </label>
                              <input id="dias_disponibles" name="dias_disponibles"
                                    type="number" class="form-control"
                                    min="3" max="5" required />
                            </div>
                             <div class="col-md-12 mb-3">
                              <label class="form-label" for="tiempo_disponible">
                                Tiempo disponible para entrenar:
                              </label>
                              <select id="tiempo_disponible" name="tiempo_disponible"
                                      class="form-control" required>
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="30">30 Minutos</option>
                                <option value="45">45 Minutos</option>
                                <option value="60">60 Minutos</option>
                              </select>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label class="form-label" for="lugar_entrenamiento">
                                La rutina de entrenamiento ¿la realizarás en un gimnasio o en tu casa?
                              </label>
                              <select id="lugar_entrenamiento" name="lugar_entrenamiento"
                                      class="form-control" required>
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="gimnasio">Gimnasio</option>
                                <option value="casa">Casa</option>
                              </select>
                            </div>
                              <!-- Campos adicionales ocultos -->
                              <div id="extraField" class="row" style="display: none; gap: 20px; margin-top: 10px;">
                                <div class="col-sm-6 mb-3">
                                  <label class="form-label" for="nivel">Experiencia en Gimnasios</label>
                                  <select id="nivel" name="nivel" class="form-control" required>
                                    <option value="default">Seleccionar</option>
                                    <option value="1">Principiante</option>
                                    <option value="2">Intermedio</option>
                                    <option value="3">Avanzado</option>
                                  </select>

                                </div>
                              </div>
                            <div class="col-md-12 mb-3">
                              <label class="form-label" for="preferencia_ejercicios">
                                Te gustan los ejercicios con elementos/máquinas o sin elementos:
                              </label>
                              <select id="preferencia_ejercicios" name="preferencia_ejercicios"
                                      class="form-control" required>
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="con elementos">Con elementos/máquinas</option>
                                <option value="sin elementos">Sin elementos</option>
                              </select>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label class="form-label" for="grupo_enfoque">
                                En que grupo muscular te gustaria enfocar el trabajo
                              </label>
                               <select class="form-select form-select-solid" id="grupo_enfoque" name="grupo_enfoque" required>
                                <option value="">Seleccione un grupo...</option>
                                <option value="1">Gluteos</option>
                                <option value="2">Piernas</option>
                                <option value="4">Tren Superior</option>
                                <option value="5">Full body</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <!-- PESTAÑA 3: FIN -->
                        <div class="tab-pane fade" id="finish">
                          <div class="row d-flex justify-content-center">
                            <div class="col-lg-6 text-center">
                              <i class="ph-duotone ph-gift f-50 text-danger"></i>
                              <h3 class="mt-4 mb-3">¡Muy bien!</h3>
                              <p>
                                Recibirás un email en las próximas 72 hs con tu plan personalizado.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- BOTONES DE NAVEGACIÓN -->
                      <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" id="btnAnterior" style="display: none;">
                          Anterior
                        </button>
                        <button type="button" class="btn btn-primary" id="btnSiguiente">
                          Siguiente
                        </button>
                        <button type="submit" class="btn btn-success" id="btnTerminar" style="display: none;">
                          Terminar
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
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
  document.addEventListener("DOMContentLoaded", () => {
    const ejercicio = document.getElementById("ejercicio");
    const extraFields = document.getElementById("extraFields");
    const diasEntrenamiento = document.getElementById("diasEntrenamiento");
    const intensidad = document.getElementById("intensidad");

    const lugar = document.getElementById("lugar_entrenamiento");
    const campoNivel = document.getElementById("extraField");
    const nivel = document.getElementById("nivel");

    function toggleEjercicio() {
      if (ejercicio.value === "si") {
        extraFields.style.display = "flex";
        diasEntrenamiento.required = true;
        diasEntrenamiento.disabled = false;
        intensidad.required = true;
        intensidad.disabled = false;
      } else {
        extraFields.style.display = "none";
        diasEntrenamiento.required = false;
        diasEntrenamiento.disabled = true;
        intensidad.required = false;
        intensidad.disabled = true;
        diasEntrenamiento.value = "";
        intensidad.value = "";
      }
    }

    function toggleNivel() {
      if (lugar.value === "gimnasio") {
        campoNivel.style.display = "flex";
        nivel.required = true;
        nivel.disabled = false;
      } else {
        campoNivel.style.display = "none";
        nivel.required = false;
        nivel.disabled = true;
        nivel.value = "default";
      }
    }

    ejercicio.addEventListener("change", toggleEjercicio);
    lugar.addEventListener("change", toggleNivel);

    toggleEjercicio();
    toggleNivel();
  });
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const btnSiguiente = document.getElementById("btnSiguiente");
    const btnAnterior  = document.getElementById("btnAnterior");
    const btnTerminar  = document.getElementById("btnTerminar");
    const progressBar  = document.querySelector("#bar .bar");
    const navLinks     = Array.from(document.querySelectorAll(".nav-pills .nav-link"));

    function getActiveNav() {
      return document.querySelector(".nav-pills .nav-link.active");
    }

    function obtenerCamposFaltantes(pane) {
      const faltantes = [];
      pane.querySelectorAll("input[required], select[required]").forEach(campo => {
        if (campo.offsetParent === null) return;
        if (!campo.value || campo.value === "default") {
          const lbl = pane.querySelector(`label[for="${campo.id}"]`);
          const nombre = lbl
            ? lbl.textContent.trim().replace(/[:?]$/, "")
            : (campo.name || campo.id);
          faltantes.push(nombre);
        }
      });
      return faltantes;
    }

    function actualizarProgreso() {
      const activoNav = getActiveNav();
      const idx       = navLinks.indexOf(activoNav);
      const pct       = ((idx + 1) / navLinks.length) * 100;
      progressBar.style.width = pct + "%";
      progressBar.setAttribute("aria-valuenow", Math.round(pct));
    }

    function actualizarBotones() {
      const activoNav = getActiveNav();
      const id        = activoNav.getAttribute("href").substring(1);

      btnAnterior.style.display  = "none";
      btnSiguiente.style.display = "none";
      btnTerminar.style.display  = "none";

      if (id === "finish") {
        btnAnterior.style.display = "inline-block";
        btnTerminar.style.display = "inline-block";
        btnSiguiente.style.marginLeft = "";
        btnSiguiente.style.marginRight = "";
      } else {
        btnSiguiente.style.display = "inline-block";
        if (id === "contactDetail") {
          btnAnterior.style.display = "none";
          btnSiguiente.style.marginLeft = "auto";
          btnSiguiente.style.marginRight = "0";
        } else {
          btnAnterior.style.display = "inline-block";
          btnSiguiente.style.marginLeft = "";
          btnSiguiente.style.marginRight = "";
        }
      }
    }

    function showNavLink(link) {
      bootstrap.Tab.getOrCreateInstance(link).show();
    }

    


    btnSiguiente.addEventListener("click", function () {
      const activoNav = getActiveNav();
      const pane      = document.querySelector(activoNav.getAttribute("href"));
      const faltantes = obtenerCamposFaltantes(pane);
      if (faltantes.length) {
        return alert(
          "Por favor completa los siguientes campos:\n• " +
          faltantes.join("\n• ")
        );
      }
      const idx = navLinks.indexOf(activoNav);
      const next = navLinks[idx + 1];
      if (next) showNavLink(next);
    });

    btnAnterior.addEventListener("click", function () {
      const activoNav = getActiveNav();
      const idx       = navLinks.indexOf(activoNav);
      const prev      = navLinks[idx - 1];
      if (prev) showNavLink(prev);
    });

    navLinks.forEach(link => {
      link.addEventListener("shown.bs.tab", () => {
        actualizarProgreso();
        actualizarBotones();
      });
    });

    // Inicializar
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