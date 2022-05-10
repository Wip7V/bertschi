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
		$sql = "SELECT * FROM ctregistro WHERE id='$id'";
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
	$sql="DELETE FROM ctregistro WHERE id=0; ";
	
	//var_dump($formulari);
	foreach($formulari as $n => $v) $$n = mysql_real_escape_string($v); //crea variables pel nom del camp i asigna el seu contingut;
	
	

$sql = "UPDATE ctregistro SET estado='$estado', subestado='$subestado', sector='$sector', fecha_entrada='$fecha_entrada', user_entrada='$user_entrada', fecha_salida='$fecha_salida', user_salida='$user_salida', carril='$carril', posicio='$posicio', pis='$pis', adjunt='$adjunt', aduana='$aduana',  tipo_declaracio='$tipo_declaracio', num_formulari='$num_formulari', contenedores='$contenedores', des_mecaderia='$des_mecaderia', codi_taric='$codi_taric', regim_aduaner='$regim_aduaner', pes='$pes', iiee_id='$iiee_id' WHERE id = $id;";
	
	mysql_query($sql) or print("error insert: ".mysql_error() );
	
	//echo $sql;
	
	$error=ob_get_clean(); //tot el texte dels echo y dels errors de php
	if(strlen($error)==0) $respuesta->Script("document.location = 'registro.php';");
	//$respuesta->Assign("sortir","value",1); //de que tot ha funcionat



	$phperror ="<pre>".$error."</pre>";
	$respuesta->Assign("error_php","innerHTML",$phperror);
	
	return $respuesta;
	
}

$xajax->processRequest();


if(isset($_GET['id'])) $id=$_GET['id'];
elseif(isset($_POST['id'])) $id=$_POST['id'];
else $id=0;

$error_img=isset($_GET['error'])?$_GET['error']:0;

/*$sql = "SELECT * FROM ctregistro WHERE id='$id'";
$result=mysql_query($sql) or print("error: ".mysql_error() );
$linia=mysql_fetch_array($result) or print("error insert: ".mysql_error() );
$fe=$linia['fecha_entrada'];
$dua=$linia['data_dua'];
$adu=$linia['aduana'];
$fs=$linia['fecha_salida'];*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<?php 
	include("cabecera.inc");
	$xajax->printJavascript("");?>

<script>
		$(function () {
			$.datepicker.setDefaults($.datepicker.regional["es"]);
			$("#fecha_entrada").datepicker({firstDay: 1 });
			$( "#fecha_entrada" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			$("#data_dua").datepicker({firstDay: 1 });
			$( "#data_dua" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			$("#fecha_salida").datepicker({firstDay: 1 });
			$( "#fecha_salida" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		});


$(document).ready(function(e) {
    

	xajax_Consulta(<?php echo $id; ?>);
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
        <div class="titulo">GESTION DE REGISTRO</div>
        <div class="separador"></div>
        <div class="formulario">
            <div class="botonessup"><a href="registro.php" class="boton">Volver a gestion de Registro</a></div>
        	    <form id="formulari" enctype="multipart/form-data" method="post" >
                    <input type="hidden" id="control_error" value="0" />

                    <input type="hidden" id="sortir" />
 				<table class="tabla" >
                <tr>
                    <td>ID</td>
                    <td><input type="text" style="width:110px" id="id" name="id" placeholder=""  /></td>
                </tr>
 				<tr>
                    <td>Contenedor:</td>
                    <td><input type="text" id="contenedor" name="contenedor"  /></td>
                </tr>
                <tr>
                    <td>estado:</td>
                    <td><select id="estado" name="estado">
                <option value="cargado">Cargado</option>
                <option value="vacio">vacio</option></select></td>
                </tr>
        <tr>
            <td>Subestado:</td>
            <td><select id="subestado" name="subestado" >
                <option value=0>-------</option>
                <option value="limpio">Limpio</option>
                <option value="sucio">Sucio</option></select></td>
        </tr>
        <tr>
            <td>Sector:</td>
            <td><select id="sector" name="sector" >
                 <?php 
		$sql="SELECT * FROM ctsector ORDER BY id";
		$result=mysql_query($sql) or die("error: ".mysql_error() );
		while($dades=mysql_fetch_array($result))
		{
			echo "<option value='".$dades['numero']."'>".$dades['numero']."</opcion> ";
		}
		?>	
               </select></td>
        </tr>
        <tr>
            <td>Carril:</td>
            <td><select id="carril" name="carril" >
                 <?php 
		$sql="SELECT * FROM ctcarril ORDER BY id";
		$result=mysql_query($sql) or die("error: ".mysql_error() );
		while($dades=mysql_fetch_array($result))
		{
			echo "<option value='".$dades['num']."'>".$dades['num']."</opcion> ";
		}
		?>	
               </select></td>
        </tr>
        <tr>
            <td>Posición:</td>
            <td><select id="posicio" name="posicio" >
                 <?php 
		$sql="SELECT * FROM ctposicion ORDER BY id";
		$result=mysql_query($sql) or die("error: ".mysql_error() );
		while($dades=mysql_fetch_array($result))
		{
			echo "<option value='".$dades['num']."'>".$dades['num']."</opcion> ";
		}
		?>	
               </select></td>
        </tr>
        <tr>
            <td>Piso:</td>
            <td><select id="pis" name="pis" >
                 <?php 
		$sql="SELECT * FROM ctpiso ORDER BY id";
		$result=mysql_query($sql) or die("error: ".mysql_error() );
		while($dades=mysql_fetch_array($result))
		{
			echo "<option value='".$dades['num']."'>".$dades['num']."</opcion> ";
		}
		?>	
               </select></td>
        </tr>
 				<tr>
                    <td>adjunt:</td>
                    <td><input type="text" id="adjunt" name="adjunt" /></td>
                </tr>
        <tr>
            <td>
                <!-- si estado = vacio visible subestado-->
                Aduana:</td>
            <td><select id="aduana" name="aduana" >
                <option value=0>NO</option>
                <option value=1>SI</option>
                <option value=2>IIEE</option></select></td>
        </tr>
        
                <tr>
            <td>DUA de Entrada:</td>
            <td><select id="duae" name="duae" >
            <option value="0"></option>
            <?php
            $sql="SELECT * FROM ctdua WHERE entrada_salida = 'en'";
            $result=mysql_query($sql) or print("error: ".mysql_error() );
			while($linia=mysql_fetch_array($result))
			{				
				echo "<option value='".$linia['id_dua']."'>".$linia['numero']."</option>";
            }
                ?>
                </select>
                </td>
        </tr>
         <tr>
            <td>DUA de Salida:</td>
            <td><select id="duas" name="duas" >
            <option value="0"></option>
            <?php
            $sql="SELECT * FROM ctdua WHERE entrada_salida = 'sa'";
            $result=mysql_query($sql) or print("error: ".mysql_error() );
			while($linia=mysql_fetch_array($result))
			{				
				echo "<option value='".$linia['id_dua']."'>".$linia['numero']."</option>";
            }
                ?>
                </select>
                </td>
        </tr> 
        <tr>
            <td>
                <!-- si estado = vacio visible subestado-->
                Tipo declaración:</td>
            <td><select id="tipo_declaracio" name="tipo_declaracio" >
                <option value="IM">IM</option>
                <option value="COM">COM</option></select></td>
        </tr>
        <tr>
            <td>Numero de fomularios:</td>
            <td  class="lf"><input id="num_formulari" name="num_formulari" placeholder="000" size="3" type="text" maxlength="3"></td>
        </tr>
        <tr>
            <td>Contenedores:</td>
            <td><select id="contenedores" name="contenedores" >
                <option value=0>0</option>
                <option value=1>1</option></select></td>
        </tr>
 				<tr>
                    <td>descripcion mercaderia:</td>
                    <td><input type="text" id="des_mecaderia" name="des_mecaderia" /></td>
                </tr>
 				<tr>
                    <td>codigo taric:</td>
                    <td><input type="text" id="codi_taric" name="codi_taric" /></td>
                </tr>
 				<tr>
                    <td>Regimen aduanero:</td>
                    <td><input type="text" id="regim_aduaner" name="regim_aduaner" /></td>
                </tr>
 				<tr>
                    <td>peso:</td>
                    <td><input type="text" id="pes" name="pes" /></td>
                </tr>
 				<tr>
                    <td>DUA ID:</td>
            <td><input type="text" id="dua_id" name="dua_id" /></td>
                </tr>
 				<tr>
                    <td>IIEE ID:</td>
            <td><input type="text" id="iiee_id" name="iiee_id" /></td>
                </tr>
        <tr>
            <td>Fecha de entrada:</td>
            <td><input type="text" id="fecha_entrada" name="fecha_entrada" value="<?php echo $fe; ?>"/></td>
          </tr>
 				<tr>
                    <td>User entrada:</td>
                    <td><input type="text" id="user_entrada" name="user_entrada" /></td>
                </tr>
 				<tr>
                    <td>fecha salida:</td>
                    <td><input type="text" id="fecha_salida" name="fecha_salida" value="<?php echo $fs; ?>" /></td>
                </tr>
 				<tr>
                    <td>User salida:</td>
                    <td><input type="text" id="user_salida" name="user_salida" /></td>
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