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
		$sql = "SELECT * FROM ctexport WHERE id_export='$id'";
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
	//$sql="DELETE FROM ctexport WHERE id_export=0; ";
	
	//var_dump($formulari);
	foreach($formulari as $n => $v) $$n = mysql_real_escape_string($v); //crea variables pel nom del camp i asigna el seu contingut;
	

		$sql = "UPDATE ctexport SET entrada_contenedor = '$entrada_contenedor', certif_export = '$certif_export', ncontenedor='$ncontenedor', dua_salida = '$dua_salida', fecha_dn='$fecha_dn', fecha_export='$fecha_export' WHERE id_export = $id_export;";
		
	mysql_query($sql) or print("error insert: ".mysql_error() );
	echo $sql;

	
	
	$error=ob_get_clean(); //tot el texte dels echo y dels errors de php
	
	
	
	if(strlen($error)==0) $respuesta->Script("document.location = 'editexpo.php';");
	//$respuesta->Assign("sortir","value",1); //de que tot ha funcionat
$respuesta->Script("alert('Datos guardados');");
	$phperror ="<pre>".$error."</pre>";
	$respuesta->Assign("error_php","innerHTML",$phperror);
	
	return $respuesta;
}

$xajax->processRequest();

if(isset($_GET['id_export'])) $id_export=$_GET['id_export'];
elseif(isset($_POST['id_export'])) $id_export=$_POST['id_export'];
else $id_export=0;

$error_img=isset($_GET['error'])?$_GET['error']:0;

$sql = "SELECT * FROM ctexport WHERE id_export='$id_export'";
$result=mysql_query($sql) or print("error: ".mysql_error() );
$linia=mysql_fetch_array($result) or print("error insert: ".mysql_error() );

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
			$("#fecha_export").datepicker({firstDay: 1 });
			//$( "#fecha_export" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
			$("#fecha_dn").datepicker({firstDay: 1 });
			//$( "#fecha_salida" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
		});
           

$(document).ready(function(e) {
    

	//xajax_Consulta(<?php echo $id_export; ?>);
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

function imprimir(){
	var myWindow = window.open("", "MsgWindow", "width=600,height=400");
myWindow.document.write(document.querySelector('.formulario').innerHTML);
    myWindow.document.close(); //missing code


    myWindow.focus();
    myWindow.print(); 

}
</script>

</head>
<body >

    <div id="principal">
        <div class="titulo">GESTION DE LAME</div>
        <div class="separador"></div>
        <div class="botonessup"  ><a href="editexpo.php" class="boton">Volver a gestion de Lame</a></div>
        <div class="separador"></div>
        <div class="formulario">

        	    <form id="formulari" enctype="multipart/form-data" method="post" >
                    <input type="hidden" id="control_error" value="0" />
                    <input type="hidden" id="sortir" />
 				<table class="tabla" >
                <tr>
                    <td>Id_export</td>
                    <td><input type="text" style="width:110px" id="id_export" name="id_export" value="<?php echo $id_export; ?>" readonly="TRUE" /></td>
                </tr>
                
        <tr>
            <td>Dispo Shipment:</td>
            <td><input type="text" id="entrada_contenedor" name="entrada_contenedor" value="<?php echo $linia['entrada_contenedor']; ?>" /></td>
          </tr>
        <tr>
        
                <tr>
            <td>Certificado Exportación (DN):</td>
            <td><input type="text" id="certif_export" name="certif_export" value="<?php echo $linia['certif_export']; ?>" /></td>
          </tr>
        <tr>
 				<tr>
                    <td>Contenedor:</td>
                    <td><input type="text" id="ncontenedor" name="ncontenedor" value="<?php echo $linia['ncontenedor']; ?>"  /></td>
<!--                    <td><select id="ncontenedor" name="ncontenedor">
                            <option value=0>Selecciona contenedor</option>
							   <?php muestra_contenedor("");	?>	
                        </select></td>
-->                </tr>


        
                <tr>
            <td>DUA Salida:</td>
            <td><input type="text" id="dua_salida" name="dua_salida" value="<?php echo $linia['dua_salida']; ?>" /></td>
          </tr>
        <tr>
        <tr>
            <td>Fecha de DN:</td>
            <td><input type="text" id="fecha_dn" name="fecha_dn" value="<?php echo $linia['fecha_dn']; ?>" /></td>
          </tr>
        <tr>
            <td>Fecha de export:</td>
            <td><input type="text" id="fecha_export" name="fecha_export" value="<?php echo $linia['fecha_export']; ?>"/></td>
          </tr>
   
  
 				<tr>
                    <td colspan="2" align="center">
                    
                <input type="hidden" id="tot_be" value=0 /></td>
                </tr>
              </table>
            </form>
 </div>
                     <div style="margin: 0 auto;     width: 600px; text-align: center;">
                    <input type="button" class="boton" value="Guardar" onclick="xajax_Guardar(xajax.getFormValues('formulari'));"/>
                    <input type="button" class="boton" value="Imprimir" onclick="imprimir()" />           
                    </div><br><br>
       	<div id="error_php"></div>
        <div class="separador"></div>
        <div id="salir"><?php include("binicio.inc"); ?></div>

   
        
        </div>
        
    </body>
</html>