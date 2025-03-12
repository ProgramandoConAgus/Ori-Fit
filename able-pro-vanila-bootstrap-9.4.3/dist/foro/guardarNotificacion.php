<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
include('../widget/db.php');

// Verificar que el admin esté autenticado
if (!isset($_SESSION['IdUsuario'])) {
    echo json_encode(['success' => false, 'message' => 'Debe estar autenticado']);
    exit;
}

// Recibir y validar datos del formulario
$idUsuario   = filter_input(INPUT_POST, 'idUsuario', FILTER_VALIDATE_INT);
$adminResponse = filter_input(INPUT_POST, 'adminResponse', FILTER_SANITIZE_STRING);

if (!$idUsuario || empty($adminResponse)) {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    exit;
}

// Título fijo para la notificación
$titulo = "Respuesta a pregunta";

// Insertar en la tabla notificaciones
$stmt = $conexion->prepare("INSERT INTO notificaciones (IdUsuario, Titulo, descripcion, fecha) VALUES (?, ?, ?, NOW())");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
    exit;
}

$stmt->bind_param("iss", $idUsuario, $titulo, $adminResponse);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Notificación guardada exitosamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar la notificación']);
}

$stmt->close();
?>
