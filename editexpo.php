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
	
	
	$sql="SELECT * FROM ctexport WHERE id_export=$id";
	//echo $sql;
	$result=mysql_query($sql) or die("error: ".mysql_error() );
	$linia=mysql_fetch_array($result);
	
	if($linia[$camp]==0) $valor=1;
	else $valor=0;
	
	//echo $linia[$camp];
	
	$sql="UPDATE ctexport SET ".$camp."=".$valor." WHERE id_export=".$id."";
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
	
	$sql="DELETE FROM ctexport WHERE id_export=".$id."";
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
			
					$(function () {

			$.datepicker.setDefaults($.datepicker.regional["es"]);

			$("#fini").datepicker({firstDay: 1 });
			$("#fini").datepicker( "option", "dateFormat", "dd/mm/yy" );
			$('#fini').datepicker('setDate', 'today');	


			$("#ffin").datepicker({firstDay: 1 });
			$("#ffin").datepicker( "option", "dateFormat", "dd/mm/yy" );
			$('#ffin').datepicker('setDate', 'today');			

		});

        </script>
        <style>
        	.dataTables_filter{
				display: none;
			}
        </style>
    </head>
    <body>
        <?php
        
        $consulta1 = "SELECT *  FROM ctexport ORDER BY id_export DESC LIMIT 0,1000";
        
        if(isset($_GET['dispo'])){
        	
        	if($_GET['dispo']!='') $consulta1 = "SELECT * FROM ctexport WHERE entrada_contenedor LIKE '".$_GET['dispo']."' ORDER BY id_export DESC LIMIT 0,1000";
        	if($_GET['contenedor']!='')  $consulta1 = "SELECT *  FROM ctexport WHERE ncontenedor LIKE '%".$_GET['contenedor']."%' ORDER BY id_export DESC LIMIT 0,1000";
        	if($_GET['dn']!='') $consulta1 = "SELECT *  FROM ctexport WHERE certif_export LIKE '%".$_GET['dn']."%' ORDER BY id_export DESC LIMIT 0,1000";
        	if($_GET['dua']!='') $consulta1 = "SELECT * FROM ctexport WHERE entrada_contenedor LIKE '".$_GET['dua']."' ORDER BY id_export DESC LIMIT 0,1000";
        	 
	}
	//echo  $consulta1;

        
        $consulta_mysql = mysql_query($consulta1) or die("mysql error: ".mysql_error() );
		
        ?>
       <div id="principal2">
            <div class="titulo">
                LISTADO LAME
            </div>
            <div class="separador"></div>

                       
            <div style="margin: 0 auto;     width: 600px; text-align: center;">
            <form action="impr_lame.php" method="get"  target="_blank">
              <!--div class="botonessup"><a href="impr_lame.php" target="_blank" class="boton"  style="margin-left:30px;">IMPRIMIR LISTADO LAME</a></div-->
              <label>Fecha Inicio:</label> <input type="text" name="fini" id="fini" /><br>
              <label>Fecha Fin:</label> <input type="text" name="ffin" id="ffin" /><br>
              <input type="submit" value="PDF" /> <!--input type="submit" value="CSV Excel" /--> 
              
              <br>
              </form>
              </div>
             <div class="separador"></div>
                          
            <div class="formulario">
            <form action="editexpo.php" method="get">
                                     <label>Dispo:</label> <input type="text" name="dispo" id="dispo" /><br>
                                     <label>Certif. Expor. DN:</label> <input type="text" name="dn" id="dn" /><br>
                                     <label>Contenedor:</label> <input type="text" name="contenedor" id="contenedor" /><br>
                                     <label>DUA Salida:</label> <input type="text" name="dua" id="dua" /><br>
            <input type="submit" value="Buscar">
            </form><br>
                <table  id="example">
            <thead>
                <tr>
                <th colspan="2"></th>
                <th>ID</th>
                <th>Dispo.</th>
                <th>Cert. Exp.(DN)</th>
                <th>CONTENEDOR</th>
                <th>DUA Salida</th>
                <th>Fecha DN</th>
                <th>Fecha Export</th>
                <th>Adjunto1</th>
                <th>Adjunto2</th>
                

                <th colspan="2"></th>
				</tr>
            </thead>
            <tbody>
                <?php while($item=mysql_fetch_array($consulta_mysql)){ 
                ?>
                 <tr>
                 <td align="center"><a href="formeditexp.php?id_export=<?php echo $item['id_export']; ?>" title="Editar" ><img src="img/editar.png" border="0" /></a>
                     </td>
                    <td align="center"><img src="img/eliminar.png" title="Borrar" onclick="javascript:eliminar(<?php echo $item['id_dua']; ?>);" />
                    </td>
                    <td class="lf"><?php echo $item['id_export']; ?></td>
                    <td class="lf"><?php echo $item['entrada_contenedor']; ?> </td>
                    <td class="lf"><?php echo $item['certif_export']; ?> </td>
                    <td class="lf"><?php echo $item['ncontenedor']; ?></td>
                    <td class="lf"><?php echo $item['dua_salida']; ?></td>
                    <td class="lf"><?php echo $item['fecha_dn']; ?></td>
                    <td class="lf"><?php echo $item['fecha_export']; ?></td>
					<td class="lf"><a href="archivo/export/<?php echo $item['id_export']."/".$item['adjunto1']; ?>"><?php echo $item['adjunto1']; ?></a></td>
					<td class="lf"><a href="archivo/export/<?php echo $item['id_export']."/".$item['adjunto2']; ?>"><?php echo $item['adjunto2']; ?></a></td>
                    <td align="center"><a href="formeditexp.php?id_export=<?php echo $item['id_export']; ?>" title="Editar" ><img src="img/editar.png" border="0" /></a>
                     </td>
                    <td align="center"><img src="img/eliminar.png" title="Borrar" onclick="javascript:eliminar(<?php echo $item['id_export']; ?>);" />
                    </td>
                </tr>
                <?php }
                 ?>
            </tbody>
        </table>
        
                <div id="error_php"></div>
            </div -->

            <div id="salir">
                 <?php include("binicio.inc"); ?>
            </div>

        </div>
    </body>
</html>
