<?php
include 'db.php';      // Conexión a la base de datos
require_once '../auth/check_session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ─────────────────────────────────────────────────────────────
    // 1) Recibir y limpiar los datos enviados por POST
    // ─────────────────────────────────────────────────────────────
    $usuario_id = $_SESSION['IdUsuario'];
    $nombre = trim($_POST['nombre']);
    $edad = isset($_POST['edad']) ? filter_var(trim($_POST['edad']), FILTER_VALIDATE_INT) : null;
    $genero = isset($_POST['genero']) ? filter_var(trim($_POST['genero']), FILTER_VALIDATE_INT) : null;
    $email = trim($_POST['email']);
    $peso = isset($_POST['peso']) ? filter_var(trim($_POST['peso']), FILTER_VALIDATE_FLOAT) : null;
    $altura = isset($_POST['altura']) ? filter_var(trim($_POST['altura']), FILTER_VALIDATE_INT) : null;
    $objetivo = trim($_POST['objetivo']);
    $suscripcion = trim($_POST['suscripcion']);
    $trabajo = trim($_POST['trabajo']);
    $ejercicio = trim($_POST['ejercicio']);
    $diasEntrenamiento = isset($_POST['dias_entrenamiento']) ? filter_var(trim($_POST['dias_entrenamiento']), FILTER_VALIDATE_INT) : null;
    $intensidad = isset($_POST['intensidad']) ? filter_var(trim($_POST['intensidad']), FILTER_VALIDATE_INT) : null;
    $nivel = isset($_POST['nivel']) ? filter_var(trim($_POST['nivel']), FILTER_VALIDATE_INT) : null;
    $lesiones = trim($_POST['lesiones']);
    $dias_disponibles = isset($_POST['dias_disponibles']) ? filter_var(trim($_POST['dias_disponibles']), FILTER_VALIDATE_INT) : null;
    $lugar_entrenamiento = trim($_POST['lugar_entrenamiento']);
    $preferencia_ejercicios = trim($_POST['preferencia_ejercicios']);
    $grupo_enfoque = trim($_POST['grupo_enfoque']);
    $tiempo_disponible = isset($_POST['tiempo_disponible']) ? filter_var(trim($_POST['tiempo_disponible']), FILTER_VALIDATE_INT) : null;
    $estado = "pendiente";
    $fechaHoraActual = date('Y-m-d H:i:s');

    // ─────────────────────────────────────────────────────────────
    // 2) Validar campos requeridos
    // ─────────────────────────────────────────────────────────────
    if (
        empty($nombre) ||
        empty($email) ||
        empty($objetivo) ||
        empty($suscripcion) ||
        empty($trabajo) ||
        empty($ejercicio) ||
        empty($lesiones) ||
        empty($dias_disponibles) ||
        empty($lugar_entrenamiento) ||
        empty($preferencia_ejercicios) ||
        empty($grupo_enfoque) ||
        
        $genero === null || $genero === false ||
        $nivel === null || $nivel === false ||
        $tiempo_disponible === null || $tiempo_disponible === false ||
        $edad === false ||
        $peso === false ||
        $altura === false
    ) {
        echo "Por favor, completa todos los campos requeridos.";
        exit();
    }

    // Valores por defecto si no se envían
    $diasEntrenamiento = $diasEntrenamiento ?? 0;
    $intensidad = $intensidad ?? 0;
    $nivel = $nivel ?? "";

    try {
        // ─────────────────────────────────────────────────────────────
        // 3) Verificar si ya existe una solicitud para este usuario
        // ─────────────────────────────────────────────────────────────
        $sql = "SELECT * FROM solicitudes_ejercicios WHERE usuario_id = ?";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error al preparar SELECT: " . $conexion->error);
        }
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 0) {
            // ─────────────────────────────────────────────────────────
            // a) INSERT: no existe solicitud previa
            // ─────────────────────────────────────────────────────────
            $sql = "INSERT INTO solicitudes_ejercicios (
                        usuario_id,
                        nombre,
                        edad,
                        email,
                        peso,
                        altura,
                        sexo,
                        objetivo,
                        suscripcion,
                        trabajo,
                        ejercicio,
                        diasEntrenamiento,
                        intensidad,
                        nivel,
                        lesiones,
                        dias_disponibles,
                        lugar_entrenamiento,
                        preferencias,
                        estado,
                        fecha_envio,
                        grupo_enfoque,
                        tiempo_disponible
                    ) VALUES (
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                    )";

            $stmt = $conexion->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Error al preparar INSERT: " . $conexion->error);
            }

            // Cadena de tipos (22 caracteres) → i, s, i, s, d, i, s, s, s, s, s, i, i, s, s, i, s, s, s, s, s, i
            $stmt->bind_param(
                "isisdiissssiiisisssssi",
                 $usuario_id,            //  1 -> i
                 $nombre,                //  2 -> s
                 $edad,                  //  3 -> i
                 $email,                 //  4 -> s
                 $peso,                  //  5 -> d
                 $altura,                //  6 -> i
                 $genero,                //  7 -> s
                 $objetivo,              //  8 -> s
                 $suscripcion,           //  9 -> s
                 $trabajo,               // 10 -> s
                 $ejercicio,             // 11 -> s
                 $diasEntrenamiento,     // 12 -> i
                 $intensidad,            // 13 -> i
                 $nivel,                 // 14 -> s
                 $lesiones,              // 15 -> s
                 $dias_disponibles,      // 16 -> i
                 $lugar_entrenamiento,   // 17 -> s
                 $preferencia_ejercicios,// 18 -> s
                 $estado,                // 19 -> s
                 $fechaHoraActual,       // 20 -> s
                 $grupo_enfoque,         // 21 -> s
                 $tiempo_disponible      // 22 -> i
            );

        } else {
            // ─────────────────────────────────────────────────────────
            // b) UPDATE: ya existe solicitud → actualizamos
            // ─────────────────────────────────────────────────────────
            $sql = "UPDATE solicitudes_ejercicios SET 
                        nombre = ?, 
                        edad = ?, 
                        email = ?, 
                        peso = ?, 
                        altura = ?, 
                        sexo = ?, 
                        objetivo = ?, 
                        suscripcion = ?, 
                        trabajo = ?, 
                        ejercicio = ?, 
                        diasEntrenamiento = ?, 
                        intensidad = ?, 
                        nivel = ?, 
                        lesiones = ?, 
                        dias_disponibles = ?, 
                        lugar_entrenamiento = ?, 
                        preferencias = ?, 
                        estado = ?, 
                        fecha_envio = ?, 
                        grupo_enfoque = ?, 
                        tiempo_disponible = ?
                    WHERE usuario_id = ?";

            $stmt = $conexion->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Error al preparar UPDATE: " . $conexion->error);
            }

            // Cadena de tipos (22 caracteres) → s, i, s, d, i, s, s, s, s, s, i, i, s, s, i, s, s, s, s, s, i, i
            $stmt->bind_param(
                "sisdiissssiiisisssssii",
                 $nombre,                 //  1 -> s
                 $edad,                   //  2 -> i
                 $email,                  //  3 -> s
                 $peso,                   //  4 -> d
                 $altura,                 //  5 -> i
                 $genero,                 //  6 -> s
                 $objetivo,               //  7 -> s
                 $suscripcion,            //  8 -> s
                 $trabajo,                //  9 -> s
                 $ejercicio,              // 10 -> s
                 $diasEntrenamiento,      // 11 -> i
                 $intensidad,             // 12 -> i
                 $nivel,                  // 13 -> s
                 $lesiones,               // 14 -> s
                 $dias_disponibles,       // 15 -> i
                 $lugar_entrenamiento,    // 16 -> s
                 $preferencia_ejercicios, // 17 -> s
                 $estado,                 // 18 -> s
                 $fechaHoraActual,        // 19 -> s
                 $grupo_enfoque,          // 20 -> s
                 $tiempo_disponible,      // 21 -> i
                 $usuario_id              // 22 -> i (cláusula WHERE)
            );
        }

        // ─────────────────────────────────────────────────────────────
        // 4) Ejecutar la consulta (INSERT o UPDATE)
        // ─────────────────────────────────────────────────────────────
        if ($stmt->execute()) {
            echo "Datos guardados exitosamente.";
            header("Location: ../widget/calcula_ejercicios.php");
            exit();
        } else {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Cerrar statement
        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Cerrar la conexión a la base de datos
        $conexion->close();
    }

} else {
    echo "Método no permitido.";
}
?>
