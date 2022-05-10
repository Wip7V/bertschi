<?php 
require_once('xajax_core/xajax.inc.php');
include("config.php");
include("conexion.php");

//$xajax = new xajax();
//$xajax->configure('javascript URI', '../');
//$xajax->configure('debug', true);

//$xajax->register(XAJAX_FUNCTION, 'Guardar');
//$xajax->register(XAJAX_FUNCTION, 'ReloadSelectFitxers');
//$xajax->register(XAJAX_FUNCTION, 'delFitxer');



/*function Guardar($formulari)
{
	ob_start(); //per a retornar un string amb tots els errors
	$respuesta = new xajaxResponse();
	$sql="DELETE FROM ctcontenedor WHERE id=0; ";
	$name = "";
	
	//var_dump($formulari);
	foreach($formulari as $n => $v) $$n = mysql_real_escape_string($v); //crea variables pel nom del camp i asigna el seu contingut;
	if(isset($_FILES["adjunt"])){
		$name = $_FILES["adjunt"]["name"];	
	}	
	
{
		$fecha_partida1=explode("/",$fecha_entrada );
		$dia= $fecha_partida1[0];
		$mes= $fecha_partida1[1];
		$anio= $fecha_partida1[2];
		$fechaent=$anio."-".$mes."-".$dia;

	
		$sql = "UPDATE ctcontenedor SET presente='$presente',estado='$estado', subestado='$subestado', sector='$sector', fecha_entrada='$fecha_entrada', carril='$carril', posicio='$posicio', pis='$pis', adjunt='$adjunt', aduana='$aduana', adr='$adr', clase='$clase', onu='$onu', arancel='$arancel', antidumping='$antidumping', iva='$iva', total='$total', iiee='$iiee', duae='$duae', duas='$duas' WHERE id = $id;";
		
		$sqlcod = "SELECT * FROM ctcontenedor WHERE id='$id'";
		$result=mysql_query($sqlcod) or print("error: ".mysql_error() );
		$linia=mysql_fetch_array($result) or print("error insert: ".mysql_error() );
		$cont=$linia['codigo'];
		
		$sqlreg = "UPDATE ctregistro SET estado='$estado', subestado='$subestado', sector='$sector', fecha_entrada='$fechaent', carril='$carril', posicio='$posicio', pis='$pis', adjunt='$adjunt', aduana='$aduana', adr='$adr', clase='$clase', onu='$onu',  arancel='$arancel', antidumping='$antidumping', iva='$iva', total='$total', iiee='$iiee', duae='$duae', duas='$duas' WHERE id_contenedor = '$id';";
		mysql_query($sql) or print("error insert: ".mysql_error() );
		mysql_query($sqlreg) or print("error insert: ".mysql_error() );
		if ($name!=""){copy( $_FILES['adjunt']['tmp_name'], "archivos/contenedor/".$name);};
	}
	
	//echo $sql;
	
	$error=ob_get_clean(); //tot el texte dels echo y dels errors de php
	if(strlen($error)==0) $respuesta->Script("alert('Datos guardados'); document.location = 'editcont.php';");
	//$respuesta->Assign("sortir","value",1); //de que tot ha funcionat



	$phperror ="<pre>".$error."</pre>";
	$respuesta->Assign("error_php","innerHTML",$phperror);
	
	return $respuesta;
	
}

$xajax->processRequest();*/

if(isset($_GET['id'])) $id=$_GET['id'];
elseif(isset($_POST['id'])) $id=$_POST['id'];
else $id=0;

$error_img=isset($_GET['error'])?$_GET['error']:0;

$sql = "SELECT * FROM ctcontenedor WHERE id='$id'";
$result=mysql_query($sql) or print("error: ".mysql_error() );
$linia=mysql_fetch_array($result) or print("error insert: ".mysql_error() );
$fe=$linia['fecha_entrada'];
$adu=$linia['aduana'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>


<!-- link rel="stylesheet" href="tree/jquery.treeview.css" /-->
<!-- script src="tree/jquery.treeview.js" type="text/javascript"></script -->

<?php 
	include("cabecera.inc");
    //$xajax->printJavascript("");
    ?>

<script>  

function guardar(obj){
	//console.log($("#formulari").serialize());
	$.post( "main.php", $("#formulari").serialize()+"&funcion=Guardar_contenedor", function(data) { setTimeout(data,0);});
}

		$(function () {
			$.datepicker.setDefaults($.datepicker.regional["es"]);
			$("#fecha_entrada").datepicker({firstDay: 1 });
			$( "#fecha_entrada" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
			$("#data_dua").datepicker({firstDay: 1 });
			$( "#data_dua" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
			
			$('#total').click(function(){
				//$('#total').val((parseFloat($('#arancel').val()) + parseFloat($('#antidumping').val())) * ($('#iva').val()/100 + 1));
$('#total').val( Math.round((parseFloat($('#arancel').val().replace(",",".")) + parseFloat($('#antidumping').val().replace(",",".")) + parseFloat($('#iiee').val().replace(",",".")) + parseFloat($('#iva').val().replace(",",".")))*100)/100);
			});	
		});



$(document).ready(function(e) {
    

	//xajax_Consulta(<?php echo $id; ?>);
	//$('#data').datepicker();
	//$("#data").datepicker( "option", "dateFormat",'yy-mm-dd');
	//$("#browser").treeview();
	//console.log("prueba");
	$.post( "main.php",{ funcion: "ver_contenedor", id: <?php echo $id; ?>}, function(data) { setTimeout(data,0);});
		
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
        <div class="titulo">GESTION DE CONTENEDORES</div>
        <div class="separador"></div>
        <div class="formulario">
            <div class="botonessup"><a href="editcont.php" class="boton">Volver a gestion de contenedores</a></div>
        	    <form id="formulari" enctype="multipart/form-data" method="post" >
                    <input type="hidden" id="control_error" value="0" />
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
                    <input type="hidden" id="sortir" />
 				<table class="tabla" >
                <tr>
                    <td>ID</td>
                    <td><input type="text" style="width:110px" placeholder="<?php echo $id; ?>" disabled="disabled" /></td>
                </tr>
 				<tr>
                    <td>Contenedor:</td>
                    <td><input type="text" id="codigo" name="codigo" disabled="disabled" <?php if($adu==1)echo 'style="color:#F00"'; ?> /></td>
                </tr>
        <tr>
            <td>
                <!-- si estado = vacio visible subestado-->
                En terminal:</td>
            <td><select id="presente" name="presente">
                <option value=0>NO</option>
                <option value=1>SI</option></select></td>
        </tr>
                <tr>
                    <td>Estado:</td>
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
            <td>Arancel:</td>
            <td><input type="text" id="arancel" name="arancel" value=""  />€</td>
          </tr>
        <tr>
            <td>Antidumping:</td>
            <td><input type="text" id="antidumping" name="antidumping" value=""  />€</td>
          </tr>          
         <tr>
            <td>Iva:</td>
            <td><input type="text" id="iva" name="iva" value=""  />€</td>
          </tr>
         <tr>
            <td>IIEE:</td>
            <td><input type="text" id="iiee" name="iiee" value=""  />€</td>
          </tr>
          <tr>
            <td>Total:</td>
            <td><input type="text" id="total" name="total" value=""  />€</td>
          </tr> 
        
        <tr>
            <td>Fecha de entrada:</td>
            <td><input type="text" id="fecha_entrada" name="fecha_entrada" value="" readonly="TRUE"/></td>
          </tr>

        <tr>
            <td>
                <!-- si estado = vacio visible subestado-->
                Aduana:</td>
            <td><select id="aduana" name="aduana" >
                <option value=0>NO</option>
                <option value=1>SI</option></select></td>
        </tr>
        <tr>
            <td>ADR:</td>
            <td><select id="adr" name="adr" onchange="adrshow()">
                <option value=0 selected="true">NO</option>
                <option value=1>SI</option>                
                </select></td>
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
            <td>Clase:</td>
            <td><select id="clase" name="clase" >
                <option value=0>0</option>
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
                <option value=6>6</option>
                <option value=7>7</option>
                <option value=8>8</option>
                <option value=9>9</option>
                <option value="X">X</option></select>
                </td>
        </tr>
         <tr>
            <td>ONU:</td>
            <td><input name="onu" type="text" id="onu"  maxlength="10">
                </td>
        </tr>
 

         
 				<tr>
                    <td colspan="2" align="center"><input type="button" class="boton" value="Guardar" onclick="guardar(this);"/>
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