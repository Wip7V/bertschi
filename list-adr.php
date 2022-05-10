<?php 
	include("config.php");
	include("conexion.php");
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GESTIÓN OPERACIONES CON CONTENEDORES</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
<script src="js/javas.js" type="text/javascript"></script>
<script src="js/jquery.js" type="text/javascript"></script>
        <script type="text/javascript" charset="utf-8">
            var oTable;
/*
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
*/			
			function imprSelec(muestra)
			{
				var ficha=document.getElementById(muestra);
				var ventimp=window.open(' ','popimpr');
				ventimp.document.write(ficha.innerHTML);
				ventimp.document.close();
				ventimp.print();
				ventimp.close();
			}

        </script>

</head>

<body>
<div id="principal2">

    <div class="formulario">
<!--    	<form method="post" id="formsal" action="list-adr.php" enctype="multipart/form-data">
    </form>
-->        <div id="imprimir">
            <a href="" onClick="imprSelec('impres')"/>Imprimir</a>
        </div>
        
	</div>
    <div class="separador"></div>
    <div id="salida">
       <div id="impres">
            <div class="titulo">
                Lista ADR
            </div>
 
	<?php
		$sqlsch="SELECT * FROM ctcontenedor WHERE adr='1' ORDER by sector ASC";
		$result=mysql_query($sqlsch, $conexion);
	?>
       <table  id="example">
        <thead>
          <tr>
            <th>Contenedor</th>
            <th>Clase</th>
            <th>ONU</th>
            <th>Sector</th>
          </tr>
       </thead>
       <tbody>
 
	<?php
		$result=mysql_query($sqlsch, $conexion);
      	while($row=mysql_fetch_array($result)){ 
	?>
        <tr>
            <td style="text-align:center;"><?php echo $row['codigo']?></td>
            <td style="text-align:center;"><?php echo $row['clase']?></td>
            <td style="text-align:center;"><?php echo $row['onu']?></td>
            <td style="text-align:center;"><?php echo $row['sector']?></td>
        </tr>
		<?php
        } 
		?>
            </tbody>
          </table>
          </div>
    </div>
    <div class="separador"></div>
    
    <div id="salir">
    	
         <?php 
		 	include("binicio.inc"); 
		  ?>
    </div>


</div><!-- cierre div principal -->
</body>
</html>
