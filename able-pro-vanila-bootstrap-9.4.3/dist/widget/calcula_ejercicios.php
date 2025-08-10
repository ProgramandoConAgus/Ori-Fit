<?php
include 'db.php';
require_once '../auth/check_session.php';

$usuario_id = $_SESSION['IdUsuario'];

// 1) Traer la última solicitud pendiente
$sql = "
  SELECT 
    peso, altura, edad, sexo, objetivo, fecha_envio,
    id AS solicitud_id, trabajo, ejercicio, diasEntrenamiento,
    intensidad, nivel, lesiones, dias_disponibles,
    lugar_entrenamiento, grupo_enfoque, tiempo_disponible
  FROM solicitudes_ejercicios
  WHERE usuario_id = ? AND estado = 'pendiente'
  ORDER BY fecha_envio DESC
  LIMIT 1
";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$fila = $stmt->get_result()->fetch_assoc();
if (!$fila) die("No hay solicitudes pendientes para este usuario.");

// 2) Extraer variables
$peso                = $fila['peso'];
$altura              = $fila['altura'];
$edad                = $fila['edad'];
$objetivo            = $fila['objetivo'];
$trabajo             = $fila['trabajo'];
$ejercicio           = $fila['ejercicio'];
$diasEntrenamiento   = $fila['diasEntrenamiento'];
$intensidad_usuario  = (int)$fila['intensidad'];
$nivel_usuario       = (int)$fila['nivel'];
$lesiones            = $fila['lesiones'];
$dias_disponibles    = (int)$fila['dias_disponibles'];
$lugar_entrenamiento = $fila['lugar_entrenamiento'];
$solicitud_id        = $fila['solicitud_id'];
$grupo_enfoque       = (int)$fila['grupo_enfoque'];
$tiempo_disponible   = (int)$fila['tiempo_disponible'];
$sexo_usuario        = (int)$fila['sexo'];

// 3) Mapear 'lugar_entrenamiento' a IdLugar
$stmt2 = $conexion->prepare("SELECT IdLugar FROM lugar WHERE Lugar = ?");
$stmt2->bind_param("s", $lugar_entrenamiento);
$stmt2->execute();
$res2 = $stmt2->get_result()->fetch_assoc();
$idLugar = $res2 ? (int)$res2['IdLugar'] : 3; // 3 = cualquiera

// 4) Configuración de días / duración / grupos musculares (TU BLOQUE ORIGINAL)
$config = [
  3 => [ // 3 días x semana
    30 => [
      1 => ['groups'=>[[1],[4],[1,2]], 'limits'=>[4,4,4]],
      2 => ['groups'=>[[2],[4],[2]],   'limits'=>[4,4,4]],
      4 => ['groups'=>[[4],[2],[4]],   'limits'=>[4,4,4]],
      5 => ['groups'=>[[4],[2,1],[3]], 'limits'=>[4,4,4]],
    ],
    45 => [
      1 => ['groups'=>[[1],[4],[1,2]], 'limits'=>[5,5,5]],
      2 => ['groups'=>[[2],[4],[2]],   'limits'=>[5,5,5]],
      4 => ['groups'=>[[4],[2],[4]],   'limits'=>[5,5,5]],
      5 => ['groups'=>[[4],[2,1],[3]], 'limits'=>[5,5,5]],
    ],
    60 => [
      1 => ['groups'=>[[1],[4],[1,2]], 'limits'=>[6,6,6]],
      2 => ['groups'=>[[2],[4],[2]],   'limits'=>[6,6,6]],
      4 => ['groups'=>[[4],[2],[4]],   'limits'=>[6,6,6]],
      5 => ['groups'=>[[4],[2,1],[3]], 'limits'=>[6,6,6]],
    ],
  ],
  4 => [ // 4 días x semana
    30 => [
      1 => ['groups'=>[[1],[4],[1,2],[2,3]], 'limits'=>[4,4,4,4]],
      2 => ['groups'=>[[2],[4],[1,3],[2]],   'limits'=>[4,4,4,4]],
      4 => ['groups'=>[[4],[2],[4,3],[4]],   'limits'=>[4,4,4,4]],
      5 => ['groups'=>[[4],[2],[1],[4,3]],   'limits'=>[4,4,4,4]],
    ],
    45 => [
      1 => ['groups'=>[[1],[4],[1,2],[2,3]], 'limits'=>[5,5,5,5]],
      2 => ['groups'=>[[2],[4],[1,3],[2]],   'limits'=>[5,5,5,5]],
      4 => ['groups'=>[[4],[2],[4,3],[4]],   'limits'=>[5,5,5,5]],
      5 => ['groups'=>[[4],[2],[1],[4,3]],   'limits'=>[5,5,5,5]],
    ],
    60 => [
      1 => ['groups'=>[[1],[4],[1,2],[2,3]], 'limits'=>[6,6,6,6]],
      2 => ['groups'=>[[2],[4],[1,3],[2]],   'limits'=>[6,6,6,6]],
      4 => ['groups'=>[[4],[2],[4,3],[4]],   'limits'=>[6,6,6,6]],
      5 => ['groups'=>[[4],[2],[1],[4,3]],   'limits'=>[7,6,6,7]],
    ],
  ],
  5 => [ // 5 días x semana
    30 => [
      1 => ['groups'=>[[1,3],[4],[2],[1],[1,3]], 'limits'=>[4,4,4,4,4]],
      2 => ['groups'=>[[2],[4],[1,3],[2],[1,3]], 'limits'=>[4,4,4,4,4]],
      4 => ['groups'=>[[4],[2],[1,3],[4],[1,3]], 'limits'=>[4,4,4,4,4]],
      5 => ['groups'=>[[4],[2],[1],[4,3],[2,1]], 'limits'=>[4,4,4,4,4]],
    ],
    45 => [
      1 => ['groups'=>[[1,3],[4],[2],[1],[1,3]], 'limits'=>[5,5,5,5,5]],
      2 => ['groups'=>[[2],[4],[1,3],[2],[1,3]], 'limits'=>[5,5,5,5,5]],
      4 => ['groups'=>[[4],[2],[1,3],[4],[1,3]], 'limits'=>[5,5,5,5,5]],
      5 => ['groups'=>[[4],[2],[1],[4,3],[2,1]], 'limits'=>[5,5,5,5,5]],
    ],
    60 => [
      1 => ['groups'=>[[1,3],[4],[2],[1],[1,3]], 'limits'=>[6,6,6,6,6]],
      2 => ['groups'=>[[2],[4],[1,3],[2],[1,3]], 'limits'=>[6,6,6,6,6]],
      4 => ['groups'=>[[4],[2],[1,3],[4],[1,3]], 'limits'=>[6,6,6,6,6]],
      5 => ['groups'=>[[4],[2],[1],[4,3],[2,1]], 'limits'=>[7,6,6,6,7]],
    ],
  ],
];

// 5) Validar config
if (!isset($config[$dias_disponibles][$tiempo_disponible][$grupo_enfoque])) {
    die("Configuración no encontrada para estos parámetros.");
}

// 6) Función para obtener ejercicios (con <= en dificultad)
function obtenerEjerciciosPorGrupos($c, array $grupos, $sexo, $dif, $lugar, $limite) {
    $inList = implode(',', array_map('intval', $grupos));
    $sql = "
      SELECT DISTINCT IdVideo, Nombre, URL
      FROM videos
      WHERE idGrupoEnfoque IN ($inList)
        AND (idSexo = ? OR idSexo = 3)
        AND (idDificultad <= ?)
        AND (idLugar = ? OR idLugar = 3)
      ORDER BY RAND()
      LIMIT ?
    ";
    $st = $c->prepare($sql);
    $st->bind_param("iiii", $sexo, $dif, $lugar, $limite);
    $st->execute();
    return $st->get_result()->fetch_all(MYSQLI_ASSOC);
}

// 7) Generar rutina (Transacción + evitar duplicados)
$conexion->begin_transaction();
try {
    $insRut = $conexion->prepare(
        "INSERT INTO rutina (idUsuario, tiempo_disponible, fecha, dias_disponible)
         VALUES (?, ?, NOW(), ?)"
    );
    $insRut->bind_param("iii", $usuario_id, $tiempo_disponible, $dias_disponibles);
    $insRut->execute();
    $rutina_id = $insRut->insert_id;

    $stmtEj = $conexion->prepare(
        "INSERT INTO rutina_ejercicio (idRutina, dia, idVideo, orden)
         VALUES (?, ?, ?, ?)"
    );

    $allGroups = [1,2,3,4,5];
    $cfg = $config[$dias_disponibles][$tiempo_disponible][$grupo_enfoque];

    for ($dia = 1; $dia <= $dias_disponibles; $dia++) {
        $ids = [];
        array_walk_recursive($cfg['groups'][$dia-1], function($v) use (&$ids) {
            $ids[] = $v;
        });

        $limit = $cfg['limits'][$dia-1];
        $ejs = obtenerEjerciciosPorGrupos($conexion, $ids, $sexo_usuario, $intensidad_usuario, $idLugar, $limit);

        if (count($ejs) < $limit) {
            $faltan = $limit - count($ejs);
            $extra = obtenerEjerciciosPorGrupos($conexion, $allGroups, $sexo_usuario, $intensidad_usuario, $idLugar, $faltan);
            $ejs = array_merge($ejs, $extra);
        }

        // 🔥 Quitar duplicados por IdVideo
        $unicos = [];
        foreach ($ejs as $ej) {
            $unicos[$ej['IdVideo']] = $ej;
        }
        $ejs = array_values($unicos);

        $orden = 1;
        foreach ($ejs as $e) {
            $stmtEj->bind_param("iiii", $rutina_id, $dia, $e['IdVideo'], $orden);
            $stmtEj->execute();
            $orden++;
        }

        error_log("DIA $dia → EJERCICIOS: " . print_r($ejs, true));
    }

    $insRes = $conexion->prepare(
        "INSERT INTO resumen_rutinas
         (idUsuario, idSolicitud, idEnfoque, fecha_calculo, idRutina)
         VALUES (?, ?, ?, NOW(), ?)"
    );
    $insRes->bind_param("iiii", $usuario_id, $solicitud_id, $grupo_enfoque, $rutina_id);
    $insRes->execute();

    $conexion->commit();
    header('Location: ../widget/panelrutina.php');
    exit();
} catch (Exception $e) {
    $conexion->rollback();
    die("Error generando rutina: " . $e->getMessage());
} finally {
    $conexion->close();
}
?>
