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
	
	
	$sql="SELECT * FROM ctuser WHERE id=$id";
	//echo $sql;
	$result=mysql_query($sql) or die("error: ".mysql_error() );
	$linia=mysql_fetch_array($result);
	
	if($linia[$camp]==0) $valor=1;
	else $valor=0;
	
	//echo $linia[$camp];
	
	$sql="UPDATE ctuser SET ".$camp."=".$valor." WHERE id=".$id."";
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
	
	$sql="DELETE FROM ctuser WHERE id=".$id."";
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
<link href="estilo.css" rel="stylesheet" type="text/css" />
		<script src="js/javas.js" type="text/javascript"></script>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
         
        
        <?php $xajax->printJavascript("");?>
        <style type="text/css" title="currentStyle">
            @import "css/demo_table.css";
	</style>
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
				"sPaginationType": "full_numbers",
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

        $consulta1 = "SELECT *  FROM ctuser";
        $consulta_mysql = mysql_query($consulta1) or die("mysql error: ".mysql_error() );
		
        ?>
       <div id="principal">
            <div class="titulo">
                GESTION DE USUARIOS
            </div>
            <div class="separador"></div>
            <div class="formulario">
    
                <div style="height:50px;"><a href="formuser.php" class="boton">Nuevo usuario</a></div>
                <br />
                
                <table class="tabla" border="1" id="example">
            <thead>
                <tr>
                <th width="20">ID</th>
                <th width="180">Nombre</th>
                <th width="180">Contraseña</th>
                <th width="180">Privilegios</th> 
				</tr>
            </thead>
            <tbody>
                <?php while($item=mysql_fetch_array($consulta_mysql)){ ?>
                 <tr>

                    <td align="center" valign="top"><?php echo $item['id']; ?></td>
                    <td align="center" valign="top"><?php echo $item['nombre']; ?></td>
					<td align="center" valign="top"><?php echo $item['pws']; ?></td>
                    <td align="center" valign="top"><?php echo $item['privilegios']; ?></td>
  
                                    
                          
                     <td align="center">
 						<a href="formuser.php?id=<?php echo $item['id']; ?>" title="Editar" ><img src="img/editar.png" border="0" class="boton"/></a>
                     </td>
                           
                    <td align="center">
                          
                            <img src="img/eliminar.png" title="Borrar" onclick="javascript:eliminar(<?php echo $item['id']; ?>);" class="boton" />
                        
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
