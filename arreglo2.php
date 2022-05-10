<?php 
include("conexion.php");

foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);
	
	var_dump($formulari);
	foreach($formulari as $n => $v) $$n = mysql_real_escape_string($v); //crea variables pel nom del camp i asigna el seu contingut;
	
	
	
	$fecha_partida1=explode("/",$fecha_entrada );
	$dia= $fecha_partida1[0];
	$mes= $fecha_partida1[1];
	$anio= $fecha_partida1[2];
	$fechaent=$anio."/".$mes."/".$dia;
	
	
	$fecha_partida2=explode("/",$fecha_salida );
	$dia1= $fecha_partida2[0];
	$mes1= $fecha_partida2[1];
	$anio1= $fecha_partida2[2];
	$fechasal=$anio1."/".$mes1."/".$dia1;
	
	
/*	
	
	$fecha1=date("m-d-Y", strtotime("$fecha_entrada"));
	$fecha2=date("m-d-Y", strtotime("$fecha_salida"));
	$fechaent=date("Y-m-d", strtotime("$fecha1"));
	$fechasal=date("Y-m-d", strtotime("$fecha2"));
	*/
	echo $fecha_entrada."<br>".$fecha_salida."<br>".$fecha1."<br>".$fecha2."<br>".$fechaent."<br>".$fechasal."<br>";
	//$fecha2=date("Y-m-d",strtotime($fecha1));
	
	$sql = "UPDATE ctregistro SET fechaent='$fechaent', fechasal='$fechasal' WHERE id=$id;";
	
	echo '<script language="javascript">alert("'.$sql.'");</script>';
	mysql_query($sql) or print("error insert: ".mysql_error() );
	
	echo $sql;
	echo mysql_query($sql);

	//$respuesta->Assign("sortir","value",1); //de que tot ha funcionat



	//header("location: arreglo.php");
?>