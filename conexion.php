<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host   = getenv('DB_HOST') ?: 'gateway01.ap-northeast-1.prod.aws.tidbcloud.com';
$user   = getenv('DB_USER') ?: '2qjxKkYTrBjEJN5.root';
$pass   = getenv('DB_PASS') ?: 'cF6SMtnLLLJGDE1V';
$db     = getenv('DB_NAME') ?: 'registro_db';
$port   = (int)(getenv('DB_PORT') ?: 4000);
$ssl_ca = getenv('DB_SSL_CA') ?: null;

try {
    $conexion = mysqli_init();

    if ($ssl_ca || $host !== 'db') {
        $conexion->ssl_set(null, null, $ssl_ca, null, null);
        $flags = MYSQLI_CLIENT_SSL;
    } else {
        $flags = 0;
    }

    $conexion->real_connect($host, $user, $pass, $db, $port, null, $flags);
    $conexion->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Error de conexión BD: " . $e->getMessage()]);
    exit;
}


