<?php 
	include("config.php");
	include("conexion.php");

	$cod="";
	if(isset($_POST["arc"])){ 
		$cod=$_POST["arc"];
		
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
			$(function () {
				$.datepicker.setDefaults($.datepicker.regional["es"]);
				$("#fecha_salida").datepicker({firstDay: 1 });
				$("#fecha_salida" ).datepicker( "option", "dateFormat", "yy/mm/dd" );
				$('#fecha_salida').datepicker('setDate', 'today');	
			});
			$(document).ready(function(e) {
				xajax_Consulta(<?php echo $cod; ?>);
					
			});
        </script>

</head>

<body>
<div id="principal">
	<div class="titulo">
    	Salida ARC
    </div>
    <div class="separador"></div>
    <div class="formulario">
    	<form method="post" id="formsal" action="iiee-sal.php" enctype="multipart/form-data">
        	ARC: 
        	  <select id="arc" name="arc" onchange="carga()">
        	<option value="">Selecciona ARC</option>
          
   <?php 
    $sql="SELECT DISTINCT arc FROM ctiiee WHERE fecha_salida='0000/00/00' ORDER BY arc";
    $result=mysql_query($sql) or die("error: ".mysql_error() );
    while($dades=mysql_fetch_array($result)){
        echo "<option value='".$dades['arc']."'>".$dades['arc']."</opcion> ";
    }
?>	
         </select>
    </form>
	</div>
    <div class="separador"></div>
    <div class="formulario">
<?php
	$cont=$cod;
	
	$row="";
	if ($cont!=""){
		$sqlsch="SELECT * FROM ctiiee WHERE arc='".$cont."' ";
		$result=mysql_query($sqlsch, $conexion);
		$dades=mysql_fetch_array($result);
	}
?>
    	 <form method="post" id="form" action="iiee-salform.php" enctype="multipart/form-data">
        	 <table class="tabla">
             
         <tr>
            <td>ARC:</td>
            <td  class="lf"><input id="arc" name="arc" type="text" value="<?php echo $dades['arc']; ?>"  readonly="TRUE">
            <input id="id_iiee" name="id_iiee" type="hidden" value="<?php echo $dades['id_iiee']; ?>">
            <input id="id_contenedor" name="id_contenedor" type="hidden" value="<?php echo $dades['id_contenedor']; ?>">
            </td>
        </tr>
        <tr>
        	<td >Contenedor: </td>
             <td  class="lf"><input id="ncontenedor" name="ncontenedor" type="text" readonly="TRUE" value="<?php echo $dades['ncontenedor']; ?>" readonly="TRUE"/></td>
           	</td>
        </tr>
        <tr>
            <td>Epigrafe Fiscal(12b / 17b):</td>
            <td  class="lf"><input id="epifiscal" name="epifiscal" type="text" readonly="TRUE" value="<?php echo $dades['epifiscal']; ?>"  readonly="TRUE"/></td>
        </tr>
        <tr>
            <td>Codigo NC(12c / 17c):</td>
            <td><input type="text" id="codigonc" name="codigonc" readonly="TRUE" value="<?php echo $dades['codigonc']; ?>"  readonly="TRUE"/></td>
        </tr>    
        <tr>
            <td>Producto (12l / 17p):</td>
            <td><input type="text" id="producto" name="producto" readonly="TRUE" value="<?php echo $dades['producto']; ?>"  readonly="TRUE"/></td>
          </tr>
        <tr>
            <td>Fecha entrada:</td>
            <td><input type="text" id="fecha_entrada" name="fecha_entrada" value="<?php echo $dades['fecha_entrada']; ?>" readonly="TRUE"/></td>
          </tr>
          <tr>
            <td>Cae Proveedor (1c / 2a):</td>
            <td><input type="text" id="caeprovee" name="caeprovee" value="<?php echo $dades['caeprovee']; ?>" readonly="TRUE"/></td>
          </tr>
        <tr>
        	<td>Litros 15ºC (12d / 17d): </td>
            <td><input type="text" id="litros15c" name="litros15c" value="<?php echo $dades['litros15c']; ?>" readonly="TRUE"/></a></td>
        </tr>
         <tr>
            <td>Fecha expedicion (2f):</td>
            <td><input type="text" id="fecha_salida" name="fecha_salida" value="<?php echo $dades['fecha_salida']; ?>"/>
			</td>
        </tr>    
         <tr>
            <td>Clase documento:</td>
            <td  class="lf"><select id="documento" name="documento" value="<?php echo $dades['documento']; ?>">
                        	 <option value=0>Selecciona documento</option>
                        	 <option value="ALB">ALB</option>
                        	 <option value="EADE">EADE</option>
                        	 <option value="otros">otros</option>
                 
                   </select>
			 </td>
        </tr>    
         <tr>
            <td>recibido:</td>
            <td  class="lf"><select id="recibido" name="recibido" value="<?php echo $dades['recibido']; ?>">
                        	 <option value=0>Selecciona documento</option>
                        	 <option value="SI">SI</option>
                        	 <option value="NO">NO</option>
                   </select>
			 </td>
        </tr>    
         <tr>
            <td>Numero Dispo:</td>
            <td  class="lf"><input id="num_dispo" name="num_dispo" type="text" value="<?php echo $dades['num_dispo']; ?>"/></td>
        </tr>
         <tr>
            <td>NIF Destinatario (4b):</td>
            <td  class="lf"><input id="nif_destino" name="nif_destino" type="text" value="<?php echo $dades['nif_destino']; ?>" /></td>
        </tr>
         <tr>
            <td>Nombre destinatario (4c):</td>
            <td  class="lf"><input type="text" id="nom_destino" name="nom_destino" value="<?php echo $dades['nom_destino']; ?>"/></td>
        </tr>
     	<tr>
            <td>Regimen Fiscal (2c):</td>
            <td class="lf"><select id="regimen" name="regimen" style="width: 500px" value="<?php echo $dades['regimen']; ?>">
                <option value=0>Selecciona Regimen Fiscal</option>
                <option value="A" class="ops">A Avituallamientos exentos a buques y aeronaves que se documentan con e-DA </option>
                <option value="D" class="ops">D Envíos de productos al amparo de supuestos de exención por entregas en el marco de las relaciones internacionales.</option>
                <option value="E" class="ops">E Envíos de productos al amparo de supuestos de exención distintos de los señalados en las letras A y D.</option>
                <option value="F" class="ops">F Salida de productos a tipo reducido con destino a consumidores finales.</option>
                <option value="R" class="ops">R Salida de productos a tipo reducido con destino a almacenes fiscales o a detallistas inscritos.</option>
                <option value="S" class="ops">S Productos que se expiden en régimen suspensivo.</option>
                <option value="PL" class="ops">PL Plena repercusión impuesto.</option>
               </select></td>
        </tr>
        <tr>
            <td>Archivo adjunto entrada:</td>
            <td  class="lf"><a href="archivos/iiee/<?php echo $dades['adjuntent']; ?>" target="_blank"><?php echo $dades['adjuntent']; ?></td>
        </tr>
        <tr>
        	<td>Archivo adjunto salida: </td>
            <td><input id="adjuntsal" name="adjuntsal" size="20" type="file"></td>
        </tr>

          <tr>
            <td colspan="2" align="center">
    
            <input type="hidden" id="useract" name="useract" value="<?php echo $useract ?>"/>
          	<input value="Guardar" type="button" id="enviarentra" name="enviarentra" class="boton" onClick="confirmaSaliiee();">
            </td>
          </tr></table>
        </form>
    </div>
    <div class="separador"></div>
    
    <div id="salir">
         <?php include("binicio.inc"); ?>
    </div>


</div><!-- cierre div principal -->
</body>
</html>
