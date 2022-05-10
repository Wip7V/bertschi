<?php 
	//require_once('xajax_core/xajax.inc.php');
	include("config.php");
	include("conexion.php");
//$xajax = new xajax();
	$cod="0";
	if(isset($_GET['codigo'])) $cod=$_GET['codigo'];
	elseif(isset($_POST['codigo'])) $cod=$_POST['codigo'];

/*	function Consulta($id)
{
	ob_start(); //per a retornar un string amb tots els errors
	$respuesta = new xajaxResponse();

	
	if($id != 0)
	{
		$sql = "SELECT * FROM ctcontenedor WHERE id='$id'";
		//echo $sql;
		$result=mysql_query($sql) or print("error: ".mysql_error() );
		$linia=mysql_fetch_array($result) or print("error insert: ".mysql_error() );
		foreach($linia as $nom => $valor) $respuesta->Assign($nom,"value",$valor); //asigna a tots els camps el seu valor a bd.
	}
	
	//posem els errors a una capa
	$phperror ="<pre>".ob_get_clean()."</pre>";
	$respuesta->Assign("error_php","innerHTML",$phperror); //posem els errors a una capa;
	
	return $respuesta;
}
*/
	$sql="SELECT * FROM ctuser WHERE nombre='".$useract."'";
	$result=mysql_query($sql, $conexion) or die("error: ".mysql_error() );
	$row=mysql_fetch_row($result);
	$privilegios=$row[3];
	
	
	//$xajax->processRequest();

	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GESTIÓN OPERACIONES CON CONTENEDORES</title>
	<?php include("cabecera.inc"); ?>
     <?php //$xajax->printJavascript("");?>
       <script type="text/javascript" charset="utf-8">
            /*var oTable;

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
				"aLengthMenu": [[25, 50, 100, 500, -1], [25, 50, 100, 500, "Todos"]],
				"aaSorting": [[ 0, "desc" ]],
				//"sPaginationType": "full_numbers",
				"bSortClasses": false,
				"iDisplayLength": 25
				} );
            } );*/

        </script>
</head>

<body>
<div id="principal">
	<div class="titulo">
    	BUSCAR CONTENEDORES
    </div>
    <div class="separador"></div>

         <?php
		if ($cod=="0"){
		    $consulta1 = "SELECT *  FROM ctcontenedor";
			$consulta_mysql = mysql_query($consulta1) or die("mysql error: ".mysql_error() );

		?>

		<div id="buscar">
		    <form action="buscar.php" method="get">
    	<input type="text" name="codigo" placeholder="CONTENEDOR">
    	<input type="submit" value="Buscar">
    </form>
          <table  id="example" align="center">
            <thead>
                <tr>
                <th width="20">ID</th>
                <th width="180">Codigo</th>
                <th width="180">En Terminal</th>
                <th width="180">Sector</th>			
                <th width="180">Aduana</th>
				</tr>
            </thead>
            <tbody>
                <?php 
			while($item=mysql_fetch_array($consulta_mysql)){ ?>
                 <tr>
                    <td align="center" valign="top"><?php echo $item['id']; ?></td>
                    <?php
						//if ($privilegios!=2) {
							?>
                    <td align="center" valign="top" ><a href="buscar.php?codigo=<?php echo $item['codigo']; ?>" title="Editar" class="boton1"><?php echo $item['codigo']; ?> </a></td>
                    <?php
						//}else{
					
					?>
                    <!--td align="center" valign="top" ><?php echo $item['codigo']; ?></td-->

 					 <?php	//}?>

                    
					<td align="center" valign="top"><?php if($item['presente']==1){echo '<span style="color:#0A0">SI</span>';}else{echo 'NO';} ?></td>
                    <td align="center" valign="top"><?php echo $item['sector']; ?></td>
<!--
                    <td align="center" valign="top"><?php echo $item['carril']; ?></td>
					<td align="center" valign="top"><?php echo $item['posicio']; ?></td>
                    <td align="center" valign="top"><?php echo $item['pis']; ?></td>
-->
                    <td align="center" valign="top"><?php if($item['aduana']==1){echo '<span style="color:#F00">SI</span>';}else{echo 'NO';} ?></td>
                     </td>
                    </td>
                </tr>
                
                <?php 
				}; ?>
            </tbody>
        </table>
		</div>

	<?php 
		}else{ ?>
	
	   <div class="formulario">
    <table class="tabla">
        <tr>
            <td>
            <a href='buscar.php' class="boton1">Listado Contenedores</a> <a href='buscardua.php' class="boton1">Listado DUAs</a> <br>
			 <!--form method="get" id="fsalb" action="buscar.php" enctype="multipart/form-data">
				  <input type="button" class="boton" value="Listado Contenedores" onclick="submit()"/>
			 </form>
			 <form method="get" id="fsalb" action="buscardua.php" enctype="multipart/form-data">
				  <input type="button" class="boton" value="Listado DUAs" onclick="submit()"/>
			 </form-->
			 </td>
        </tr>
	</table>
		</div>
    <div class="separador"></div>
		<div id="salida">

<?php
	$cont=$cod;
	$row="";
	//if ($cont!=""){
		$sqlsch="SELECT * FROM ctregistro WHERE contenedor like '".$cont."'";
		$result=mysql_query($sqlsch, $conexion);
		$cant = mysql_num_rows($result);
		$row=mysql_fetch_row($result);
	//}
?>
<script>
	<?php 
	if($cant == 0){
	?>
	
	document.location = "buscar.php";
		
	<?php }
	?>
</script>
    
          
        <table id="example" class="dua" >
        	<thead>
        	<th></th>
        		<th>Contenedor</th>
        		<th>Fecha</th>
        		<th>Estado</th>
        		<th>Subestado</th>
        		<th>Sector</th>
        		<th>Antidumping</th>
        		<th>Arancel</th>
        		<th>Iva</th>
        		<th>Total</th>
        	</thead>
        	<tbody>
        		<?php
        		                    
                      $sql2="SELECT * FROM ctregistro WHERE contenedor like '".$cont."'";
                    // echo $sql2;
                     //if($item['entrada_salida']=='sa') $sql2 = "SELECT * FROM ctcontenedor WHERE duas = ".$item['id_dua'];
                     
					 	$rs2 = mysql_query($sql2) or die("mysql error: ".mysql_error() );
					 	$item3=mysql_fetch_array($rs2);
					 	
					 	echo "<tr>";
					 	echo "<td><a href='formedit.php?id=".$item3['id']."'><img src='img/editar.png'></a></td>" ; 
					 	echo "<td class='lf'>".$item3['contenedor']."</td>";
					 	echo "<td class='lf'>".$item3['fecha_entrada']."</td>";
					 	echo "<td class='lf'>".$item3['estado']."</td>";
					 	echo "<td class='lf'>".$item3['subestado']."</td>";
					 	
					 	echo "<td class='lf'>".$item3['sector']."</td>";
					 	echo "<td class='lf'>".$item3['antidumping']."€</td>";
					 	echo "<td class='lf'>".$item3['arancel']."€</td>";
					 	echo "<td class='lf'>".$item3['iva']."€</td>";
					 	echo "<td class='lf'>".$item3['total']."€</td>";
					 	echo "</tr>";
					 	
					 
					 ?>
        	</tbody>
        </table>
        <br><br>
        <?php 
        
        
        
          $sql2="SELECT partida_contenedor.data, ctdua.*, ctpartida.* FROM ctpartida, partida_contenedor, ctdua WHERE ctdua.id_dua = ctpartida.dua AND partida_contenedor.partida = ctpartida.id AND  partida_contenedor.contenedor=".$item3['id']." ORDER BY data DESC";
         $rs2 = mysql_query($sql2) or die("mysql error: ".mysql_error() );
        while($item=mysql_fetch_array($rs2))
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

           
				</tr>
            </thead>
            <tbody>
                 <tr>
                 <td align="center"><a href="formeditdua.php?id_dua=<?php echo $item['id_dua']; ?>" title="Editar" ><img src="img/editar.png" border="0" /></a>
                     </td>
                    <td ><?php echo $item['numero']; ?> </td>
                    <td >
                    <?php 
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

                    
                    </td>
                </tr>
                            </tbody>
        </table>


        
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
					 	echo "<td><a href='formeditpartida.php?id=".$item['id']."'><img src='img/editar.png'></a></td>" ; 
					 	echo "<td>".$item['partida']."</td>";
					 	echo "<td>".$item['des_mercaderia']."</td>";
					 	echo "<td>".$item['codi_taric']."</td>";
					 	
						echo "<td>".$item['referencia']."</td>";
					 	echo "<td>".$item['manipulaciones']."</td>";
					 	echo "<td>".$item['coste']."€</td>";
					 	echo "<td>".$item['valor_esta']."€</td>";
					 	echo "<td>".$item['regim_aduaner']."</td>";
					 	
					 	echo "<td>".$item['bultos']."</td>";
					 	echo "<td>".$item['granel']."</td>";
					 	echo "<td>".$item['peso']."</td>";
					 	?>
								
					<?php
					 	echo "</tr>";
					 	
					 
					 ?>
        	</tbody>
        </table>
        <br><br>
            <?php } ?>

    </div>
<?php } ?>
    <div class="separador"></div>
    
    <div id="salir">
    	
         <?php 
		 	include("binicio.inc"); 
		  ?>
    </div>


</div><!-- cierre div principal -->
</body>
</html>
