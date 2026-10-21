<?php
    // conectar con la base de datos
    require_once "conexion.php";
// insertar nuevo usario
	$ins = "insert into usuarios(nombre, clave, rol) values('Alberto', '33333', '1');";
	$resul = $bd->query($ins);	
	//comprobar errores
	if($resul) {
		echo "insert correcto <br>";
		echo "Filas insertadas: " . $resul->rowCount() . "<br>";
	}else print_r( $bd -> errorinfo());	
	// para los autoincrementos
	echo "Código de la fila insertada" . $bd->lastInsertId() . "<br>";