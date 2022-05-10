<?php 
require_once('xajax_core/xajax.inc.php');
include("config.php");
include("conexion.php");


$sql = "SELECT * FROM ctregistro"; //WHERE fechaent='0000-00-00'";
$result=mysql_query($sql) or print("error: ".mysql_error() );
$linia=mysql_fetch_array($result) or print("error insert: ".mysql_error() );



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
     <form method="post" id="formulari" action="arreglo2.php" enctype="multipart/form-data">
                    <input type="hidden" id="control_error" value="0" />
                    <input type="hidden" id="sortir" />
 				<table class="tabla" >
                <tr>
                    <td>ID</td>
                    <td><input type="text" style="width:110px" name="id" value="<?php echo $linia['id']; ?>" /></td>
                </tr>
 				<tr>
                    <td>Contenedor:</td>
                    <td><input type="text" id="contenedor" name="contenedor" value="<?php echo $linia['contenedor'] ?>" /></td>
                    <td>ID</td>
                </tr>
        <tr>
            <td>Fecha de entrada:</td>
            <td><input type="text" id="fecha_entrada" name="fecha_entrada" value="<?php echo $linia['fecha_entrada']; ?>"/></td>
            <td><?php echo $linia['fechaent']; ?></td>
          </tr>
 				<tr>
                    <td>fecha salida:</td>
                    <td><input type="text" id="fecha_salida" name="fecha_salida" value="<?php echo $linia['fecha_salida']; ?>" /></td>
                    <td><?php echo $linia['fechasal']; ?></td>
                </tr>
 				<tr>
                    <td colspan="2" align="center">
        		<input type="submit" value="Buscar" class="boton" /> 
                <input type="hidden" id="tot_be" value=0 /></td>
                </tr>
              </table>
            </form>
           
            
            <script language="javascript">alert("actualizar");</script>
            
     <?php       
while($item=mysql_fetch_array($result)){ 
	
	
	$id=$item['id'];
	$fecha_partida1=explode("/",$item['fecha_entrada'] );
	$dia= $fecha_partida1[0];
	$mes= $fecha_partida1[1];
	$anio= $fecha_partida1[2];
	$fechaent=$anio."-".$mes."-".$dia;
	
	$fecha_partida2=explode("/",$item['fecha_salida'] );
	$dia1= $fecha_partida2[0];
	$mes1= $fecha_partida2[1];
	$anio1= $fecha_partida2[2];
	$fechasal=$anio1."-".$mes1."-".$dia1;
/*
				$id=$item['id'];
				$f1=$item['fecha_entrada'];
				$f2=$item['fecha_salida'];
				$fecha1=date("m-d-Y", strtotime("$f1"));
				$fecha2=date("m-d-Y", strtotime("$f2"));
				$fechaent=date("Y-m-d", strtotime("$fecha1"));
				$fechasal=date("Y-m-d", strtotime("$fecha2"));
*/
	//echo $item['fecha_entrada']."<br>".$fechaent."<br>".$item['fecha_salida']."<br>".$fechasal."<br>";
	
	$sql = "UPDATE ctregistro SET fechaent='$fechaent', fechasal='$fechasal' WHERE id=$id;";
	mysql_query($sql) or print("error insert: ".mysql_error() );
	echo $id."-->  ".$fechaent."  --> ".$fechasal."<br>";
			
}
?>
            

</body>
</html>