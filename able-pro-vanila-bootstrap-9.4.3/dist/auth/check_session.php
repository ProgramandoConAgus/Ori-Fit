<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['IdUsuario'])) {
    header('Location: ../index.php');
    exit();
}
?>
