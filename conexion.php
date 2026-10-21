<?php
declare(strict_types=1);

$cadenaConexion = 'mysql:dbname=empresa;host=127.0.0.1;charset=utf8mb4';
$usuario = 'root';
$clave = '';

try {
	$bd = new PDO($cadenaConexion, $usuario, $clave, [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false,
	]);
} catch (PDOException $e) {
	http_response_code(500);
	exit('No se pudo conectar con la base de datos empresa.');
}
