<?php
require_once '../auth/check_admin.php';

if (!isset($_GET['id'])) {
    header('Location: '.$uri.'/ori-fit/able-pro-vanila-bootstrap-9.4.3/dist/recetas/');
}

$content = 'contents/receta_update.php';
$title = "Editar Receta";
include('../layouts/layout.php');
?>