<?php 
require_once('xajax_core/xajax.inc.php');
include("config.php");
include("conexion.php");

$xajax = new xajax();

$xajax->register(XAJAX_FUNCTION, 'Modifica');
$xajax->register(XAJAX_FUNCTION, 'EliminaDua');
$xajax->register(XAJAX_FUNCTION, 'EliminaPartida');

function Modifica($camp, $id)
{
	ob_start(); //per a retornar un string amb tots els errors
	$respuesta = new xajaxResponse();
	
	
	$sql="SELECT * FROM ctdua WHERE id_dua=$id";
	//echo $sql;
	$result=mysql_query($sql) or die("error: ".mysql_error() );
	$linia=mysql_fetch_array($result);
	
	if($linia[$camp]==0) $valor=1;
	else $valor=0;
	
	//echo $linia[$camp];
	
	$sql="UPDATE ctdua SET ".$camp."=".$valor." WHERE id_dua=".$id."";
	mysql_query($sql);
	
	$respuesta->Replace($camp.$id,"innerHTML",$camp.$linia[$camp], $camp.$valor);
		
	$phperror ="<pre>".ob_get_clean()."</pre>";
	$respuesta->Assign("error_php","innerHTML",$phperror);
	
	return $respuesta;
}

function EliminaDua($id)
{
	ob_start(); //per a retornar un string amb tots els errors
	$respuesta = new xajaxResponse();
	
	$sql="DELETE FROM ctdua WHERE id_dua=".$id."";
	mysql_query($sql);

	$sql="UPDATE ctpartida SET dua = 0 WHERE dua =".$id;
	mysql_query($sql);
	
	$respuesta->Script("document.location = document.URL;");
	//echo $sql;
	

	$phperror ="<pre>".ob_get_clean()."</pre>";
	$respuesta->Assign("error_php","innerHTML",$phperror);
	
	return $respuesta;
}

function EliminaPartida($id)
{
	ob_start(); //per a retornar un string amb tots els errors
	$respuesta = new xajaxResponse();
	
	$sql="DELETE FROM ctpartida WHERE id=".$id."";
	mysql_query($sql);

	$sql="DELETE FROM partida_contenedorWHERE partida =".$id;
	mysql_query($sql);
	
	$sql="UPDATE ctcontenedor SET partida = 0 WHERE partida =".$id;
	mysql_query($sql);
	
	$sql="UPDATE ctregistro SET partida = 0 WHERE partida =".$id;
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
<title>GESTI??N OPERACIONES CON CONTENEDORES</title>
<style>
	.lf{
		font-size: 12px !important;
	}

.dua{
	font-size: 14px !important;
	width: 100%;
}
</style>
<?php 
	include("cabecera.inc");
	$xajax->printJavascript("");
?>
        <script type="text/javascript" charset="utf-8">
            var oTable;

            $(document).ready(function() {
				
				
				
				/*$('#example tbody tr').hover( function() {
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
				} );*/
            } );

            
			function Modifica(camp, id)
			{
				$('#'+camp+id).src()
				xajax_Modifica(camp,id);	
			}
			
			function eliminarDua($id)
			{
				if(confirm('Desitja esborrar aquestes dades?'))
				{
					xajax_EliminaDua($id);
    	            //setTimeout("window.location=document.URL;",500);
            	}	
			}
			
			function eliminarPartida($id)
			{
				if(confirm('Desitja esborrar aquestes dades?'))
				{
					xajax_EliminaPartida($id);
    	            //setTimeout("window.location=document.URL;",500);
            	}	
			}

        </script>
    </head>
    <body>
        <?php

        $consulta1 = "SELECT distinct(ctdua.id_dua), ctdua.* FROM ctdua, ctpartida, ctregistro, partida_contenedor WHERE partida_contenedor.partida = ctpartida.id AND partida_contenedor.contenedor = ctregistro.id_contenedor AND ctdua.id_dua = ctpartida.dua ORDER BY id_dua DESC";
        $consulta_mysql = mysql_query($consulta1) or die("mysql error: ".mysql_error() );
		
        ?>
       <div id="principal2">
            <div class="titulo">
                REGISTRO DE DUA / PARTIDA
            </div>
                        <div class="separador"></div>
                        <div class="botonessup"><a href="impr-dua.php" target="_blank" class="boton"  style="margin-left:30px;">IMPRIMIR LISTADO DUA</a></div><br>
            <div class="formulario">
  <div style="background-color: #000; height: 3px;"></div><br>  
                <?php while($item=mysql_fetch_array($consulta_mysql))
                { ?>
                
            <table id="example" class="dua" >
            <thead>
                <tr>
                <th width="20" colspan="1"></th>
                <th width="80">Numero DUA</th>
                <th width="50">Tipo DUA</th>
                
                <th width="80">Fecha</th>
                <th width="80">Fecha<br> prevista</th>
                <th width="60">Tipo</th>
                <th width="40">Tipo aduana</th>
                <th width="40">Tipo declaracion</th>
                <th width="40">Numero<br> formulario</th>

                <th width="40">Destinatario</th>
                <th width="40">Estatuto<br> aduanero</th>

                <th width="60">Adjunt</th>

                <th  width="20" colspan="1"></th>
				</tr>
            </thead>
            <tbody>
                 <tr>
                 <td align="center"><a href="formeditdua.php?id_dua=<?php echo $item['id_dua']; ?>" title="Editar" ><img src="img/editar.png" border="0" /></a>
                     </td>
                    <td class="lf"><?php echo $item['numero']; ?> </td>
                    <td class="lf"><?php if($item['entrada_salida']=='en') echo "Entrada"; else echo "Salida"; ?> </td>
                    
                    <td class="lf"><?php echo substr($item['fecha'],0,10); ?></td>
                    <td class="lf"><?php echo substr($item['fecha_prevista'],0,10); ?></td>
					<td class="lf"><?php echo $item['tipo']; ?></td>
                    <td class="lf"><?php echo $item['tipo_aduana']?></td>
                    <td class="lf"><?php echo $item['tipo_declaracio']?></td>
                    <td class="lf"><?php echo $item['num_formulari']?></td>


                    <td class="lf"><?php echo $item['destinatario']?></td>
                    <td class="lf"><?php echo $item['estatuto_aduanero']?></td>

                     <td class="lf"><?php 
                     if ($item['adjunt']!=''){
                     $nombre =split("/",$item['adjunt']);
                     echo "<a href='".$item['adjunt']."' target='_blank'>".$nombre[2]."</a>";
                     }
                     ?></td>

                    <td align="center"><img src="img/eliminar.png" title="Borrar" onclick="javascript:eliminarDua(<?php echo $item['id_dua']; ?>);" />
                    </td>
                </tr>
                            </tbody>
        </table>

        
        <?php
        
             if($item['entrada_salida']=='en') $sql2 = "SELECT ctpartida.*, ctdua.numero FROM ctpartida, ctdua WHERE duae = id_dua AND duae = ".$item['id_dua'];
             if($item['entrada_salida']=='sa') $sql2 = "SELECT ctpartida.*, ctdua.numero FROM ctpartida, ctdua WHERE duae = id_dua AND duas = ".$item['id_dua'];
        			$rs = mysql_query($sql2) or die("mysql error: ".mysql_error() );
					 	while($item2=mysql_fetch_array($rs)){ 
        ?>
        
        <table id="example" >
        	<thead>
        	<th></th>
        		<th>Partida</th>
        		<th>Descripci??n</th>
        		<th>Codigo Taric</th>

				<th>Referencia</th>
				<th>Manipulaciones</th>
        		<th>Coste Manipulaciones</th>
        		<th>Valor Estadistico</th>
        		<th>Regimen Aduanero</th>
        		
        		<th>Bultos</th>
        		<th>Granel</th>
        		<th>Peso</th>

        	</thead>
        	<tbody>
        		<?php
        		                    

                     

					 	echo "<tr>";
					 	echo "<td><a href='formeditpartida.php?id=".$item2['id']."'><img src='img/editar.png'></a></td>" ; 
					 	echo "<td>".$item2['numero']." - ".$item2['partida']."</td>";
					 	echo "<td>".$item2['des_mercaderia']."</td>";
					 	echo "<td>".$item2['codi_taric']."</td>";
					 	
						echo "<td>".$item2['referencia']."</td>";
					 	echo "<td>".$item2['manipulaciones']."</td>";
					 	echo "<td>".$item2['coste']."???</td>";
					 	echo "<td>".$item2['valor_esta']."???</td>";
					 	echo "<td>".$item2['regim_aduaner']."</td>";
					 	
					 	echo "<td>".$item2['bultos']."</td>";
					 	echo "<td>".$item2['granel']."</td>";
					 	echo "<td>".$item2['peso']."</td>";
					 	?>
								<td align="center"><img src="img/eliminar.png" title="Borrar" onclick="javascript:eliminarPartida(<?php echo $item2['id']; ?>);" />
					<?php
					 	echo "</tr>";
					 	
					 
					 ?>
        	</tbody>
        </table>
        
        
        <table id="example" >
        	<thead>
        	<th></th>
        		<th>Contenedor</th>
        		<th>Fecha</th>
        		<th>Sector</th>
        		<th>Antidumping</th>
        		<th>Arancel</th>
        		<th>Iva</th>
        		<th>Total</th>
        		<th>Fecha Salida</th>
        	</thead>
        	<tbody>
        		<?php
        		                    
                      $sql2 = "SELECT ctregistro.* FROM ctregistro, partida_contenedor WHERE partida_contenedor.contenedor = ctregistro.id_contenedor AND partida_contenedor.partida = ".$item2['id'];
                    // echo $sql2;
                     //if($item['entrada_salida']=='sa') $sql2 = "SELECT * FROM ctcontenedor WHERE duas = ".$item['id_dua'];
                     
					 	$rs2 = mysql_query($sql2) or die("mysql error: ".mysql_error() );
					 	while($item3=mysql_fetch_array($rs2))
					 	{ 
					 	echo "<tr>";
					 	echo "<td><a href='formedit.php?id=".$item3['id']."'><img src='img/editar.png'></a></td>" ; 
					 	echo "<td>".$item3['contenedor']."</td>";
					 	echo "<td>".$item3['fecha_entrada']."</td>";
					 	echo "<td>".$item3['sector']."</td>";
					 	echo "<td>".$item3['antidumping']."???</td>";
					 	echo "<td>".$item3['arancel']."???</td>";
					 	echo "<td>".$item3['iva']."???</td>";
					 	echo "<td>".$item3['total']."???</td>";
					 	echo "<td>".$item3['fecha_salida']."</td>";
					 	echo "</tr>";
					 	}
					 
					 ?>
        	</tbody>
        </table><br>

                <?php } ?>
                <div style="background-color: #000; height: 3px;"></div><br>
				<?php } ?>
        
                <div id="error_php"></div>
            </div>
            <div class="separador"></div>
              
            <div id="salir">
                 <?php include("binicio.inc"); ?>
            </div>

        </div>
    </body>
</html>

