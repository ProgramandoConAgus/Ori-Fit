<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {

    require_once '../../sql_files/database.php';

    $database = new Database();
    $conn = $database->getConnection();
    if ($conn === null) {
        throw new Exception('DB connection failed');
    }

    // Parámetros de entrada
    $titulo = $_GET['titulo'] ?? '';
    $dificultad = $_GET['dificultad'] ?? '';
    $tiempo_preparacion = $_GET['tiempo_preparacion'] ?? '';
    $ingrediente = $_GET['ingrediente'] ?? '';  // Nuevo filtro para ingrediente
    $page = $_GET['page'] ?? 1;
    $limit = 8; // Número de recetas por página
    $offset = ($page - 1) * $limit;

    // Construir la consulta SQL con filtros
    $sql = "
        SELECT DISTINCT r.* 
        FROM recetas r
        LEFT JOIN recetas_ingredientes ri ON r.id = ri.receta_id
        LEFT JOIN ingredientes i ON ri.ingrediente_id = i.id
        WHERE 1=1
    ";

    if (!empty($titulo)) {
        $sql .= " AND titulo LIKE :titulo";
    }
    if (!empty($dificultad)) {
        $sql .= " AND dificultad = :dificultad";
    }
    if (!empty($tiempo_preparacion)) {
        $sql .= " AND tiempo_preparacion <= :tiempo_preparacion";
    }
    if (!empty($ingrediente)) {
        $sql .= " AND i.nombre LIKE :ingrediente";
    }
    $sql .= " LIMIT :limit OFFSET :offset";

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare($sql);
    if (!empty($titulo)) {
        $stmt->bindValue(':titulo', "%$titulo%", PDO::PARAM_STR);
    }
    if (!empty($dificultad)) {
        $stmt->bindValue(':dificultad', $dificultad, PDO::PARAM_STR);
    }
    if (!empty($tiempo_preparacion)) {
        $stmt->bindValue(':tiempo_preparacion', $tiempo_preparacion, PDO::PARAM_INT);
    }
    if (!empty($ingrediente)) {
        $stmt->bindValue(':ingrediente', "%$ingrediente%", PDO::PARAM_STR);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    // Obtener los resultados de la consulta
    $recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Obtener el total de registros para calcular el número de páginas
    $totalSql = "
        SELECT COUNT(DISTINCT r.id) as total 
        FROM recetas r
        LEFT JOIN recetas_ingredientes ri ON r.id = ri.receta_id
        LEFT JOIN ingredientes i ON ri.ingrediente_id = i.id
        WHERE 1=1
    ";
    if (!empty($titulo)) {
        $totalSql .= " AND titulo LIKE :titulo";
    }
    if (!empty($dificultad)) {
        $totalSql .= " AND dificultad = :dificultad";
    }
    if (!empty($tiempo_preparacion)) {
        $totalSql .= " AND tiempo_preparacion <= :tiempo_preparacion";
    }

    $totalStmt = $conn->prepare($totalSql);
    if (!empty($titulo)) {
        $totalStmt->bindValue(':titulo', "%$titulo%", PDO::PARAM_STR);
    }
    if (!empty($dificultad)) {
        $totalStmt->bindValue(':dificultad', $dificultad, PDO::PARAM_STR);
    }
    if (!empty($tiempo_preparacion)) {
        $totalStmt->bindValue(':tiempo_preparacion', $tiempo_preparacion, PDO::PARAM_INT);
    }
    $totalStmt->execute();
    $totalRows = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalRows / $limit);

    // Formatear los resultados en JSON
    echo json_encode([
        'recetas' => $recetas,
        'totalPages' => $totalPages
    ]);

    $conn = null;

} catch (Exception $e) {
    // Manejo de excepciones
    echo "Ocurrió un error: " . $e->getMessage();
}
?>
