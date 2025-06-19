<?php
require_once __DIR__.'/../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $edad = isset($_POST['edad']) ? intval($_POST['edad']) : 0;
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $plan = isset($_POST['plan']) ? intval($_POST['plan']) : 0;
    $rol = isset($_POST['rol']) ? intval($_POST['rol']) : 0;
    $acceso = isset($_POST['acceso']) && $_POST['acceso'] === 'permitido' ? 'Habilitado' : 'Deshabilitado';

    // Validar campos obligatorios
    if (empty($nombre) || empty($apellido) || empty($telefono) || empty($correo) || empty($edad) || empty($plan) || empty($rol)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    try {
        // Preparar consulta para insertar el nuevo usuario
        $query = "INSERT INTO usuarios (nombre, apellido, edad, telefono, correo, acceso, idTipoPlan, idRol) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        // Asignar parámetros
        $stmt->bind_param("ssisssii", $nombre, $apellido, $edad, $telefono, $correo, $acceso, $plan, $rol);

        // Ejecutar consulta
        if ($stmt->execute()) {
            // Redirigir con mensaje de éxito
            header("Location: w_paneladm.php?#usuarios");
            exit(); // Detener ejecución después de la redirección
        } else {
            throw new Exception("Error al agregar el usuario: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conexion->close();
    }
} else {
    echo "Método no permitido.";
}
?>
