<?php
session_start();
header('Content-Type: application/json'); // Para que JS lo reciba como JSON

include '../conexion.php';

if (!isset($_SESSION['nombre_usuario'])) {
    echo json_encode([
        'status' => 'error',
        'mensaje' => 'Debes iniciar sesión para enviar la evaluación.'
    ]);
    exit;
}

// Recuperar datos del usuario
$nombre_usuario = $_SESSION['nombre_usuario'];
$curso = $_POST['curso'] ?? 'Curso Desconocido';

// Obtener ID del usuario
$sql = "SELECT ID_Usuario FROM Usuarios WHERE Nombre_Usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo json_encode([
        'status' => 'error',
        'mensaje' => 'Usuario no encontrado.'
    ]);
    exit;
}

$fila = $resultado->fetch_assoc();
$id_usuario = $fila['ID_Usuario'];

// Respuestas correctas por curso
switch ($curso) {
    case "Introducción a las Finanzas":
        $respuestas_correctas = ["a", "b", "a", "b", "a", "a", "a", "a", "a", "a"];
        break;
    case "Inversiones 101":
        $respuestas_correctas = ["b", "b", "b", "b", "c", "a", "b", "b", "b", "b"];
        break;
    case "Gestión de deudas":
        $respuestas_correctas = ["c", "a", "c", "b", "a", "b", "b", "a", "a", "a"];
        break;
    case "Estrategias de Ahorro":
        $respuestas_correctas = ["b", "c", "b", "b", "a", "b", "b", "a", "b", "b"];
        break;
    case "Fundamentos Bancarios":
        $respuestas_correctas = ["a", "a", "a", "b", "a", "a", "a", "b", "a", "a"];
        break;
    case "Planificación Financiera":
        $respuestas_correctas = ["a", "a", "a", "a", "a", "a", "a", "a", "a", "a"];
        break;
    // Agrega más cursos aquí si es necesario
    default:
        echo json_encode([
            'status' => 'error',
            'mensaje' => 'Curso no reconocido. No se puede evaluar.'
        ]);
        exit;
}

// Calcular respuestas y puntuación
$puntos = 0;
$respuestas_usuario = [];

foreach ($respuestas_correctas as $i => $respuesta_correcta) {
    $numero_pregunta = $i + 1;
    $clave = "pregunta$numero_pregunta";
    $respuesta_usuario = $_POST[$clave] ?? '';
    $respuestas_usuario[$clave] = $respuesta_usuario;

    if ($respuesta_usuario === $respuesta_correcta) {
        $puntos++;
    }
}

// Calificación en base 10
$calificacion = $puntos;
$aprobado = $calificacion >= 6 ? 1 : 0;
$respuestas_json = json_encode($respuestas_usuario);

// Insertar en la base de datos
$sql = "INSERT INTO Evaluaciones (ID_Usuario, Curso, Respuestas, Calificacion, Aprobado, Fecha)
        VALUES (?, ?, ?, ?, ?, NOW())";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("issii", $id_usuario, $curso, $respuestas_json, $calificacion, $aprobado);

if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'calificacion' => $calificacion,
        'aprobado' => $aprobado,
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'mensaje' => 'Error al guardar la evaluación: ' . $stmt->error,
    ]);
}

$stmt->close();
$conexion->close();
?>
