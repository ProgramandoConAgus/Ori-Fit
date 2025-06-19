<?php
session_start();
include '../../vendor/autoload.php';
require_once __DIR__.'/../db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json; charset=utf-8');

// Verificar sesión y usuario
if (!isset($_SESSION['IdUsuario'])) {
    echo json_encode(['success' => false, 'message' => 'Debe estar autenticado']);
    exit;
}

// Validar entrada
$mensaje = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_STRING);
if (empty($mensaje)) {
    echo json_encode(['success' => false, 'message' => 'El mensaje no puede estar vacío']);
    exit;
}

$userId = $_SESSION['IdUsuario'];

// Insertar la pregunta en la tabla "preguntasUsuarios"
$insertQuery = "INSERT INTO preguntasUsuarios (IdUsuario, pregunta) VALUES (?, ?)";
$stmtInsert = $conexion->prepare($insertQuery);
if (!$stmtInsert) {
    echo json_encode(['success' => false, 'message' => 'Error al preparar la inserción']);
    exit;
}
$stmtInsert->bind_param("is", $userId, $mensaje);
if (!$stmtInsert->execute()) {
    echo json_encode(['success' => false, 'message' => 'Error al guardar la pregunta']);
    exit;
}

// Obtener el ID de la pregunta recién insertada
$idPregunta = $conexion->insert_id;
$stmtInsert->close();

// Obtener datos del usuario
$stmt = $conexion->prepare("SELECT nombre, apellido, correo FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$userData = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Configurar PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración SMTP (usando tus credenciales existentes)
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'educacion@programandoconagus.com';
    $mail->Password = 'Pca@07071';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remitente y destinatario
    $mail->setFrom('educacion@programandoconagus.com', 'Soporte Team Ori');
    $mail->addAddress('educacion@programandoconagus.com'); // Correo de soporte

    // Contenido del mensaje
    $mail->isHTML(true);
    $mail->Subject = 'Nueva consulta de usuario';
    $mail->Body = "
        <h3>Consulta desde el panel</h3>
        <p><strong>Usuario:</strong> {$userData['nombre']} {$userData['apellido']}</p>
        <p><strong>Email:</strong> {$userData['correo']}</p>
        <p><strong>Mensaje:</strong></p>
        <div style='background:#f8f9fa; padding:15px; border-radius:5px;'>
            " . nl2br(htmlspecialchars($mensaje)) . "
        </div>
        <p><small>Enviado el " . date('d/m/Y H:i:s') . "</small></p>
        <h1><a href='http://localhost/Ori-Fit/able-pro-vanila-bootstrap-9.4.3/dist/foro/respuestaForo.php?idpregunta=" . $idPregunta . "'>Responder</a></h1>
    ";
    $mail->send();
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    error_log('Error al enviar consulta: ' . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Error al enviar la consulta. Intente nuevamente más tarde.'
    ]);
}
?>
