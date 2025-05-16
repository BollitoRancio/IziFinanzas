<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    $host = "localhost";
    $usuario = "root";
    $clave = "1234";
    $base_de_datos = "IziFinanzas";
} else {
    $host = "auth-db1957.hstgr.io";
    $usuario = "u143755789_root";
    $clave = "Contraizi1234!";
    $base_de_datos = "u143755789_IziFinanzas";
}
$conexion = new mysqli($host, $usuario, $clave, $base_de_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
