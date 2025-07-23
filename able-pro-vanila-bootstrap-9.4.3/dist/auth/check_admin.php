<?php
require_once __DIR__.'/check_session.php';
if (!isset($_SESSION['IdRol']) || $_SESSION['IdRol'] != 2) {
    header('Location: ../pages/panel.php');
    exit();
}
?>
