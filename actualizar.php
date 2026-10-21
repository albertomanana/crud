<?php
    // conectar con la base de datos
    require_once "conexion.php";
// actualizar
	$upd = "update usuarios set rol =  0 where rol = 1";
	$resul = $bd->query($upd);	
	//comprobar errores
	if($resul){
		echo "update correcto <br>";
		echo "Filas actualizadas: " . $resul->rowCount() . "<br>";
	}else print_r( $bd -> errorinfo());	