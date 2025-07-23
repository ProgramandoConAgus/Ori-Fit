<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = (int) $_POST['id'];

        $conexion->begin_transaction();
        try {
            // Eliminar datos dependientes
            $stmt = $conexion->prepare("DELETE FROM planes_nutricionales WHERE solicitud_id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();

            $stmt = $conexion->prepare("DELETE FROM resumen_planes WHERE solicitud_id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();

            // Eliminar solicitud principal
            $stmt = $conexion->prepare("DELETE FROM solicitudes WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();

            $conexion->commit();
            header("Location: w_paneladm.php#solicitudes");
            exit();
        } catch (Exception $e) {
            $conexion->rollback();
            echo "Error al eliminar la solicitud: " . $e->getMessage();
        }
    } else {
        echo "Falta el ID de la solicitud para eliminar.";
    }
}

$conexion->close();
?>
