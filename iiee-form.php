<?php
	include("conexion.php");
	foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);

//	var_dump($_POST);
//	var_dump($_FILES);
//	$conte=$cont1;	
//	echo 'alert("'.$conte.'");';			
//	$i=1;
//	while ($conte!=""){	
	$name = $_FILES["adjunt"]["name"];

				$sql="SELECT id FROM ctcontenedor WHERE codigo='$ncont'";
				$dades=mysql_query($sql, $conexion) or die("error: ".mysql_error() );
				$row=mysql_fetch_array($dades);
				$contid= $row[0];
		
				$sqlinsertdua="INSERT INTO ctiiee(id_contenedor,ncontenedor,fecha_entrada,epifiscal,codigonc,producto,caeprovee,arc,litros15c,adjuntent) VALUES ('$contid','$ncont','$fecha_entrada','$epifiscal','$codigonc','$producto','$caeprovee','$arc','$litros15c','$name');";
				
				mysql_query($sqlinsertdua, $conexion) or die("error entrada: ".mysql_error());
				
				$sql="SELECT id_iiee FROM ctiiee WHERE arc='$arc' AND ncontenedor='$ncont'";
				$dades=mysql_query($sql, $conexion) or die("error: ".mysql_error() );
				$row=mysql_fetch_array($dades);
				$iieeid= $row[0];
				
				$sqlupcon = "UPDATE ctcontenedor SET iiee_id='$iieeid' WHERE codigo = '$ncont'; ";
				mysql_query($sqlupcon, $conexion) or die("error registro: ".mysql_error());
				$sqlupreg = "UPDATE ctregistro SET iiee_id='$iieeid' WHERE id_contenedor = '$contid'; ";
				mysql_query($sqlupreg, $conexion) or die("error registro: ".mysql_error());
				if(isset($_FILES['adjunt']['tmp_name'])){
					copy( $_FILES['adjunt']['tmp_name'], "archivos/iiee/".$name);
					}
//		$i++;
//		if(isset($_POST["cont".$i])){$conte=$_POST["cont".$i];
//		}else{$conte="";}
		//echo 'alert("'.$conte.'");';
//	}
if($error>0) header("location: iiee.php?error=".$error);
else header("location: principal.php");
//		echo '<a href="dua.php">Inicio</a>';
?>