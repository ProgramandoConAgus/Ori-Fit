<?php
require_once __DIR__.'/../db.php'; // Conexión a la base de datos

// Consulta para obtener los ingredientes ordenados por categoría
$sql = "SELECT ingredientes.Nombre AS Ingrediente, categorias.Nombre AS Categoria 
        FROM ingredientes 
        LEFT JOIN categorias ON ingredientes.IdCategoria = categorias.IdCategoria 
        ORDER BY categorias.Nombre, ingredientes.Nombre";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Categoria</th><th>Ingrediente</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . htmlspecialchars($row['Categoria']) . "</td><td>" . htmlspecialchars($row['Ingrediente']) . "</td></tr>";
    }
    
    echo "</table>";
} else {
    echo "No hay ingredientes disponibles.";
}

$conexion->close();
?>
