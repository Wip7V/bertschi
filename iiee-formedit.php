<?php 
require_once('xajax_core/xajax.inc.php');
include("config.php");
include("conexion.php");

$xajax = new xajax();
$xajax->register(XAJAX_FUNCTION, 'Consulta');
$xajax->register(XAJAX_FUNCTION, 'Guardar');
//$xajax->register(XAJAX_FUNCTION, 'ReloadSelectFitxers');
//$xajax->register(XAJAX_FUNCTION, 'delFitxer');


function Consulta($id)
{
	ob_start(); //per a retornar un string amb tots els errors
	$respuesta = new xajaxResponse();

	
	if($id != 0)
	{
		$sql = "SELECT * FROM ctiiee WHERE id_iiee='$id'";
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


function Guardar($formulari)
{
	ob_start(); //per a retornar un string amb tots els errors
	$respuesta = new xajaxResponse();
	$sql="DELETE FROM ctiiee WHERE id_iiee=0; ";
	
	//var_dump($formulari);
	foreach($formulari as $n => $v) $$n = mysql_real_escape_string($v); //crea variables pel nom del camp i asigna el seu contingut;
	
	
	if($id_iiee==0){
	$sql="INSERT INTO ctiiee(id_contenedor,ncontenedor,fecha_entrada,epifiscal,codigonc,producto,caeprovee,arc,litros15c,fecha_salida,documento,num_dispo,nif_destino,nom_destino,regimen,recibido,adjuntent,adjuntsal) VALUES ('$contid','$ncont','$fecha_entrada','$epifiscal','$codigonc','$producto','$caeprovee','$arc','$litros15c','$fecha_salida','$documento','$num_dispo','$nif_destino','$nom_destino','$regimen','$recibido','$adjuntent','$adjuntsal');";	
	mysql_query($sql) or print("error insert: ".mysql_error() );
	}
	else {
		$sql = "UPDATE ctiiee SET id_contenedor='$id_contenedor', ncontenedor='$ncontenedor', fecha_entrada='$fecha_entrada', epifiscal='$epifiscal', codigonc='$codigonc', producto='$producto', caeprovee='$caeprovee', arc='$arc', litros15c='$litros15c', fecha_salida='$fecha_salida', documento='$documento', num_dispo='$num_dispo', nif_destino='$nif_destino', nom_destino='$nom_destino', regimen='$regimen', recibido='$recibido', adjuntent='$adjuntent', adjuntsal='$adjuntsal' WHERE id_iiee = $id_iiee;";
		
	mysql_query($sql) or print("error insert: ".mysql_error() );
//	mysql_query($sqlreg) or print("error insert: ".mysql_error() );

	}
	
	//echo $sql;
	
	$error=ob_get_clean(); //tot el texte dels echo y dels errors de php
	if(strlen($error)==0) $respuesta->Script("document.location = 'iiee-edit.php';");
	//$respuesta->Assign("sortir","value",1); //de que tot ha funcionat



	$phperror ="<pre>".$error."</pre>";
	$respuesta->Assign("error_php","innerHTML",$phperror);
	
	return $respuesta;
	
}

$xajax->processRequest();

if(isset($_GET['id_iiee'])) $id_iiee=$_GET['id_iiee'];
elseif(isset($_POST['id_iiee'])) $id_iiee=$_POST['id_iiee'];
else $id_iiee=0;

$error_img=isset($_GET['error'])?$_GET['error']:0;

$sql = "SELECT * FROM ctiiee WHERE id_iiee='$id_iiee'";
$result=mysql_query($sql) or print("error: ".mysql_error() );
$linia=mysql_fetch_array($result) or print("error insert: ".mysql_error() );
$fe=$linia['fecha_entrada'];
$fs=$linia['fecha_salida'];
//$dua=$linia['data_dua'];
//$adu=$linia['aduana'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<?php 
	include("cabecera.inc");
	$xajax->printJavascript("");
?>

<script> 
		$(function () {
			$.datepicker.setDefaults($.datepicker.regional["es"]);
			$("#fecha_entrada").datepicker({firstDay: 1 });
			$( "#fecha_entrada" ).datepicker( "option", "dateFormat", "yy/mm/dd" );
			$("#fecha_salida").datepicker({firstDay: 1 });
			$( "#fecha_salida" ).datepicker( "option", "dateFormat", "yy/mm/dd" );
			
		});
          
$(document).ready(function(e) {
    

	xajax_Consulta(<?php echo $id_iiee; ?>);
	//$('#data').datepicker();
	//$("#data").datepicker( "option", "dateFormat",'yy-mm-dd');
	//$("#browser").treeview();
		
});


function pone(valor)
{
	valor=valor.replace('//','/');
	$('#turl').val(valor);
}

function veure()
{
	window.open($('#turl').val(),'Fitxer');
}
</script>

</head>
<body >

    <div id="principal">
        <div class="titulo">EDICION DE IIEE</div>
        <div class="separador"></div>
        <div class="botonessup"><a href="iiee-edit.php" class="boton">Volver a gestion de IIEE</a></div>
        <div class="separador"></div>
        <div class="formulario">

        	    <form id="formulari" enctype="multipart/form-data" method="post" >
                    <input type="hidden" id="control_error" value="0" />
                    <input type="hidden" id="id_iiee" name="id_iiee" value="<?php echo $id_iiee; ?>"/>
                    <input type="hidden" id="id_contenedor" name="id_contenedor" value="<?php echo $id_contenedor; ?>"/>
                    <input type="hidden" id="sortir" />
 				<table class="tabla" >
                <tr>
                    <td>Id_iiee</td>
                    <td><input type="text" style="width:110px" id="id_iiee" name="id_iiee" value="<?php echo $id_iiee; ?>" readonly="true" /></td>
                </tr>
 				<tr>
                    <td>Numero contenedor:</td>
                    <td><input type="text" id="ncontenedor" name="ncontenedor" value="<?php echo $ncontenedor; ?>"/></td>
                </tr>
        <tr>
            <td>Fecha de Entrada:</td>
            <td><input type="text" id="fecha_entrada" name="fecha_entrada" value="<?php echo $fecha_entrada; ?>" /></td>
          </tr>
                <tr>
                    <td>Epigrafe fiscal:</td>
                    <td><select id="epifiscal" name="epifiscal"  style="width: 500px" value="<?php echo $epifiscal; ?>">
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
                    <td>codigo NC:</td>
                    <td><input type="text" id="codigonc" name="codigonc" value="<?php echo $codigonc; ?>" maxlength="8"/></td>
                </tr>
        <tr>
            <td>Producto (12l / 17p):</td>
            <td><select id="producto" name="producto" value="<?php echo $producto; ?>"/>
            	 <option value=0>Selecciona producto</option>
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
            <td>CAE Proveedor:</td>
            <td><input type="text" id="caeprovee" name="caeprovee" value="<?php echo $caeprovee; ?>" maxlength="13"/></td>
          </tr>
        <tr>
        <tr>   
            <td>ARC:</td>
            <td><input id="arc" name="arc" type="text" value="<?php echo $arc; ?>" maxlength="22"></td>
        </tr>    
        <tr>   
            <td>Litros 15ºC:</td>
            <td><input id="litros15c" name="litros15c" type="text" value="<?php echo $litros15c; ?>"></td>
        </tr>    
            <td>Fecha de salida:</td>
            <td><input type="text" id="fecha_salida" name="fecha_salida" value="<?php echo $fs; ?>"/></td>
          </tr>
           <tr>
            <td>Documento:</td>
            <td><select id="documento" name="documento" value="<?php echo $documento; ?>">
                <option value=0>Selecciona tipo de documento</option>
                <option value="ALB">ALB</option>
                <option value="EADE">EADE</option>
                <option value="otros">OTROS</option>
                </select></td>
        </tr> 
         <tr>
            <td>Numero dispo:</td>
            <td  class="lf"><input id="num_dispo" name="num_dispo" type="text" value="<?php echo $num_dispo; ?>"></td>
        </tr>
         <tr>
            <td>NIF destinatario:</td>
            <td  class="lf"><input id="nif_destino" name="nif_destino" type="text" value="<?php echo $nif_destino; ?>"></td>
        </tr>
         <tr>
            <td>Nombre destinatario:</td>
            <td  class="lf"><input id="nom_destino" name="nom_destino" type="text" value="<?php echo $nom_destino; ?>"></td>
        </tr>
        <tr>
            <td>Regimen Fiscal (2c):</td>
            <td><select id="regimen" name="regimen" value="<?php echo $regimen; ?>" style="width: 500px">
                <option value=0>Selecciona Regimen Fiscal</option>
                <option value="A" class="ops">A Avituallamientos exentos a buques y aeronaves que se documentan con e-DA </option>
                <option value="D" class="ops">D Envíos de productos al amparo de supuestos de exención por entregas en el marco de las relaciones internacionales.</option>
                <option value="E" class="ops">E Envíos de productos al amparo de supuestos de exención distintos de los señalados en las letras A y D.</option>
                <option value="F" class="ops">F Salida de productos a tipo reducido con destino a consumidores finales.</option>
                <option value="R" class="ops">R Salida de productos a tipo reducido con destino a almacenes fiscales o a detallistas inscritos.</option>
                <option value="S" class="ops">S Productos que se expiden en régimen suspensivo.</option>
               </select></td>
        </tr>    
         <tr>
            <td>Recidido:</td>
            <td  class="lf"><select id="recidido" name="recidido"value="<?php echo $recidido; ?>">
                        	 <option value=0>Selecciona una opcion</option>
                        	 <option value="SI">SI</option>
                        	 <option value="NO">NO</option>
                 
                   </select>
			 </td>
        </tr>    
        <tr>
        	<td>Archivo adjunto: </td>
            <td><input id="adjuntent" name="adjuntent" size="20" type="text" value="<?php echo $adjuntent; ?>"></td>
        </tr>
        <tr>
        	<td>Archivo adjunto: </td>
            <td><input id="adjuntsal" name="adjuntsal" size="20" type="text" value="<?php echo $adjuntsal; ?>"></td>
        </tr>
 				<tr>
                    <td colspan="2" align="center"><input type="button" class="boton" value="Guardar" onclick="xajax_Guardar(xajax.getFormValues('formulari'));"/>
                <input type="hidden" id="tot_be" value=0 /></td>
                </tr>
              </table>
            </form>
           
 </div>
       	<div id="error_php"></div>
        <div class="separador"></div>
        <div id="salir"><?php include("binicio.inc"); ?></div>

   
        
        </div>
        
    </body>
</html>