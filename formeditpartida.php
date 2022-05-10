<?php 
require_once('xajax_core/xajax.inc.php');
include("config.php");
include("conexion.php");

/*
$xajax = new xajax();
$xajax->register(XAJAX_FUNCTION, 'Consulta');
$xajax->register(XAJAX_FUNCTION, 'Guardar');


function Consulta($id)
{
	ob_start(); //per a retornar un string amb tots els errors
	$respuesta = new xajaxResponse();

	
	if($id != 0)
	{
		$sql = "SELECT * FROM ctpartida WHERE id='$id'";
		//echo $sql;
		$result=mysql_query($sql) or print("error: ".mysql_error() );
		$linia=mysql_fetch_array($result);
		foreach($linia as $nom => $valor) $respuesta->Assign($nom,"value",$valor); //asigna a tots els camps el seu valor a bd.
	}
	
	//posem els errors a una capa
	$phperror ="<pre>".ob_get_clean()."</pre>";
	$respuesta->Assign("error_php","innerHTML",mysql_real_escape_string ($phperror)); //posem els errors a una capa;
	
	return $respuesta;
}


function Guardar($formulari)
{
	ob_start(); //per a retornar un string amb tots els errors
	$respuesta = new xajaxResponse();
	$sql="DELETE FROM ctdua WHERE id_dua=0; ";
	
	//var_dump($formulari);
	foreach($formulari as $n => $v) $$n = mysql_real_escape_string($v); //crea variables pel nom del camp i asigna el seu contingut;
	
	
		
				$sql = "UPDATE ctpartida SET des_mercaderia='$des_mercaderia', codi_taric='$codi_taric', regim_aduaner='$regim_aduaner', peso='$peso', valor_esta='$valor_esta' , referencia='$referencia', coste='".str_replace(",",".",$coste)."', manipulaciones='$manipulaciones', granel='$granel', bultos=$bultos WHERE id = $id;";
		
//		$sqlcod = "SELECT * FROM ctdua WHERE id_dua='$id_dua'";
//		$result=mysql_query($sqlcod) or print("error: ".mysql_error() );
//		$linia=mysql_fetch_array($result) or print("error insert: ".mysql_error() );
//		$cont=$linia['codigo'];
		
//		$sqlreg = "UPDATE ctregistro SET estado='$estado', subestado='$subestado', sector='$sector', fecha_entrada='$fecha_entrada', carril='$carril', posicio='$posicio', pis='$pis', adjunt='$adjunt', aduana='$aduana', tipo_aduana='$tipo_aduana', tipo_declaracio='$tipo_declaracio', num_formulari='$num_formulari', partida_ordre='$partida_ordre', contenedores='$contenedores', des_mecaderia='$des_mecaderia', codi_taric='$codi_taric', regim_aduaner='$regim_aduaner', pes='$pes', data_dua='$data_dua' WHERE contenedor = '$cont';";
		
		
	mysql_query($sql) or print("error insert: ".mysql_error() );
//	mysql_query($sqlreg) or print("error insert: ".mysql_error() );

	
	
	//echo $sql;
	
	$error=ob_get_clean(); //tot el texte dels echo y dels errors de php
	if(strlen($error)==0) $respuesta->Script("document.location = 'editdua.php';");
	//$respuesta->Assign("sortir","value",1); //de que tot ha funcionat



	$phperror ="<pre>".$error."</pre>";
	$respuesta->Assign("error_php","innerHTML",$phperror);
	
	return $respuesta;
	
}

$xajax->processRequest();*/

if(isset($_GET['id'])) $id_dua=$_GET['id'];
elseif(isset($_POST['id'])) $id_dua=$_POST['id'];
else $id_dua=0;

$error_img=isset($_GET['error'])?$_GET['error']:0;

/*$sql = "SELECT * FROM ctdua WHERE id_dua='$id_dua'";
$result=mysql_query($sql) or print("error: ".mysql_error() );
$linia=mysql_fetch_array($result) or print("error insert: ".mysql_error() );*/
//$fe=$linia['fecha_dua'];
//$fs=$linia['fecha_salida'];
//$nde=$linia['ndua_entrada'];
//$nds=$linia['ndua_salida'];
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
	//$xajax->printJavascript("");
?>

<script> 

          
$(document).ready(function(e) {
    

	//xajax_Consulta(<?php echo $id_dua; ?>);
	//console.log("prueba <?php echo $id_dua; ?>");
	$.post( "main.php",{ funcion: "ver_partida", id: <?php echo $id_dua; ?>}, function(data) { setTimeout(data,0);});
	//$('#data').datepicker();
	//$("#data").datepicker( "option", "dateFormat",'yy-mm-dd');
	//$("#browser").treeview();
			
			$.datepicker.setDefaults($.datepicker.regional["es"]);
			$("#fecha").datepicker({firstDay: 1 });
			$("#fecha").datepicker( "option", "dateFormat", "yy-mm-dd" );
			$("#fecha_prevista").datepicker({firstDay: 1 });
			$("#fecha_prevista").datepicker( "option", "dateFormat", "yy-mm-dd" );
			
		
});

function guardar(obj){
	//console.log($("#formulari").serialize());
	$.post( "main.php", $("#formulari").serialize()+"&funcion=Guardar_partida", function(data) { setTimeout(data,0);});
}

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
        <div class="titulo">GESTION DE PARTIDA</div>
        <div class="separador"></div>
        <div class="botonessup"><a href="registro-dua.php" class="boton">Volver a Registro DUA</a></div>
        <div class="separador"></div>
        <div class="formulario">

        	    <form id="formulari" enctype="multipart/form-data" method="post" >
                    <input type="hidden" id="control_error" value="0" />
                    
                    <input type="hidden"  value="" id="id" name="id" />
                    
                    <input type="hidden" id="sortir" />
 				<table class="tabla" >

        <tr>
            <td>Partida:</td>
            <td  class="lf"><input id="partida" name="partida" type="text" value="0"></td>
        </tr>
        
         <tr>
            <td>Codigo TARIC:</td>
            <td  class="lf"><input id="codi_taric" name="codi_taric" type="text" placeholder="0000000000" maxlength="10"></td>
        </tr>
         <tr>
            <td>Regimen aduanero:</td>
            <td  class="lf"><input id="regim_aduaner" name="regim_aduaner" type="text" placeholder="0000" maxlength="4"></td>
        </tr>
        <tr>
            <td>Descripcion de mercancia:</td>
            <td  class="lf"><input id="des_mercaderia" name="des_mercaderia" type="text" maxlength="25"></td>
        </tr>

     	<tr>
            <td>Valor estadistico:</td>
            <td  class="lf"><input id="valor_esta" name="valor_esta" type="text"></td>
        </tr>
        
                <tr>
            <td>Nº REFERENCIA</td>
            <td  class="lf"><input id="referencia" name="referencia" type="text"></td>
        </tr> 
        
       
        
        <tr>
            <td>Coste Almacenamiento o<br> Manipulaciones Usuales:</td>
            <td  class="lf"><input id="coste" name="coste" type="text">€</td>
        </tr>

        <tr>
            <td>Manipulaciones Usuales:</td>
            <td  class="lf"><input id="manipulaciones" name="manipulaciones" type="text"></td>
        </tr>
        
        <tr>
        <td>Granel:</td>
                        <td  class="lf">
            <select id="granel" name="granel">
            	<option>NO</option>
            	<option>SI</option>
            	
            </select></td>
        </tr>
        
        <tr>
            <td>Bultos:</td>
            <td  class="lf"><input id="bultos" name="bultos" type="text" value="0"></td>
        </tr>
          
     	<tr>
            <td>Peso:</td>
            <td  class="lf"><input id="peso" name="peso" type="text"></td>
        </tr>
        
        
 				<tr>
                    <td colspan="2" align="center"><input type="button" class="boton" value="Guardar" onclick="guardar()"/>
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