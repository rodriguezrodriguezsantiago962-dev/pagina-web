<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = getenv('DB_HOST') ?: 'db';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '12345678';
$db   = getenv('DB_NAME') ?: 'registro_db';
$port = (int)(getenv('DB_PORT') ?: 3306);

try {
    $conexion = new mysqli($host, $user, $pass, $db, $port);
    $conexion->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Error de conexión BD: " . $e->getMessage()]);
    exit;
}

