<?php
include('widget/db.php');
$message = '';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];

    // Consulta para verificar si el correo existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            // Obtener el registro del usuario
            $user = $result->fetch_assoc();

            // Verificar la contraseña
            if (password_verify($password, $user['password'])) {
                if($user['acceso']==1){    
                    // Iniciar sesión o redirigir al usuario
                    session_start();
                    $_SESSION['IdUsuario'] = $user['id'];
                    header('Location: ./pages/panel.php'); // Redirigir a un área segura
                    exit();
                }
                else{
                    $message="No tiene acceso a la plataforma";
                }
            } else {
                $message = "La contraseña es incorrecta.";
            }
        } else {
            $message = "No se encontró una cuenta con este correo.";
        }
    } else {
        $message = "Error en la consulta: " . $conexion->error;
    }

    $stmt->close();
} else {
    $message = "Por favor, completa ambos campos.";
}

if ($message !== '') {
    echo $message;
}
?>
