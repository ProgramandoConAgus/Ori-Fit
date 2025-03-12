<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $solicitud_id = $_POST['solicitud_id'];
    $calorias = $_POST['calorias'];
    $proteinas = $_POST['proteinas'];
    $grasas = $_POST['grasas'];
    $carbohidratos = $_POST['carbohidratos'];
    $ingredientes = $_POST['ingredientes'] ?? [];

    $conexion->begin_transaction();

    try {
        // Validación de campos principales
        if (!is_numeric($calorias)) throw new Exception("Calorías inválidas");
        if (!is_numeric($proteinas)) throw new Exception("Proteínas inválidas");
        if (!is_numeric($grasas)) throw new Exception("Grasas inválidas");
        if (!is_numeric($carbohidratos)) throw new Exception("Carbohidratos inválidos");

        // 1. Actualizar resumen_planes
        $stmt = $conexion->prepare("
            UPDATE resumen_planes 
            SET calorias = ?, proteinas = ?, grasas = ?, carbohidratos = ?, fecha_calculo = NOW() 
            WHERE solicitud_id = ?
        ");
        $stmt->bind_param("iiiii", $calorias, $proteinas, $grasas, $carbohidratos, $solicitud_id);
        
        if (!$stmt->execute()) throw new Exception("Error actualizando resumen: " . $stmt->error);
        $stmt->close();

        // 2. Eliminar ingredientes antiguos
        $deleteStmt = $conexion->prepare("DELETE FROM planes_nutricionales WHERE solicitud_id = ?");
        $deleteStmt->bind_param("i", $solicitud_id);
        if (!$deleteStmt->execute()) throw new Exception("Error eliminando ingredientes: " . $deleteStmt->error);
        $deleteStmt->close();

        // 3. Insertar nuevos ingredientes
        if (!empty($ingredientes)) {
            $insertStmt = $conexion->prepare("
                INSERT INTO planes_nutricionales 
                (solicitud_id, idIngrediente, porcion, tiempo_comida, proteinas, grasas, carbohidratos) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");

            foreach ($ingredientes as $index => $ing) {
                // Validación de estructura del ingrediente
                if (!isset($ing['id'], $ing['porcion'], $ing['tiempo_comida'])) {
                    throw new Exception("Faltan campos en el ingrediente $index");
                }

                // Calcular valores nutricionales
                $idIngrediente = $ing['id'];
                $porcion = $ing['porcion'];
                $tiempo_comida = $ing['tiempo_comida'];
                
                // Obtener valores base del ingrediente
                $sql_nutrientes = "SELECT Gramos_Proteina, Gramos_Grasas, Gramos_Carbohidratos 
                                 FROM ingredientes 
                                 WHERE IdIngrediente = ?";
                $stmt_nut = $conexion->prepare($sql_nutrientes);
                $stmt_nut->bind_param("i", $idIngrediente);
                $stmt_nut->execute();
                $nutrientes = $stmt_nut->get_result()->fetch_assoc();
                
                if (!$nutrientes) throw new Exception("Ingrediente $idIngrediente no encontrado");
                
                // Calcular por porción
                $proteinas_ing = ($nutrientes['Gramos_Proteina'] * $porcion) / 100;
                $grasas_ing = ($nutrientes['Gramos_Grasas'] * $porcion) / 100;
                $carbohidratos_ing = ($nutrientes['Gramos_Carbohidratos'] * $porcion) / 100;

                $insertStmt->bind_param(
                    "iiisddd",
                    $solicitud_id,
                    $idIngrediente,
                    $porcion,
                    $tiempo_comida,
                    $proteinas_ing,
                    $grasas_ing,
                    $carbohidratos_ing
                );
                
                if (!$insertStmt->execute()) throw new Exception("Error insertando ingrediente: " . $insertStmt->error);
            }
            $insertStmt->close();
        }

        $conexion->commit();
        header("Location: w_paneladm.php");
        echo json_encode(['success' => true, 'message' => 'Plan actualizado correctamente']);
    } catch (Exception $e) {
        $conexion->rollback();
        http_response_code(400);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>