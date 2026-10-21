<?php
require_once __DIR__ . '/conexion.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$registro = [
	'nombre' => '',
	'clave' => '',
	'rol' => '',
];

if ($id > 0) {
	$consulta = $bd->prepare('SELECT nombre, clave, rol FROM usuarios WHERE id = :id');
	$consulta->execute([':id' => $id]);
	$registroEncontrado = $consulta->fetch();

	if (!$registroEncontrado) {
		http_response_code(404);
		exit('El usuario no existe.');
	}

	$registro = $registroEncontrado;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $id ? 'Editar' : 'Crear' ?> registro</title>
</head>
<body>
	<h1><?= $id ? 'Editar registro' : 'Nuevo registro' ?></h1>

	<form action="guardar.php" method="post">
		<input type="hidden" name="id" value="<?= $id ?>">

		<label for="nombre">Nombre</label>
		<input type="text" id="nombre" name="nombre"
			   value="<?= htmlspecialchars($registro['nombre'], ENT_QUOTES, 'UTF-8') ?>"
			   required maxlength="100">

		<label for="clave">Clave</label>
		<input type="text" id="clave" name="clave"
			   value="<?= htmlspecialchars($registro['clave'], ENT_QUOTES, 'UTF-8') ?>"
			   required maxlength="100">

		<label for="rol">Rol</label>
		<input type="text" id="rol" name="rol"
			   value="<?= htmlspecialchars($registro['rol'], ENT_QUOTES, 'UTF-8') ?>"
			   required maxlength="100">


		<div class="acciones">
			<button type="submit"><?= $id ? 'Actualizar' : 'Insertar' ?></button>
		</div>
	</form>

	<?php if ($id): ?>
		<form action="guardar.php" method="post">
			<input type="hidden" name="id" value="<?= $id ?>">
			<input type="hidden" name="accion" value="eliminar">
			<button type="submit">Eliminar</button>
		</form>
	<?php endif; ?>
</body>
</html>
