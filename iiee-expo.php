<?php 
	include("config.php");
	include("conexion.php");
	foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);


	$fecha1="0";
	$fecha2="0";
	$archivo="";
	$terminal="";
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
			$("#fecha1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			$("#fecha2").datepicker({firstDay: 1 });
			$("#fecha2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			
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
    	Exportador IIEE
    </div>
    <div class="separador"></div>
    <div class="formulario">
    	<form method="post" id="formsal" action="iiee-expo.php" enctype="multipart/form-data">
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
            <td colspan="2"><input type="button" class="boton" onClick="tredia()" value="Ultimos 30 dias" /><input type="button" class="boton" onClick="hoy()" value="Registros de hoy" /></td>
          </tr>
           <tr>
        	<td ><input type="submit" value="Mostrar" class="boton" /></td>
            <td ></td>
          </tr>
          
          </table> 
 
   </form>             

    
	</div>
    <div class="separador"></div>
    <div id="salida">
            <div class="formulario">
                <table  id="example">
            <thead>
                <tr>
                <th >ID_IIEE</th>
                <th>id_contenedor</th>
                <th>contenedor</th>
                <th>fecha entrada</th>
                <th>Epigrafe fiscal</th>
                <th>Codigo NC</th>
                <th>Producto</th>
                <th>CAE proveedor</th>
                <th>ARC</th>
                <th>fecha salida</th>
                <th>Litros 15ºC</th>
                <th>Tipo documento</th>
                <th>Numero dispo</th>
                <th>NIF destinatario</th>
                <th>Nombre destinatario</th>
                <th>Regimen fiscal</th>
                <th>Archivo adjunto entrada</th>
                <th>Archivo adjunto salida</th>
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
        	$consulta1="WHERE fecha_entrada BETWEEN '$fecha1' AND '$fecha2' ";
	    }

}
	if ($consulta1!="0"){
		$consulta="SELECT * FROM ctiiee $consulta1 ORDER by id_iiee";
	}else{
		$consulta="SELECT * FROM ctiiee ORDER by id_iiee DESC LIMIT 30";
	}
	
        $result=mysql_query($consulta, $conexion);
		
		$num_rows = mysql_num_rows($result);
		if ($num_rows==0){
			echo '<script language="javascript">alert("Esta busqueda no ha dado ningún resultado");</script>';

		}else{
			if ($archivo!="" && $fecha1!="" && $fecha2!="" ){ exportar($consulta,$archivo);}

			while($item=mysql_fetch_array($result)){ ?>
			 <tr>
				<td ><?php echo $item['id_iiee']; ?></td>
				<td ><?php echo $item['id_contenedor']; ?> </td>
				<td ><?php echo $item['ncontenedor']; ?></td>
				<td ><?php echo $item['fecha_entrada']; ?></td>
				<td ><?php echo $item['epifiscal']; ?></td>
				<td ><?php echo $item['codigonc']; ?></td>
				<td ><?php echo $item['producto']; ?></td>
				<td ><?php echo $item['caeprovee']; ?></td>
				<td ><?php echo $item['arc']?></td>
				<td ><?php echo $item['fecha_salida']?></td>
				<td ><?php echo $item['litros15c']?></td>
				<td ><?php echo $item['documento']?></td>
				<td ><?php echo $item['num_dispo']?></td>
				<td ><?php echo $item['nif_destino']?></td>
				<td ><?php echo $item['nom_destino']?></td>
				<td ><?php echo $item['regimen']?></td>
				<td ><?php echo $item['adjuntent']?></td>
				<td ><?php echo $item['adjuntsal']?></td>
			</tr>
			<?php } 
		}?>
            </tbody>
        </table>
        
                <div id="error_php"></div>
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
