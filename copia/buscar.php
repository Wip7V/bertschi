<?php include("config.php");
	include("conexion.php");
	$cod="0";
	if(isset($_POST["codigo"])){ 
		$cod=$_POST["codigo"];
	} 
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GESTIÓN OPERACIONES CON CONTENEDORES</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
<script src="js/javas.js" type="text/javascript"></script>
<script src="js/jquery.js" type="text/javascript"></script>

</head>

<body>
<div id="principal">
	<div class="titulo">
    	BUSCAR CONTENEDORES
    </div>
    <div class="separador"></div>
    <div class="formulario">
    	<form method="post" id="formsal" action="buscar.php" enctype="multipart/form-data">
        	Contenedor: 
        	  <select id="codigo" name="codigo" onchange="carga()">
        	<option value=0>Selecciona contenedor</option>
           <?php 
			$sql="SELECT * FROM ctcontenedor ORDER BY codigo";
			$result=mysql_query($sql) or die("error: ".mysql_error() );
			while($dades=mysql_fetch_array($result)){
				echo "<option value='".$dades['codigo']."'>".$dades['codigo']."</opcion> ";
			}
		?>	
         </select>
		 <!--
		 <input value="Buscar" type="submit" class="boton">
		 -->
    </form>
	</div>
    <div class="separador"></div>
    <div id="salida">
<?php
	if(isset($_POST["codigo"])){
		$cont=$_POST["codigo"];
	}else{
		$cont="";
	}
	$row=array("","","","","","","");
	if ($cont!=""){
		$sqlsch="SELECT * FROM ctcontenedor WHERE codigo='".$cont."'";
	
		$result=mysql_query($sqlsch, $conexion);
		$row=mysql_fetch_row($result);
	}
?>
    <table class="tabla">
        <tr>
            <td>ID:</td>
            <td class="lf"><?php echo $row[0]?></td>
        </tr><tr>
            <td>Contenedor:</td>
            <td class="lf"><?php echo $row[1]?></td>
        </tr><tr>
            <td>Estado:</td>
            <td class="lf"><?php echo $row[2]?></td>
        </tr>
        <?php if ($row[3]!="0"){?>
        <tr>
            <td>
                <!-- si estado = vacio visible subestado-->
                Subestado:</td>
            <td class="lf"><?php echo $row[3]?></td>
        </tr>
        <?php }?>
        <tr>
            <td>Sector:</td>
            <td class="lf"><?php echo $row[4]?></td>
        </tr><tr>
            <td>Fecha de entrada:</td>
            <td class="lf"><?php echo $row[5]?></td>
          </tr>
          <tr>
            <td>Fecha de Salida:</td>
            <td class="lf"><?php echo $row[6]?></td>
          </tr></table>
    </div>
    <div class="separador"></div>
    
    <div id="salir">
    	
         <?php 
		 	include("binicio.inc"); 
		  ?>
    </div>


</div><!-- cierre div principal -->
</body>
</html>
