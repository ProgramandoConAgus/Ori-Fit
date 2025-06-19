<?php
session_start(); // Iniciar sesión para manejar los datos

// Identificar el formulario actual
$formularioActual = isset($_POST['formularioActual']) ? $_POST['formularioActual'] : 1;

// Manejar el envío de formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($formularioActual) {
        case 1:
            $_SESSION['formulario1'] = array_map('htmlspecialchars', $_POST);
            $formularioActual = 2;
            break;
        case 2:
            $_SESSION['formulario2'] = array_map('htmlspecialchars', $_POST);
            $formularioActual = 3;
            break;
        case 3:
            $_SESSION['formulario3'] = array_map('htmlspecialchars', $_POST);
            
            // Combinar todos los datos
            $todosLosDatos = array_merge(
                $_SESSION['formulario1'],
                $_SESSION['formulario2'],
                $_SESSION['formulario3']
            );

            // Guardar en la base de datos
            require_once __DIR__.'/../db.php';
            $stmt = $conn->prepare("
                INSERT INTO solicitudes 
                (nombre, edad, peso, altura, genero, objetivo, comidas, alimentos_excluidos, enfermedades, 
                 sentimientos_alimentacion, estres_soluciones, trabajo, ejercicio, dias_entrenamiento, intensidad) 
                VALUES 
                (:nombre, :edad, :peso, :altura, :genero, :objetivo, :comidas, :alimentos_excluidos, :enfermedades, 
                 :sentimientos_alimentacion, :estres_soluciones, :trabajo, :ejercicio, :dias_entrenamiento, :intensidad)
            ");
            $stmt->execute([
                ':nombre' => $todosLosDatos['nombre'],
                ':edad' => $todosLosDatos['edad'],
                ':peso' => $todosLosDatos['peso'],
                ':altura' => $todosLosDatos['altura'],
                ':genero' => $todosLosDatos['genero'],
                ':objetivo' => $todosLosDatos['objetivo'],
                ':comidas' => $todosLosDatos['comidas'],
                ':alimentos_excluidos' => $todosLosDatos['alimentos_excluidos'],
                ':enfermedades' => $todosLosDatos['enfermedades'],
                ':sentimientos_alimentacion' => $todosLosDatos['sentimientos_alimentacion'],
                ':estres_soluciones' => $todosLosDatos['estres_soluciones'],
                ':trabajo' => $todosLosDatos['trabajo'],
                ':ejercicio' => $todosLosDatos['ejercicio'],
                ':dias_entrenamiento' => $todosLosDatos['dias_entrenamiento'] ?? null,
                ':intensidad' => $todosLosDatos['intensidad'] ?? null,
            ]);

            // Redirigir al usuario
            session_destroy();
            exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Multi-Formularios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<div class="container">
    <?php if ($formularioActual == 1): ?>
        <!-- Formulario 1: Datos personales -->
        <form method="post">
            <input type="hidden" name="formularioActual" value="1">
            <h3 class="mb-3">Datos personales</h3>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Tu nombre completo" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="edad">Edad</label>
                    <input type="number" id="edad" name="edad" class="form-control" placeholder="Tu edad" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="peso">Peso (kg)</label>
                    <input type="number" id="peso" name="peso" class="form-control" step="0.01" placeholder="Tu peso en kg" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="altura">Altura (cm)</label>
                    <input type="number" id="altura" name="altura" class="form-control" placeholder="Tu altura en cm" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="genero">Género</label>
                    <select id="genero" name="genero" class="form-control" required>
                        <option disabled selected>Seleccionar</option>
                        <option value="mujer">Mujer</option>
                        <option value="hombre">Hombre</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="objetivo">Objetivo</label>
                    <select id="objetivo" name="objetivo" class="form-control" required>
                        <option disabled selected>Seleccionar</option>
                        <option value="perderpeso">Perder peso</option>
                        <option value="aumentomasa">Aumentar masa muscular</option>
                        <option value="alimentacionsaludable">Alimentación saludable</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Siguiente</button>
        </form>
    <?php elseif ($formularioActual == 2): ?>
        <!-- Formulario 2: Alimentación -->
        <form method="post">
            <input type="hidden" name="formularioActual" value="2">
            <h3 class="mb-3">Preguntas sobre tu alimentación</h3>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">¿Cuántas comidas al día haces?</label>
                    <select name="comidas" class="form-control" required>
                        <option disabled selected>Seleccionar</option>
                        <option value="trescomidas">Tres comidas</option>
                        <option value="cuatrocomidas">Cuatro comidas</option>
                        <option value="cincocomidas">Cinco comidas</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">¿Alimentos que no te gusten o seas alérgico?</label>
                    <input type="text" name="alimentos_excluidos" class="form-control" placeholder="Alimentos a evitar" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Enfermedades o patologías alimenticias</label>
                    <input type="text" name="enfermedades" class="form-control" placeholder="Detalles" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">¿Cómo te sientes al comer?</label>
                    <input type="text" name="sentimientos_alimentacion" class="form-control" placeholder="Tus sentimientos" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">¿Qué te ayuda en situaciones de estrés?</label>
                    <input type="text" name="estres_soluciones" class="form-control" placeholder="Ej: salir a caminar" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Siguiente</button>
        </form>
        <?php elseif ($formularioActual == 3): ?>
    <!-- Formulario 3: Ejercicio físico -->
    <form method="post">
        <input type="hidden" name="formularioActual" value="3">
        <h3 class="mb-3">Ejercicio Físico</h3>
        <div class="row">
            <div class="col-md-6">
                <label class="form-label" for="trabajo">¿Tu trabajo es sedentario o activo?</label>
                <select id="trabajo" name="trabajo" class="form-control" required>
                    <option disabled selected>Seleccionar</option>
                    <option value="sedentario">Sedentario</option>
                    <option value="activo">Activo</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="ejercicio">¿Sueles hacer ejercicio físico?</label>
                <select id="ejercicio" name="ejercicio" class="form-control" required>
                    <option disabled selected>Seleccionar</option>
                    <option value="si">Sí</option>
                    <option value="no">No</option>
                </select>
            </div>
        </div>

        <!-- Campos adicionales ocultos inicialmente -->
        <div id="extraFields" style="display: none; gap: 20px; margin-top: 10px;">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="diasEntrenamiento">Días de entrenamiento (1-7)</label>
                    <input name="dias_entrenamiento" type="number" id="diasEntrenamiento" class="form-control" min="1" max="7" placeholder="Días de entrenamiento" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="intensidad">Intensidad (1-6)</label>
                    <input name="intensidad" type="number" id="intensidad" class="form-control" min="1" max="6" placeholder="Intensidad" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Enviar</button>
    </form>

    <!-- Script para mostrar/ocultar los campos adicionales -->
    <script>
        document.getElementById('ejercicio').addEventListener('change', function () {
            const extraFields = document.getElementById('extraFields');
            if (this.value === 'si') {
                extraFields.style.display = 'block';
                document.getElementById('diasEntrenamiento').required = true;
                document.getElementById('intensidad').required = true;
            } else {
                extraFields.style.display = 'none';
                document.getElementById('diasEntrenamiento').required = false;
                document.getElementById('intensidad').required = false;
            }
        });
    </script>
<?php endif; ?>
</div>

</body>
</html>
