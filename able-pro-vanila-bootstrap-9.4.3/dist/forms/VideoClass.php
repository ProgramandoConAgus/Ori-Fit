<?php
class Videos {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPorId($id) {
        try {
            // Preparamos la consulta SQL
            $sql = "SELECT 
                        Nombre, 
                        Descripcion, 
                        IdGrupoMuscular, 
                        IdGrupoEnfoque, 
                        URL, 
                    FROM videos 
                    WHERE IdVideo = ?";
            
            $stmt = $this->conexion->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
            }

            // Vinculamos el parámetro
            $stmt->bind_param("i", $id);
            
            // Ejecutamos la consulta
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }
            
            // Obtenemos los resultados
            $resultado = $stmt->get_result();
            
            if ($resultado->num_rows === 0) {
                return null; // No se encontraron resultados
            }
            
            // Devolvemos los datos como array asociativo
            return $resultado->fetch_assoc();
            
        } catch (Exception $e) {
            // Manejo de errores
            error_log("Error en Video::obtenerPorId: " . $e->getMessage());
            return null;
        }
    }
}
?>