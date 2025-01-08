<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir el ID del usuario a borrar
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    // Validar el ID
    if (empty($id)) {
        echo "ID de usuario no válido.";
        exit();
    }

    try {
        // Preparar la consulta para eliminar el usuario
        $query = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conexion->prepare($query);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        // Asignar el parámetro
        $stmt->bind_param("i", $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir con mensaje de éxito
            header("Location: w_paneladm.php?#usuarios");
            exit();
        } else {
            throw new Exception("Error al eliminar el usuario: " . $stmt->error);
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