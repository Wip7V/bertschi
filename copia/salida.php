<?php include("config.php");
	include("conexion.php");
	 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GESTIÓN OPERACIONES CON CONTENEDORES</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
<script src="js/javas.js" type="text/javascript"></script>
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="js/ng_all.js"></script>
<script type="text/javascript" src="js/components/calendar.js"></script>
</head>

<body>
<div id="principal">
	<div class="titulo">
    	SALIDA DE CONTENEDORES
    </div>
        <div class="separador"></div>

    <div class="formulario">
    	<form method="post" id="formsal" action="salida.php" enctype="multipart/form-data">
        	Contenedor: 
        	  <select id="codigo" name="codigo" onchange="carga()">
        	<option value=0>Selecciona contenedor</option>
           <?php 
			$sql="SELECT * FROM ctcontenedor ORDER BY codigo";
			$result=mysql_query($sql) or die("error: ".mysql_error());
			while($dades=mysql_fetch_array($result)){
				echo "<option value='".$dades['codigo']."'>".$dades['codigo']."</opcion> ";
			}
		?>	
         </select>
    </form>
	</div>
        <div class="separador"></div>

    <div id="salida">
<?php
	$cont=$_POST["codigo"];
	$row="";
	if ($cont!=""){
		$sqlsch="SELECT * FROM ctcontenedor WHERE codigo='".$cont."'";
		$result=mysql_query($sqlsch, $conexion);
		$row=mysql_fetch_row($result);
	}
?>
    	<form method="post" id="guarsal" action="contsalida.php" enctype="multipart/form-data">

    <table class="tabla">
        <tr>
            <td>Contenedor:</td>
            <td class="lf"><?php echo $row[1]?><input type="hidden" id="codigo" name="codigo" value="<?php echo $row[1]?>"/></td>
        </tr><tr>
            <td>Estado:</td>
            <td class="lf"><?php echo $row[2]?><input type="hidden" id="estado" name="estado" value="<?php echo $row[2]?>"/></td>
        </tr><tr>
            <td>
                <!-- si estado = vacio visible subestado-->
                Subestado:</td>
            <td class="lf"><?php echo $row[3]?><input type="hidden" id="subest" name="subest" value="<?php echo $row[3]?>"/></td>
        </tr><tr>
            <td>Sector:</td>
            <td class="lf"><?php echo $row[4]?><input type="hidden" id="sector" name="sector" value="<?php echo $row[4]?>"/></td>
        </tr><tr>
            <td>Fecha de entrada:</td>
            <td class="lf"><?php echo $row[5]?><input type="hidden" id="fechaent" name="fechaent" value="<?php echo $row[5]?>"/></td>
          </tr>
          <tr>
            <td>Fecha de Salida:</td>
            <td class="lf"><input type="date" id="fechasalida" name="fechasalida" value="<?php if ($row[0]!=""){echo date("m/d/Y");} ?>"/></td>
             <script type="text/javascript">
				ng.ready(function(){
					var my_cal = new ng.Calendar({
						input: 'fechasalida',            // the input field id
						date_format:'d/m/Y',
        				months_text:'short',
						start_date: 'last year',   // the start date (default is today)
						end_date: 'year + 5',      // the end date (related to start_date, 4 years from today)
						display_date: new Date()   // the display date (default is start_date)
					});
												
				});
</script>
          </tr><tr>
            <td colspan="2" align="center">
    
            <input type="hidden" id="id" name="id" value="<?php echo $row[0] ?>"/>
             <input type="hidden" id="useract" name="useract" value="<?php echo $useract ?>"/>
         	<input value="Guardar" type="button" id="enviarsalida" name="enviarsalida" onClick="confirmaSalida()" class="boton">
			</td>
          </tr></table>
        </form>
    </div>
    <div class="separador"></div>
    
    <div id="salir">
         <?php include("binicio.inc"); ?>
    </div>


</div><!-- cierre div principal -->
</body>
</html>
