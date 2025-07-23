<?php
include 'db.php';
require_once '../auth/check_admin.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Método no permitido.";
    exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id <= 0) {
    echo "ID de usuario no válido.";
    exit;
}

try {
    $conexion->begin_transaction();

    /* ---------- 1) Traer IDs relacionados ---------- */
    // Solicitudes de planes de alimentación
    $solicitudesIds = [];
    $stmt = $conexion->prepare("SELECT id FROM solicitudes WHERE usuario_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) $solicitudesIds[] = (int)$row['id'];
    $stmt->close();

    // Solicitudes de rutinas/ejercicios
    $solEjIds = [];
    $stmt = $conexion->prepare("SELECT id FROM solicitudes_ejercicios WHERE usuario_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) $solEjIds[] = (int)$row['id'];
    $stmt->close();

    // Rutinas
    $rutinaIds = [];
    $stmt = $conexion->prepare("SELECT IdRutina FROM rutina WHERE idUsuario = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) $rutinaIds[] = (int)$row['IdRutina'];
    $stmt->close();

    /* Helper para deletes con IN */
    $deleteIn = function(mysqli $cxn, string $table, string $col, array $ids) {
        if (!$ids) return;
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "DELETE FROM {$table} WHERE {$col} IN ($placeholders)";
        $stmt = $cxn->prepare($sql);
        $types = str_repeat('i', count($ids));
        $stmt->bind_param($types, ...$ids);
        $stmt->execute();
        $stmt->close();
    };

    /* ---------- 2) Borrar tablas hijas ---------- */
    // Derivadas de solicitudes (alimentación)
    if ($solicitudesIds) {
        $deleteIn($conexion, 'planes_nutricionales', 'solicitud_id', $solicitudesIds);
        $deleteIn($conexion, 'resumen_planes', 'solicitud_id', $solicitudesIds);
    }

    // Derivadas de solicitudes_ejercicios (rutinas)
    if ($solEjIds) {
        $deleteIn($conexion, 'resumen_rutinas', 'idSolicitud', $solEjIds);
    }

    // Derivadas de rutina
    if ($rutinaIds) {
        $deleteIn($conexion, 'rutina_ejercicio', 'idRutina', $rutinaIds);
    }

    /* ---------- 3) Borrar registros directamente ligados al usuario ---------- */
    $stmt = $conexion->prepare("DELETE FROM alergiasusuario WHERE IdUsuario = ?");
    $stmt->bind_param("i", $id); $stmt->execute(); $stmt->close();

    $stmt = $conexion->prepare("DELETE FROM notificaciones WHERE IdUsuario = ?");
    $stmt->bind_param("i", $id); $stmt->execute(); $stmt->close();

    $stmt = $conexion->prepare("DELETE FROM preguntasusuarios WHERE IdUsuario = ?");
    $stmt->bind_param("i", $id); $stmt->execute(); $stmt->close();

    $stmt = $conexion->prepare("DELETE FROM resumen_planes WHERE idUsuario = ?");
    $stmt->bind_param("i", $id); $stmt->execute(); $stmt->close();

    $stmt = $conexion->prepare("DELETE FROM resumen_rutinas WHERE idUsuario = ?");
    $stmt->bind_param("i", $id); $stmt->execute(); $stmt->close();

    $stmt = $conexion->prepare("DELETE FROM rutina WHERE idUsuario = ?");
    $stmt->bind_param("i", $id); $stmt->execute(); $stmt->close();

    $stmt = $conexion->prepare("DELETE FROM solicitudes_ejercicios WHERE usuario_id = ?");
    $stmt->bind_param("i", $id); $stmt->execute(); $stmt->close();

    $stmt = $conexion->prepare("DELETE FROM solicitudes WHERE usuario_id = ?");
    $stmt->bind_param("i", $id); $stmt->execute(); $stmt->close();

    /* ---------- 4) Usuario ---------- */
    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        throw new Exception("Error al eliminar el usuario: " . $stmt->error);
    }
    $stmt->close();

    $conexion->commit();
    header("Location: w_paneladm.php?#usuarios");
    exit;
} catch (Exception $e) {
    $conexion->rollback();
    http_response_code(500);
    echo "Error: " . $e->getMessage();
} finally {
    $conexion->close();
}
