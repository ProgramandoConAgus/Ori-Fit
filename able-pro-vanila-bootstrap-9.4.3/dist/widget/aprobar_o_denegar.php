<?php
include 'db.php'; // Asegúrate de que esta línea esté presente para conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que se haya recibido una acción y una ID de solicitud
    if (isset($_POST['accion'], $_POST['id'])) {
        $accion = $_POST['accion'];
        $id = (int) $_POST['id']; 

        // Definir el valor para el estado según la acción
        $estado = ($accion === 'aprobar') ? 'aprobada' : 'denegada';

        // Preparar la consulta SQL para actualizar el estado
        $sql = "UPDATE solicitudes SET estado = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            // Vincular los parámetros y ejecutar la consulta
            $stmt->bind_param("si", $estado, $id);
            if ($stmt->execute()) {
                // Redirigir de vuelta a la página de solicitudes
                header("Location: w_paneladm.php#solicitudes");
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
