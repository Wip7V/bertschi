<?php
//	foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);
//	var_dump($_POST);
//	var_dump($_FILES);
	include("conexion.php");
	$id = $_POST['id'];
	$codigo = $_POST['codigo'];
	//$fechaent = $_POST['fechaent'];
	//$fechasalida = $_POST['fechasalida'];
	$usersal = $_POST['useract'];
	
	$fecha_partida1=explode("/",$_POST['fechaent'] );
	$dia= $fecha_partida1[0];
	$mes= $fecha_partida1[1];
	$anio= $fecha_partida1[2];
	$fechaent=$anio."-".$mes."-".$dia;
	$fecha_partida11=explode("/",$_POST['fechasalida'] );
	
	$dia1= $fecha_partida11[0];
	$mes1= $fecha_partida11[1];
	$anio1= $fecha_partida11[2];
	$fechasalida=$anio1."-".$mes1."-".$dia1;
				
	$sqlinsertcont = "DELETE FROM ctcontenedor WHERE id='".$id."'";
	$sqlinsertreg = "UPDATE ctregistro SET fecha_salida='".$fechasalida."', user_salida='".$usersal."' WHERE contenedor='".$codigo."' AND fecha_entrada='".$fechaent."'";
	mysql_query($sqlinsertcont, $conexion) or die("error entrada: ".mysql_error());
	mysql_query($sqlinsertreg, $conexion) or die("error registro: ".mysql_error());


	if($error>0) header("location: salida.php?error=".$error);
	else header("location: principal.php");

?>