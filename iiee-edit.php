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
	
	
	$sql="SELECT * FROM ctiiee WHERE id_iiee=$id";
	//echo $sql;
	$result=mysql_query($sql) or die("error: ".mysql_error() );
	$linia=mysql_fetch_array($result);
	
	if($linia[$camp]==0) $valor=1;
	else $valor=0;
	
	//echo $linia[$camp];
	
	$sql="UPDATE ctiiee SET ".$camp."=".$valor." WHERE id_iiee=".$id."";
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
	
	$sql="DELETE FROM ctiiee WHERE id_iiee=".$id."";
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
<?php 
	include("cabecera.inc");
	$xajax->printJavascript("");
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
				"iDisplayLength": 30
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
                GESTION DE IIEE
            </div>
            <div class="separador"></div>
            <div class="formulario">
                <table  id="example">
            <thead>
                <tr>
                <th colspan="2"></th>
                <th>ID_IIEE</th>
                <th>id_contenedor</th>
                <th>contenedor</th>
                <th>fecha entrada</th>
                <th>Epigrafe fiscal</th>
                <th>Codigo NC</th>
                <th>Producto</th>
                <th>CAE proveedor</th>
                <th>ARC</th>
                <th>Litros 15ºC</th>
                <th>fecha salida</th>
                <th>Tipo documento</th>
                <th>Numero dispo</th>
                <th>NIF destinatario</th>
                <th>Nombre destinatario</th>
                <th>Regimen fiscal</th>
                <th>Recibido</th>
                <th>Archivo adjunto entrada</th>
                <th>Archivo adjunto salida</th>
                <th colspan="2"></th>
				</tr>
            </thead>
            <tbody>
                <?php while($item=mysql_fetch_array($consulta_mysql)){ ?>
                 <tr>
                 <td align="center"><a href="iiee-formedit.php?id_iiee=<?php echo $item['id_iiee']; ?>" title="Editar" ><img src="img/editar.png" border="0" /></a>
                     </td>
                    <td align="center"><img src="img/eliminar.png" title="Borrar" onclick="javascript:eliminar(<?php echo $item['id_iiee']; ?>);" />
                    </td>
                    <td class="lf"><?php echo $item['id_iiee']; ?></td>
                    <td class="lf"><?php echo $item['id_contenedor']; ?> </td>
					<td class="lf"><?php echo $item['ncontenedor']; ?></td>
                    <td class="lf"><?php echo $item['fecha_entrada']; ?></td>
                    <td class="lf"><?php echo $item['epifiscal']; ?></td>
                    <td class="lf"><?php echo $item['codigonc']; ?></td>
                    <td class="lf"><?php echo $item['producto']; ?></td>
					<td class="lf"><?php echo $item['caeprovee']; ?></td>
                    <td class="lf"><?php echo $item['arc']?></td>
                    <td class="lf"><?php echo $item['litros15c']?></td>
                    <td class="lf"><?php echo $item['fecha_salida']?></td>
                    <td class="lf"><?php echo $item['documento']?></td>
                    <td class="lf"><?php echo $item['num_dispo']?></td>
                    <td class="lf"><?php echo $item['nif_destino']?></td>
                    <td class="lf"><?php echo $item['nom_destino']?></td>
                    <td class="lf"><?php echo $item['regimen']?></td>
                    <td class="lf"><?php echo $item['recibido']?></td>
                    <td class="lf"><?php echo $item['adjuntent']?></td>
                    <td class="lf"><?php echo $item['adjuntsal']?></td>
                    <td align="center"><a href="iiee-formedit.php?id_iiee=<?php echo $item['id_iiee']; ?>" title="Editar" ><img src="img/editar.png" border="0" /></a>
                     </td>
                    <td align="center"><img src="img/eliminar.png" title="Borrar" onclick="javascript:eliminar(<?php echo $item['id_iiee']; ?>);" />
                    </td>
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
