<?php
$conexion = new mysqli('localhost', 'root', '12345', 'registro_db';

if ($conexion->connect_error) {
	die("Fallo de Conexion: " . $conexion->connect_error);
}else{
	echo "Conexion exitosa a la base de datos";
}
?>
