<?php
include 'db.php';

// Iniciar la sesión para obtener datos de usuario
session_start();

$usuario_id = $_SESSION['IdUsuario'];

// Obtener solicitud más reciente
$sql = "SELECT peso, altura, edad, genero, objetivo, fecha_envio, id, trabajo, ejercicio, diasEntrenamiento, intensidad, nivel, lesiones, dias_disponibles, lugar_entrenamiento
        FROM solicitudes_ejercicios
        WHERE usuario_id = ? AND estado = 'pendiente'
        ORDER BY fecha_envio DESC LIMIT 1";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "No se encontraron solicitudes aprobadas para este usuario.";
    exit();
}

$fila = $resultado->fetch_assoc();
$peso = $fila['peso'];
$altura = $fila['altura'];
$edad = $fila['edad'];
$sexo = $fila['genero'];
$objetivo = $fila['objetivo'];
$trabajo = $fila['trabajo'];
$ejercicio = $fila['ejercicio'];
$diasEntrenamiento = $fila['diasEntrenamiento'];
$intensidad = $fila['intensidad'];
$nivel = $fila['nivel'];
$lesiones = $fila['lesiones'];
$dias_disponibles = $fila['dias_disponibles'];
$lugar_entrenamiento = $fila['lugar_entrenamiento'];
$solicitud_id = $fila['id'];


?>