<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $plan = isset($_POST['plan']) ? intval($_POST['plan']) : 0;
    $rol = isset($_POST['rol']) ? intval($_POST['rol']) : 0;
    // Convertir el checkbox de acceso a un valor numérico (1=Habilitado, 2=Deshabilitado)
    $acceso = isset($_POST['acceso']) && $_POST['acceso'] === 'permitido' ? 1 : 2;

    // Validar campos obligatorios
    if (empty($nombre) || empty($apellido) || empty($telefono) || empty($correo) || empty($password) || empty($plan) || empty($rol)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $fecha = date("Y-m-d");

    try {
        // Preparar consulta para insertar el nuevo usuario
        $query = "INSERT INTO usuarios (nombre, apellido, correo, password, idRol, acceso, telefono, fecha_registro, idTipoPlan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        // Asignar parámetros
        $stmt->bind_param("ssssiiisi", $nombre, $apellido, $correo, $hashed_password, $rol, $acceso, $telefono, $fecha, $plan);

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
