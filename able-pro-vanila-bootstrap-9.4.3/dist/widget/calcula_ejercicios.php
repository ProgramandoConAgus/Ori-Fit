<?php
include 'db.php';

// Permite utilizar este script sin redirección cuando se incluye
if (!defined('SKIP_REDIRECT')) {
    define('SKIP_REDIRECT', false);
}

session_start();
$usuario_id = $_SESSION['IdUsuario'];

// Obtener la última solicitud de ejercicios en estado pendiente
$sql = "SELECT id, dias_disponibles FROM solicitudes_ejercicios
        WHERE usuario_id = ? AND estado = 'pendiente'
        ORDER BY fecha_envio DESC LIMIT 1";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    if (!SKIP_REDIRECT) {
        echo 'No se encontraron solicitudes pendientes.';
    }
    exit();
}
$fila = $res->fetch_assoc();
$solicitud_id = (int)$fila['id'];
$dias = (int)$fila['dias_disponibles'];
$tiempo = 60; // minutos disponibles por día (valor por defecto)

$conexion->begin_transaction();
try {
    // Crear rutina base
    $stmt = $conexion->prepare("INSERT INTO rutina (dias_disponible, tiempo_disponible) VALUES (?, ?)");
    $stmt->bind_param('ii', $dias, $tiempo);
    $stmt->execute();
    $idRutina = $conexion->insert_id;
    $stmt->close();

    // Registrar resumen de rutina con enfoque por defecto = 1
    $enfoque = 1;
    $stmt = $conexion->prepare("INSERT INTO resumen_rutinas (idSolicitud, idEnfoque, idRutina, fecha_calculo) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param('iii', $solicitud_id, $enfoque, $idRutina);
    $stmt->execute();
    $stmt->close();

    // Obtener videos aleatorios para la rutina
    $videos = [];
    $resVid = $conexion->query("SELECT IdVideo FROM videos ORDER BY RAND()");
    while ($row = $resVid->fetch_assoc()) {
        $videos[] = $row['IdVideo'];
    }

    if (!$videos) {
        throw new Exception('No hay videos disponibles');
    }

    $index = 0;
    for ($dia = 1; $dia <= $dias; $dia++) {
        for ($orden = 1; $orden <= 3; $orden++) {
            if ($index >= count($videos)) {
                $index = 0;
            }
            $idVideo = $videos[$index++];
            $stmt = $conexion->prepare("INSERT INTO rutina_ejercicio (idRutina, dia, idVideo, orden) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('iiii', $idRutina, $dia, $idVideo, $orden);
            $stmt->execute();
            $stmt->close();
        }
    }

    $conexion->commit();
} catch (Exception $e) {
    $conexion->rollback();
    if (!SKIP_REDIRECT) {
        echo 'Error: ' . $e->getMessage();
    }
}

$conexion->close();

if (!SKIP_REDIRECT) {
    header('Location: ../pages/panel.php');
}
?>
