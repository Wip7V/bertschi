<?php 

include("config.php");
include("conexion.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>GESTIÓN OPERACIONES CON CONTENEDORES</title>
	<?php include("cabecera.inc"); ?>
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

            


        </script>
        <style>
	#example{
		    font-size: 12px !important;
	}
</style>
    </head>
    <body>
        <?php

        $consulta1 = "SELECT *  FROM ctdua";
        $consulta_mysql = mysql_query($consulta1) or die("mysql error: ".mysql_error() );
		
        ?>
       <div id="principal2">
            <div class="titulo">
                REGISTRO DE DUA
            </div>
            <div class="separador"></div>
            <div class="formulario">
            <table  id="example">
            <thead>
                <tr>
                <th width="20">ID</th>
                <th width="180"Codigo</th>

                <th width="180">fecha</th>
                <th width="180">fechar Prevista</th> 
                <th width="180">tipo de salida</th>
                <th width="180">codigo taric</th>
                <th width="180">tipo aduana</th>
                <th width="180">tipo declaracion</th>
                <th width="180">num form</th>
                <th width="180">descripcion</th>
                <th width="180">regimen aduanero</th>
                <th width="180">destinatario</th>
				</tr>
            </thead>
            <tbody>
                <?php while($item=mysql_fetch_array($consulta_mysql)){ ?>
                 <tr>
                    <td align="center" valign="top"><?php echo $item['id_dua']; ?></td>
                    <td align="center" valign="top"><?php echo $item['numero']; ?> </td>
					

                    <td align="center" valign="top"><?php echo $item['fecha']; ?></td>
                    <td align="center" valign="top"><?php echo $item['fecha_prevista']; ?></td>
				
                    <td align="center" valign="top"><?php echo $item['tipo']; ?></td>
                    <td align="center" valign="top"><?php echo $item['codi_taric']; ?></td>
                    <td align="center" valign="top"><?php echo $item['tipo_aduana']; ?></td>
                    <td align="center" valign="top"><?php echo $item['tipo_declaracio']; ?></td>
                    <td align="center" valign="top"><?php echo $item['num_formulari']; ?></td>
                    <td align="center" valign="top"><?php echo $item['des_mercaderia']; ?></td>
                    <td align="center" valign="top"><?php echo $item['regim_aduaner']; ?></td>
                    <td align="center" valign="top"><?php echo $item['destinatario']; ?></td>
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
