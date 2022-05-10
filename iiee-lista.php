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
<!--	-->
    <div class="formulario">
        <div id="imprimir">
            <a href="" onClick="imprSelec('impres')"/>Imprimir</a>
        </div>
        
	</div>
    <div class="separador"></div>
    <div id="salida">
       <div id="impres">
  
	<?php
		$sqlsch="SELECT * FROM ctcontenedor, ctiiee WHERE aduana='2' AND ctcontenedor.id=ctiiee.id_contenedor ORDER by sector ASC";
		$result=mysql_query($sqlsch, $conexion);
	?>
   			<div class="titulo">Lista IIEE</div>
       <table  id="example">
        <thead>
          <tr>
            <th>Contenedor</th>
            <th>Sector</th>
            <th>producto</th>
          </tr>
       </thead>
       <tbody>
 
	<?php
		$result=mysql_query($sqlsch, $conexion);
      	while($row=mysql_fetch_array($result)){ 
	?>
        <tr>
            <td style="text-align:center;"><?php echo $row['codigo']?></td>
            <td style="text-align:center;"><?php echo $row['sector']?></td>
            <td style="text-align:center;"><?php echo $row['producto']?></td>

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
