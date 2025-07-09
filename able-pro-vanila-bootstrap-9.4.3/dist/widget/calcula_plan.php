<?php
// Conectar a la base de datos
include 'db.php';

// Iniciar la sesión para obtener datos de usuario
session_start();

$usuario_id = $_SESSION['IdUsuario'];

// Obtener solicitud más reciente
$sql = "SELECT peso, altura, edad, genero, objetivo, fecha_envio, id, trabajo, ejercicio, intensidad, comidas
        FROM solicitudes
        WHERE usuario_id = ? AND estado = 'pendiente'
        ORDER BY fecha_envio DESC LIMIT 1";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "No se encontraron solicitudes aprobadas para este usuario.";
    exit();
}
$fila = $resultado->fetch_assoc();
$comidas = explode("-", $fila['comidas']);
$peso = $fila['peso'];
$altura = $fila['altura'];
$edad = $fila['edad'];
$sexo = $fila['genero'];
$objetivo = $fila['objetivo'];
$solicitud_id = $fila['id'];

// Cálculos de requerimientos nutricionales (mantenido igual)
if ($sexo == 'hombre') {
    $tmb = (10 * $peso) + (6.25 * $altura) - (5 * $edad) + 5;
} else {
    $tmb = (10 * $peso) + (6.25 * $altura) - (5 * $edad) - 161;
}

if($fila['trabajo'] == "activo"){
    if($fila['ejercicio'] == "no" || $fila['intensidad'] < 3){
        $actividad = 2;
    }
    else if($fila['intensidad'] < 5){
        $actividad = 3;
    }
    else if($fila['intensidad'] == 5){
        $actividad = 4;
    }
    else{
        $actividad = 5;
    }
} else {
    $actividad = 1;
}

switch ($actividad) {
    case 1: $factor_actividad = 1.2; break;
    case 2: $factor_actividad = 1.375; break;
    case 3: $factor_actividad = 1.55; break;
    case 4: $factor_actividad = 1.725; break;
    case 5: $factor_actividad = 1.9; break;
}

$calorias_diarias = $tmb * $factor_actividad;

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

$proteinas_g = round($proteinas / 4);
$grasas_g = round($grasas / 9);
$carbohidratos_g = round($carbohidratos / 4);
$calorias_diarias_round=round($calorias_diarias);
// Guardar resumen del plan
$sql_resumen = "INSERT INTO resumen_planes 
                (idUsuario, solicitud_id, calorias, proteinas, grasas, carbohidratos)
                VALUES (?, ?, ?, ?, ?, ?)";
                
$stmt_resumen = $conexion->prepare($sql_resumen);
$stmt_resumen->bind_param("iiiiii", $usuario_id, $solicitud_id, $calorias_diarias_round, $proteinas_g, $grasas_g, $carbohidratos_g);
$stmt_resumen->execute();

// Nueva consulta de ingredientes con tiempos de comida
$sql_alimentos = "SELECT i.IdIngrediente, i.Nombre, i.IdCategoria, i.Calorias, 
                         i.Gramos_Proteina, i.Gramos_Carbohidratos, i.Gramos_Grasas,
                         i.tiempoComidas, c.Nombre AS Categoria
                  FROM ingredientes i
                  JOIN categorias c ON i.IdCategoria = c.IdCategoria
                  WHERE i.IdIngrediente NOT IN (
                      SELECT IdIngrediente FROM alergiasusuario WHERE IdUsuario = ?
                  )
                  ORDER BY RAND()";

$stmt_alimentos = $conexion->prepare($sql_alimentos);
$stmt_alimentos->bind_param("i", $usuario_id);
$stmt_alimentos->execute();
$resultado_alimentos = $stmt_alimentos->get_result();

$ingredientes = [];

// Organizar ingredientes por categoría
while ($alimento = $resultado_alimentos->fetch_assoc()) {
    $ingredientes[$alimento['Categoria']][] = $alimento;
}

// Función mejorada para selección de ingredientes
function seleccionarIngredientesPorComida($comida, $categoria, $cantidad = 4) {
    global $ingredientes;
    
    if (!isset($ingredientes[$categoria])) {
        return [];
    }
    
    $filtrados = array_filter($ingredientes[$categoria], function($ing) use ($comida) {
        return in_array($comida, explode('-', $ing['tiempoComidas']));
    });
    
    shuffle($filtrados);
    return array_slice($filtrados, 0, $cantidad);
}

// Crear estructura del plan nutricional
$plan_nutricional = [];
foreach ($comidas as $comida) {
    $plan_nutricional[$comida] = [
        'Proteínas' => seleccionarIngredientesPorComida($comida, 'Proteínas'),
        'Carbohidratos' => seleccionarIngredientesPorComida($comida, 'Carbohidratos'),
        'Grasas saludables' => seleccionarIngredientesPorComida($comida, 'Grasas saludables')
    ];
}

// Insertar en la base de datos
foreach ($plan_nutricional as $tiempo_comida => $categorias) {
    foreach ($categorias as $categoria => $ingredientes) {
        foreach ($ingredientes as $ingrediente) {
            $sql_insert = "INSERT INTO planes_nutricionales 
                          (solicitud_id, idIngrediente, porcion, tiempo_comida, 
                           calorias, proteinas, grasas, carbohidratos, estado_id)
                          VALUES (?, ?, 100, ?, ?, ?, ?, ?, 1)";
            
            $stmt_insert = $conexion->prepare($sql_insert);
            $stmt_insert->bind_param(
                "iisdddd", 
                $solicitud_id,
                $ingrediente['IdIngrediente'],
                $tiempo_comida,
                $ingrediente['Calorias'],
                $ingrediente['Gramos_Proteina'],
                $ingrediente['Gramos_Grasas'],
                $ingrediente['Gramos_Carbohidratos']
            );
            $stmt_insert->execute();
        }
    }
}

$stmt_alimentos->close();
$conexion->close();
header('Location: ../pages/panel.php');
