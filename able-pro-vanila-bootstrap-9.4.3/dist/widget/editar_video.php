<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $id = isset($_POST['IdVideo']) ? intval($_POST['IdVideo']) : 0;
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
    $url = isset($_POST['url']) ? trim($_POST['url']) : '';
    $grupoMuscular = isset($_POST['grupo_muscular']) ? intval($_POST['grupo_muscular']) : 0;
    $direccion = isset($_POST['movimiento_direccion']) ? intval($_POST['movimiento_direccion']) : 0;
    $equipamiento = isset($_POST['equipamiento']) ? intval($_POST['equipamiento']) : 0;
    $lugar = isset($_POST['lugar']) ? intval($_POST['lugar']) : 0;
    $sexo = isset($_POST['sexo']) ? intval($_POST['sexo']) : 0;
    $dificultad = isset($_POST['dificultad']) ? intval($_POST['dificultad']) : 0;
    $grupoEnfoque = isset($_POST['grupo_enfoque']) ? intval($_POST['grupo_enfoque']) : 0;

    // Validar campos obligatorios
    if (empty($id) || empty($nombre) || empty($descripcion) || empty($url) || empty($grupoMuscular) || empty($direccion) || empty($equipamiento) || empty($lugar) || empty($sexo) || empty($grupoEnfoque)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    try {
        // Preparar consulta
    $query = "UPDATE videos SET Nombre = ?, Descripcion = ?, URL = ?, idGrupoMuscular = ?, idDireccion = ?, idEquipamiento = ?, idLugar = ?, idSexo = ?, idDificultad = ?, idGrupoEnfoque = ?
    WHERE IdVideo = ?";
    $stmt = $conexion->prepare($query);

    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("sssiiiiiiii", $nombre, $descripcion, $url, $grupoMuscular, $direccion, $equipamiento, $lugar, $sexo, $dificultad, $grupoEnfoque, $id);

        // Ejecutar consulta
        if ($stmt->execute()) {
            // Redirigir con mensaje de éxito
            header("Location: w_paneladm.php?#videos");
            exit(); // Detener ejecución tras redirección
        } else {
            throw new Exception("Error al actualizar el video: " . $stmt->error);
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