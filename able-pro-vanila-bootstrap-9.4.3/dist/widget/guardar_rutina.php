<?php
include 'db.php';
require_once '../auth/check_session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $diasEntrenamiento = isset($_POST['dias_entrenamiento']) ? filter_var(trim($_POST['dias_entrenamiento']), FILTER_VALIDATE_INT) : 0;
    $intensidad = isset($_POST['intensidad']) ? filter_var(trim($_POST['intensidad']), FILTER_VALIDATE_INT) : 0;
    $nivel = isset($_POST['nivel']) ? filter_var(trim($_POST['nivel']), FILTER_VALIDATE_INT) : 0;
    $lesiones = trim($_POST['lesiones']);
    $dias_disponibles = isset($_POST['dias_disponibles']) ? filter_var(trim($_POST['dias_disponibles']), FILTER_VALIDATE_INT) : null;
    $lugar_entrenamiento = trim($_POST['lugar_entrenamiento']);
    $preferencia_ejercicios = trim($_POST['preferencia_ejercicios']);
    $grupo_enfoque = isset($_POST['grupo_enfoque']) ? filter_var(trim($_POST['grupo_enfoque']), FILTER_VALIDATE_INT) : 0;
    $tiempo_disponible = isset($_POST['tiempo_disponible']) ? filter_var(trim($_POST['tiempo_disponible']), FILTER_VALIDATE_INT) : null;
    $estado = "pendiente";
    $fechaHoraActual = date('Y-m-d H:i:s');

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
        $genero === null ||
        $nivel === null ||
        $tiempo_disponible === null ||
        $edad === false ||
        $peso === false ||
        $altura === false
    ) {
        echo "Por favor, completa todos los campos requeridos.";
        exit();
    }

    try {
        $sql = "SELECT 1 FROM solicitudes_ejercicios WHERE usuario_id = ?";
        $stmt = $conexion->prepare($sql);
        if (!$stmt) throw new Exception("Error al preparar SELECT: " . $conexion->error);

        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 0) {
            // INSERT
            $sql = "INSERT INTO solicitudes_ejercicios (
                        usuario_id, nombre, edad, email, peso, altura, sexo,
                        objetivo, suscripcion, trabajo, ejercicio,
                        diasEntrenamiento, intensidad, nivel, lesiones,
                        dias_disponibles, lugar_entrenamiento, preferencias,
                        estado, fecha_envio, grupo_enfoque, tiempo_disponible
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            if (!$stmt) throw new Exception("Error al preparar INSERT: " . $conexion->error);

            // Tipos corregidos (genero i, nivel i, grupo_enfoque i)
            $stmt->bind_param(
                "isisdiissssiiisissssii",
                $usuario_id, $nombre, $edad, $email, $peso, $altura, $genero,
                $objetivo, $suscripcion, $trabajo, $ejercicio, $diasEntrenamiento,
                $intensidad, $nivel, $lesiones, $dias_disponibles, $lugar_entrenamiento,
                $preferencia_ejercicios, $estado, $fechaHoraActual, $grupo_enfoque, $tiempo_disponible
            );
        } else {
            // UPDATE
            $sql = "UPDATE solicitudes_ejercicios SET
                        nombre=?, edad=?, email=?, peso=?, altura=?, sexo=?,
                        objetivo=?, suscripcion=?, trabajo=?, ejercicio=?,
                        diasEntrenamiento=?, intensidad=?, nivel=?, lesiones=?,
                        dias_disponibles=?, lugar_entrenamiento=?, preferencias=?,
                        estado=?, fecha_envio=?, grupo_enfoque=?, tiempo_disponible=?
                    WHERE usuario_id=?";
            $stmt = $conexion->prepare($sql);
            if (!$stmt) throw new Exception("Error al preparar UPDATE: " . $conexion->error);

            $stmt->bind_param(
                "sisdiissssiiisisssssii",
                $nombre, $edad, $email, $peso, $altura, $genero, $objetivo,
                $suscripcion, $trabajo, $ejercicio, $diasEntrenamiento, $intensidad,
                $nivel, $lesiones, $dias_disponibles, $lugar_entrenamiento,
                $preferencia_ejercicios, $estado, $fechaHoraActual, $grupo_enfoque,
                $tiempo_disponible, $usuario_id
            );
        }

        if ($stmt->execute()) {
            header("Location: ../widget/calcula_ejercicios.php");
            exit();
        } else {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
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
