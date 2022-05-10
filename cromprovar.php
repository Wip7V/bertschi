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
</head>

<body>
<div id="principal2">
	<div class="titulo">
    	REGISTRO DE CONTENEDORES
    </div>
    <div class="separador"></div>
           <div id="impres">
        <table  id="example">
            <thead>
                <tr>
                <th width="20">ID</th>
                <th width="180">contenedor</th>
                <th width="180">Fecha Entrada</th>
                <th width="180">Fecha Salida</th> 
                <th width="180">fechaent</th>
                <th width="180">fechasal</th> 
			</tr>
            </thead>
            <tbody>
 <?php
		$sqlselect="SELECT * FROM ctregistro ORDER by id";
        $result=mysql_query($sqlselect, $conexion);
		$num_rows = mysql_num_rows($result);
		if ($num_rows==0){
			echo "<tr><td colspan='9' align='center'><h1>Esta combinación no ha dado ningún resultado</h1></td></tr>";
		}else{
			 while($item=mysql_fetch_array($result)){ ?>
                 <tr>
                   <td align="center" valign="top"><?php echo $item['id']; ?></td>
					<td align="center" valign="top"><?php echo $item['contenedor']; ?></td>
                    <td align="center" valign="top"><?php echo $item['fecha_entrada']; ?></td>
                    <td align="center" valign="top"><?php echo $item['fecha_salida']; ?></td>
                    <td align="center" valign="top"><?php echo $item['fechaent']; ?></td>
                    <td align="center" valign="top"><?php echo $item['fechasal']; ?></td>
                    
		  <?php } }?>
        </tbody>
    </table>
    	</div>
    </div>
    <div class="separador"></div>
    
    <div id="salir">
         <?php include("binicio.inc"); ?>
    </div>

</div><!-- cierre div principal -->
</body>
</html>