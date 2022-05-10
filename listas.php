<?php 
	include("config.php");
	include("conexion.php");
	foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);


	$fecha1="0";
	$fecha2="0";
	$archivo="";
	$terminal="";
	$rango="nada";
	if(isset($_POST["rango"])){ 
		$rango=$_POST["rango"];
	}
/*	

	if(isset($_POST["consul"])){ 
		$consul=$_POST["consul"];
	} 
		if(isset($_POST["fecha1"])){ 
		$fecha1=$_POST["fecha1"];
	} 
		if(isset($_POST["fecha2"])){ 
		$fecha2=$_POST["fecha2"];
	} 
		if(isset($_POST["archivo"])){ 
		$archivo=$_POST["archivo"];
	} 
*/

 
	
	
	
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GESTIÓN OPERACIONES CON CONTENEDORES</title>
	<?php 
		include("cabecera.inc"); 
	?>

        <script type="text/javascript" charset="utf-8">
            var oTable;

            $(document).ready(function() {
				
				$('#example tbody tr').hover( function() {
				var iCol = $('tr').index(this) % 5;
				var nTrs = oTable.fnGetNodes();
				$('tr:nth-child('+(iCol+1)+')', nTrs).addClass( 'highlighted' );
				}, function() {
					var nTrs = oTable.fnGetNodes();
					$('tr.highlighted', nTrs).removeClass('highlighted');
				} );
				oTable = $('#example').dataTable( {
				"aLengthMenu": [[25, 50, 100, 500, -1], [25, 50, 100, 500, "Tots"]],
				"aaSorting": [[ 0, "desc" ]],
				//"sPaginationType": "full_numbers",
				"bSortClasses": false,
				"iDisplayLength": 100
				} );
            } );
			function imprSelec(muestra)
			{
				var ficha=document.getElementById(muestra);
				var ventimp=window.open(' ','popimpr');
				ventimp.document.write(ficha.innerHTML);
				ventimp.document.close();
				ventimp.print();
				ventimp.close();
			}


		$(function () {
			$.datepicker.setDefaults($.datepicker.regional["es"]);
			$("#fecha1").datepicker({firstDay: 1 });
			$("#fecha1" ).datepicker( "option", "dateFormat", "yy/mm/dd" );
			$("#fecha2").datepicker({firstDay: 1 });
			$("#fecha2" ).datepicker( "option", "dateFormat", "yy/mm/dd" );
			$('#fecha1').datepicker('setDate', 'today');
			$('#fecha2').datepicker('setDate', 'today');
		});
		
		function hoy(){
			$('#fecha1').datepicker('setDate', 'today');
			$('#fecha2').datepicker('setDate', 'today');	
		}
		function tredia(){
			$('#fecha1').datepicker('setDate', 'today-30d');
			$('#fecha2').datepicker('setDate', 'today');	
		}


        </script>

</head>

<body>
<div id="principal2">
	<div class="titulo">
    	Listas
    </div>
    <div class="separador"></div>
    <div class="formulario">
    	<form method="post" id="formsal" action="listas.php" enctype="multipart/form-data">
  		   	 <table class="tabla">
<!--             
        <tr>
        	<td >		</td>
            <td ><input  id="consulta" name="consulta" value="<?php echo $consulta; ?>" readonly="true"/></td>
          </tr>
 -->       <tr>
            <td>Fecha inicio:</td>
            <td><input type="text" id="fecha1" name="fecha1"/></td>
          </tr>
        	  <tr>
            <td>Fecha fin:</td>
            <td><input type="text" id="fecha2" name="fecha2"/></td>
          </tr>
          
           <tr>
        	<td >Nombre del archivo a exportar:</td>
            <td ><input type="text" id="archivo" name="archivo" /></td>
          </tr>
          <tr>
            <td >
                <input type="radio" name="rango" value="todos" checked="checked" > Todos<br>
                <input type="radio" name="rango" value="entrada" > Entrada<br>
                <input type="radio" name="rango" value="salida"> Salida<br>
                <input type="radio" name="rango" value="terminal"> Terminal
            </td>
            <td >
            	<input type="button" class="boton" onClick="tredia()" value="Ultimos 30 dias" /><br>
            	<input type="button" class="boton" onClick="hoy()" value="Registros de hoy" /></td>
          </tr>
           <tr>
        	<td ><input type="submit" value="Mostrar" class="boton" /></td>
            <td ><div id="imprimir">
            <a href="" onClick="imprSelec('impres')"/>Imprimir</a>
        </div>
        </td>
          </tr>
          
          </table> 
 
   </form>             

	</div>
    <div class="separador"></div>
	<div id="impres">
    <div id="salida">
	
            <div class="formulario">
                <table  id="example">
            <thead>
                <tr>
                <th width="20">ID</th>
                <th width="180">contenedor</th>
                <th width="180">Fecha Entrada</th>
                <th width="180">Fecha Salida</th> 
                <th width="180">Sector</th>
                <th width="180">Clase</th>
                <th width="180">ONU</th>
<!--
                <th width="180">Estado</th>
                <th width="180">Subestado</th>
                <th width="180">User Salida</th>
                <th width="180">User Entrada</th>
                <th width="180">Carril</th> 
                <th width="180">Posicion</th>
                <th width="180">Piso</th>
                <th width="180">Adjunto</th>
                <th width="180">Aduana</th>
-->
				</tr>
            </thead>
            <tbody>
                <?php
	$consulta1="0";			
    $consulta = "";
		//var_dump($_POST);
$tamaño = count($_POST);
		//echo "<br> $tamaño";
if ($tamaño>0)
{
	foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);
			 
	if ($fecha1!="" && $fecha2!="" ){
		if ($rango=="entrada"){
			$consulta1="WHERE fecha_entrada BETWEEN '$fecha1' AND '$fecha2'";
		}elseif ($rango=="salida"){
			$consulta1="WHERE fecha_salida BETWEEN '$fecha1' AND '$fecha2'";
		}elseif ($rango=="todos"){
			$consulta1="WHERE (fecha_entrada BETWEEN '$fecha1' AND '$fecha2') OR (fecha_salida BETWEEN '$fecha1' AND '$fecha2') ";
		}elseif ($rango=="terminal"){
			$consulta1="WHERE fecha_salida ='0000-00-00' ";
		}
	}

}
	if ($consulta1!="0"){
		$consulta="SELECT * FROM ctregistro $consulta1 ORDER by id";
	}else{
		$consulta="SELECT * FROM ctregistro ORDER by id DESC LIMIT 30";
	}
	
        $result=mysql_query($consulta, $conexion);
		
		$num_rows = mysql_num_rows($result);
		if ($num_rows==0){
			echo '<script language="javascript">alert("Esta busqueda no ha dado ningún resultado");</script>';

		}else{
			if ($archivo!="" && $fecha1!="" && $fecha2!="" ){ exportar($consulta,$archivo);}
			 
			echo $rango;
            //echo $consulta;
	
			while($item=mysql_fetch_array($result)){ ?>
			 <tr>
                    <td align="center" valign="top"><?php echo $item['id']; ?></td>
                    <td align="center" valign="top"><?php echo $item['contenedor']; ?> </td>
                    <td align="center" valign="top"><?php echo $item['fecha_entrada']; ?></td>
                    <td align="center" valign="top"><?php echo $item['fecha_salida']; ?></td>
                    <td align="center" valign="top"><?php echo $item['sector']; ?></td>
		            <td align="center" valign="top"><?php echo $item['clase']?></td>
		            <td align="center" valign="top"><?php echo $item['onu']?></td>
<!--
					<td align="center" valign="top"><?php echo $item['estado']; ?></td>
                    <td align="center" valign="top"><?php echo $item['subestado']; ?></td>
                    <td align="center" valign="top"><?php echo $item['sector']; ?></td>
                    <td align="center" valign="top"><?php echo $item['user_entrada']; ?></td>
                    <td align="center" valign="top"><?php echo $item['carril']; ?></td>
					<td align="center" valign="top"><?php echo $item['posicio']; ?></td>
                    <td align="center" valign="top"><?php echo $item['pis']; ?></td>
                    <td align="center" valign="top"><?php echo $item['adjunt']; ?></td>
                    <td align="center" valign="top"><?php echo $item['aduana']; ?></td>
-->                    
			</tr>
			<?php } 
		}?>
            </tbody>
        </table>
        
                <div id="error_php"></div>
            </div>
    </div>
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
