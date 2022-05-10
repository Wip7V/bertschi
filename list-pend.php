<?php 
	include("config.php");
	include("conexion.php");
	$cod="0";
	if(isset($_POST["ndua_entrada"])){ 
		$cod=$_POST["ndua_entrada"];
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

        </script>

</head>

<body>
<div id="principal2">
	<div class="titulo">
    	LISTA PENDIENTE ENTRADA DUA
    </div>
    <div class="separador"></div>
    <div class="formulario">
    	<form method="post" id="formsal" action="list-pend.php" enctype="multipart/form-data">
        	Codigo DUA: 
        	  <select id="ndua_entrada" name="ndua_entrada" onchange="carga()">
        	<option value="0">Selecciona Codigo DUA</option>
<!--            <option value="">Mostrar todo</option>
-->           <?php 
			$sql="SELECT DISTINCT ndua_entrada FROM ctdua WHERE fecha_prevista_ent='' ORDER BY ndua_entrada";
			$result=mysql_query($sql) or die("error: ".mysql_error() );
			while($dades=mysql_fetch_array($result)){
				echo "<option value='".$dades['ndua_entrada']."'>".$dades['ndua_entrada']."</opcion> ";
			}
		?>	
         </select>
        <div id="imprimir">
            <a href="" onClick="imprSelec('impres')"/>Imprimir</a>
        </div>
        
    </form>
	</div>
    <div class="separador"></div>
    <div id="salida">
       <div id="impres">

   
	<?php
	$cont=$cod;
	$row="";
	if ($cont!="0"){
		$sqlsch="SELECT * FROM ctdua WHERE ndua_entrada='".$cont."'";
	 }else{
		 $sqlsch="SELECT * FROM ctdua WHERE ndua_entrada='0'";
	//	$sqlsch="SELECT * FROM ctdua ORDER BY id_dua";
	 }
		$result=mysql_query($sqlsch, $conexion);
		$trow=mysql_fetch_array($result);
		 ?>
       <table  id="example">
        <thead>
          <tr>
            <th>DUA entrada</th>
            <th>Codigo TARIC</th>
            <th>Tipo aduana</th>
            <th>Tipo declaracion</th>
            <th>Numero formularios</th>
            <th>Partida orden</th>
            <th>Descripcion mercancia</th>
            <th>Regimen aduanero</th>
            <th>Peso DUA</th>
            
         </tr>
       </thead>
       <tbody>
        <tr>
            <td class="lf"><?php echo $trow['ndua_entrada'] ?></td>
            <td class="lf"><?php echo $trow['codi_taric']?></td>
            <td class="lf"><?php echo $trow['tipo_aduana']?></td>
            <td class="lf"><?php echo $trow['tipo_declaracio']?></td>
            <td class="lf"><?php echo $trow['num_formulari']?></td>
            <td class="lf"><?php echo $trow['partida_ordre']?></td>
            <td class="lf"><?php echo $trow['des_mercaderia']?></td>
            <td class="lf"><?php echo $trow['regim_aduaner']?></td>
            <td class="lf"><?php echo $trow['pes_dua']?></td>
          </tr>
            </tbody>
          </table>
    <div class="separador"></div>
       <table  id="example">
        <thead>
          <tr>
<!--            <th>ID</th>
-->            <th>Contenedor</th>
            <th>DUA salida</th>
            
            <th>Fecha DUA</th>
            <th>Fecha prevista de entrada</th>
            <th>Fecha entrada contenedor</th>
            <th>Fecha salida</th>
            <th>Tipo de salida</th>
			<th>Sector</th>
			<th>Carril</th>
			<th>Posicion</th>
			<th>Piso</th>
         </tr>
       </thead>
       <tbody>
 
		 <?php
		$result=mysql_query($sqlsch, $conexion);
      	while($row=mysql_fetch_array($result)){ 
			$sqlcont="SELECT * FROM ctcontenedor WHERE codigo='".$row['ncontenedor']."' AND fecha_entrada='' ";
			$reslt=mysql_query($sqlcont, $conexion);
			$rowcont=mysql_fetch_array($reslt);
	  ?>
        <tr>
<!--            <td class="lf"><?php echo $row['id_dua']?></td>
-->            <td class="lf"><?php echo $row['ncontenedor']?></td>
            <td class="lf"><?php echo $row['ndua_salida']?></td>
            <td class="lf"><?php echo $row['fecha_dua']; ?></td>
            <td class="lf"><?php echo $row['fecha_prevista_ent']; ?></td>
            <td class="lf"><?php echo $rowcont['fecha_entrada']; ?></td>
            <td class="lf"><?php echo $row['fecha_salida']?></td>
            <td class="lf"><?php echo $row['tipo_salida']?></td>
            <td class="lf"><?php echo $rowcont['sector']; ?></td>
            <td class="lf"><?php echo $rowcont['carril']; ?></td>
            <td class="lf"><?php echo $rowcont['posicio']?></td>
            <td class="lf"><?php echo $rowcont['pis']?></td>
          </tr>
                <?php
				} ?>
            </tbody>
          </table>
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
