<?php
include 'db.php'; // Incluye la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que se haya recibido el ID de la solicitud
    if (isset($_POST['id'])) {
        $id = (int) $_POST['id'];

        // Preparar la consulta para eliminar la solicitud
        $sql = "DELETE FROM solicitudes WHERE id = ?";
        $stmt = $conexion->prepare($sql);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            // Vincular el parámetro y ejecutar la consulta
            $stmt->bind_param("i", $id); // "i" significa entero
            if ($stmt->execute()) {
                // Redirigir de vuelta a la página principal después de eliminar
                header("Location: w_solis.php?mensaje=eliminado");
                exit(); 
            } else {
                echo "Error al eliminar la solicitud.";
            }
            $stmt->close();
        } else {
            echo "Error al preparar la consulta.";
        }
    } else {
        echo "Falta el ID de la solicitud para eliminar.";
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
