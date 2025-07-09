<?php
include('db.php');
include('UsuarioClass.php');
session_start();

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
<!-- En el head -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.select2-container--bootstrap-5 .select2-selection {
    min-height: 45px;
    padding: 8px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 20px;
    padding: 3px 10px;
}

.select2-container--bootstrap-5 .select2-dropdown {
    border-radius: 8px;
    border: 1px solid #dee2e6;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
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
                      <!-- END: Define your progress bar here -->
                      <!-- START: Define your tab pans here -->
                      <div class="tab-pane show active" id="contactDetail">
                      <form id="contactForm" action="./guardar_datos.php" method="POST">
    <div class="text-center">
        <h3 class="mb-2">Datos personales</h3>
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
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre completo</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Introduzca su nombre completo" required />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="edad">Edad</label>
                        <input type="number" id="edad" name="edad" class="form-control" placeholder="Introduzca su edad" required />
                    </div>
               </div>
                    <div class="col-sm-6">
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
                        <select id="objetivo" name="objetivo" class="form-control" required >
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
                        </select>
                      </div>
                  </div>
               </div>
             </div>
                </div>
                  </div>
                      <!-- end contact detail tab pane -->
                      <div class="tab-pane" id="jobDetail">
                          <div class="text-center">
                            <h3 class="mb-2">Alimentación</h3>
                            <small class="text-muted">Estas preguntas nos ayudarán a entender tus hábitos alimenticios y a personalizar tus planes según tus necesidades.</small>
                          </div>
                          
                          <div class="row mt-4">
                            <div class="col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">¿Cuántas comidas al día quieres hacer?</label>
                                <select name="comidas[]" class="form-select select2-multiple" multiple="multiple" required >
                                      <option value="desayuno">Desayuno</option>
                                      <option value="almuerzo">Almuerzo</option>
                                      <option value="merienda">Merienda</option>
                                      <option value="cena">Cena</option>
                                      <option value="snack">Snack</option>
                                      </select>
                              </div>
                            </div>
                            <div class="col-sm-6">
    <div class="mb-3">
        <label class="form-label  mb-2">¿Hay algún alimento que no te guste o seas alérgico?</label>
        <select name="alimentos_excluidos[]" 
                id="alergias-input" 
                class="form-select select2-multiple"
                multiple 
                data-placeholder="Selecciona alimentos">
            <?php
            $consulta = "SELECT * FROM ingredientes ORDER BY Nombre";
            $stm = $conexion->prepare($consulta);
            $stm->execute();
            $resultado = $stm->get_result();
            
            if ($resultado->num_rows > 0) {
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<option value='" . $fila['IdIngrediente'] . "'>" . htmlspecialchars($fila['Nombre']) . "</option>";
                }
            } else {
                echo "<option value='' disabled>No hay ingredientes disponibles</option>";
            }
            ?>
        </select>
    </div>
</div>
                            <div class="col-sm-6">
                              <div class="mb-3">
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
                              </div>
                            </div>
                          </div>
                      </div>
                      <!-- end job detail tab pane -->
                      <div class="tab-pane" id="educationDetail">
    <div class="text-center">
        <h3 class="mb-2">Actividad Física</h3>
        <small class="text-muted">La información sobre tu rutina de ejercicio es esencial para adaptar tu plan a tu actividad física habitual.</small>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="mb-3">
                <label class="form-label" for="actividadtrabajo">¿Tu trabajo es sedentario o activo?</label>
                <select name="trabajo" class="form-control" required>
                    <option value="default" disabled selected>Seleccionar</option>
                    <option value="sedentario">Sedentario</option>
                    <option value="activo">Activo</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label class="form-label" for="ejercicio">¿Haces o empezarás a hacer ejercicio físico?</label>
                <select name="ejercicio" id="ejercicio" class="form-control" required>
                    <option value="default" disabled selected>Seleccionar</option>
                    <option value="si">Sí</option>
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

        <?php if ($datosUsuario['idTipoPlan'] == 3): ?>
            <!-- Campos adicionales para idTipoPlan 3 -->
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="actividad_previas">¿Ya realizaste actividad física en otro momento? ¿Cuál?</label>
                    <input type="text" name="actividad_previas" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="lesiones">¿Tenés o tuviste alguna lesión?</label>
                    <input type="text" name="lesiones" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="ultimo_entrenamiento">Si no te encuentras entrenando actualmente, ¿Cuándo fue la última vez que lo hiciste?</label>
                    <input type="text" name="ultimo_entrenamiento" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="dias_disponibles">¿De cuántos días de la semana dispones para entrenar? (3, 4 o 5)</label>
                    <input type="number" name="dias_disponibles" class="form-control" min="3" max="5" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="lugar_entrenamiento">La rutina de entrenamiento ¿la realizarás en un gimnasio o en tu casa?</label>
                    <select name="lugar_entrenamiento" class="form-control" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="gimnasio">Gimnasio</option>
                        <option value="casa">Casa</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="preferencia_ejercicios">Te gustan los ejercicios con elementos/máquinas o sin elementos:</label>
                    <select name="preferencia_ejercicios" class="form-control" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="con elementos">Con elementos/máquinas</option>
                        <option value="sin elementos">Sin elementos</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="tiempo_disponible">Tiempo disponible para entrenar:</label>
                    <select name="tiempo_disponible" class="form-control" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="30">30 Minutos</option>
                        <option value="45">45 Minutos</option>
                        <option value="60">60 Minutos</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="nivel">Experiencia en Gimnasios</label>
                    <select name="nivel" class="form-control" required>
                        <option value="default">Seleccionar</option>
                        <option value="1">Principiante</option>
                        <option value="2">Intermedio</option>
                        <option value="3">Avanzado</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="grupo_enfoque">En que grupo muscular te gustaria enfocar el trabajo</label>
                    <select name="grupo_enfoque" class="form-select form-select-solid" required>
                        <option value="">Seleccione un grupo...</option>
                        <option value="1">Gluteos</option>
                        <option value="2">Piernas</option>
                        <option value="4">Tren Superior</option>
                        <option value="5">Full body</option>
                    </select>
                </div>
            </div>
        <?php endif; ?>
    </div>
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
                     <!-- Controles de Navegación -->
                          <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="btnAnterior" style="display: none;">Anterior</button>
                            <button type="button" class="btn btn-primary" id="btnSiguiente">Siguiente</button>
                            <button type="submit" class="btn btn-success" id="btnTerminar" style="display: none;">Terminar</button>
                          </div>
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
    <script>
      document.getElementById('contactForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        const data = new FormData(form);

        try {
          await fetch('./guardar_datos.php', { method: 'POST', body: new FormData(form) });
          await fetch('./guardar_ejercicios.php', { method: 'POST', body: new FormData(form) });
          window.location.href = '../pages/panel.php';
        } catch (err) {
          console.error('Error al enviar formularios:', err);
          alert('Ocurri\u00f3 un error al generar los planes.');
        }
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.select2-multiple').select2({
        theme: 'bootstrap-5',
        placeholder: 'Selecciona tus opciones',
        closeOnSelect: false,
        width: '100%'
    });
});
/*
$(document).ready(function() {
    $('.select2-multiple').select2({
        theme: 'bootstrap-5',
        placeholder: function() {
            return $(this).data('placeholder');
        },
        closeOnSelect: false,
        width: '100%'
    });
});*/
</script>
    

  </body>
  <!-- [Body] end -->
</html>


<?php


?>