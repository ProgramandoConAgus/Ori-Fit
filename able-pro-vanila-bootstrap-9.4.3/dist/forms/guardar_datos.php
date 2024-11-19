<?php
include 'db.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos
    $nombre = trim($_POST['nombre']);
    $edad = isset($_POST['edad']) ? filter_var(trim($_POST['edad']), FILTER_VALIDATE_INT) : null;
    $genero = trim($_POST['genero']);  // Campo genero
    $email = trim($_POST['email']); // Campo email
    $peso = isset($_POST['peso']) ? filter_var(trim($_POST['peso']), FILTER_VALIDATE_FLOAT) : null;
    $altura = isset($_POST['altura']) ? filter_var(trim($_POST['altura']), FILTER_VALIDATE_INT) : null;
    $objetivo = trim($_POST['objetivo']);
    $suscripcion = trim($_POST['suscripcion']);
    $comidas = trim($_POST['comidas']);
    $alimentos_excluidos = trim($_POST['alimentos_excluidos']);
    $enfermedades = trim($_POST['enfermedades']);
    $sentimientos_alimentacion = trim($_POST['sentimientos_alimentacion']);
    $estres_soluciones = trim($_POST['estres_soluciones']);
    $trabajo = trim($_POST['trabajo']);
    $ejercicio = trim($_POST['ejercicio']);
    $dias_entrenamiento = isset($_POST['dias_entrenamiento']) ? filter_var(trim($_POST['dias_entrenamiento']), FILTER_VALIDATE_INT) : null;
    $intensidad = isset($_POST['intensidad']) ? filter_var(trim($_POST['intensidad']), FILTER_VALIDATE_INT) : null;
    $fechaHoraActual = date('Y-m-d H:i:s'); 

    // Validar campos requeridos
    if (
        empty($nombre) || 
        empty($genero) ||  
        empty($email) ||   
        empty($objetivo) ||
        empty($suscripcion) || 
        empty($comidas) || 
        empty($estres_soluciones) || 
        $edad === false || 
        $peso === false || 
        $altura === false
    ) {
        echo "Por favor, completa todos los campos requeridos.";
        exit();
    }

    // Campos opcionales (asegurar que no sean NULL si no se proporcionan)
    $dias_entrenamiento = $dias_entrenamiento ?? 0; // Si no se envía, valor por defecto
    $intensidad = $intensidad ?? 0;

    try {
        // Insertar datos en la base de datos
        $sql = "INSERT INTO solicitudes (nombre, edad, genero, email, peso, altura, objetivo, suscripcion, comidas, alimentos_excluidos, enfermedades, sentimientos_alimentacion, estres_soluciones, trabajo, ejercicio, dias_entrenamiento, intensidad, fecha_envio) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        // Verificar si la consulta se preparó correctamente
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        // Asociar los parámetros y ejecutar la consulta
        $stmt->bind_param(
            "sissdisssssssssiis",
            $nombre,
            $edad,
            $genero, 
            $email,  
            $peso,
            $altura,
            $objetivo,
            $suscripcion,
            $comidas,
            $alimentos_excluidos,
            $enfermedades,
            $sentimientos_alimentacion,
            $estres_soluciones,
            $trabajo,
            $ejercicio,
            $dias_entrenamiento,
            $intensidad,
            $fechaHoraActual
        );

        if ($stmt->execute()) {
            echo "Datos guardados exitosamente.";
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

header("Location: cuestionariohecho.php");
exit();
?>
