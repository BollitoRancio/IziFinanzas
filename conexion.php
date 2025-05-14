<?php
$host = "localhost";
$usuario = "root"; 
$clave = "1234"; 
$base_de_datos = "IziFinanzas"; 

$conexion = new mysqli($host, $usuario, $clave, $base_de_datos);

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}
?>
