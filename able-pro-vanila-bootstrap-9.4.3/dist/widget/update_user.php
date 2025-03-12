<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $acceso = isset($_POST['acceso']) && $_POST['acceso'] === 'permitido' ? 'Habilitado' : 'Deshabilitado';
    $plan = isset($_POST['plan']) ? intval($_POST['plan']) : 0;
    $rol = isset($_POST['rol']) ? intval($_POST['rol']) : 0;

    // Validar campos obligatorios
    if (empty($id) || empty($nombre) || empty($apellido) || empty($telefono) || empty($correo) || empty($plan) || empty($rol)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }
    if($acceso=="Habilitado"){
        $acceso=1;
    }
    else{
        $acceso=2;
    }

    try {
        // Preparar consulta
        $query = "UPDATE usuarios SET nombre = ?, apellido = ?, telefono = ?, correo = ?, acceso = ?, idTipoPlan = ?, idRol = ? WHERE id = ?";
        $stmt = $conexion->prepare($query);
        
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        // Asignar parámetros correctamente
        $stmt->bind_param("ssssssii", $nombre, $apellido, $telefono, $correo, $acceso, $plan, $rol, $id);

        // Ejecutar consulta
        if ($stmt->execute()) {
            // Redirigir con mensaje de éxito
            header("Location: w_paneladm.php?#usuarios");
            exit(); // Detener ejecución tras redirección
        } else {
            throw new Exception("Error al actualizar el usuario: " . $stmt->error);
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
