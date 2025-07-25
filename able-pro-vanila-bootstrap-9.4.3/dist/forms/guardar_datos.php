<?php
include 'db.php'; // Conexión a la base de datos
require_once '../auth/check_session.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Recibir y limpiar los datos
    $usuario_id = $_SESSION['IdUsuario'];

    // Consultar tipo de plan del usuario
    $plan = 1;
    $stmtPlan = $conexion->prepare("SELECT idTipoPlan FROM usuarios WHERE id = ?");
    if ($stmtPlan) {
        $stmtPlan->bind_param("i", $usuario_id);
        if ($stmtPlan->execute()) {
            $resPlan = $stmtPlan->get_result();
            if ($filaPlan = $resPlan->fetch_assoc()) {
                $plan = (int)$filaPlan['idTipoPlan'];
            }
        }
        $stmtPlan->close();
    }

    $nombre = trim($_POST['nombre']);
    $edad = isset($_POST['edad']) ? filter_var(trim($_POST['edad']), FILTER_VALIDATE_INT) : null;
    $genero = trim($_POST['genero']);  // Campo genero
    // Convertir genero a valor numérico si es necesario
    $genero_num = is_numeric($genero)
        ? (int)$genero
        : ($genero === 'hombre' ? 1 : 2);
    $email = trim($_POST['email']); // Campo email
    $peso = isset($_POST['peso']) ? filter_var(trim($_POST['peso']), FILTER_VALIDATE_FLOAT) : null;
    $altura = isset($_POST['altura']) ? filter_var(trim($_POST['altura']), FILTER_VALIDATE_INT) : null;
    $objetivo = trim($_POST['objetivo']);
    $suscripcion = trim($_POST['suscripcion']);
    $comidaArray = $_POST['comidas'];
    $alimentos_excluidos = $_POST['alimentos_excluidos'];
    $enfermedades = trim($_POST['enfermedades']);
    $sentimientos_alimentacion = trim($_POST['sentimientos_alimentacion']);
    $estres_soluciones = trim($_POST['estres_soluciones']);
    $trabajo = trim($_POST['trabajo']);
    $ejercicio = trim($_POST['ejercicio']);
    $dias_entrenamiento = isset($_POST['dias_entrenamiento']) ? filter_var(trim($_POST['dias_entrenamiento']), FILTER_VALIDATE_INT) : null;
    $intensidad = isset($_POST['intensidad']) ? filter_var(trim($_POST['intensidad']), FILTER_VALIDATE_INT) : null;

    // Datos adicionales si el plan es mixto
    $lesiones = isset($_POST['lesiones']) ? trim($_POST['lesiones']) : '';
    $dias_disponibles = isset($_POST['dias_disponibles']) ? filter_var(trim($_POST['dias_disponibles']), FILTER_VALIDATE_INT) : null;
    $lugar_entrenamiento = isset($_POST['lugar_entrenamiento']) ? trim($_POST['lugar_entrenamiento']) : '';
    $preferencia_ejercicios = isset($_POST['preferencia_ejercicios']) ? trim($_POST['preferencia_ejercicios']) : '';
    $tiempo_disponible = isset($_POST['tiempo_disponible']) ? filter_var(trim($_POST['tiempo_disponible']), FILTER_VALIDATE_INT) : null;
    $nivel = isset($_POST['nivel']) ? filter_var(trim($_POST['nivel']), FILTER_VALIDATE_INT) : null;
    $grupo_enfoque = isset($_POST['grupo_enfoque']) ? trim($_POST['grupo_enfoque']) : '';
    $estado = "pendiente"; // Estado por defecto
    $fechaHoraActual = date('Y-m-d H:i:s'); 
    $comidas=implode("-", $comidaArray);;
    
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
    $dias_entrenamiento = ($dias_entrenamiento === null || $dias_entrenamiento === false) ? 0 : $dias_entrenamiento;
    $intensidad = ($intensidad === null || $intensidad === false) ? 0 : $intensidad;
    $nivel = ($nivel === null || $nivel === false) ? 1 : $nivel;
    $dias_disponibles = ($dias_disponibles === null || $dias_disponibles === false) ? 0 : $dias_disponibles;
    $tiempo_disponible = ($tiempo_disponible === null || $tiempo_disponible === false) ? 30 : $tiempo_disponible;
    $grupo_enfoque = $grupo_enfoque === '' ? 5 : (int)$grupo_enfoque;

    try {
        // Verificar si ya existe una solicitud
        $sql = "SELECT * FROM solicitudes WHERE usuario_id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 0) {
            // Insertar nueva solicitud
            $sql = "INSERT INTO solicitudes (usuario_id, nombre, edad, genero, email, peso, altura, objetivo, suscripcion, comidas, enfermedades, sentimientos_alimentacion, estres_soluciones, trabajo, ejercicio, dias_entrenamiento, intensidad, estado, fecha_envio) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        } else {
            // Actualizar solicitud existente
            $sql = "UPDATE solicitudes SET 
                        nombre = ?, edad = ?, genero = ?, email = ?, peso = ?, altura = ?, objetivo = ?, suscripcion = ?, comidas = ?, enfermedades = ?, sentimientos_alimentacion = ?, estres_soluciones = ?, trabajo = ?, ejercicio = ?, dias_entrenamiento = ?, intensidad = ?, estado = ?, fecha_envio = ? 
                    WHERE usuario_id = ?";
        }

        $stmt = $conexion->prepare($sql);

        // Verificar si la consulta se preparó correctamente
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        // Asociar los parámetros y ejecutar la consulta
        if ($resultado->num_rows == 0) {
            $stmt->bind_param(
                "isissdissssssssiiss",
                $usuario_id,
                $nombre,
                $edad,
                $genero, 
                $email,  
                $peso,
                $altura,
                $objetivo,
                $suscripcion,
                $comidas,
                $enfermedades,
                $sentimientos_alimentacion,
                $estres_soluciones,
                $trabajo,
                $ejercicio,
                $dias_entrenamiento,
                $intensidad,
                $estado,
                $fechaHoraActual
            );
        } else {
            $stmt->bind_param(
                "sissdissssssssiissi",
                $nombre,
                $edad,
                $genero, 
                $email,  
                $peso,
                $altura,
                $objetivo,
                $suscripcion,
                $comidas,
                $enfermedades,
                $sentimientos_alimentacion,
                $estres_soluciones,
                $trabajo,
                $ejercicio,
                $dias_entrenamiento,
                $intensidad,
                $estado,
                $fechaHoraActual,
                $usuario_id
            );
        }

        if ($stmt->execute()) {
            // Manejar los alimentos excluidos
            $exitoso = true;
            $sql_alergia = "DELETE FROM alergiasusuario WHERE IdUsuario = ?";
            $stmt_alergia = $conexion->prepare($sql_alergia);
            $stmt_alergia->bind_param("i", $usuario_id);
            $stmt_alergia->execute();

            $sql_alergia_insert = "INSERT INTO alergiasusuario (IdUsuario, IdIngrediente) VALUES (?, ?)";
            $stmt_alergia_insert = $conexion->prepare($sql_alergia_insert);

            foreach ($alimentos_excluidos as $ingrediente_id) {
                $stmt_alergia_insert->bind_param("ii", $usuario_id, $ingrediente_id);
                if (!$stmt_alergia_insert->execute()) {
                    $exitoso = false;
                    throw new Exception("Error al insertar alergia: " . $stmt_alergia_insert->error);
                }
            }

            if ($exitoso) {
                // Si el usuario tiene plan mixto, guardamos también la solicitud de ejercicios
                if ($plan === 3) {
                    $sqlSelEj = "SELECT * FROM solicitudes_ejercicios WHERE usuario_id = ?"; 
                    $stmtSelEj = $conexion->prepare($sqlSelEj);
                    $stmtSelEj->bind_param("i", $usuario_id);
                    $stmtSelEj->execute();
                    $resSelEj = $stmtSelEj->get_result();

                    if ($resSelEj->num_rows == 0) {
                        $sqlEj = "INSERT INTO solicitudes_ejercicios (usuario_id, nombre, edad, email, peso, altura, sexo, objetivo, suscripcion, trabajo, ejercicio, diasEntrenamiento, intensidad, nivel, lesiones, dias_disponibles, lugar_entrenamiento, preferencias, estado, fecha_envio, grupo_enfoque, tiempo_disponible) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmtEj = $conexion->prepare($sqlEj);
                        $stmtEj->bind_param(
                            "isisdiissssiiisisssssi",
                            $usuario_id,
                            $nombre,
                            $edad,
                            $email,
                            $peso,
                            $altura,
                            $genero_num,
                            $objetivo,
                            $suscripcion,
                            $trabajo,
                            $ejercicio,
                            $dias_entrenamiento,
                            $intensidad,
                            $nivel,
                            $lesiones,
                            $dias_disponibles,
                            $lugar_entrenamiento,
                            $preferencia_ejercicios,
                            $estado,
                            $fechaHoraActual,
                            $grupo_enfoque,
                            $tiempo_disponible
                        );
                    } else {
                        $sqlEj = "UPDATE solicitudes_ejercicios SET nombre = ?, edad = ?, email = ?, peso = ?, altura = ?, sexo = ?, objetivo = ?, suscripcion = ?, trabajo = ?, ejercicio = ?, diasEntrenamiento = ?, intensidad = ?, nivel = ?, lesiones = ?, dias_disponibles = ?, lugar_entrenamiento = ?, preferencias = ?, estado = ?, fecha_envio = ?, grupo_enfoque = ?, tiempo_disponible = ? WHERE usuario_id = ?";
                        $stmtEj = $conexion->prepare($sqlEj);
                        $stmtEj->bind_param(
                            "sisdiissssiiisisssssii",
                            $nombre,
                            $edad,
                            $email,
                            $peso,
                            $altura,
                            $genero_num,
                            $objetivo,
                            $suscripcion,
                            $trabajo,
                            $ejercicio,
                            $dias_entrenamiento,
                            $intensidad,
                            $nivel,
                            $lesiones,
                            $dias_disponibles,
                            $lugar_entrenamiento,
                            $preferencia_ejercicios,
                            $estado,
                            $fechaHoraActual,
                            $grupo_enfoque,
                            $tiempo_disponible,
                            $usuario_id
                        );
                    }
                    $stmtEj->execute();
                }

                echo "Datos guardados exitosamente.";
                header("Location: ../widget/calcula_plan.php");
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
