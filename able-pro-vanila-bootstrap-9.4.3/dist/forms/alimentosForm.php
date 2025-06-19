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

$step = isset($_GET['step']) ? intval($_GET['step']) : 1;
$template = __DIR__ . '/../../views/alimentos/step' . $step . '.php';
if (!file_exists($template)) {
    $template = __DIR__ . '/../../views/alimentos/step1.php';
}
include $template;
