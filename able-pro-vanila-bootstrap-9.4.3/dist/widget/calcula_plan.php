<?php
// Conectar a la base de datos
include 'db.php';

// Iniciar la sesión para obtener datos de usuario
session_start();

// $usuario_id = $_SESSION['usuario_id']; // Captura el id de la sesión del usuario (para pruebas está hardcodeado)
//$usuario_id = 1;  ID de usuario hardcodeado para pruebas
$usuario_id = 1; // ID de usuario hardcodeado para pruebas

// Consulta para obtener la última solicitud aprobada del usuario con rol "usuario"
$sql = "SELECT peso, altura, edad, sexo, actividad, objetivo, fecha_solicitud, id 
        FROM solicitudes_nutricionales 
        WHERE usuario_id = ? AND estado_id = '1'
        ORDER BY fecha_solicitud DESC LIMIT 1"; // Solo la última solicitud aprobada

// Preparar la consulta
$stmt = $conexion->prepare($sql);

// Vincular el parámetro usuario_id
$stmt->bind_param("i", $usuario_id);

// Ejecutar la consulta
$stmt->execute();

// Obtener el resultado de la consulta
$resultado = $stmt->get_result();

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Asignar los datos obtenidos a variables
    $fila = $resultado->fetch_assoc();
    $peso = $fila['peso'];
    $altura = $fila['altura'];
    $edad = $fila['edad'];
    $sexo = $fila['sexo'];
    $actividad = $fila['actividad'];
    $objetivo = $fila['objetivo'];
    $fecha_solicitud = $fila['fecha_solicitud'];
    $solicitud_id = $fila['id'];
} else {
    echo "No se encontraron solicitudes aprobadas para este usuario.";
    exit();
}

// Calcular TMB (Tasa Metabólica Basal) según el sexo
if ($sexo == 'hombre') {
    $tmb = (10 * $peso) + (6.25 * $altura) - (5 * $edad) + 5;
} else {
    $tmb = (10 * $peso) + (6.25 * $altura) - (5 * $edad) - 161;
}

// Ajuste según nivel de actividad física
switch ($actividad) {
    case 'sedentario':
        $factor_actividad = 1.2;
        break;
    case 'ligero':
        $factor_actividad = 1.375;
        break;
    case 'moderado':
        $factor_actividad = 1.55;
        break;
    case 'intenso':
        $factor_actividad = 1.725;
        break;
    case 'muy_intenso':
        $factor_actividad = 1.9;
        break;
}

// Calcular calorías diarias
$calorias_diarias = $tmb * $factor_actividad;

// Definir proporciones de macronutrientes según el objetivo
if ($objetivo == 'perder_peso') {
    $proteinas = $sexo == 'hombre' ? 0.30 * $calorias_diarias : 0.25 * $calorias_diarias;
    $grasas = $sexo == 'hombre' ? 0.25 * $calorias_diarias : 0.35 * $calorias_diarias;
    $carbohidratos = $sexo == 'hombre' ? 0.45 * $calorias_diarias : 0.40 * $calorias_diarias;
} elseif ($objetivo == 'mantener_peso') {
    $proteinas = $sexo == 'hombre' ? 0.25 * $calorias_diarias : 0.20 * $calorias_diarias;
    $grasas = $sexo == 'hombre' ? 0.25 * $calorias_diarias : 0.30 * $calorias_diarias;
    $carbohidratos = $sexo == 'hombre' ? 0.50 * $calorias_diarias : 0.50 * $calorias_diarias;
} elseif ($objetivo == 'ganar_peso') {
    $proteinas = $sexo == 'hombre' ? 0.30 * $calorias_diarias : 0.25 * $calorias_diarias;
    $grasas = $sexo == 'hombre' ? 0.20 * $calorias_diarias : 0.30 * $calorias_diarias;
    $carbohidratos = $sexo == 'hombre' ? 0.50 * $calorias_diarias : 0.45 * $calorias_diarias;
}

// Calcular gramos de macronutrientes
$proteinas_g = round($proteinas / 4);
$grasas_g = round($grasas / 9);
$carbohidratos_g = round($carbohidratos / 4);

// Consulta para obtener los ingredientes que causan alergia
 $sql_alergias = "SELECT IdIngrediente FROM alergiasusuario WHERE IdUsuario = ?";
 $stmt_alergias = $conexion->prepare($sql_alergias);
 $stmt_alergias->bind_param("i", $usuario_id); // Vincular el ID del usuario
 $stmt_alergias->execute();
 $resultado_alergias = $stmt_alergias->get_result();

// Crear un array con los IDs de ingredientes que causan alergia
 $alergias = [];
 while ($fila = $resultado_alergias->fetch_assoc()) {
     $alergias[] = $fila['IdIngrediente'];
 }
 $stmt_alergias->close(); // Cerrar consulta de alergias

 // Crear placeholders para los valores de alergias (ej: "?, ?, ?")
 $placeholders = implode(',', array_fill(0, count($alergias), '?'));

// Consulta para obtener alimentos excluyendo ingredientes alérgicos
 $sql_alimentos = "SELECT i.IdIngrediente, i.Nombre, i.IdCategoria, i.Calorias, i.Gramos_Proteina, i.Gramos_Carbohidratos, i.Gramos_Grasas, c.Nombre AS Categoria
                   FROM ingredientes i
                   JOIN categorias c ON i.IdCategoria = c.IdCategoria
                   WHERE i.IdIngrediente NOT IN ($placeholders)"; // Excluir ingredientes con alergia


// Definir estado pendiente
$estado = '1';

// Consulta para obtener alimentos excluyendo ingredientes alérgicos
$sql_alimentos = "SELECT i.IdIngrediente, i.Nombre, i.IdCategoria, i.Calorias, i.Gramos_Proteina, i.Gramos_Carbohidratos, i.Gramos_Grasas, c.Nombre AS Categoria
                  FROM ingredientes i
                  JOIN categorias c ON i.IdCategoria = c.IdCategoria
                  WHERE i.IdIngrediente NOT IN ($placeholders)";

// Preparar y vincular los parámetros de la consulta de alimentos
$stmt_alimentos = $conexion->prepare($sql_alimentos);
if (count($alergias) > 0) {
    $types = str_repeat('i', count($alergias)); // Define tipos de datos para los parámetros
    $stmt_alimentos->bind_param($types, ...$alergias); // Vincular cada alergia como parámetro
}

// Ejecutar la consulta y obtener el resultado
$stmt_alimentos->execute();
$resultado_alimentos = $stmt_alimentos->get_result();

// Preparar la sentencia de inserción en planes_nutricionales
$sql_insert = "INSERT INTO planes_nutricionales 
               (solicitud_id, idIngrediente, porcion, calorias, proteinas, grasas, carbohidratos, estado_id)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_insert = $conexion->prepare($sql_insert);

// Iterar sobre cada alimento y realizar la inserción en planes_nutricionales
while ($alimento = $resultado_alimentos->fetch_assoc()) {
    $idIngrediente = $alimento['IdIngrediente'];
    $porcion = 100; // Definir una porción predeterminada (por ejemplo, 100g)
    $calorias = $alimento['Calorias'];
    $proteinas = $alimento['Gramos_Proteina'];
    $grasas = $alimento['Gramos_Grasas'];
    $carbohidratos = $alimento['Gramos_Carbohidratos'];
    $estado_id = 1;
 

    // Vincular parámetros y ejecutar la inserción
    $stmt_insert->bind_param("iiidddds", $solicitud_id, $idIngrediente, $porcion, $calorias, $proteinas, $grasas, $carbohidratos, $estado);
    $stmt_insert->execute();
}


// Mensaje de confirmación
echo "Datos del plan nutricional guardados con éxito con estado 'pendiente'.";


// Muestra datos generales para cotrol de LEAN

echo "<h2>Datos de control</h2>";
    echo "Peso: $peso g<br>";
    echo "Altura: $altura g<br>";
    echo "Edad: $edad g<br>";


echo "<h2>Datos de mi plan</h2>";
    echo "Objetivo: $fecha_solicitud g<br>";
    echo "Objetivo: $objetivo g<br>";


echo "<h2>Consumo Diario recomendado</h2>";
    echo "Calorías diarias recomendadas: " . round($calorias_diarias) . " kcal<br>";
    echo "Proteínas: $proteinas_g g<br>";
    echo "Grasas: $grasas_g g<br>";
    echo "Carbohidratos: $carbohidratos_g g<br>";


// Cerrar consulta de alimentos y conexión a la base de datos
$stmt_alimentos->close();
$conexion->close();
?>