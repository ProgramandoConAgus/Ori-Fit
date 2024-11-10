<?php
class Database {
    public $host = 'localhost';
    private $db_name = 'ejerciciosphp';
    private $username = 'root';
    private $password = '';
    public $conn;

    // Método para conectar a la base de datos
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error en la conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
