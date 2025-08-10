<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    $conexion->begin_transaction();
    try {
        // 1) Obtener idRutina
        $stmt = $conexion->prepare("SELECT idRutina FROM resumen_rutinas WHERE idSolicitud = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($idRutina);
        $stmt->fetch();
        $stmt->close();

        if ($idRutina) {
            // 2) Borrar ejercicios de la rutina (hijo de rutina)
            $del = $conexion->prepare("DELETE FROM rutina_ejercicio WHERE idRutina = ?");
            $del->bind_param('i', $idRutina);
            $del->execute();
            $del->close();

            // 3) Borrar el resumen que referencia a la rutina (hijo de rutina)
            $delRes = $conexion->prepare("DELETE FROM resumen_rutinas WHERE idSolicitud = ?");
            $delRes->bind_param('i', $id);
            $delRes->execute();
            $delRes->close();

            // 4) Ahora sí, borrar la rutina (padre)
            $delRut = $conexion->prepare("DELETE FROM rutina WHERE IdRutina = ?");
            $delRut->bind_param('i', $idRutina);
            $delRut->execute();
            $delRut->close();
        } else {
            // Si no hay rutina asociada, igual hay que borrar el resumen
            $delRes = $conexion->prepare("DELETE FROM resumen_rutinas WHERE idSolicitud = ?");
            $delRes->bind_param('i', $id);
            $delRes->execute();
            $delRes->close();
        }

        // 5) Finalmente, borrar la solicitud
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

$conexion->close();
