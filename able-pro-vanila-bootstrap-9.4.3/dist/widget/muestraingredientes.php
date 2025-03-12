<?php
include('db.php'); // Incluir archivo de conexión

try {
    $query = "SELECT c.Nombre AS categoria, i.Nombre AS ingrediente, i.tiempoComidas 
              FROM ingredientes i 
              INNER JOIN categorias c ON i.IdCategoria = c.IdCategoria 
              where i.tiempoComidas is  null
              ORDER BY c.Nombre ASC, i.Nombre ASC";
    
    $resultado = $conexion->query($query);
    
    if($resultado->num_rows === 0) {
        throw new Exception("No se encontraron ingredientes");
    }

    $current_category = '';
    echo "LISTA DE INGREDIENTES POR CATEGORÍA:\n\n";
    
    while($fila = $resultado->fetch_assoc()) {
        if($fila['categoria'] != $current_category) {
            $current_category = $fila['categoria'];
            echo "<br>=== " . strtoupper($current_category) . " === <br>";
        }
        echo "- " . $fila['ingrediente'] . "<br>";
    }

} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>