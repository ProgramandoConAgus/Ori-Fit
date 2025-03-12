<?php
class Usuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPorId($id) {
        try {
            // Preparamos la consulta SQL
            $sql = "SELECT 
                        nombre, 
                        apellido, 
                        correo, 
                        telefono, 
                        idRol, 
                        acceso, 
                        idTipoPlan 
                    FROM usuarios 
                    WHERE id = ?";
            
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
            error_log("Error en Usuario::obtenerPorId: " . $e->getMessage());
            return null;
        }
    }

    public function ObtenerSolicitud($id) {
        try {
            // Preparamos la consulta SQL para obtener todas las solicitudes del usuario
            $sql = "SELECT * 
                    FROM solicitudes 
                    WHERE usuario_id = ? 
                    ORDER BY fecha_envio DESC
                    LIMIT 1";  // Ordenamos por fecha descendente
            
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
                return []; // Devolvemos array vacío si no hay resultados
            }
            
            // Devolvemos todos los registros como array asociativo
            return $resultado->fetch_all(MYSQLI_ASSOC);
            
        } catch (Exception $e) {
            // Manejo de errores
            error_log("Error en Usuario::ObtenerSolicitud: " . $e->getMessage());
            return [];
        }
    }
}
?>