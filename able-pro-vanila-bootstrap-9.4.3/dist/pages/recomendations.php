<?php
require_once '../auth/check_session.php';
$IdUsuario = $_SESSION['IdUsuario'];
include('../widget/db.php');
include('../forms/UsuarioClass.php');

$usuario = new Usuario($conexion);
$datosUsuario = $usuario->obtenerPorId($_SESSION['IdUsuario']);

require_once '../widget/notifications.php';
$notificaciones = get_notifications($conexion);
$notificationCount = count($notificaciones);
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

    <!-- Main Content -->
    <div class="pc-container">
      <div class="pc-content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <div class="card shadow-sm mb-4">
  <div class="card-header bg-primary text-white">
    <h1 class="mb-0" style="color:white;">ACLARACIONES Y TIPS</h1>
  </div>
  <div class="card-body">
    <p class="fs-5"><strong>Sos parte del #TeamOri</strong></p>
    <p class="mb-3">¡Es importante que leas el archivo completo antes de comenzar!</p>
    <p class="mb-4">¡HOLA! Soy Ori, y esta es una guía esencial de consejos e indicaciones.</p>

    <hr>

    <div class="mb-4">
      <h2 class="text-primary">Cantidad de comidas</h2>
      <p>Deben consumirse todos los días, las comidas indicadas en el plan. ¡No importa el orden!</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Peso de las comidas</h2>
      <p>Las comidas del plan se encuentran en peso neto (eliminando cáscaras, carozos, huesos).</p>
      <p>Más adelante encontrarás equivalencias por si no tenés balanza, pero sería conveniente comprar una económica para mayor exactitud (y no comer de menos).</p>
      <p>La idea es eliminar el concepto de “permitido”, y entender el plan de alimentación como una guía saludable. No busquemos comer algo prohibido, sino sanar nuestra relación con la comida, para entender que es muy importante lo que elegimos comer.</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Comidas libres</h2>
      <p>Si elegiste el plan que tiene seguimiento 1 a 1 conmigo, una vez por semana vamos a realizar un control, al cual llamo <em>"check"</em>. Me vas a enviar foto de tus cuatro perfiles como en la planilla.</p>
      <p>¡Es responsabilidad del asesorado enviar el check en tiempo y forma! El plan seguirá su curso aún cuando no estemos en contacto.</p>
      <p>Si tu plan no tiene seguimiento, el control será una vez a los 30 días de comenzar para evaluar los resultados y renovar.</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Para llevar un seguimiento...</h2>
      <h3 class="text-secondary">Verduras Verdes: Ilimitadas</h3>
      <p>
        Estas son: <em>LECHUGA, REPOLLO BLANCO Y COLORADO, ACELGA, ESPINACA, ZAPALLITO, BERENJENA, CEBOLLA BLANCA Y MORADA, MORRÓN (ROJO/VERDE/AMARILLO/NARANJA), ZUCCHINI, ALBAHACA, BRÓCOLI, CHAUCHAS, RÚCULA, ESPÁRRAGOS, CEBOLLA DE VERDEO, PUERRO, AJO, KALE, ACHICORIA, HINOJO, APIO, PEPINO, PEREJIL, REPOLLITOS DE BRUCELA, ALCAHUCIL, RABANITOS, AJÍ, BERRO, HONGOS, HABAS, NABO.</em>
      </p>
      <p class="fst-italic">(PREGUNTAR POR OTRAS QUE NO ESTÉN EN EL LISTADO)</p>
      <h3 class="text-secondary">Tomate y Zanahoria</h3>
      <p>Si la ensalada o porción de verduras tiene verduras verdes, podemos adicionar.</p>
      <h3 class="text-secondary">Carbohidratos</h3>
      <p>BATATA, CALABAZA, ZAPALLO ANCO, PAPA, COLIFLOR, REMOLACHA: SON CARBOHIDRATOS, POR ESO RECOMIENDO CONSUMIRLOS EN LAS PORCIONES QUE INDICA EL PLAN.</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Bebidas</h2>
      <p>Se recomienda el consumo de 2L de agua diarios. Puede incorporarse la toma de jugos de sobre sin azúcar, o gaseosas light, pero evitando que sea algo diario, por la cantidad de químicos y edulcorantes que poseen. Si no estás acostumbrado a tomar gaseosas, mucho mejor. Estas podrían ser un puente para en un paso siguiente, dejarlas. Las infusiones como tés, café y mate son libres, y en lo posible, se recomienda restringir el consumo de alcohol.</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Control de ansiedad</h2>
      <p>El plan contempla los macronutrientes que tu cuerpo necesita; no debemos pasar hambre. En caso de picoteos, atracones o hambre, puede ser por ansiedad o falta de alimentos ultraprocesados. Recurrí a mí, hablar siempre es bueno.</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Orden de comidas</h2>
      <p>El orden de las comidas es de libre elección. Si por cuestiones de comodidad preferís comer la comida del almuerzo en la cena o intercambiar otro orden, es posible mientras se respeten porciones y cantidades de ingestas diarias para que no pases hambre ni falten nutrientes.</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Carnes magras</h2>
      <p>Se considera carne roja magra a los cortes como: peceto, lomo, nalga, bola de lomo, cuadrada, paleta. Carne de cerdo: lomo o costilla. El filet puede ser de cualquier pescado blanco (no salmón, por el alto contenido graso).</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Condimentos</h2>
      <p>Vinagre (cualquier tipo), aceto balsámico (no reducción), limón, especias a gusto, picante, salsa de soja, mostaza y ketchup. Evitar el consumo de cualquier tipo de sal, mayonesa o salsas estilo César o Ranch. Para las ensaladas es aceptable una cucharada sopera de aceite de oliva, medida de esa forma.</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Endulzantes</h2>
      <p>Siempre la primera recomendación será evitar los edulcorantes y consumir las bebidas o comidas sin endulzar. En un primer momento se puede recurrir a la stevia o miel natural (que si bien aporta azúcar, no posee químicos).</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Horarios</h2>
      <p>No es necesario comer cada determinada cantidad de horas, pero sí es recomendable que no pasen más de 4 horas entre cada comida.</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Formas de cocción</h2>
      <p>Los alimentos pueden ser cocidos al horno, a la plancha, hervidos, al vapor o en freidora de aire. Se deben evitar métodos que utilicen aceite, como freír. Los ingredientes pueden consumirse por separado o mezclados en woks, sopas, revueltos, ensaladas, grillados, etc.</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Mensaje Final</h2>
      <p>Por último, y no menos importante, esto es una demostración de amor propio y cuidado. No debe generarte ansiedad ni ponerte mal; al contrario, tiene que motivarnos a crecer día a día y superarnos, con paciencia y tratándonos con cariño. Acá estamos para aprender. Te felicito y vamos por esos cambios.</p>
      <p>Mi disponibilidad es de LUNES A SÁBADO. Siempre respondo en orden de llegada los mensajes, a medida que estoy disponible, para quienes tengan seguimiento contratado en sus planes.</p>
      <p>Siempre que puedas o recuerdes, toma fotos a tus comidas o entrenamientos y comparte tus avances en redes sociales (<em>podés etiquetar mi Instagram @orianacristiano</em>), ya que esa publicación puede motivar a otra persona del team o a quien ni te imagines.</p>
      <p>Cualquier progreso, por mínimo que sea, se disfruta e internaliza más cuando lo compartimos, ya sea en el grupo de whatsapp o de manera pública. ¡No estás solx!</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Recordar</h2>
      <p>El plan se modificará una vez por mes, a medida que vayamos avanzando. Recordá que debes enviar el control, y modificaremos las cantidades de macronutrientes de la alimentación acorde a lo evaluado.</p>
      <p>El pago es mensual, debiendo abonar en los días en que se realiza la inscripción. Por ejemplo, si al ingresar abonan el día 15 del mes, todos los meses deberán pagar alrededor de esa fecha y enviar comprobante. Por favor, no atrasarse; el plan se renueva automáticamente. <strong>AVISAR si no continúan.</strong></p>
      <p>Recomiendo (fuertemente) imprimir o anotar el plan en una hoja física, además del formato digital. Tenerlo a la vista nos ayudará a cumplir con las comidas y a orientarnos con mayor rapidez, ya que muchas veces estamos acostumbrados a comer poco o menos de lo que debemos y olvidamos ingredientes.</p>
    </div>

    <div class="mb-4">
      <h2 class="text-primary">Referencias y Equivalencias</h2>
      <p class="mb-3">
        <strong>
          Taza = 250ml<br>
          Tacita = 150ml<br>
          Cucharada (sopera) = 15ml<br>
          Cucharita (postre) = 5ml<br>
          Vaso = 200ml
        </strong>
      </p>
      <h3 class="text-secondary">Referencias de algunos alimentos que pueden aparecer en tu plan</h3>
      <h4 class="text-secondary">Proteínas (peso en crudo)</h4>
      <p>
        Pechuga/carne roja/carne de cerdo: 200gr = tamaño de la mano entera – 120gr = palma de la mano<br>
        Tofu = 100gr = tamaño de una tarjeta, rebanada<br>
        Soja texturizada = 100gr hidratada = 50gr sin hidratar = 3/4 taza<br>
        Seitán = 100gr = tamaño de la palma de la mano<br>
        Jamón natural = 1 feta = 15gr
      </p>
      <h4 class="text-secondary">Carbohidratos (peso cocido)</h4>
      <p>
        Taza de arroz/quinoa/avena = 250gr<br>
        Taza de fideos = 300gr<br>
        1 rebanada de pan = 20/30gr<br>
        Papa/batata/remolacha mediana = 150/200gr<br>
        Calabaza (rodaja mediana) = 120gr<br>
        Avena = 10gr = 1 cucharada<br>
        Taza de legumbres = 200gr<br>
        Polenta = 80gr = medio plato playo<br>
        Palmitos/choclo/arvejas = 100gr = 1 tacita<br>
        Cereales/Granola sin azúcar = 10gr = 1 cucharada
      </p>
      <h3 class="text-secondary">Tabla de equivalencias</h3>
      <p>En caso de no tener balanza:</p>
    </div>
  </div>
</div>
<!-- ... contenido anterior ... -->

<div class="mb-4">
      <h2 class="text-primary">Informacion Adicional</h2>
      <div class="row">
        <!-- Card 1 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title text-primary">PDF Ejemplo 1</h5>
              <p class="card-text">Descripcion de ejemplo</p>
              <div class="d-flex gap-2">
                <a href="../assets/pdf/ACLARACIONES Y TIPS.pdf" 
                   class="btn btn-primary"
                   target="_blank">
                  <i class="fas fa-eye me-2"></i>Ver PDF
                </a>
                <a href="../assets/pdf/ACLARACIONES Y TIPS.pdf" 
                   class="btn btn-outline-primary"
                   download="ACLARACIONES Y TIPS.pdf">
                  <i class="fas fa-download me-2"></i>Descargar
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title text-primary">PDF Ejemplo 2</h5>
              <p class="card-text">Descripcion de ejemplo</p>
              <div class="d-flex gap-2">
                <a href="../assets/pdf/ACLARACIONES Y TIPS.pdf" 
                   class="btn btn-primary"
                   target="_blank">
                  <i class="fas fa-eye me-2"></i>Ver PDF
                </a>
                <a href="../assets/pdf/ACLARACIONES Y TIPS.pdf" 
                   class="btn btn-outline-primary"
                   download="Guia_Nutricion_TeamOri.pdf">
                  <i class="fas fa-download me-2"></i>Descargar
                </a>
              </div>
            </div>
          </div>
        </div>


        <!-- Card 3 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title text-primary">PDF Ejemplo 3</h5>
              <p class="card-text">Descripcion de ejemplo</p>
              <div class="d-flex gap-2">
                <a href="../assets/pdf/ACLARACIONES Y TIPS.pdf" 
                   class="btn btn-primary"
                   target="_blank">
                  <i class="fas fa-eye me-2"></i>Ver PDF
                </a>
                <a href="../assets/pdf/ACLARACIONES Y TIPS.pdf" 
                   class="btn btn-outline-primary"
                   download="Guia_Nutricion_TeamOri.pdf">
                  <i class="fas fa-download me-2"></i>Descargar
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

<!-- ... resto del código ... -->
              </div>
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
  </body>
</html>
