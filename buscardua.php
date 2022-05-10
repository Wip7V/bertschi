<?php 
require_once('xajax_core/xajax.inc.php');
include("config.php");
include("conexion.php");

$xajax = new xajax();


$xajax->register(XAJAX_FUNCTION, 'EliminaDua');
$xajax->register(XAJAX_FUNCTION, 'EliminaPartida');


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
	

	$respuesta->Script("document.location = document.URL;");
	//echo $sql;
	

	$phperror ="<pre>".ob_get_clean()."</pre>";
	$respuesta->Assign("error_php","innerHTML",$phperror);
	
	return $respuesta;
}

$xajax->processRequest();

	$cod="0";
	if(isset($_GET["ndua_entrada"])){ 
		$cod=$_GET["ndua_entrada"];
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
<?php 
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
<div id="principal2">
	<div class="titulo">
    	BUSCAR DUA
    </div>
    <div class="separador"></div>
    <div class="formulario">
    	<form method="get" id="formsal" action="buscardua.php" enctype="multipart/form-data">

        	  <!--select id="ndua_entrada" name="ndua_entrada" onchange="carga()">
        	<option value="0">Selecciona Codigo DUA</option>
           <?php 
			/*$sql="SELECT id_dua, numero FROM ctdua ORDER BY numero";
			$result=mysql_query($sql) or die("error: ".mysql_error() );
			while($dades=mysql_fetch_array($result)){
				echo "<option value='".$dades['id_dua']."'>".$dades['numero']."</opcion> ";
			}*/
		?>	
         </select-->

    	<input type="text" name="ndua_entrada" placeholder="CODIGO DUA">
    	<input type="submit" value="Buscar">

        <div id="imprimir">
            <a href="" onClick="imprSelec('impres')"/>Imprimir</a>
        </div>
        
    </form>
	</div>
    <div class="separador"></div>
    <div id="salida">
       <div id="impres">

   
  <?php


        $consulta1 = "SELECT * FROM ctdua WHERE numero like '$cod'";
        $consulta_mysql = mysql_query($consulta1) or die("mysql error: ".mysql_error() );
		
        ?>
    
                <?php while($item=mysql_fetch_array($consulta_mysql))
                { ?>
                
            <table id="example" >
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
                    <td ><?php echo $item['numero']; ?> </td>
                    <td ><?php 
                    if($item['entrada_salida']=='en') echo "Entrada";
                    if($item['entrada_salida']=='in') echo "Intermedio";
                    if($item['entrada_salida']=='sa') echo "Salida";
                    
                      ?> </td>
                    
                    <td ><?php echo substr($item['fecha'],0,10); ?></td>
                    <td ><?php echo substr($item['fecha_prevista'],0,10); ?></td>
					<td ><?php echo $item['tipo']; ?></td>
                    <td ><?php echo $item['tipo_aduana']?></td>
                    <td ><?php echo $item['tipo_declaracio']?></td>
                    <td ><?php echo $item['num_formulari']?></td>


                    <td ><?php echo $item['destinatario']?></td>
                    <td ><?php echo $item['estatuto_aduanero']?></td>

                     <td ><?php 
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
        <br>
        
        <?php
        
            /* if($item['entrada_salida']=='en') $sql2 = "SELECT * FROM ctpartida WHERE duae = ".$item['id_dua'];
             if($item['entrada_salida']=='sa') $sql2 = "SELECT * FROM ctpartida WHERE duas = ".$item['id_dua'];*/
              $sql2 = "SELECT * FROM ctpartida WHERE dua = ".$item['id_dua'];
        			$rs = mysql_query($sql2) or die("mysql error: ".mysql_error() );
					 	while($item2=mysql_fetch_array($rs)){ 
        ?>
        
        <table id="example" >
        	<thead>
        	<th></th>
        		<th>Partida</th>
        		<th>Descripción</th>
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
					 	echo "<td>".$item2['partida']."</td>";
					 	echo "<td>".$item2['des_mercaderia']."</td>";
					 	echo "<td>".$item2['codi_taric']."</td>";
					 	
						echo "<td>".$item2['referencia']."</td>";
					 	echo "<td>".$item2['manipulaciones']."</td>";
					 	echo "<td>".$item2['coste']."€</td>";
					 	echo "<td>".$item2['valor_esta']."€</td>";
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
        	</thead>
        	<tbody>
        		<?php
        		                    
                      //$sql2 = "SELECT * FROM ctcontenedor, partida_contenedor WHERE partida_contenedor.contenedor = ctcontenedor.id AND partida_contenedor.partida = ".$item2['id'];
                      $sql2 = "SELECT * FROM ctcontenedor WHERE ctcontenedor.partida = ".$item2['id'];
                    // echo $sql2;
                     //if($item['entrada_salida']=='sa') $sql2 = "SELECT * FROM ctcontenedor WHERE duas = ".$item['id_dua'];
                     
					 	$rs2 = mysql_query($sql2) or die("mysql error: ".mysql_error() );
					 	while($item3=mysql_fetch_array($rs2))
					 	{ 
					 	echo "<tr>";
					 	echo "<td><a href='formedit.php?id=".$item3['id']."'><img src='img/editar.png'></a></td>" ; 
					 	echo "<td><a href='buscar.php?codigo=".$item3['codigo']."' class='boton1'>".$item3['codigo']."</a></td>";
					 	echo "<td>".$item3['fecha_entrada']."</td>";
					 	echo "<td>".$item3['sector']."</td>";
					 	echo "<td>".$item3['antidumping']."€</td>";
					 	echo "<td>".$item3['arancel']."€</td>";
					 	echo "<td>".$item3['iva']."€</td>";
					 	echo "<td>".$item3['total']."€</td>";
					 	echo "</tr>";
					 	}
					 
					 ?>
        	</tbody>
        </table><br>

HISTORICO CONTENEDORES DEL DUA
        <table id="example" >
        	<thead>
        	<th></th>
        		<th>Contenedor</th>
        		<th>Fecha - Partida</th>
        		<th>Partida</th>
        		<th>DUA</th>
        		<th>Fecha DUA</th>
        		<th>Sector</th>
        		<th>Antidumping</th>
        		<th>Arancel</th>
        		<th>Iva</th>
        		<th>Total</th>
        	</thead>
        	<tbody>
        		<?php
        		                    
                      $sql2 = "SELECT ctcontenedor.*, ctdua.*, ctpartida.partida, partida_contenedor.data FROM ctcontenedor, partida_contenedor, ctpartida, ctdua WHERE ctpartida.id = partida_contenedor.partida AND ctpartida.dua = ctdua.id_dua AND partida_contenedor.contenedor = ctcontenedor.id AND partida_contenedor.partida = ".$item2['id'];
                     // echo $sql2;
                     //if($item['entrada_salida']=='sa') $sql2 = "SELECT * FROM ctcontenedor WHERE duas = ".$item['id_dua'];
                     
					 	$rs2 = mysql_query($sql2) or die("mysql error: ".mysql_error() );
					 	while($item3=mysql_fetch_array($rs2))
					 	{ 
					 	echo "<tr>";
					 	echo "<td><a href='formedit.php?id=".$item3['id']."'><img src='img/editar.png'></a></td>" ; 
					 	echo "<td><a href='buscar.php?codigo=".$item3['codigo']."' class='boton1'>".$item3['codigo']."</a></td>";
					 	echo "<td>".$item3['data']."</td>";
					 	echo "<td>".$item3['partida']."</td>";
					 	echo "<td>".$item3['numero']."</td>";
					 	echo "<td>".$item3['fecha']."</td>";
					 	echo "<td>".$item3['sector']."</td>";
					 	echo "<td>".$item3['antidumping']."€</td>";
					 	echo "<td>".$item3['arancel']."€</td>";
					 	echo "<td>".$item3['iva']."€</td>";
					 	echo "<td>".$item3['total']."€</td>";
					 	echo "</tr>";
					 	}
					 
					 ?>
        	</tbody>
        </table>
 
 <?php }} ?>
 
  <div class="separador"></div>
 

          </div>
    </div>
   
    
    <div id="salir">
    	
         <?php 
		 	include("binicio.inc"); 
		  ?>
    </div>


</div><!-- cierre div principal -->
</body>
</html>
