<?php	include("conexion.php");	foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);	var_dump($_POST);//	var_dump($_FILES);	$conte=$cont1;	//	echo 'alert("'.$conte.'");';				$i=1;	$adjunt = '';				if(isset($_FILES['adjunt']['tmp_name'])){					copy( $_FILES['adjunt']['tmp_name'], "archivos/dua/".$_FILES["adjunt"]["name"]);					$adjunt = "archivos/dua/".$_FILES["adjunt"]["name"];				}					$sqlinsertdua="INSERT INTO ctdua(numero,tipo,fecha,fecha_prevista,tipo_aduana,tipo_declaracio,num_formulari,destinatario, estatuto_aduanero,  entrada_salida, adjunt) VALUES ('$numero','$tipo','$fecha','$fecha_prevista','$tipo_aduana','$tipo_declaracio','$num_formulari','$destinatario', '$estatuto_aduanero', 'in','$adjunt');";					mysql_query($sqlinsertdua, $conexion) or die("error entrada: ".mysql_error());			$duaid = mysql_insert_id();			while ($conte!="")		{							$sql="SELECT id FROM ctpartida WHERE partida='$conte'";				$dades=mysql_query($sql, $conexion) or die("error: ".mysql_error() );				$row=mysql_fetch_array($dades);				$contid= $row[0];							$sqlupreg = "UPDATE ctpartida SET dua='$duaid' WHERE id = '$contid'; ";				//echo $sqlupreg . "<br>";				mysql_query($sqlupreg, $conexion) or die("error ctregistro: ".mysql_error());								$i++;		if(isset($_POST["cont".$i])){$conte=$_POST["cont".$i];		}else{$conte="";}		}//	if($error>0){ header("location: duasal.php?error=".$error);};//	if(strlen($error)==0){Script("alert('Datos guardados'); document.location = 'duasal.php';");};if($error>0) header("location: duaint.php?error=".$error);else header("location: principal.php");//		echo '<a href="dua.php">Inicio</a>';?>