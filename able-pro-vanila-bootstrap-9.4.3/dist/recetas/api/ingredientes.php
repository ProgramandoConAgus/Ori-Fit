<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

try{

require_once '../../sql_files/database.php';

$database = new Database(); 
$conn = $database->getConnection();
// $conn->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

 

$sql = "
    SELECT i.* 
    FROM ingredientes i
    WHERE 1=1
";

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($sql);

$stmt->execute();

// Obtener los resultados de la consulta
$ingredientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
 

// Formatear los resultados en JSON
echo json_encode( $ingredientes);

$conn = null;

}catch(e){
    //echo "Ocurrió un error: " . $e->getMessage();
}
?>
