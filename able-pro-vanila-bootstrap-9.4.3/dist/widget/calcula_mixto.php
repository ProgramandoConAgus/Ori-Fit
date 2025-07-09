<?php
// Genera plan nutricional y de ejercicios para planes mixtos
define('SKIP_REDIRECT', true);
include 'calcula_plan.php';
include 'calcula_ejercicios.php';
header('Location: ../pages/panel.php');
?>
