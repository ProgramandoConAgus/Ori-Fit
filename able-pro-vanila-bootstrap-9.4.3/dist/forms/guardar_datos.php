<?php
include 'db.php'; // Incluye la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $genero = $_POST['genero'];
    $objetivo = $_POST['objetivo'];
    $comidas = $_POST['comidas'];
    $alimentos_excluidos = $_POST['alimentos_excluidos'];
    $enfermedades = $_POST['enfermedades'];
    $sentimientos_alimentacion = $_POST['sentimientos_alimentacion'];
    $estrés_soluciones = $_POST['estrés_soluciones'];
    $trabajo = $_POST['trabajo'];
    $ejercicio = $_POST['ejercicio'];
    $dias_entrenamiento = $_POST['dias_entrenamiento'] ?? null; // Puede ser null si no se proporcionó
    $intensidad = $_POST['intensidad'] ?? null; // Puede ser null si no se proporcionó

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO datos_personales (nombre, edad, peso, altura, genero, objetivo, comidas, alimentos_excluidos, enfermedades, sentimientos_alimentacion, estres_soluciones, trabajo, ejercicio, dias_entrenamiento, intensidad) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Usar una declaración preparada para evitar inyecciones SQL
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("siisssssssssii", $nombre, $edad, $peso, $altura, $genero, $objetivo, $comidas, $alimentos_excluidos, $enfermedades, $sentimientos_alimentacion, $estrés_soluciones, $trabajo, $ejercicio, $dias_entrenamiento, $intensidad);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
