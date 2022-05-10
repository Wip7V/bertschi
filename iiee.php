<?php 
	include("config.php");
	include("conexion.php");
	 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GESTIÓN OPERACIONES CON CONTENEDORES</title>
	<?php 
		include("cabecera.inc"); 
	?>
<script type="text/javascript">
		$(function () {
			$.datepicker.setDefaults($.datepicker.regional["es"]);
			$("#fecha_entrada").datepicker({firstDay: 1 });
			$("#fecha_entrada").datepicker( "option", "dateFormat", "yy/mm/dd" );
			$("#fecha_salida").datepicker({firstDay: 1 });
			$("#fecha_salida").datepicker( "option", "dateFormat", "yy/mm/dd" );
			$('#fecha_entrada').datepicker('setDate', 'today');	
		});

		function ComprobarARC()
		{
			document.form.action = "iiee.php"; 
			document.form.submit();	
		}
		
</script>

</head>

<body>
    <?php
		$comprobado="NO COMPROBADO";
		$arc = "";
		
		if (isset($_POST['arc1'])){

			$arc = $_POST['arc1'];
			$sql="SELECT * FROM ctiiee WHERE arc='$arc'";
			$resultado = mysql_query($sql);
			$filas = mysql_num_rows($resultado);
			if ($filas==FALSE){
				echo "<script>alert('El ARC introducido esta libre');</script>";
				$comprobado="COMPROBADO";
			}else{
				echo "<script>alert('El ARC introducido ya existe, introduce un numero distinto');</script>";
				$arc = "";
			}
		
		}


?>
<div id="principal">
	<div class="titulo">
    	Entrada IIEE
    </div>
    <div class="separador"></div>
    <div class="formulario">
    	 <form method="post" id="form" name="form" action="iiee-form.php" enctype="multipart/form-data">
        	 <table class="tabla">
             
         <tr>
            <td>ARC:</td>
            <td class="lf"> <input id="arc1" name="arc1" type="text" maxlength="22" > 
            <input type="button" value="Comprobar ARC" onclick="ComprobarARC()"><br />
            <input id="arc" name="arc" type="text" readonly="TRUE" value="<?php echo $arc; ?>"style="background-color:#999" >
            <input id="comprobar" name="comprobar" type="text" readonly="TRUE" value="<?php echo $comprobado; ?>"style="background-color:#999" >
            </td>
        </tr>    
        <tr>
        	<td >Contenedor: </td>
            <td  class="lf"><select id="ncont" name="ncont">
                <option value=0>Selecciona contenedor</option>
                       <?php 
					   $consulta="SELECT DISTINCT codigo,aduana FROM ctcontenedor WHERE aduana=2 AND codigo NOT IN (SELECT DISTINCT ncontenedor as codigo FROM ctiiee)";
					  
					   muestra_contenedor($consulta);	?>	
                 </select> </td>
            
             <td  class="lf"><div id="content"></div></td>
               
           	</td>
        </tr>
         <tr>
            <td>Epigrafe Fiscal(12b / 17b):</td>
            <td  class="lf"><select id="epifiscal" name="epifiscal"  style="width: 500px">
            	 <option value=0>Selecciona Epigrafe Fiscal</option>
<option value="B0" class="ops">	B0 Gasolinas con plomo.	</option>
<option value="B1" class="ops">	B1 Gasolinas sin plomo.	</option>
<option value="B2" class="ops">	B2 Gasóleos para uso general.	</option>
<option value="B3" class="ops">	B3 Gasóleos con tipo reducido.	</option>
<option value="B4" class="ops">	B4 Fuelóleos.	</option>
<option value="B5" class="ops">	B5 G.L.P. para uso general.	</option>
<option value="B6" class="ops">	B6 G.L.P. carburante automóviles Servicio Público.	</option>
<option value="B7" class="ops">	B7 G.L.P. usos distintos carburante.	</option>
<option value="B8" class="ops">	B8 Metano para uso general.	</option>
<option value="B9" class="ops">	B9 Metano para usos distintos carburante.	</option>
<option value="C0" class="ops">	C0 Queroseno uso general.	</option>
<option value="C1" class="ops">	C1 Queroseno usos distintos carburante.	</option>
<option value="C2" class="ops">	C2 Alquitranes de hulla.	</option>
<option value="C3" class="ops">	C3 Benzoles, toluoles, xiloles.	</option>
<option value="C4" class="ops">	C4 Aceites de creosota.	</option>
<option value="C5" class="ops">	C5 Aceites brutos de la destilación de alquitranes de hulla.	</option>
<option value="C6" class="ops">	C6 Aceites crudos condensados de gas natural para uso general.	</option>
<option value="C7" class="ops">	C7 Aceites crudos condensados de gas natural usos distintos carburantes.	</option>
<option value="C8" class="ops">	C8 Los demás aceites crudos de petróleo o de minerales bituminosos.	</option>
<option value="C9" class="ops">	C9 Gasolinas especiales, carburorreactores tipo gasolina y demás aceites ligeros.	</option>
<option value="D0" class="ops">	D0 Aceites medios distintos de los querosenos para uso general.	</option>
<option value="D1" class="ops">	D1 Aceites medios distintos de los querosenos usos distintos carburantes.	</option>
<option value="D2" class="ops">	D2 Aceites pesados y preparaciones de los códigos NC 2710.00.87 a 2710.00.98.	</option>
<option value="D3" class="ops">	D3 Hidrocarburos gaseosos del código NC 2711.29.00, excepto el metano, para uso general.	</option>
<option value="D4" class="ops">	D4 Hidrocarburos gaseosos del código NC 2711.29.00, excepto el metano, para usos distintos de carburante.	</option>
<option value="D5" class="ops">	D5 Vaselina, parafina y productos similares.	</option>
<option value="D6" class="ops">	D6 Mezclas bituminosas a base de asfalto o de betún natural, de betún de petróleo, de alquitrán mineral o de brea de alquitrán mineral.	</option>
<option value="D7" class="ops">	D7 Hidrocarburos de composición química definida.	</option>
<option value="D8" class="ops">	D8 Preparaciones de los códigos NC 3403.11.00 y 3403.19.	</option>
<option value="D9" class="ops">	D9 Preparaciones antidetonantes y aditivos del código NC 3811.	</option>
<option value="E0" class="ops">	E0 Mezclas de alquilbencenos y mezclas de alquilnaftalenos.	</option>
                 
                   </select>
            </td>
        </tr>
        <tr>
            <td>Codigo NC(12c / 17c):</td>
            <td  class="lf"><input id="codigonc" name="codigonc" type="text" placeholder="00000000" maxlength="8"></td>
        </tr>
        <tr>
            <td>Producto (12l / 17p):</td>
            <td><select id="producto" name="producto" />
            	 <option value="E200">E200 Aceites animales y vegetales</option>
            	 <option value="E300">E300 Hidrocarburos (productos energéticos)</option>
            	 <option value="E410">E410 Gasolinas con plomo</option>
            	 <option value="E420">E420 Gasolinas sin plomo</option>
            	 <option value="E430">E430 Gasóleo no marcado</option>
            	 <option value="E440">E440 Gasóleo marcado</option>
            	 <option value="E450">E450 Queroseno no marcado</option>
            	 <option value="E460">E460 Queroseno marcado</option>
            	 <option value="E470">E470 Fuelóleo pesado</option>
            	 <option value="E480">E480 Productos clasif. en mov. al por mayor</option>
            	 <option value="E490">E490 Productos no E480, salvo mov. al por mayor</option>
            	 <option value="E500">E500 Gases de petróleo licuados y hidrocarburos</option>
            	 <option value="E600">E600 Hidrocarburos acíclicos saturados</option>
            	 <option value="E700">E700 Hidrocarburos cíclicos</option>
            	 <option value="E800">E800 Alcohol metílico sin origen sintético</option>
            	 <option value="E910">E910 Ésteres monoalquílicos de ácidos grasos</option>
            	 <option value="E920">E920 Productos para combustible, no E910</option>
                   </select>
            
            </td>
          </tr>
  		 
        <tr>
            <td>Fecha entrada:</td>
            <td><input type="text" id="fecha_entrada" name="fecha_entrada"/></td>
          </tr>
          <tr>
            <td>Cae Proveedor (1c / 2a):</td>
            <td><input type="text" id="caeprovee" name="caeprovee" type="text" maxlength="13"/></td>
          </tr>
         <tr>
            <td>Litros 15ºC (12d / 17d)):</td>
            <td class="lf"> <input id="litros15c" name="litros15c" type="text" maxlength="10" ></td>
        </tr>    

<!--
        <tr>
            <td>Fecha expedicion (2f):</td>
            <td><input type="text" id="fecha_salida" name="fecha_salida"/></td>
          </tr>
         <tr>
            <td>Clase documento:</td>
            <td  class="lf"><select id="documento" name="documento">
                        	 <option value=0>Selecciona documento</option>
                        	 <option value="ALB">ALB</option>
                        	 <option value="EADE">EADE</option>
                 
                   </select>
</td>
        </tr>
         <tr>
            <td>Numero Dispo:</td>
            <td  class="lf"><input id="num_dispo" name="num_dispo" type="text" placeholder="0000000000" maxlength="10"></td>
        </tr>
        <tr>
            <td>NIF Destinatario (4b):</td>
            <td  class="lf"><input id="nif_destino" name="nif_destino" type="text"></td>
        </tr>
        <tr>
            <td>Nombre destinatario (4c):</td>
            <td  class="lf"><input id="nom_destino" name="nom_destino" type="text" maxlength="25"></td>
        </tr>
        <tr>
            <td>Regimen Fiscal (2c):</td>
            <td><select id="regimen" name="regimen">
                <option value=0>Selecciona Regimen Fiscal</option>
                <option value="A">A</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="R">R</option>
                <option value="S">S</option>
               </select></td>
        </tr>
        -->    
        <tr>
        	<td>Archivo adjunto: </td>
            <td><input id="adjuntent" name="adjuntent" size="20" type="file"></td>
        </tr>
          <tr>
            <td colspan="2" align="center">
    
            <input type="hidden" id="useract" name="useract" value="<?php echo $useract ?>"/>
          	<input value="Guardar" type="button" id="enviarentra" name="enviarentra" class="boton" onClick="confirmaiiee()">
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
