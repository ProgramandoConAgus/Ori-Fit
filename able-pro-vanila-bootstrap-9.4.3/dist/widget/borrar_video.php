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
        // 1) Eliminar las rutinas que referencian este video
        $delRutina = $conexion->prepare("DELETE FROM rutina_ejercicio WHERE idVideo = ?");
        if (!$delRutina) {
            throw new Exception("Error al preparar DELETE de rutina_ejercicio: " . $conexion->error);
        }
        $delRutina->bind_param("i", $id);
        $delRutina->execute();
        $delRutina->close();

        // 2) Eliminar primero las asociaciones en video_equipamiento
        $delAssoc = $conexion->prepare("DELETE FROM video_equipamiento WHERE idVideo = ?");
        if (!$delAssoc) {
            throw new Exception("Error al preparar DELETE de video_equipamiento: " . $conexion->error);
        }
        $delAssoc->bind_param("i", $id);
        $delAssoc->execute();
        $delAssoc->close();

        // 3) Eliminar asociaciones en video_grupo_muscular
        $delGrupo = $conexion->prepare("DELETE FROM video_grupo_muscular WHERE idVideo = ?");
        if (!$delGrupo) {
            throw new Exception("Error al preparar DELETE de video_grupo_muscular: " . $conexion->error);
        }
        $delGrupo->bind_param("i", $id);
        $delGrupo->execute();
        $delGrupo->close();
        
        // 4) Ahora eliminar el video en sí
        $query = "DELETE FROM videos WHERE IdVideo = ?";
        $stmt = $conexion->prepare($query);
        if (!$stmt) {
            throw new Exception("Error al preparar DELETE de videos: " . $conexion->error);
        }
        $stmt->bind_param("i", $id);

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
