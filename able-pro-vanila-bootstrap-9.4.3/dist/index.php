<?php


?>

<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Iniciar sesión - Ori Team</title>
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
    <link rel="icon" href="./assets/images/LOGO SIN FONDO-02.png" type="image/x-icon" />
 <!-- [Font] Family -->
<link rel="stylesheet" href="./assets/fonts/inter/inter.css" id="main-font-link" />
<!-- [phosphor Icons] https://phosphoricons.com/ -->
<link rel="stylesheet" href="./assets/fonts/phosphor/duotone/style.css" />
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="./assets/fonts/tabler-icons.min.css" />
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="./assets/fonts/feather.css" />
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="./assets/fonts/fontawesome.css" />
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="./assets/fonts/material.css" />
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="./assets/css/style.css" id="main-style-link" />
<script src="./assets/js/tech-stack.js"></script>
<link rel="stylesheet" href="./assets/css/style-preset.css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <div class="auth-main">
      <div class="auth-wrapper v1">
        <div class="auth-form">
          <div class="card my-5">
            <div class="card-body">
              <div class="text-center">
                <a href="#"><img src="./assets/images/LOGO SIN FONDO-02.png" alt="img" height="80px" width="80px"/></a>
                
              </div>
              <div class="saprator my-3">
                <span>Ingresar como Usuario</span>
              </div>
              <form id="formLogin">
              <div class="mb-3">
                <input type="email" class="form-control" id="email" placeholder="Correo Electronico" name="email" />
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password" />
              </div>
              <div class="d-flex mt-1 justify-content-between align-items-center">
                <h6 class="text-secondary f-w-400 mb-0">
                  <a href="forgot-password-v1.html"> Olvidaste tu contraseña? </a>
                </h6>
              </div>
              <div class="d-grid mt-4">
                <button type="submit" class="btn text-white" style="background-color: #ab76ff;">Ingresar</button>
              </div>
              <div class="d-flex justify-content-between align-items-end mt-4">
                <h6 class="f-w-500 mb-0">Todavia no tenes acceso?</h6>
                <a href="register.php" class="link-primary">Create una cuenta</a>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="./assets/js/plugins/popper.min.js"></script>
    <script src="./assets/js/plugins/simplebar.min.js"></script>
    <script src="./assets/js/plugins/bootstrap.min.js"></script>
    <script src="./assets/js/fonts/custom-font.js"></script>
    <script src="./assets/js/pcoded.js"></script>
    <script src="./assets/js/plugins/feather.min.js"></script>
   
    <script>
    document.getElementById("formLogin").addEventListener("submit", function(e) {
      e.preventDefault(); // Prevenir el envío normal del formulario

      // Obtener los valores de los inputs y convertir el correo a minúsculas
      const email = document.getElementById('email').value.trim().toLowerCase();
      const password = document.getElementById('password').value;

      // Preparar los datos para enviar
      const data = { email, password };

      // Enviar datos usando fetch a login.php
      fetch('validacion-login.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          Swal.fire({
            title: 'Éxito',
            text: result.message,
            icon: 'success',
            confirmButtonText: 'Continuar'
          }).then(() => {
            // Redireccionar al dashboard en caso de éxito
            window.location.href = './pages/panel.php';
          });
        } else {
          Swal.fire({
            title: 'Error',
            text: result.message || 'Datos incorrectos',
            icon: 'error',
            confirmButtonText: 'Aceptar'
          });
        }
      })
      .catch(error => {
        console.error('Error:', error);
        Swal.fire({
          title: 'Error',
          text: 'Error al enviar los datos',
          icon: 'error',
          confirmButtonText: 'Aceptar'
        });
      });
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
    
</div>
</div>

  </body>
  <!-- [Body] end -->
</html>


<?php


?>