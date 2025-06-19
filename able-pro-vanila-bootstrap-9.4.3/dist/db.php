<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$baseDatos = "testing";

$conexion = new mysqli($servidor, $usuario, $contraseña, $baseDatos);

if ($conexion->connect_error) {
    die("Error de conexion" . $conexion->connect_error);
}
