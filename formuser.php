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
		$sql = "SELECT * FROM ctuser WHERE id='$id'";
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
	$sql="DELETE FROM ctuser WHERE id=0; ";
	
	//var_dump($formulari);
	foreach($formulari as $n => $v) $$n = mysql_real_escape_string($v); //crea variables pel nom del camp i asigna el seu contingut;
	
	
	if($id==0)
	$sql="INSERT INTO ctuser (nombre,pws,privilegios) VALUES ('$nombre','$pws','$privilegios');";
	else $sql = "UPDATE ctuser SET nombre='$nombre', pws='$pws', privilegios='$privilegios' WHERE id = $id;";
	
	mysql_query($sql) or print("error insert: ".mysql_error() );
	
	//echo $sql;
	
	$error=ob_get_clean(); //tot el texte dels echo y dels errors de php
	if(strlen($error)==0) $respuesta->Script("document.location = 'gestuser.php';");
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>

    <link href="estilo.css" rel="stylesheet" type="text/css" />
    <script src="js/javas.js" type="text/javascript"></script>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<!-- link rel="stylesheet" href="tree/jquery.treeview.css" /-->
<!-- script src="tree/jquery.treeview.js" type="text/javascript"></script -->

<?php $xajax->printJavascript("");?>

<script>

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
        <div class="titulo">GESTION DE USUARIOS</div>
        <div class="separador"></div>
        <div class="formulario">
            <div class="botonessup"><a href="gestuser.php" class="boton">Volver a gestion de usuarios</a></div>
        	    <form id="formulari" enctype="multipart/form-data" method="post" >
                    <input type="hidden" id="control_error" value="0" />
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                    <input type="hidden" id="sortir" />
 				<table class="tabla" >
                <tr>
                    <td>ID</td>
                    <td><input type="text" style="width:110px" placeholder="<?php echo $id; ?>" disabled="disabled" /></td>
                </tr>
 				<tr>
                    <td>Nombre:</td>
                    <td><input type="text" id="nombre" name="nombre" /></td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td><input type="text" id="pws" name="pws" /></td>
                </tr>
                <tr>
                    <td>Privilegios:</td>
                    <td><select id="privilegios" name="privilegios" >
                <option value=0 selected="selected">Registrado</option>
                <option value=1>Administrador</option>
                <option value=2>Observador</option></select></td></td>
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