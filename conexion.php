<?php
$host = "localhost";
$usuario = "u143755789_root"; 
$clave = "Contraizi1234!"; 
$base_de_datos = "u143755789_IziFinanzas"; 

$conexion = new mysqli($host, $usuario, $clave, $base_de_datos);

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}
?>
