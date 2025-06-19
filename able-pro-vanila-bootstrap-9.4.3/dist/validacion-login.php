<?php
require_once __DIR__.'/db.php';

// Establece la cabecera para indicar que la respuesta es JSON
header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => '',
    'redirect' => ''
];

// Leer el JSON enviado en la petición
$input = json_decode(file_get_contents('php://input'), true);

// Validar que se hayan recibido los campos necesarios
if (isset($input['email']) && isset($input['password'])) {
    $email = strtolower(trim($input['email']));
    $password = $input['password'];

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
                if ($user['acceso'] == 1) {    
                    // Iniciar sesión
                    session_start();
                    $_SESSION['IdUsuario'] = $user['id'];
                    
                    $response['success'] = true;
                    $response['message'] = 'Ingreso exitoso.';
                    $response['redirect'] = './pages/panel.php';
                } else {
                    $response['message'] = "No tiene acceso a la plataforma.";
                }
            } else {
                $response['message'] = "La contraseña es incorrecta.";
            }
        } else {
            $response['message'] = "No se encontró una cuenta con este correo.";
        }
    } else {
        $response['message'] = "Error en la consulta: " . $conexion->error;
    }

    $stmt->close();
} else {
    $response['message'] = "Por favor, completa ambos campos.";
}

echo json_encode($response);
exit();
?>
