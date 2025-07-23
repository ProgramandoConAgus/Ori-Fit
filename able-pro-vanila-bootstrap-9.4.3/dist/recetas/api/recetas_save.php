<?php
require_once '../../auth/check_admin.php';
  if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];
$uniqueName ="";
require_once '../../configuration.php';

try {
   

    // Verifica si el archivo ha sido cargado
    if (isset($_FILES['foto_receta']) && $_FILES['foto_receta']['error'] === UPLOAD_ERR_OK) {
      

        // Crea la carpeta si no existe
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Nombre del archivo original y extensión
        $fileName = basename($_FILES['foto_receta']['name']);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Generar un nombre único para evitar sobreescribir archivos
        $uniqueName = uniqid('receta_') . '.' . $fileType;

        

        // Ruta completa del archivo en el servidor
        $targetFile = $targetDir . $uniqueName; 

        // Validación de tipo de archivo (opcional)
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($fileType), $allowedTypes)) {
            throw new Exception("Tipo de archivo no permitido. Solo se permiten JPG, JPEG, PNG, y GIF.");
        }

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES['foto_receta']['tmp_name'], $targetFile)) {
            
        } else {
            throw new Exception("Error al mover el archivo a la carpeta de destino.");
        }
    } else {
        throw new Exception("Error al cargar el archivo.");
    }
} catch (Exception $e) {
    echo "Ocurrió un error: " .json_encode($e)."<br/>" ;
} 


try {
    // Conexión a la base de datos
    require_once '../../sql_files/database.php';
   

    $database = new Database(); 
    $conn = $database->getConnection(); 

    // Iniciar la transacción
    $conn->beginTransaction(); 
    // Insertar en la tabla recetas
    $sqlReceta = "INSERT INTO recetas (titulo, descripcion, dificultad, foto, tiempo_preparacion, porciones) VALUES (:titulo, :descripcion, :dificultad, :foto, :tiempo_preparacion, :porciones)";
    $stmtReceta = $conn->prepare($sqlReceta);
    $stmtReceta->bindParam(':titulo', $_POST['titulo']);
    $stmtReceta->bindParam(':descripcion', $_POST['descripcion']);
    $stmtReceta->bindParam(':dificultad',$_POST['dificultad']); 

    $tiempo_preparacion = !empty($_POST['tiempo_preparacion']) ? $_POST['tiempo_preparacion'] : null;
    $porciones = !empty($_POST['porciones']) ? $_POST['porciones'] : null;
 

    $stmtReceta->bindParam(':tiempo_preparacion',$tiempo_preparacion);
    $stmtReceta->bindParam(':porciones',$porciones);
    $stmtReceta->bindParam(':foto', $uniqueName);
   
    
    $stmtReceta->execute();
    $recetaId = $conn->lastInsertId();

    // Insertar ingredientes en la tabla recetas_ingredientes
    $sqlIngrediente = "INSERT INTO recetas_ingredientes (receta_id, ingrediente_id, cantidad, unidad_medida) VALUES (:receta_id, :ingrediente_id, :cantidad, :unidad_medida)";
    $stmtIngrediente = $conn->prepare($sqlIngrediente);

    foreach ($_POST['ingredientes'] as $ingrediente) {
        //echo json_encode($ingrediente)."<br />";
        $stmtIngrediente->bindParam(':receta_id', $recetaId);
        $stmtIngrediente->bindParam(':ingrediente_id', $ingrediente['ingrediente_id']);
        $stmtIngrediente->bindParam(':cantidad', $ingrediente['cantidad']);
        $stmtIngrediente->bindParam(':unidad_medida', $ingrediente['unidad']);
        $stmtIngrediente->execute();
    }

    // Confirmar la transacción
    $conn->commit();
  
    header('Location: '.$uri.'/ori-fit/able-pro-vanila-bootstrap-9.4.3/dist/recetas/');
    //echo "Receta guardada exitosamente.";

} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conn->rollBack();
    echo "Error al guardar la receta: " . $e->getMessage()."<br />";
    echo json_encode($_POST)."<br />";

    //header('Location: '.$uri.'/ori-fit/able-pro-vanila-bootstrap-9.4.3/dist/recetas/nueva-receta.php');
}

$conn = null;
?>
