<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
  $uri = 'https://';
} else {
  $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];


error_reporting(E_ALL);
ini_set('display_errors', 1);

try{

require_once '../../sql_files/database.php';

$database = new Database(); 
$conn = $database->getConnection(); 

$id = $_GET['id'] ?? '';

$sql = "
    SELECT * 
    FROM recetas 
    WHERE ";

if (!empty($id)) {
    $sql .= " id = :id";
}  
 
$stmt = $conn->prepare($sql); 
if (!empty($id)) {
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
}
$stmt->execute();
$receta = $stmt->fetch(PDO::FETCH_ASSOC);
$sql = "
  SELECT ri.cantidad, ri.unidad_medida, i.nombre AS ingrediente
  FROM recetas_ingredientes ri
  INNER JOIN ingredientes i ON ri.ingrediente_id = i.IdIngrediente
  WHERE ri.receta_id = :id
";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
$stmt->execute();
$receta['ingredientes'] = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Formatear los resultados en JSON
echo json_encode( $receta);

$conn = null;

}catch(e){
    //echo "Ocurrió un error: " . $e->getMessage();
}
?>
