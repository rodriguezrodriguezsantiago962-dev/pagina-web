<?php
header('Content-Type: application/json; charset=utf-8');
include 'conexion.php';

$resultado = $conexion->query("SELECT id, nombre, email, telefono FROM usuarios ORDER BY id DESC");
$registros = [];

if ($resultado) {
    while ($row = $resultado->fetch_assoc()) {
        $registros[] = $row;
    }
}

echo json_encode($registros);
$conexion->close();
?>