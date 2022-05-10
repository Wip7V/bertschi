<?php 
require_once('xajax_core/xajax.inc.php');
include("config.php");
include("conexion.php");

$xajax = new xajax();

$xajax->register(XAJAX_FUNCTION, 'Modifica');
$xajax->register(XAJAX_FUNCTION, 'Elimina');

function Modifica($camp, $id)
{
	ob_start(); //per a retornar un string amb tots els errors
	$respuesta = new xajaxResponse();
	
	
	$sql="SELECT * FROM ctcontenedor WHERE id=$id";
	//echo $sql;
	$result=mysql_query($sql) or die("error: ".mysql_error() );
	$linia=mysql_fetch_array($result);
	
	if($linia[$camp]==0) $valor=1;
	else $valor=0;
	
	//echo $linia[$camp];
	
	$sql="UPDATE ctcontenedor SET ".$camp."=".$valor." WHERE id=".$id."";
	mysql_query($sql);
	
	$respuesta->Replace($camp.$id,"innerHTML",$camp.$linia[$camp], $camp.$valor);
		
	$phperror ="<pre>".ob_get_clean()."</pre>";
	$respuesta->Assign("error_php","innerHTML",$phperror);
	
	return $respuesta;
}

function Elimina($id)
{
	ob_start(); //per a retornar un string amb tots els errors
	$respuesta = new xajaxResponse();
	
	$sql="DELETE FROM ctcontenedor WHERE id=".$id."";
	mysql_query($sql);
	$respuesta->Script("document.location = document.URL;");
	//echo $sql;
	

	$phperror ="<pre>".ob_get_clean()."</pre>";
	$respuesta->Assign("error_php","innerHTML",$phperror);
	
	return $respuesta;
}

$xajax->processRequest();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GESTIÓN OPERACIONES CON CONTENEDORES</title>
	<?php include("cabecera.inc"); ?>
    <?php $xajax->printJavascript("");?>
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

            
			function Modifica(camp, id)
			{
				$('#'+camp+id).src()
				xajax_Modifica(camp,id);	
			}
			
			function eliminar($id)
			{
				if(confirm('Desitja esborrar aquestes dades?'))
				{
					xajax_Elimina($id);
    	            //setTimeout("window.location=document.URL;",500);
            	}	
			}

        </script>
    </head>
    <body>
        <?php

        $consulta1 = "SELECT *  FROM ctiiee";
        $consulta_mysql = mysql_query($consulta1) or die("mysql error: ".mysql_error() );
		
        ?>
       <div id="principal2">
            <div class="titulo">
                REGISTRO DE IIEE
            </div>
            <div class="separador"></div>
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
                <?php while($item=mysql_fetch_array($consulta_mysql)){ ?>
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
                <?php } ?>
            </tbody>
        </table>
        
                <div id="error_php"></div>
            </div>
            <div class="separador"></div>
            <div id="salir">
                 <?php include("binicio.inc"); ?>
            </div>

        </div>
    </body>
</html>
