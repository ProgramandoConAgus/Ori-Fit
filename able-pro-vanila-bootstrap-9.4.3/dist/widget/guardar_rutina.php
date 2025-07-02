<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $solicitud_id    = intval($_POST['solicitud_id'] ?? 0);
    $enfoque         = intval($_POST['enfoque'] ?? 0);
    $dias_disponible = intval($_POST['dias_disponible'] ?? 0);
    $tiempo          = intval($_POST['tiempo_disponible'] ?? 0);
    $ejercicios      = $_POST['ejercicios'] ?? [];

    $conexion->begin_transaction();

    try {
        if (!$solicitud_id) throw new Exception('Solicitud inválida');

        // Obtener idRutina asociado
        $stmt = $conexion->prepare("SELECT idRutina FROM resumen_rutinas WHERE idSolicitud = ? ORDER BY fecha_calculo DESC LIMIT 1");
        $stmt->bind_param('i', $solicitud_id);
        $stmt->execute();
        $stmt->bind_result($idRutina);
        if (!$stmt->fetch()) {
            throw new Exception('Plan no encontrado');
        }
        $stmt->close();

        // Actualizar resumen_rutinas
        $stmt = $conexion->prepare("UPDATE resumen_rutinas SET idEnfoque = ?, fecha_calculo = NOW() WHERE idSolicitud = ?");
        $stmt->bind_param('ii', $enfoque, $solicitud_id);
        if (!$stmt->execute()) throw new Exception('Error actualizando resumen: ' . $stmt->error);
        $stmt->close();

        // Actualizar rutina
        $stmt = $conexion->prepare("UPDATE rutina SET dias_disponible = ?, tiempo_disponible = ? WHERE IdRutina = ?");
        $stmt->bind_param('iii', $dias_disponible, $tiempo, $idRutina);
        if (!$stmt->execute()) throw new Exception('Error actualizando rutina: ' . $stmt->error);
        $stmt->close();

        // Limpiar ejercicios actuales
        $del = $conexion->prepare("DELETE FROM rutina_ejercicio WHERE idRutina = ?");
        $del->bind_param('i', $idRutina);
        $del->execute();
        $del->close();

        // Insertar ejercicios nuevos
        $ins = $conexion->prepare("INSERT INTO rutina_ejercicio (idRutina, dia, idVideo, orden) VALUES (?, ?, ?, ?)");
        foreach ($ejercicios as $dia => $lista) {
            $diaInt = intval($dia);
            $orden = 1;
            if (is_array($lista)) {
                foreach ($lista as $vid) {
                    $vidInt = intval($vid);
                    $ordInt = $orden++;
                    $ins->bind_param('iiii', $idRutina, $diaInt, $vidInt, $ordInt);
                    if (!$ins->execute()) throw new Exception('Error insertando ejercicio: ' . $ins->error);
                }
            }
        }
        $ins->close();

        $conexion->commit();
        header('Location: w_paneladm.php?#solicitudes-ej');
        exit();
    } catch (Exception $e) {
        $conexion->rollback();
        echo 'Error: ' . $e->getMessage();
    } finally {
        $conexion->close();
    }
} else {
    echo 'Método no permitido.';
}
?>
