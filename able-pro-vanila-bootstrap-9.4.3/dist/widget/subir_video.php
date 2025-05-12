<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre        = trim($_POST['nombre'] ?? '');
    $descripcion   = trim($_POST['descripcion'] ?? '');
    $url           = trim($_POST['url'] ?? '');
    $grupoMuscular = intval($_POST['grupo_muscular'] ?? 0);
    $direccion     = intval($_POST['movimiento_direccion'] ?? 0);
    $lugar         = intval($_POST['lugar'] ?? 0);
    $sexo          = intval($_POST['sexo'] ?? 0);
    $dificultad    = intval($_POST['dificultad'] ?? 0);
    $grupoEnfoque  = intval($_POST['grupo_enfoque'] ?? 0);
    $equipamientos = isset($_POST['equipamiento']) && is_array($_POST['equipamiento']) ? array_map('intval', $_POST['equipamiento']) : [];

    // Validación
    if (
        empty($nombre) || empty($descripcion) || empty($url) ||
        empty($grupoMuscular) || empty($direccion) || empty($lugar) ||
        empty($sexo) || empty($grupoEnfoque)
    ) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    try {
        $query = "INSERT INTO videos (Nombre, Descripcion, URL, idGrupoMuscular, idDireccion, idLugar, idSexo, idDificultad, idGrupoEnfoque)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);
        if (!$stmt) throw new Exception("Error al preparar INSERT: " . $conexion->error);

        $stmt->bind_param("sssiiiiii", $nombre, $descripcion, $url, $grupoMuscular, $direccion, $lugar, $sexo, $dificultad, $grupoEnfoque);
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
                $eqId = intval($eq); // actualizar el valor
                if (!$stmtEquip->execute()) {
                    throw new Exception("Error al insertar equipamiento: " . $stmtEquip->error);
                }
            }
            $stmtEquip->close();
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
