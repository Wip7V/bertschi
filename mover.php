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


function Guardar($formulari)
{
	ob_start(); //per a retornar un string amb tots els errors
	$respuesta = new xajaxResponse();
	$sql="DELETE FROM ctcontenedor WHERE id=0; ";
	
	//var_dump($formulari);
	foreach($formulari as $n => $v) $$n = mysql_real_escape_string($v); //crea variables pel nom del camp i asigna el seu contingut;
	
	
	if($id==0){ $respuesta->Script("document.location = 'mover.php'; alert('Tiene que seleccionar un contenedor');");
		}
	else {
		$espacio = "SELECT * FROM ctcontenedor WHERE sector='$sector' AND carril='$carril' AND posicio='$posicio' AND pis='$pis'";
		
		$resultado = mysql_query($espacio);
		$filas = mysql_num_rows($resultado);
	$filas=FALSE;	
		if ($filas==FALSE){

			$sql = "UPDATE ctcontenedor SET estado='$estado', subestado='$subestado', sector='$sector', carril='$carril', posicio='$posicio', pis='$pis' WHERE id = $id;";
			$sqlreg = "UPDATE ctregistro SET estado='$estado', subestado='$subestado', sector='$sector', carril='$carril', posicio='$posicio', pis='$pis' WHERE id_contenedor = '$id';";
				
				
			mysql_query($sql) or print("error insert: ".mysql_error() );
			mysql_query($sqlreg) or print("error insert: ".mysql_error() );
		}else{
			
			$respuesta->Script("alert('Posicion para el contenedor ocupada'); document.location = 'mover.php?codigo=$codigo';");
			return $respuesta;
		}

	}
	
	//echo $sql;
	
	$error=ob_get_clean(); //tot el texte dels echo y dels errors de php
	if(strlen($error)==0) $respuesta->Script("alert('Datos guardados'); document.location = 'mover.php?codigo=0';");
	//$respuesta->Assign("sortir","value",1); //de que tot ha funcionat



	$phperror ="<pre>".$error."</pre>";
	$respuesta->Assign("error_php","innerHTML",$phperror);
	
	return $respuesta;
	
}

$xajax->processRequest();

if(isset($_GET['codigo'])) $codigo=$_GET['codigo'];
elseif(isset($_POST['codigo'])) $codigo=$_POST['codigo'];
else $codigo=0;

$error_img=isset($_GET['error'])?$_GET['error']:0;

$sql = "SELECT * FROM ctcontenedor WHERE codigo='$codigo'";
$result=mysql_query($sql) or print("error: ".mysql_error() );
$linia=mysql_fetch_array($result);// or print("error insert: ".mysql_error() );
$id=$linia['id'];
$fe=$linia['fecha_entrada'];
$adu=$linia['aduana'];
$fich=$linia['adjunt'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>

   <?php include("cabecera.inc"); ?>

<!-- link rel="stylesheet" href="tree/jquery.treeview.css" /-->
<!-- script src="tree/jquery.treeview.js" type="text/javascript"></script -->

<?php $xajax->printJavascript("");?>

<script>           
ng.ready(function(){
	var my_cal = new ng.Calendar({
		input: 'fecha_entrada',            // the input field id
		date_format:'d/m/Y',
		months_text:'short',
		start_date: 'year - 1',   // the start date (default is today)
		end_date: 'year + 4',      // the end date (related to start_date, 4 years from today)
		display_date: new Date()   // the display date (default is start_date)
	});
								
});


$(document).ready(function(e) {

	xajax_Consulta(<?php echo $id; ?>);
	//$('#data').datepicker();
	//$("#data").datepicker( "option", "dateFormat",'yy-mm-dd');
	//$("#browser").treeview();
		
});
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
        <div class="titulo">MOVER CONTENEDORES</div>
        <div class="separador"></div>
         <div class="formulario">
    	<form method="post" id="formsal" action="mover.php" enctype="multipart/form-data">
        	Contenedor: 
        	  <select id="codigo" name="codigo" onchange="carga()">
        	<option value=0>Selecciona contenedor</option>
           <?php 
		   $consulta = "SELECT * FROM ctcontenedor ORDER BY codigo";
			muestra_contenedor($consulta);
		?>	
         </select>
    </form>
	</div>
        <div class="formulario">
        	    <form id="formulari" enctype="multipart/form-data" method="post" >
                    <input type="hidden" id="control_error" value="0" />
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
                    <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo; ?>"/>
                    <input type="hidden" id="sortir" />
                      <?php 
		  if ($id!=0){ 
/*			$consu = "SELECT * FROM ctcontenedor WHERE codigo=$codigo ORDER BY codigo";
			$reslt=mysql_query($consu) or print("error: ".mysql_error() );
			$linia=mysql_fetch_array($reslt);
*/		  }
		?>	
 				<table class="tabla">
                <tr>
                    <td>ID</td>
                    <td><input type="text" style="width:110px" placeholder="<?php echo $id; ?>" disabled="disabled" /></td>
                </tr>
 				<tr>
                    <td>Contenedor:</td>
                    <td><input type="text" <?php if($adu==1)echo 'style="color:#F00"'; ?> value="<?php echo $codigo; ?>" readonly="TRUE" /></td>
                </tr>
                <tr>
                    <td>Estado:</td>
                    <td><input type="text" value="<?php echo $linia['estado']; ?>" readonly="readonly" /> </td>
                </tr>
        <tr>
            <td>Subestado:</td>
            <td><input type="text"  value="<?php echo $linia['subestado']; ?>" readonly="readonly" /> </td>
        </tr>
        <tr>
            <td>Sector:</td>
            <td><select id="sector" name="sector" >
            <option value=0>0</option>
                 <?php 
		$sql="SELECT * FROM ctsector ORDER BY id";
		$result=mysql_query($sql) or die("error: ".mysql_error() );
		while($dades=mysql_fetch_array($result))
		{
			if ($linia['sector'] != $dades['numero']){
				echo "<option value='".$dades['numero']."'>".$dades['numero']."</opcion> ";
			}else{
				echo "<option value='".$dades['numero']."' selected='selected'>".$dades['numero']."</opcion> ";
			}
		}
		?>	
               </select></td>
        </tr>
        <tr>
            <td>Carril:</td>
            <td><select id="carril" name="carril" >
            <option value=0>0</option>
                 <?php 
		$sql="SELECT * FROM ctcarril ORDER BY id";
		$result=mysql_query($sql) or die("error: ".mysql_error() );
		while($dades=mysql_fetch_array($result))
		{
			if ($linia['carril'] != $dades['num']){
				echo "<option value='".$dades['num']."'>".$dades['num']."</opcion> ";
			}else{
				echo "<option value='".$dades['num']."' selected='selected'>".$dades['num']."</opcion> ";
			}
		}
		?>	
               </select></td>
        </tr>
        <tr>
            <td>Posición:</td>
            <td><select id="posicio" name="posicio" >
            <option value=0>0</option>
                 <?php 
		$sql="SELECT * FROM ctposicion ORDER BY id";
		$result=mysql_query($sql) or die("error: ".mysql_error() );
		while($dades=mysql_fetch_array($result))
		{
			if ($linia['posicio'] != $dades['num']){
				echo "<option value='".$dades['num']."'>".$dades['num']."</opcion> ";
			}else{
				echo "<option value='".$dades['num']."' selected='selected'>".$dades['num']."</opcion> ";
			}
		}
		?>	
               </select></td>
        </tr>
        <tr>
            <td>Piso:</td>
            <td><select id="pis" name="pis" >
            <option value=0>0</option>
                 <?php 
		$sql="SELECT * FROM ctpiso ORDER BY id";
		$result=mysql_query($sql) or die("error: ".mysql_error() );
		while($dades=mysql_fetch_array($result))
		{
			if ($linia['pis'] != $dades['num']){
				echo "<option value='".$dades['num']."'>".$dades['num']."</opcion> ";
			}else{
				echo "<option value='".$dades['num']."' selected='selected'>".$dades['num']."</opcion> ";
			}
		}
		?>	
               </select></td>
        </tr>
                <tr>
            <td>adjunto:</td>
            <td><a href="archivos/contenedor/<?php echo $fich; ?>" target="_blank"><?php echo $fich; ?></a></td>
          </tr>

        <tr>
            <td>Fecha de entrada:</td>
            <td><input type="text"  value="<?php echo $fe; ?>" disabled="disabled"/>
            <input type="hidden" id="fecha_entrada" name="fecha_entrada" value="<?php echo $fe; ?>"/></td>
          </tr>
               
 				<tr>
                    <td></td>
                    <td><input type="button" class="boton" value="Guardar" onclick="xajax_Guardar(xajax.getFormValues('formulari'));"/>
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