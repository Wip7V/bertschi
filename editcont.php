<?php 

require_once('xajax_core/xajax.inc.php');

include("config.php");

include("conexion.php");



$xajax = new xajax();



$xajax->register(XAJAX_FUNCTION, 'Modifica');

$xajax->register(XAJAX_FUNCTION, 'Elimina');



function Modifica($camp, $id)

{

	ob_start(); //per a retornar un string amb tots els errors

	$respuesta = new xajaxResponse();

	

	

	$sql="SELECT * FROM ctcontenedor WHERE id=$id";

	//echo $sql;

	$result=mysql_query($sql) or die("error: ".mysql_error() );

	$linia=mysql_fetch_array($result);

	

	if($linia[$camp]==0) $valor=1;

	else $valor=0;

	

	//echo $linia[$camp];

	

	$sql="UPDATE ctcontenedor SET ".$camp."=".$valor." WHERE id=".$id."";

	mysql_query($sql);

	

	$respuesta->Replace($camp.$id,"innerHTML",$camp.$linia[$camp], $camp.$valor);

		

	$phperror ="<pre>".ob_get_clean()."</pre>";

	$respuesta->Assign("error_php","innerHTML",$phperror);

	

	return $respuesta;

}



function Elimina($id)

{

	ob_start(); //per a retornar un string amb tots els errors

	$respuesta = new xajaxResponse();

	

	$sql="DELETE FROM ctcontenedor WHERE id=".$id."";

	mysql_query($sql);

	$respuesta->Script("document.location = document.URL;");

	//echo $sql;

	



	$phperror ="<pre>".ob_get_clean()."</pre>";

	$respuesta->Assign("error_php","innerHTML",$phperror);

	

	return $respuesta;

}



$xajax->processRequest();



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>GESTIÓN OPERACIONES CON CONTENEDORES</title>

	<?php include("cabecera.inc"); ?>

    <?php $xajax->printJavascript("");?>

        <script type="text/javascript" charset="utf-8">

            var oTable;



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



            

			function Modifica(camp, id)

			{

				$('#'+camp+id).src()

				xajax_Modifica(camp,id);	

			}

			

			function eliminar($id)

			{

				if(confirm('Desitja esborrar aquestes dades?'))

				{

					xajax_Elimina($id);

    	            //setTimeout("window.location=document.URL;",500);

            	}	

			}



        </script>

    </head>

    <body>

        <?php



        $consulta1 = "SELECT ctc.*  FROM ctcontenedor as ctc LEFT JOIN ctdua as duae ON ctc.duae = duae.id_dua LEFT JOIN ctdua as duas ON ctc.duas = duas.id_dua";

        $consulta_mysql = mysql_query($consulta1) or die("mysql error: ".mysql_error() );

		

        ?>

       <div id="principal2">

            <div class="titulo">

                GESTION DE CONTENEDORES

            </div>

            <div class="separador"></div>

            <div class="formulario">

                <table  id="example">

            <thead>

                <tr>

                <th ></th><th ></th>

                <th width="20">ID</th>

                <th width="180">Codigo</th>

                <th width="180">En Terminal</th>

                <th width="180">Estado</th>

                <th width="180">Subestado</th>

                <th width="180">Sector</th>

                <th width="180">Carril</th> 

                <th width="180">Posicion</th>

                <th width="180">Piso</th>

                <th width="180">Fecha Entrada</th>

                <th width="180">Adjunto</th>
                <th width="180">Certi. Recep.</th>

                <th width="180">Aduana</th>

                <th width="180">ADR</th>

                <th width="180">Clase</th>

                <th width="180">ONU</th>

                <th width="180">IIEE</th>

                <th width="180">Arancel</th>

                <th width="180">Antidumping</th>

                <th width="180">Iva</th>

                <th width="180">Total</th>

				</tr>

            </thead>

            <tbody>

                <?php while($item=mysql_fetch_array($consulta_mysql)){ ?>

                 <tr>

                 <td align="center"><a href="formedit.php?id=<?php echo $item['id']; ?>" title="Editar" ><img src="img/editar.png" border="0" /></a>

                     </td>

                    <td align="center"><img src="img/eliminar.png" title="Borrar" onclick="javascript:eliminar(<?php echo $item['id']; ?>);" />

                    </td>

                    <td align="center" valign="top"><?php echo $item['id']; ?></td>

                    <td align="center" valign="top"><?php if($item['aduana']==1){echo '<span style="color:#F00">'.$item['codigo'].'</span>';}else{echo $item['codigo'];} ?> </td>

					<td align="center" valign="top"><?php if($item['presente']==1){echo '<span style="color:#0A0">SI</span>';}else{echo 'NO';} ?></td>

					<td align="center" valign="top"><?php echo $item['estado']; ?></td>

                    <td align="center" valign="top"><?php echo $item['subestado']; ?></td>

                    <td align="center" valign="top"><?php echo $item['sector']; ?></td>

                    <td align="center" valign="top"><?php echo $item['carril']; ?></td>

					<td align="center" valign="top"><?php echo $item['posicio']; ?></td>

                    <td align="center" valign="top"><?php echo $item['pis']; ?></td>

                    <td align="center" valign="top"><?php echo $item['fecha_entrada']; ?></td>

                    <td align="center" valign="top"><a href="/archivos/contenedor/<?php echo $item['id']."/".$item['adjunt']; ?>"><?php echo $item['adjunt']; ?></a></td>
                    <td align="center" valign="top"><a href="/archivos/contenedor/<?php echo $item['id']."/".$item['certi']; ?>"><?php echo $item['certi']; ?></a></td>

                    <td align="center" valign="top"><?php if($item['aduana']==1){echo '<span style="color:#F00">SI</span>';}else{echo 'NO';} ?></td>

                    <td align="center" valign="top"><?php echo $item['adr']; ?></td>

                    <td align="center" valign="top"><?php echo $item['clase']; ?></td>

                    <td align="center" valign="top"><?php echo $item['onu']; ?></td>

                    <td align="center" valign="top"><?php echo $item['iiee']; ?></td>

                    <td align="center" valign="top"><?php echo $item['arancel']; ?></td>

                    <td align="center" valign="top"><?php echo $item['antidumping']; ?></td>

                    <td align="center" valign="top"><?php echo $item['iva']; ?></td>

                    <td align="center" valign="top"><?php echo $item['total']; ?></td>

                    <td align="center"><a href="formedit.php?id=<?php echo $item['id']; ?>" title="Editar" ><img src="img/editar.png" border="0" /></a>

                     </td>

                    <td align="center"><img src="img/eliminar.png" title="Borrar" onclick="javascript:eliminar(<?php echo $item['id']; ?>);" />

                    </td>

                </tr>

                <?php } ?>

            </tbody>

        </table>

        

                <div id="error_php"></div>

            </div>

            <div class="separador"></div>

            <div id="salir">

                 <?php include("binicio.inc"); ?>

            </div>



        </div>

    </body>

</html>

