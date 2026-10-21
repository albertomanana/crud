<?php
require_once __DIR__ . '/conexion.php';

$usuarios = $bd->query('SELECT id, nombre, clave, rol FROM usuarios ORDER BY id')->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Usuarios</title>
</head>
<body>
	<h1>Usuarios</h1>
	<p><a href="formulario.php">Nuevo usuario</a></p>
	<table border="1">
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Clave</th>
			<th>Rol</th>
			<th>Acciones</th>
		</tr>
		<?php foreach ($usuarios as $usuario): ?>
			<tr>
				<td><?= (int) $usuario['id'] ?></td>
				<td><?= htmlspecialchars($usuario['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
				<td><?= htmlspecialchars($usuario['clave'], ENT_QUOTES, 'UTF-8') ?></td>
				<td><?= htmlspecialchars($usuario['rol'], ENT_QUOTES, 'UTF-8') ?></td>
				<td><a href="formulario.php?id=<?= (int) $usuario['id'] ?>">Editar</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>