<?php
header('Content-Type: application/json');
include 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($data['nombre']) && isset($data['email']) && isset($data['telefono'])) {
    $id = intval($data['id']);
    $nombre = $conexion->real_escape_string($data['nombre']);
    $email = $conexion->real_escape_string($data['email']);
    $telefono = $conexion->real_escape_string($data['telefono']);

    $sql = "UPDATE usuarios SET nombre = '$nombre', email = '$email', telefono = '$telefono' WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "¡Registro actualizado con éxito!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al actualizar: " . $conexion->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Faltan datos obligatorios"]);
}

$conexion->close();
?>