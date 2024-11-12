<?php
include 'db.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos del formulario
    $nombre = trim($_POST['nombre']);
    $edad = filter_var(trim($_POST['edad']), FILTER_VALIDATE_INT);
    $peso = filter_var(trim($_POST['peso']), FILTER_VALIDATE_FLOAT);
    $altura = filter_var(trim($_POST['altura']), FILTER_VALIDATE_INT);
    $genero = trim($_POST['genero']);
    $objetivo = trim($_POST['objetivo']);
    $comidas = filter_var(trim($_POST['comidas']), FILTER_VALIDATE_INT);
    $alimentos_excluidos = trim($_POST['alimentos_excluidos']);
    $enfermedades = trim($_POST['enfermedades']);
    $sentimientos_alimentacion = trim($_POST['sentimientos_alimentacion']);
    $estres_soluciones = trim($_POST['estres_soluciones']);
    $trabajo = trim($_POST['trabajo']);
    $ejercicio = trim($_POST['ejercicio']);
    $dias_entrenamiento = isset($_POST['dias_entrenamiento']) ? filter_var(trim($_POST['dias_entrenamiento']), FILTER_VALIDATE_INT) : null;
    $intensidad = isset($_POST['intensidad']) ? trim($_POST['intensidad']) : null;

    // Verificar si los campos necesarios están completos y válidos
    if ($nombre === "" || !$edad || !$peso || !$altura || $genero === "" || $objetivo === "" || !$comidas) {
        echo "Por favor, ingresa todos los datos requeridos correctamente.";
        exit();
    }

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO solicitudes (nombre, edad, peso, altura, genero, objetivo, comidas, alimentos_excluidos, enfermedades, sentimientos_alimentacion, estres_soluciones, trabajo, ejercicio, dias_entrenamiento, intensidad) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Usar una declaración preparada para evitar inyecciones SQL
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    // Asignación de tipos según la base de datos
    $stmt->bind_param("siidisissssssii", $nombre, $edad, $peso, $altura, $genero, $objetivo, $comidas, $alimentos_excluidos, $enfermedades, $sentimientos_alimentacion, $estres_soluciones, $trabajo, $ejercicio, $dias_entrenamiento, $intensidad);

    // Ejecutar la consulta y verificar el resultado
    if ($stmt->execute()) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos: " . htmlspecialchars($stmt->error);
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
