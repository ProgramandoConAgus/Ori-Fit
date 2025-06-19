<?php
require_once __DIR__.'/../db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $peso = isset($_POST['peso']) ? trim($_POST['peso']) : '';
    $altura = isset($_POST['altura']) ? trim($_POST['altura']) : '';
    $objetivo = isset($_POST['objetivo']) ? trim($_POST['objetivo']) : '';
    $suscripcion = isset($_POST['suscripcion']) ? trim($_POST['suscripcion']) : '';
    $comidas = isset($_POST['comidas']) ? trim($_POST['comidas']) : '';
    $estres_soluciones = isset($_POST['estres_soluciones']) ? trim($_POST['estres_soluciones']) : '';
    $alimentos_excluidos = isset($_POST['alimentos_excluidos']) ? trim($_POST['alimentos_excluidos']) : '';
    $enfermedades = isset($_POST['enfermedades']) ? trim($_POST['enfermedades']) : '';
    $sentimientos_alimentacion = isset($_POST['sentimientos_alimentacion']) ? trim($_POST['sentimientos_alimentacion']) : '';
    $trabajo = isset($_POST['trabajo']) ? trim($_POST['trabajo']) : '';
    $ejercicio = isset($_POST['ejercicio']) ? trim($_POST['ejercicio']) : '';
    $dias_entrenamiento = isset($_POST['dias_entrenamiento']) ? trim($_POST['dias_entrenamiento']) : '';
    $intensidad = isset($_POST['intensidad']) ? trim($_POST['intensidad']) : '';
    $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';

    // Validar campos obligatorios
    if (empty($id) || empty($peso) || empty($altura) || empty($objetivo) || empty($suscripcion) || empty($comidas) || empty($estres_soluciones) || empty($alimentos_excluidos) || empty($enfermedades) || empty($trabajo) || empty($dias_entrenamiento) || empty($intensidad) || empty($estado)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    // Validación de campos numéricos
    if (!is_numeric($peso) || !is_numeric($altura) || !is_numeric($dias_entrenamiento) || !is_numeric($intensidad)) {
        echo "El peso, altura y días de entrenamiento deben ser números válidos.";
        exit();
    }

    try {
        // Preparar consulta
        $query = "UPDATE solicitudes SET peso = ?, altura = ?, objetivo = ?, suscripcion = ?, comidas = ?, estres_soluciones = ?, alimentos_excluidos = ?, enfermedades = ?, sentimientos_alimentacion = ?, trabajo = ?, ejercicio = ?, dias_entrenamiento = ?, intensidad = ?, estado = ? WHERE id = ?";
        $stmt = $conexion->prepare($query);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        // Asignar parámetros
        // Ajustamos los tipos de los parámetros según corresponda:
        // 'd' para float (peso, altura), 's' para string (otros campos) y 'i' para enteros (id, días_entrenamiento)
        $stmt->bind_param("iisssssssssiisi", $peso, $altura, $objetivo, $suscripcion, $comidas, $estres_soluciones, $alimentos_excluidos, $enfermedades, $sentimientos_alimentacion, $trabajo, $ejercicio, $dias_entrenamiento, $intensidad, $estado, $id);

        // Ejecutar consulta
        if ($stmt->execute()) {
            // Redirigir con mensaje de éxito
            header("Location: w_paneladm.php#usuarios");
                exit(); // Asegúrate de detener la ejecución después de la redirección
        } else {
            throw new Exception("Error al actualizar el formulario: " . $stmt->error);
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
