<?php
//	foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);
//	var_dump($_POST);
//	var_dump($_FILES);
	include("conexion.php");
	$letra = $_POST['letra'];
	$num1 = $_POST['num1'];
	$num2 = $_POST['num2'];
	$codigo = $letra . $num1 .'-'.$num2;
	$estado = $_POST['estado'];
	$subestado = $_POST['subest'];
	$sector = $_POST['sector'];
	$fechaent = $_POST['fechaent'];
	$userent = $_POST['useract'];
	
				
				$cuerpo = "Datos contenedor";
				$cuerpo .= "Codigo: ". $codigo ."\n";
				$cuerpo .= "Estado: ". $estado . "\n";
				$cuerpo .= "Subestado: ". $subestado ."\n";
				$cuerpo .= "sector: ". $sector . "\n";
				$cuerpo .= "fecha entrada: ".  $fechaent ."\n";
				
				$sqlinsertcont = "INSERT INTO ctcontenedor (codigo,estado,subestado,sector,fecha_entrada) VALUES ('$codigo','$estado','$subestado','$sector','$fechaent') ";
				$sqlinsertreg = "INSERT INTO ctregistro (contenedor,estado,subestado,sector,fecha_entrada,user_entrada) VALUES ('$codigo','$estado','$subestado','$sector','$fechaent','$userent') ";
				mysql_query($sqlinsertcont, $conexion) or die("error entrada: ".mysql_error());
				mysql_query($sqlinsertreg, $conexion) or die("error registro: ".mysql_error());


if($error>0) header("location: entrada.php?error=".$error);
else header("location: principal.php");

?>