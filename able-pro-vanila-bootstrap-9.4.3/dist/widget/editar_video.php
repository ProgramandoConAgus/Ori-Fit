<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['IdVideo']) ? intval($_POST['IdVideo']) : 0;
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $url = trim($_POST['url'] ?? '');
    $grupoMuscular = intval($_POST['grupo_muscular'] ?? 0);
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
        $query = "UPDATE videos SET Nombre = ?, Descripcion = ?, URL = ?, idGrupoMuscular = ?, idDireccion = ?, idLugar = ?, idSexo = ?, idDificultad = ?, idGrupoEnfoque = ? WHERE IdVideo = ?";
        $stmt = $conexion->prepare($query);
        if (!$stmt) throw new Exception("Error preparando UPDATE: " . $conexion->error);

        $stmt->bind_param("sssiiiiiii", $nombre, $descripcion, $url, $grupoMuscular, $direccion, $lugar, $sexo, $dificultad, $grupoEnfoque, $id);
        if (!$stmt->execute()) throw new Exception("Error al actualizar video: " . $stmt->error);
        $stmt->close();

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
