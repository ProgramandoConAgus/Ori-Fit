<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'], $_POST['id'])) {
        $accion = $_POST['accion'];
        $id = (int) $_POST['id'];

        $estado = ($accion === 'aprobar') ? 'aprobada' : 'denegada';
        $sql = "UPDATE solicitudes_ejercicios SET estado = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('si', $estado, $id);
            if ($stmt->execute()) {
                header('Location: w_paneladm.php#solicitudes-ej');
                exit();
            } else {
                echo "Error al actualizar el estado de la solicitud.";
            }
            $stmt->close();
        } else {
            echo "Error al preparar la consulta.";
        }
    } else {
        echo "Faltan datos para procesar la solicitud.";
    }
}
$conexion->close();
?>
