<?php
include 'db.php'; // Conexión a la base de datos
session_start();    
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Recibir y limpiar los datos
    $usuario_id = $_SESSION['IdUsuario'];
    $nombre = trim($_POST['nombre']);
    $edad = isset($_POST['edad']) ? filter_var(trim($_POST['edad']), FILTER_VALIDATE_INT) : null;
    $genero = trim($_POST['genero']);  // Campo genero
    $email = trim($_POST['email']); // Campo email
    $peso = isset($_POST['peso']) ? filter_var(trim($_POST['peso']), FILTER_VALIDATE_FLOAT) : null;
    $altura = isset($_POST['altura']) ? filter_var(trim($_POST['altura']), FILTER_VALIDATE_INT) : null;
    $objetivo = trim($_POST['objetivo']);
    $suscripcion = trim($_POST['suscripcion']);
    $trabajo = trim($_POST['trabajo']);
    $ejercicio = trim($_POST['ejercicio']);
    $diasEntrenamiento = isset($_POST['dias_entrenamiento']) ? filter_var(trim($_POST['dias_entrenamiento']), FILTER_VALIDATE_INT) : null;
    $intensidad = isset($_POST['intensidad']) ? filter_var(trim($_POST['intensidad']), FILTER_VALIDATE_INT) : null;
    $actividad_previa = trim($_POST['actividad_previas']);
    $lesiones = trim($_POST['lesiones']);
    $ultimo_entrenamiento = trim($_POST['ultimo_entrenamiento']);
    $dias_disponibles = trim($_POST['dias_disponibles']);
    $lugar_entrenamiento = trim($_POST['lugar_entrenamiento']);
    $preferencia_ejercicios = trim($_POST['preferencia_ejercicios']);
    $estado = "pendiente"; // Estado por defecto
    $fechaHoraActual = date('Y-m-d H:i:s'); 
    
    // Validar campos requeridos
    if (
        empty($nombre) || 
        empty($genero) ||  
        empty($email) ||   
        empty($objetivo) ||
        empty($suscripcion) || 
        empty($trabajo) ||
        empty($ejercicio) ||
        empty($actividad_previa) ||
        empty($lesiones) ||
        empty($ultimo_entrenamiento) ||
        empty($dias_disponibles) ||
        empty($lugar_entrenamiento) ||
        empty($preferencia_ejercicios) ||
    
        $edad === false || 
        $peso === false || 
        $altura === false
    ) {
        echo "Por favor, completa todos los campos requeridos.";
        exit();
    }

    // Campos opcionales (asegurar que no sean NULL si no se proporcionan)
    $diasEntrenamiento = $diasEntrenamiento ?? 0; // Si no se envía, valor por defecto
    $intensidad = $intensidad ?? 0;


    try {
        // Verificar si ya existe una solicitud
        $sql = "SELECT * FROM solicitudes WHERE usuario_id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 0) {
            // Insertar nueva solicitud
            $sql = "INSERT INTO solicitudes_ejercicios (
                usuario_id, nombre, edad, email, peso, altura, genero, objetivo, suscripcion, trabajo,
                ejercicio, diasEntrenamiento, intensidad, actividad_previa, lesiones, ultimo_entrenamiento,
                dias_disponibles, lugar_entrenamiento, preferencias, estado, fecha_envio
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    } else {
            // Actualizar solicitud existente
            $sql = "UPDATE solicitudes_ejercicios SET 
            nombre = ?, edad = ?, email = ?, peso = ?, altura = ?, genero = ?, objetivo = ?, suscripcion = ?, trabajo = ?, ejercicio = ?, 
            diasEntrenamiento = ?, intensidad = ?, actividad_previa = ?, lesiones = ?, ultimo_entrenamiento = ?, 
            dias_disponibles = ?, lugar_entrenamiento = ?, preferencias = ?, estado = ?, fecha_envio = ?
            WHERE usuario_id = ?";
        }

        $stmt = $conexion->prepare($sql);

        // Verificar si la consulta se preparó correctamente
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        // Asociar los parámetros y ejecutar la consulta
        if ($resultado->num_rows == 0) {
           // Para INSERT (22 columnas)
           $stmt->bind_param(
            "isisiisssssiiisssssss",
            $usuario_id,
            $nombre,
            $edad,
            $email,
            $peso,
            $altura,
            $genero,
            $objetivo,
            $suscripcion,
            $trabajo,
            $ejercicio,
            $diasEntrenamiento,
            $intensidad,
            $actividad_previa,
            $lesiones,
            $ultimo_entrenamiento,
            $dias_disponibles,
            $lugar_entrenamiento,
            $preferencia_ejercicios,
            $estado,
            $fechaHoraActual
        );
                } else {
                    $stmt->bind_param(
                        "sisisiissssiiissssssi",
                        $nombre,
                        $edad,
                        $email,
                        $peso,
                        $altura,
                        $genero,
                        $objetivo,
                        $suscripcion,
                        $trabajo,
                        $ejercicio,
                        $diasEntrenamiento,
                        $intensidad,
                        $actividad_previa,
                        $lesiones,
                        $ultimo_entrenamiento,
                        $dias_disponibles,
                        $lugar_entrenamiento,
                        $preferencia_ejercicios,
                        $estado,
                        $fechaHoraActual,
                        $usuario_id
                    );
                            }
        
        if ($stmt->execute()) {
            $exitoso = true;
            // Manejar los alimentos excluidos

            if ($exitoso) {
                echo "Datos guardados exitosamente.";
                header("Location: ../widget/asignar_entrenamientos.php");
                exit();
            }
        } else {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Cerrar la consulta
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