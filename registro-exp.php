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

        $consulta1 = "SELECT *  FROM ctexport";
        $consulta_mysql = mysql_query($consulta1) or die("mysql error: ".mysql_error() );
		
        ?>
       <div id="principal2">
            <div class="titulo">
                REGISTRO EXPORT
            </div>
            <div class="separador"></div>
            <div class="formulario">
                <table  id="example">
            <thead>
                <tr>
                <th width="20">ID EXPORT</th>
                <th width="180">NUM EXPORT1</th>
                <th width="180">NUM EXPORT2</th>
                <th width="180">NUM EXPORT3</th>
                <th width="180">NUM EXPORT4</th>
                <th width="180">contenedor</th>
                <th width="180">fecha EXPORT</th>
                <th width="180">Fecha salida</th>
                <th width="180">tipo de salida</th>
                <th width="180">codigo taric</th>
                <th width="180">tipo aduana</th>
                <th width="180">tipo declaracion</th>
                <th width="180">num form</th>
                <th width="180">descripcion</th>
                <th width="180">regimen aduanero</th>
                <th width="180">destinatario</th>
				</tr>
            </thead>
            <tbody>
                <?php while($item=mysql_fetch_array($consulta_mysql)){ ?>
                 <tr>
                    <td align="center" valign="top"><?php echo $item['id_export']; ?></td>
                    <td align="center" valign="top"><?php echo $item['nexport1']; ?> </td>
                    <td align="center" valign="top"><?php echo $item['nexport2']; ?> </td>
                    <td align="center" valign="top"><?php echo $item['nexport3']; ?> </td>
                    <td align="center" valign="top"><?php echo $item['nexport4']; ?> </td>
                    <td align="center" valign="top"><?php echo $item['ncontenedor']; ?></td>
                    <td align="center" valign="top"><?php echo $item['fecha_export']; ?></td>
					<td align="center" valign="top"><?php echo $item['fecha_salida']; ?></td>
                    <td align="center" valign="top"><?php echo $item['tipo_salida']; ?></td>
                    <td align="center" valign="top"><?php echo $item['codi_taric']; ?></td>
                    <td align="center" valign="top"><?php echo $item['tipo_aduana']; ?></td>
                    <td align="center" valign="top"><?php echo $item['tipo_declaracio']; ?></td>
                    <td align="center" valign="top"><?php echo $item['num_formulari']; ?></td>
                    <td align="center" valign="top"><?php echo $item['des_mercaderia']; ?></td>
                    <td align="center" valign="top"><?php echo $item['regim_aduaner']; ?></td>
                    <td align="center" valign="top"><?php echo $item['destinatario']; ?></td>
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
