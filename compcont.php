<?php
	include("config.php");
	include("conexion.php");

	foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);

	$num1 = $_POST['contenedor'];
	$num2 = $_POST['digito'];
	$codigo = $num1 .'-'.$num2;


		$sql="SELECT * FROM ctcontenedor WHERE codigo=$codigo";
		$resultado = mysql_query($sql);
		$filas = mysql_num_rows($resultado);
		if ($filas!=FALSE){
			
			header("location: entrada.php");
			echo "<script language='JavaScript'> 
                alert('El contenedor introducido ya existe, introduce un numero distinto'); 
                </script>";
			
		}else{
			
			header("location: entrada.php?nc=".$num1."&dg=".$num2);
			echo "<script language='JavaScript'> 
                alert('El contenedor introducido esta libre'); 
                </script>";
		}
		



?>