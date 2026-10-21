<?php
declare(strict_types=1);

require_once __DIR__ . '/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: formulario.php');
	exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?: 0;
$accion = $_POST['accion'] ?? 'guardar';

if ($accion === 'eliminar') {
	if ($id <= 0) {
		exit('Identificador de usuario no válido.');
	}

	$consulta = $bd->prepare('DELETE FROM usuarios WHERE id = :id');
	$consulta->execute([':id' => $id]);
	header('Location: leer.php');
	exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$clave = trim($_POST['clave'] ?? '');
$rol = trim($_POST['rol'] ?? '');

if ($nombre === '' || $clave === '' || $rol === '') {
	exit('Todos los campos son obligatorios.');
}

if ($id > 0) {
	$consulta = $bd->prepare(
		'UPDATE usuarios SET nombre = :nombre, clave = :clave, rol = :rol WHERE id = :id'
	);
	$consulta->execute([
		':nombre' => $nombre,
		':clave' => $clave,
		':rol' => $rol,
		':id' => $id,
	]);
} else {
	$consulta = $bd->prepare(
		'INSERT INTO usuarios (nombre, clave, rol) VALUES (:nombre, :clave, :rol)'
	);
	$consulta->execute([
		':nombre' => $nombre,
		':clave' => $clave,
		':rol' => $rol,
	]);
}

header('Location: leer.php');
exit;
