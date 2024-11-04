<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    try {
        $sql = "INSERT INTO usuarios (Nombre, Apellido, Email, password, habilitado) VALUES (:nombre, :apellido, :email, :password, 0)";
        $stmt = $conn->prepare($sql);
        
        
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        
      
        $stmt->execute();
        
        echo "Usuario registrado exitosamente.";
    } catch (PDOException $e) {
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
}
?>