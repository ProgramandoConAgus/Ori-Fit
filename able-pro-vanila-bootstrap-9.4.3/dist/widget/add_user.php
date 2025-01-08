<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $edad = isset($_POST['edad']) ? trim($_POST['edad']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $acceso = isset($_POST['acceso']) && $_POST['acceso'] === 'permitido' ? 'Habilitado' : 'Deshabilitado';

    // Validar campos obligatorios
    if (empty($nombre) || empty($apellido) || empty($telefono) || empty($correo) || empty($edad)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    try {
        // Preparar consulta para insertar el nuevo usuario
        $query = "INSERT INTO usuarios ( id, nombre, apellido, edad, telefono, correo, acceso) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        // Asignar parámetros
        $stmt->bind_param("issiiss", $id, $nombre, $apellido, $edad, $telefono, $correo, $acceso);

        // Ejecutar consulta
        if ($stmt->execute()) {
            // Redirigir con mensaje de éxito
            header("Location: w_paneladm.php?#usuarios");
            exit(); // Asegúrate de detener la ejecución después de la redirección
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