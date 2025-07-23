<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Limpiar todas las variables de la sesión
$_SESSION = [];

// Destruir la cookie de sesión si existe
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}

session_destroy();
header('Location: ../index.php');
exit();
?>
