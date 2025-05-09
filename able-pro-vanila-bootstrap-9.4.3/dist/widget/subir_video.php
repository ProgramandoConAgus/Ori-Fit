<?php
include 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

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


    try{
    
    $query = "INSERT INTO videos (Nombre, Descripcion, URL, idGrupoMuscular, idDireccion, idEquipamiento, idLugar, idSexo, idDificultad, idGrupoEnfoque) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);

    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("sssiiiiiii", $nombre, $descripcion, $url, $grupoMuscular, $direccion, $equipamiento, $lugar, $sexo, $dificultad, $grupoEnfoque);

     // Ejecutar consulta
     if ($stmt->execute()) {
        // Redirigir con mensaje de éxito
        header("Location: w_paneladm.php?#videosEntrenamientoModal");
        exit(); // Detener ejecución después de la redirección
    } else {
        throw new Exception("Error al agregar el video: " . $stmt->error);
    }

    }catch(Exception $error){
        echo "Error: " . $error->getmessage();
    }finally{
        $conexion->close();
    }
}




?>