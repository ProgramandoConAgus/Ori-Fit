<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir el ID del video a borrar
    $id = isset($_POST['IdVideo']) ? intval($_POST['IdVideo']) : 0;

    // Validar el ID
    if (empty($id)) {
        echo "ID de video no válida.";
        exit();
    }

    try {
        // Preparar la consulta para eliminar el video
        $query = "DELETE FROM videos WHERE IdVideo = ?";
        $stmt = $conexion->prepare($query);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        // Asignar el parámetro
        $stmt->bind_param("i", $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir con mensaje de éxito
            header("Location: w_paneladm.php?#videos");
            exit();
        } else {
            throw new Exception("Error al eliminar el video: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conexion->close();
    }
} else {
    echo "Método no permitido.";
}
?>