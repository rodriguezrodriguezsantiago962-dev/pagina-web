<?php
header('Content-Type: application/json');
include 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    $data = $_POST;
}

if (isset($data['nombre']) && isset($data['email']) && isset($data['telefono'])) {
    $nombre = $conexion->real_escape_string($data['nombre']);
    $email = $conexion->real_escape_string($data['email']);
    $telefono = $conexion->real_escape_string($data['telefono']);

    $sql = "INSERT INTO usuarios (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono')";

    if ($conexion->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "¡Registro guardado con éxito!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al guardar: " . $conexion->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Faltan datos obligatorios"]);
}

$conexion->close();
?>
