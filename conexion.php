<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    // En tu computadora local con XAMPP
    $host = "localhost";
    $usuario = "root";
    $clave = "1234";
    $base_de_datos = "IziFinanzas";
} else {
    // En el servidor Hostinger
    $host = "localhost"; // Usa localhost aquí, no auth-db...
    $usuario = "u143755789_root"; // Verifica en tu panel de Hostinger
    $clave = "Contraizi1234!";     // O la que hayas puesto
    $base_de_datos = "u143755789_IziFinanzas"; // Nombre exacto
}
$conexion = new mysqli($host, $usuario, $clave, $base_de_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
