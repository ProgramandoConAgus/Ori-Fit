<?php
  if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];
$uniqueName ="";
 
try {
   

    // Verifica si el archivo ha sido cargado
    if (isset($_FILES['foto_receta']) && $_FILES['foto_receta']['error'] === UPLOAD_ERR_OK) {
        // Ruta de la carpeta donde quieres almacenar las fotos
        $targetDir = "/Applications/XAMPP/htdocs/Ori-Fit/able-pro-vanila-bootstrap-9.4.3/dist/files/";

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
            //echo "Archivo subido exitosamente.";

            // // Guardar la información de la receta en la base de datos
            // require_once '../sql_files/database.php';
            // $database = new Database();
            // $conn = $database->getConnection();

            // // Otros datos de la receta
            // $titulo = $_POST['titulo'];
            // $descripcion = $_POST['descripcion'];
            // $dificultad = $_POST['dificultad'];
            
            // // Consulta para guardar la receta con la ruta de la foto
            // $stmt = $conn->prepare("INSERT INTO recetas (titulo, descripcion, dificultad, foto) VALUES (?, ?, ?, ?)");
            // $stmt->bind_param("ssss", $titulo, $descripcion, $dificultad, $targetFile);

            // if ($stmt->execute()) {
            //     //echo "Receta guardada con éxito.";
            // } else {
            //     throw new Exception("Error al guardar la receta: " . $conn->error);
            // }

            // $stmt->close();
            // $conn->close();
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
    $sqlReceta = "INSERT INTO recetas (titulo, descripcion, dificultad, foto) VALUES (:titulo, :descripcion, :dificultad, :foto)";
    $stmtReceta = $conn->prepare($sqlReceta);
    $stmtReceta->bindParam(':titulo', $_POST['titulo']);
    $stmtReceta->bindParam(':descripcion', $_POST['descripcion']);
    $stmtReceta->bindParam(':dificultad',$_POST['dificultad']);
 
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
