<?php
// Conectar a la base de datos
include 'db.php';

// Iniciar sesión para obtener datos de usuario
session_start();

// Para pruebas, el ID del usuario está hardcodeado. Cambiar a $_SESSION['usuario_id'] en producción.
$usuario_id = 1; 

// Consulta para obtener la última solicitud aprobada del usuario
$sql = "SELECT peso, altura, edad, sexo, actividad, objetivo, fecha_solicitud, id 
        FROM solicitudes_nutricionales 
        WHERE usuario_id = ? AND estado = 'aprobada'
        ORDER BY fecha_solicitud DESC LIMIT 1";

// Preparar y ejecutar la consulta
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar si hay resultados y extraer los datos de la solicitud
if ($resultado->num_rows > 0) {
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

// Calcular TMB y calorías diarias basadas en datos del usuario
$tmb = $sexo == 'hombre' ? (10 * $peso) + (6.25 * $altura) - (5 * $edad) + 5 : (10 * $peso) + (6.25 * $altura) - (5 * $edad) - 161;

$actividad_fisica = [
    'sedentario' => 1.2,
    'ligero' => 1.375,
    'moderado' => 1.55,
    'intenso' => 1.725,
    'muy_intenso' => 1.9,
];
$factor_actividad = $actividad_fisica[$actividad];
$calorias_diarias = $tmb * $factor_actividad;

// Calcular macronutrientes según el objetivo
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

// Consulta para obtener alimentos
$sql_alimentos = "SELECT i.IdIngrediente, i.Nombre, i.Calorias, i.Gramos_Proteina, i.Gramos_Carbohidratos, i.Gramos_Grasas, c.Nombre AS Categoria
                  FROM ingredientes i
                  JOIN categorias c ON i.IdCategoria = c.IdCategoria";
$stmt_alimentos = $conexion->prepare($sql_alimentos);
$stmt_alimentos->execute();
$resultado_alimentos = $stmt_alimentos->get_result();


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calcular y Guardar Plan</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<!-- Resumen del plan nutricional -->
<h2>Resumen de Plan Nutricional</h2>
<div>Calorías diarias recomendadas: <?= round($calorias_diarias) ?> kcal</div>
<div>Proteínas: <?= $proteinas_g ?> g</div>
<div>Grasas: <?= $grasas_g ?> g</div>
<div>Carbohidratos: <?= $carbohidratos_g ?> g</div>

<!-- Tabla de alimentos sugeridos -->
<h3>Alimentos Sugeridos</h3>
<table border="1" style="width: 100%; margin-top: 15px;">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Calorías</th>
            <th>Proteínas (g)</th>
            <th>Carbohidratos (g)</th>
            <th>Grasas (g)</th>
            
            <th>Categoría</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($alimento = $resultado_alimentos->fetch_assoc()): ?>
        <tr>
            <td><?= $alimento['Nombre']; ?></td>
            <td><?= $alimento['Calorias']; ?></td>
            <td><?= $alimento['Gramos_Proteina']; ?></td>
            <td><?= $alimento['Gramos_Carbohidratos']; ?></td>
            <td><?= $alimento['Gramos_Grasas']; ?></td>
         
            <td><?= $alimento['Categoria']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Botones de acción -->
<div style="margin-top: 20px;">
    <button id="aprobar" class="boton-accion" style="background-color: green; color: white;">Aprobar</button>
    <button id="rechazar" class="boton-accion" style="background-color: red; color: white;">Rechazar</button>
    <button id="suspender" class="boton-accion" style="background-color: orange; color: white;">Suspender</button>
</div>

<script>
$(document).ready(function() {
    $('.boton-accion').click(function() {
        const accion = $(this).attr('id');

        $.ajax({
            url: 'calcula_y_guarda_plan.php',
            type: 'POST',
            data: {
                accion: accion,
                solicitud_id: <?= $solicitud_id ?>,
                proteinas_g: <?= $proteinas_g ?>,
                grasas_g: <?= $grasas_g ?>,
                carbohidratos_g: <?= $carbohidratos_g ?>,
                calorias_diarias: <?= round($calorias_diarias) ?>
            },
            success: function(response) {
                alert(response);
            },
            error: function() {
                alert("Hubo un error al intentar guardar el plan.");
            }
        });
    });
});
</script>

</body>
</html>
