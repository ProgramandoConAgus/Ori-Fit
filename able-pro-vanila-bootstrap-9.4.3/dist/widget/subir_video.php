<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre          = trim($_POST['nombre'] ?? '');
    $descripcion     = trim($_POST['descripcion'] ?? '');
    $url             = trim($_POST['url'] ?? '');
    $gruposMusculares = isset($_POST['grupo_muscular']) && is_array($_POST['grupo_muscular']) ? array_map('intval', $_POST['grupo_muscular']) : [];
    $direccion       = intval($_POST['movimiento_direccion'] ?? 0);
    $lugar           = intval($_POST['lugar'] ?? 0);
    $sexo            = intval($_POST['sexo'] ?? 0);
    $dificultad      = intval($_POST['dificultad'] ?? 0);
    $grupoEnfoque    = intval($_POST['grupo_enfoque'] ?? 0);
    $equipamientos   = isset($_POST['equipamiento']) && is_array($_POST['equipamiento']) ? array_map('intval', $_POST['equipamiento']) : [];

    // Validación
    if (
        empty($nombre) || empty($descripcion) || empty($url) ||
        empty($gruposMusculares) || empty($direccion) || empty($lugar) ||
        empty($sexo) || empty($grupoEnfoque)
    ) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    try {
        // Insertar video con idGrupoMuscular en NULL (relación ahora es múltiple)
        $query = "INSERT INTO videos (Nombre, Descripcion, URL, idDireccion, idLugar, idSexo, idDificultad, idGrupoEnfoque)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);
        if (!$stmt) throw new Exception("Error al preparar INSERT: " . $conexion->error);

$stmt->bind_param("sssiiiii", $nombre, $descripcion, $url, $direccion, $lugar, $sexo, $dificultad, $grupoEnfoque);
        if (!$stmt->execute()) throw new Exception("Error al ejecutar INSERT videos: " . $stmt->error);

        $videoId = $stmt->insert_id;
        $stmt->close();

        // Insertar equipamientos
        if (!empty($equipamientos)) {
            $queryEquip = "INSERT INTO video_equipamiento (idVideo, idEquipamiento) VALUES (?, ?)";
            $stmtEquip = $conexion->prepare($queryEquip);
            if (!$stmtEquip) throw new Exception("Error al preparar INSERT video_equipamiento: " . $conexion->error);

            $stmtEquip->bind_param("ii", $videoId, $eqId);
            foreach ($equipamientos as $eq) {
                $eqId = intval($eq);
                if (!$stmtEquip->execute()) {
                    throw new Exception("Error al insertar equipamiento: " . $stmtEquip->error);
                }
            }
            $stmtEquip->close();
        }

        // Insertar grupos musculares
        if (!empty($gruposMusculares)) {
            $queryGM = "INSERT INTO video_grupo_muscular (idVideo, idGrupoMuscular) VALUES (?, ?)";
            $stmtGM = $conexion->prepare($queryGM);
            if (!$stmtGM) throw new Exception("Error al preparar INSERT video_grupo_muscular: " . $conexion->error);

            $stmtGM->bind_param("ii", $videoId, $gmId);
            foreach ($gruposMusculares as $gm) {
                $gmId = intval($gm);
                if (!$stmtGM->execute()) {
                    throw new Exception("Error al insertar grupo muscular: " . $stmtGM->error);
                }
            }
            $stmtGM->close();
        }

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
