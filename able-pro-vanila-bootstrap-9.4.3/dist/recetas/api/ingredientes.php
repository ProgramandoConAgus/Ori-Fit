<?php

// Mostrar todos los errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    require_once '../../sql_files/database.php';

    $database = new Database(); 
    $conn = $database->getConnection();

    $sql = "SELECT IdIngrediente, Nombre, Gramos_Proteina, Calorias, Gramos_Grasas FROM ingredientes";

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Obtener los resultados de la consulta
    $ingredientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Formatear los resultados en JSON
    echo json_encode($ingredientes);

    // Cerrar la conexión
    $conn = null;

} catch (Exception $e) {
    // Mostrar mensaje de error
    echo "Ocurrió un error: " . $e->getMessage();
}
?>
