<?php
//	foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);
//	var_dump($_POST);
//	var_dump($_FILES);
	include("conexion.php");
	$id = $_POST['id'];
	$codigo = $_POST['codigo'];
	$fechaent = $_POST['fechaent'];
	$fechasalida = $_POST['fechasalida'];
	$usersal = $_POST['useract'];
				
	$sqlinsertcont = "DELETE FROM ctcontenedor WHERE id='".$id."'";
	$sqlinsertreg = "UPDATE ctregistro SET fecha_salida='".$fechasalida."', user_salida='".$usersal."' WHERE contenedor='".$codigo."' AND fecha_entrada='".$fechaent."'";
	mysql_query($sqlinsertcont, $conexion) or die("error entrada: ".mysql_error());
	mysql_query($sqlinsertreg, $conexion) or die("error registro: ".mysql_error());


	if($error>0) {header("location: salida.php?error=".$error);
	}else{ ?>
	<script>alert("Datos guardados");</script>
	<?php
	header("location: principal.php");}

?>