<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accion = $_POST['accion'];
    $solicitud_id = $_POST['solicitud_id'];
    $porcion = 1; // Modificar según el valor necesario
    $calorias = $_POST['calorias_diarias'];
    $proteinas = $_POST['proteinas_g'];
    $grasas = $_POST['grasas_g'];
    $carbohidratos = $_POST['carbohidratos_g'];
    
    $idIngrediente = 1; // Modificar según el valor necesario
    $estado_id = $accion == 'aprobar' ? 1 : ($accion == 'rechazar' ? 2 : 3);

    $sql = "INSERT INTO tabla_nutricional 
            (solicitud_id, porcion, calorias, proteinas, grasas, carbohidratos, idIngrediente, estado_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
 
    $stmt = $conexion->prepare($sql);

 // Vincular parámetros y ejecutar la inserción    
    $stmt->bind_param("iidddddii", $solicitud_id, $porcion, $calorias, $proteinas, $grasas, $carbohidratos, $idIngrediente, $estado_id);

    if ($stmt->execute()) {
        echo "Plan guardado exitosamente con la acción: $accion.";
    } else {
        echo "Error al guardar el plan.";
    }
}
?>




// Preparar la sentencia de inserción en planes_nutricionales
$sql_insert = "INSERT INTO planes_nutricionales 
               (solicitud_id, idIngrediente, porcion, calorias, proteinas, grasas, carbohidratos, fibra, estado)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_insert = $conexion->prepare($sql_insert);

// Iterar sobre cada alimento y realizar la inserción en planes_nutricionales
while ($alimento = $resultado_alimentos->fetch_assoc()) {
    $idIngrediente = $alimento['IdIngrediente'];
    $porcion = 100; // Definir una porción predeterminada (por ejemplo, 100g)
    $calorias = $alimento['Calorias'];
    $proteinas = $alimento['Gramos_Proteina'];
    $grasas = $alimento['Gramos_Grasas'];
    $carbohidratos = $alimento['Gramos_Carbohidratos'];
    $fibra = 0; // Valor de fibra por defecto

    // Vincular parámetros y ejecutar la inserción
    $stmt_insert->bind_param("iiiddddis", $solicitud_id, $idIngrediente, $porcion, $calorias, $proteinas, $grasas, $carbohidratos, $fibra, $estado);
    $stmt_insert->execute();
}