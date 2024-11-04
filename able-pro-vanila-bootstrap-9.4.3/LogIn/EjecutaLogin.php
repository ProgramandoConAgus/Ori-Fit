<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $sql = "SELECT * FROM usuarios WHERE Email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            if ($usuario['habilitado'] == 1) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['Nombre'];
                header("Location: dashboard.php"); // Aca necesito saber a donde se va a ir
                exit();
            } else {
                echo "Tu cuenta aún no ha sido habilitada. Por favor, espera la aprobación del administrador.";
            }
        } else {
            echo "Email o contraseña incorrectos.";
        }
    } catch (PDOException $e) {
        echo "Error al iniciar sesión: " . $e->getMessage();
    }
}
?>