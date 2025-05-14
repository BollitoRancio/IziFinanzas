<?php
session_start();

include '../conexion.php';

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Verificar que el usuario esté logueado
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(["success" => false, "message" => "Usuario no logueado"]);
    exit;
}

// Recibir los datos desde el AJAX
$id_usuario = $_SESSION['id_usuario'];  // Usar la ID del usuario desde la sesión
$id_leccion = $_POST['id_leccion'];
$estado = $_POST['estado'];  // 'En curso' o 'Completado'

// Mostrar los valores recibidos (solo para depuración)
var_dump($id_usuario, $id_leccion, $estado);

// Consulta SQL para insertar o actualizar el progreso
$sql = "INSERT INTO Progreso_Lec (ID_Leccion, ID_Usuario, Estado)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE Estado = ?, Fecha_UltimaActualizacion = CURRENT_TIMESTAMP";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conn->error]);
    exit;
}

// Asociar los parámetros con la consulta preparada
$stmt->bind_param("iiiss", $id_leccion, $id_usuario, $estado, $estado);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Progreso guardado correctamente"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al ejecutar la consulta: " . $stmt->error]);
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
