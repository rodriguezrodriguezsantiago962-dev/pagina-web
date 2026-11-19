<?php
header('Content-Type: application/json');
include 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'])) {
    $id = intval($data['id']);

    $sql = "DELETE FROM usuarios WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "¡Registro eliminado con éxito!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al eliminar: " . $conexion->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "ID no proporcionado"]);
}

$conexion->close();
?>