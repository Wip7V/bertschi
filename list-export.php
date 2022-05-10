<?php 
	include("config.php");
	include("conexion.php");
	$cod="0";
	if(isset($_POST["nexport1"])){ 
		$cod=$_POST["nexport1"];
	} 
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GESTIÓN OPERACIONES CON CONTENEDORES</title>
	<?php include("cabecera.inc"); ?>
        <script type="text/javascript" charset="utf-8">
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
    	LISTA EXPORT
    </div>
    <div class="separador"></div>
    <div class="formulario">
    	<form method="post" id="formsal" action="list-export.php" enctype="multipart/form-data">
        	Codigo DUA: 
        	  <select id="nexport1" name="nexport1" onchange="carga()">
        	<option value="0">Selecciona Dispo</option>
<!--            <option value="">Mostrar todo</option>
-->           <?php 
			$sql="SELECT DISTINCT nexport1 FROM ctexport ORDER BY nexport1";
			$result=mysql_query($sql) or die("error: ".mysql_error() );
			while($dades=mysql_fetch_array($result)){
				echo "<option value='".$dades['nexport1']."'>".$dades['nexport1']."</opcion> ";
			}
		?>	
         </select></form>
        <table id="example"><tr><td>
        
        <div id="imprimir">
            <a href="" onClick="imprSelec('impres')"/>Imprimir</a>
        </div> 
        </td><td>      
   <?php
	if ($cod!="0"){  ?>
    	<form method="post" id="genpdf" action="genpdf.php" enctype="multipart/form-data" target="_blank">
            <input type="hidden" id="nexport1" name="nexport1" value="<?php echo $cod; ?>" />
          	<input value="Generar PDF" type="button" id="butpdf" name="butpdf" class="boton" onClick="submit()">
		</form>
  <?php
  	 }
		 ?>
        </td></tr></table>
        
 
    
    
	</div>
    <div class="separador"></div>
    <div id="salida">
       <div id="impres">

   
	<?php
	$cont=$cod;
	$row="";
	if ($cont!="0"){
		$sqlsch="SELECT * FROM ctexport WHERE nexport1='".$cont."'";
	 }else{
		 $sqlsch="SELECT * FROM ctexport WHERE nexport1='0'";
	//	$sqlsch="SELECT * FROM ctdua ORDER BY id_dua";
	 }
		$result=mysql_query($sqlsch, $conexion);
		$trow=mysql_fetch_array($result);
		 ?>
       <table  id="example">
        <thead>
          <tr>
            <th>Dispo 1</th>
            <th>Dispo 2</th>
            <th>Dispo 3</th>
            <th>Dispo 4</th>
            <th>Codigo TARIC</th>
            <th>Tipo aduana</th>
            <th>Tipo declaracion</th>
            <th>Numero formularios</th>
            <th>Descripcion mercancia</th>
            <th>Regimen aduanero</th>
            <th>Peso Export</th>
            
         </tr>
       </thead>
       <tbody>
        <tr>
            <td class="lf"><?php echo $trow['nexport1'] ?></td>
            <td class="lf"><?php echo $trow['nexport2'] ?></td>
            <td class="lf"><?php echo $trow['nexport3'] ?></td>
            <td class="lf"><?php echo $trow['nexport4'] ?></td>
            <td class="lf"><?php echo $trow['codi_taric']?></td>
            <td class="lf"><?php echo $trow['tipo_aduana']?></td>
            <td class="lf"><?php echo $trow['tipo_declaracio']?></td>
            <td class="lf"><?php echo $trow['num_formulari']?></td>
            <td class="lf"><?php echo $trow['des_mercaderia']?></td>
            <td class="lf"><?php echo $trow['regim_aduaner']?></td>
            <td class="lf"><?php echo $trow['pes_export']?></td>
          </tr>
            </tbody>
          </table>
    <div class="separador"></div>
       <table  id="example">
        <thead>
          <tr>
	         <th>Contenedor</th>
            <th>FECHA SALIDA</th>
            <th>tipo de salida</th>
         </tr>
       </thead>
       <tbody>
 
		 <?php
		$result=mysql_query($sqlsch, $conexion);
      	while($row=mysql_fetch_array($result)){ 
	  ?>
        <tr>
            <td class="lf"><?php echo $row['ncontenedor']?></td>
            <td class="lf"><?php echo $row['fecha_salida']?></td>
            <td class="lf"><?php echo $row['tipo_salida']?></td>
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
