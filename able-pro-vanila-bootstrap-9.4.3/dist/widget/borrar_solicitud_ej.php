<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = (int)$_POST['id'];

        $conexion->begin_transaction();
        try {
            // Buscar rutina asociada a la solicitud
            $idRutina = null;
            $stmt = $conexion->prepare("SELECT idRutina FROM resumen_rutinas WHERE idSolicitud = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($idRutina);
            $stmt->fetch();
            $stmt->close();

            if ($idRutina) {
                $del = $conexion->prepare("DELETE FROM rutina_ejercicio WHERE idRutina = ?");
                $del->bind_param('i', $idRutina);
                $del->execute();
                $del->close();

                $delRut = $conexion->prepare("DELETE FROM rutina WHERE IdRutina = ?");
                $delRut->bind_param('i', $idRutina);
                $delRut->execute();
                $delRut->close();
            }

            $stmt = $conexion->prepare("DELETE FROM resumen_rutinas WHERE idSolicitud = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();

            $stmt = $conexion->prepare("DELETE FROM solicitudes_ejercicios WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();

            $conexion->commit();
            header('Location: w_paneladm.php#solicitudes-ej');
            exit();
        } catch (Exception $e) {
            $conexion->rollback();
            echo 'Error al eliminar la solicitud: ' . $e->getMessage();
        }
    } else {
        echo 'Falta el ID de la solicitud para eliminar.';
    }
}

$conexion->close();
?>
