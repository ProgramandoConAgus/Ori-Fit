<?php

/************BUSCARDOR INGREDIENTES PARA CAMPO ALERGIAS*************************/
// Buscar ingredientes, recupero los ingredientes para el campo de alergias
// Mejora la experiencia de usuario.


include 'db.php';

// Asegurarse de que el parámetro 'query' esté presente
$query = $_GET['query'] ?? '';

if (strlen($query) >= 3) {
    $statement = $conexion->prepare("SELECT Nombre FROM ingredientes WHERE Nombre LIKE ? LIMIT 10");
    $search = "%$query%";
    $statement->bind_param("s", $search);
    $statement->execute();
    $resultados = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

    // Enviar los resultados en formato JSON
    echo json_encode(array_column($resultados, 'Nombre'));
} else {
    echo json_encode([]);
}

/******************************************************************************/
?>
