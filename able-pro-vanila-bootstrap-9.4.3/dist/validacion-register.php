<?php
include('widget/db.php');
$message='';
if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['telefono'])) {
    $nombre = strtolower(trim($_POST['nombre']));
    $apellido = strtolower(trim($_POST['apellido']));
    $email = strtolower(trim($_POST['email']));
    $telefono=$_POST['telefono'];
    $password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];
	
    // Consultar la base de datos para obtener el registro del usuario
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $message="Ya existe una cuenta con este mail.";
        } else {
            if($password===$confirmPassword){
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql_insert = "INSERT INTO usuarios (nombre, apellido, correo, password, idRol, acceso, telefono, fecha_registro,idTipoPlan) VALUES (?, ?, ?, ?,?,?, ?,?,?)";
                $stmt_insert = $conexion->prepare($sql_insert);
                $idTipoUsuario = 1;
				$idsuscripcion=2;
                $fecha=date("Y-m-d");
				$idTipoPlan=1;
                $stmt_insert->bind_param('ssssiiisi', $nombre, $apellido, $email, $hashed_password, $idTipoUsuario, $idsuscripcion, $telefono, $fecha,$idTipoPlan);

                if ($stmt_insert->execute()) {
                    header('Location: index.php');
                    exit(); 
                } else {
                    $message = "Error al crear el usuario: " . $stmt_insert->error;
                }

            }
			else{
				$message="Las contraseñas deben ser iguales";
			}


        }
    } else {
        $message="Error en la consulta: " . $conexion->error . "<br>";
    }

    $stmt->close();
} else {
    echo "Todos los campos son requeridos.";
}

?>
<?php
/*
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
<base href="./" />
<title>Medicina y Anatomia</title>

	<link rel="icon" type="image/png" href="./images/logo-anato.png">
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template - Metronic by KeenThemes" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Metronic by Keenthemes" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="auth-bg bgi-size-cover bgi-position-center bgi-no-repeat">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page bg image-->
			<style>body { background-image: url('assets/media/auth/bg8.jpg'); } [data-bs-theme="dark"] body { background-image: url('assets/media/auth/bg8-dark.jpg'); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Signup Welcome Message -->
			<div class="d-flex flex-column flex-center flex-column-fluid">
				<!--begin::Content-->
				<div class="d-flex flex-column flex-center text-center p-10">
					<!--begin::Wrapper-->
					<div class="card card-flush w-md-650px py-5">
						<div class="card-body py-15 py-lg-20">
							<!--begin::Title-->
							<h1 class="fw-bolder text-gray-900 mb-5">Lo sentimos...</h1>
							<!--end::Title-->
							<!--begin::Text-->
							<div class="fw-semibold fs-6 text-gray-500 mb-7"><?=$message?></div>
							<!--end::Text-->
							<!--begin::Illustration-->
							<div class="mb-0">
								<img src="./images/estudio.png" class="mw-100 mh-300px theme-light-show" alt="" />
								<img src="./images/estudio.png" class="mw-100 mh-300px theme-dark-show" alt="" />
							</div>
							<!--end::Illustration-->
							<!--begin::Link-->
							<div class="mb-0">
								<a href="index.php" class="btn btn-sm btn-primary">Volver</a>
							</div>
							<!--end::Link-->
						</div>
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Authentication - Signup Welcome Message-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
*/