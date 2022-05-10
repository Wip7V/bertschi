<?php  include("config.php");
	include("conexion.php");
	 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GESTIÓN OPERACIONES CON CONTENEDORES</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="principal">
	<div class="titulo">
    	GESTIÓN OPERACIONES CON CONTENEDORES
    </div>
    <div class="separador"></div>
    <div class="botones">
    	<p><a href="entrada.php">Entrar contenedor</a>
        <a href="buscar.php">Buscar contenedor</a>
        <a href="salida.php">Salida contenedor</a></p>
       <!-- Solo visible si introduce usuario administrador -->
       <?php 
	    $sql="SELECT * FROM ctuser WHERE nombre='".$useract."'";
		$result=mysql_query($sql, $conexion) or die("error: ".mysql_error() );
		$row=mysql_fetch_row($result);
		if ($row[3] == "1"){
	   ?>
	   <p>
        <a href="gestuser.php">Gestion usuarios</a>
        <a href="registro.php">Registro</a></p>
        <?php } ?>
	</div>
    <div class="separador"></div>
	<div id="salir">
         <?php include("binicio.inc"); ?>
    </div>

</div><!-- cierre div principal -->

</body>
</html>
