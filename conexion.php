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

git config --global user.name "Santiago" && git config --global user.email "rodriguezrodriguezsantiago66@gmail.com" && git commit -m 
"Deploy PHP 8.2 Apache con TiDB Cloud" && git branch -M main && git remote add origin 
https://github.com/rodriguezrodriguezsantiago962-dev/practica01-php-docker.git && git push -u origin main