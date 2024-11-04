<?php
$host = 'localhost';     
$dbname = 'orifit';    
$username = 'root';      
$password = '';         

try {
    $conn = new mysqli ($host,$dbname, $username, $password);
   
} catch(Exception $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}
?>