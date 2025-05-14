<?php
session_start(); // Inicia sesión si no estaba iniciada
session_unset(); // Limpia todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirige al login (ajústalo si tu archivo se llama diferente)
header("Location: index.html");
exit();
?>
