<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['IdVideo']) ? intval($_POST['IdVideo']) : 0;
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $url = trim($_POST['url'] ?? '');
    $grupoMuscular = isset($_POST['grupo_muscular']) && is_array($_POST['grupo_muscular'])
        ? array_map('intval', $_POST['grupo_muscular'])
        : [];
    $direccion = intval($_POST['movimiento_direccion'] ?? 0);
    $lugar = intval($_POST['lugar'] ?? 0);
    $sexo = intval($_POST['sexo'] ?? 0);
    $dificultad = intval($_POST['dificultad'] ?? 0);
    $grupoEnfoque = intval($_POST['grupo_enfoque'] ?? 0);
    $equipamientos = $_POST['equipamiento'] ?? [];

    if (
        empty($id) || empty($nombre) || empty($descripcion) || empty($url) ||
        empty($grupoMuscular) || empty($direccion) || empty($lugar) ||
        empty($sexo) || empty($grupoEnfoque)
    ) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    try {
        // Actualizar datos básicos del video
        $query = "UPDATE videos SET Nombre = ?, Descripcion = ?, URL = ?, idDireccion = ?, idLugar = ?, idSexo = ?, idDificultad = ?, idGrupoEnfoque = ? WHERE IdVideo = ?";
        $stmt = $conexion->prepare($query);
        if (!$stmt) throw new Exception("Error preparando UPDATE: " . $conexion->error);

        $stmt->bind_param("sssiiiiii", $nombre, $descripcion, $url, $direccion, $lugar, $sexo, $dificultad, $grupoEnfoque, $id);
        if (!$stmt->execute()) throw new Exception("Error al actualizar video: " . $stmt->error);
        $stmt->close();

        // Actualizar grupos musculares
        $delGrupo = $conexion->prepare("DELETE FROM video_grupo_muscular WHERE idVideo = ?");
        $delGrupo->bind_param("i", $id);
        $delGrupo->execute();
        $delGrupo->close();

        if (!empty($grupoMuscular)) {
            $insGrupo = $conexion->prepare("INSERT INTO video_grupo_muscular (idVideo, idGrupoMuscular) VALUES (?, ?)");
            if (!$insGrupo) throw new Exception("Error preparando INSERT video_grupo_muscular: " . $conexion->error);

            $insGrupo->bind_param("ii", $id, $gmId);
            foreach ($grupoMuscular as $gm) {
                $gmId = intval($gm);
                if (!$insGrupo->execute()) {
                    throw new Exception("Error al insertar grupo muscular: " . $insGrupo->error);
                }
            }
            $insGrupo->close();
        }

        // Eliminar equipamiento actual del video
        $del = $conexion->prepare("DELETE FROM video_equipamiento WHERE idVideo = ?");
        $del->bind_param("i", $id);
        $del->execute();
        $del->close();

        // Insertar nuevo equipamiento (si hay)
        if (!empty($equipamientos) && is_array($equipamientos)) {
            $ins = $conexion->prepare("INSERT INTO video_equipamiento (idVideo, idEquipamiento) VALUES (?, ?)");
            foreach ($equipamientos as $eqId) {
                $eqInt = intval($eqId);
                $ins->bind_param("ii", $id, $eqInt);
                $ins->execute();
            }
            $ins->close();
        }

        // Redirigir al panel
        header("Location: w_paneladm.php?#videos");
        exit();

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conexion->close();
    }

} else {
    echo "Método no permitido.";
}
?>
