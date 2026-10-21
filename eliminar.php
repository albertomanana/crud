<?php
require_once __DIR__ . '/conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
	exit('Identificador de usuario no válido.');
}

$consulta = $bd->prepare('DELETE FROM usuarios WHERE id = :id');
$consulta->execute([':id' => $id]);

header('Location: leer.php');
exit;