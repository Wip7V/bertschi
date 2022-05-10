<?php
	include("conexion.php");
	foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);
	$name = $_FILES["adjuntsal"]["name"];

//	var_dump($_POST);
//	var_dump($_FILES);
//	echo 'alert("'.$conte.'");';			
	$sqlinsertdua="UPDATE ctiiee SET id_contenedor='$id_contenedor', ncontenedor='$ncontenedor', fecha_entrada='$fecha_entrada', epifiscal='$epifiscal', codigonc='$codigonc', producto='$producto', caeprovee='$caeprovee', arc='$arc', litros15c='$litros15c', fecha_salida='$fecha_salida', documento='$documento', num_dispo='$num_dispo', nif_destino='$nif_destino', nom_destino='$nom_destino', regimen='$regimen', recibido='$recibido', adjuntent='$adjuntent', adjuntsal='$name' WHERE id_iiee = $id_iiee;";
	
	mysql_query($sqlinsertdua, $conexion) or die("error entrada: ".mysql_error());

	copy( $_FILES['adjuntsal']['tmp_name'], "archivos/iiee/".$name);
				//echo 'alert("'.$conte.'");';
//	if($error>0){ header("location: duasal.php?error=".$error);};
//	if(strlen($error)==0){Script("alert('Datos guardados'); document.location = 'duasal.php';");};
	if($error>0) header("location: iiee-sal.php?error=".$error);
	else header("location: principal.php");
//		echo '<a href="dua.php">Inicio</a>';
?>