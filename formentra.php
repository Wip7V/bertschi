<?php

//	var_dump($_POST);

//	var_dump($_FILES);

	include("conexion.php");
	foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);
//	$letra = $_POST['letra'];

	//$num1 = $_POST['contenedor'];

	//$num2 = $_POST['digito'];

	$codigo = $contenedor .'-'.$digito;

//	$codigo = $_POST['codigo'];

	//$estado = $_POST['estado'];

	//$subestado = $_POST['subest'];

	//$sector = $_POST['sector'];

	//$fechaent = $_POST['fechaent'];

	//$userent = $_POST['useract'];

//	$carril = $_POST['carril'];

//	$posicio = $_POST['posicio'];

	//$pis = $_POST['piso'];

//	$aduana = $_POST['aduana'];



	$name = $_FILES["adjunt"]["name"];
	$certi = $_FILES["certi"]["name"];

	$fecha_partida1=explode("/",$_POST['fechaent'] );

	$dia= $fecha_partida1[0];

	$mes= $fecha_partida1[1];

	$anio= $fecha_partida1[2];

	$fechaentr=$anio."-".$mes."-".$dia;

				

				$cuerpo = "Datos contenedor";

				$cuerpo .= "Codigo: ". $codigo ."\n";

				$cuerpo .= "Estado: ". $estado . "\n";

				$cuerpo .= "Subestado: ". $subest ."\n";

				$cuerpo .= "sector: ". $sector . "\n";

				$cuerpo .= "fecha entrada: ".  $fechaent ."\n";

				

				$sqlinsertcont="INSERT INTO ctcontenedor (codigo,estado,subestado,sector,fecha_entrada,carril,posicio,pis,adjunt, certi,aduana,presente,adr,clase,onu,arancel, antidumping, iva, iiee, total) VALUES ('$codigo','$estado','$subest','$sector','$fechaent','$carril','$posicio','$piso','$name','$certi','$aduana','$presente','$adr','$clase','$onu','".str_replace(",",".",$arancel)."', '".str_replace(",",".",$antidumping)."', '".str_replace(",",".",$iva)."','".str_replace(",",".",$iiee)."', '".str_replace(",",".",$total)."');";
//echo $sql."<br>";
				mysql_query($sqlinsertcont, $conexion) or die("error ctcontenedor: ".mysql_error());

				

				/*$sql="SELECT id FROM ctcontenedor WHERE codigo='$codigo' AND fecha_entrada='$fechaent'";

				$dades=mysql_query($sql, $conexion) or die("error: ".mysql_error() );

				$row=mysql_fetch_array($dades)

				$result= $row[0];*/

				$result = mysql_insert_id();

//				echo $sql;

	//			echo $dades;

//				echo 'resul =  ' . $row[0];

				

				$sqlinsertreg = "INSERT INTO ctregistro (id_contenedor,contenedor,estado,subestado,sector,fecha_entrada,user_entrada,carril,posicio,pis,adjunt, certi,aduana,adr,clase,onu,arancel, antidumping, iva,iiee, total) VALUES ('$result','$codigo','$estado','$subestado','$sector','$fechaentr','$useract','$carril','$posicio','$piso','$name','$certi','$aduana','$adr','$clase','$onu','".str_replace(",",".",$arancel)."', '".str_replace(",",".",$antidumping)."', '".str_replace(",",".",$iva)."','".str_replace(",",".",$iiee)."', '".str_replace(",",".",$total)."') ";

				//echo $sql;

				mysql_query($sqlinsertreg, $conexion) or die("error ctregistro: ".mysql_error());
				
				$id = $result;
				$id;
				mkdir("archivos/contenedor/$id");

				if ($name!=""){copy( $_FILES['adjunt']['tmp_name'], "archivos/contenedor/$id/$name");};
				if ($certi!=""){copy( $_FILES['certi']['tmp_name'], "archivos/contenedor/$id/$certi");};



if($error>0) header("location: entrada.php?error=".$error);

else header("location: principal.php");

//	echo '<a href="entrada.php">Inicio</a>';

?>