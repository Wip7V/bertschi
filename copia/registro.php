<?php include("config.php");
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
</head>

<body>
<div id="registro">
	<div class="titulo">
    	REGISTRO DE CONTENEDORES
    </div>
    <div class="separador"></div>
   

    <div id="entrada">
    <form method="post" id="form" action="registro.php" enctype="multipart/form-data">
    <table border="1" class="tabla">
    <tr>    
            <td><select id="letra" name="letra">
                <option value=0>Letras</option>
                 <?php 
					$sql="SELECT * FROM ctletra ORDER BY id";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						echo "<option value='".$dades['letra']."'>".$dades['letra']."</opcion> ";
					}
					?>						  
			 	</select>
                <input id="num1" name="num1" placeholder="000000" size="6" type="text" maxlength="6"/>-<input id="num2" name="num2" placeholder="0"type="text" size="1" maxlength="1"/></td>
            <td><select id="sector" name="sector">
                <option value=0>Selecciona sector</option>
                 <?php 
					$sql="SELECT * FROM ctsector ORDER BY id";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						if ($dades['numero'] != NULL) echo "<option value='".$dades['numero']."'>".$dades['numero']."</opcion> ";
					}
					?>						  
			 	</select></td>
     </tr>
    <tr>
            <td><select id="estado" name="estado">
                <option value=0>Selecciona Estado</option>
                <option value="cargado">Cargado</option>
                <option value="vacio">vacio</option></select></td>

            <td><select id="subestado" name="subestado">
                <option value=0>Selecciona Subestado</option>
                <option value="limpio">Limpio</option>
                <option value="sucio">Sucio</option></select></td>
            
    </tr>
    <tr>
            <td><select id="fecha_entrada" name="fecha_entrada">
                <option value=0>Fecha Entrada</option>
                 <?php 
					$sql="SELECT DISTINCT fecha_entrada FROM ctregistro ORDER BY fecha_entrada";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						if ($dades['fecha_entrada'] != NULL) echo "<option value='".$dades['fecha_entrada']."'>".$dades['fecha_entrada']."</opcion> ";
					}
					?>						  
			 	</select></td> 
            <td><select id="user_entrada" name="user_entrada">
                <option value=0>Usuario Entrada</option>
                 <?php 
					$sql="SELECT DISTINCT user_entrada FROM ctregistro ORDER BY id";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						if ($dades['user_entrada'] != NULL) echo "<option value='".$dades['user_entrada']."'>".$dades['user_entrada']."</opcion> ";
					}
					?>						  
			 	</select></td>
    </tr>
    <tr>
            <td><select id="fecha_salida" name="fecha_salida">
                <option value=0>Fecha Salida</option>
                 <?php 
					$sql="SELECT DISTINCT fecha_salida FROM ctregistro ORDER BY fecha_salida";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						if ($dades['fecha_salida'] != NULL) echo "<option value='".$dades['fecha_salida']."'>".$dades['fecha_salida']."</opcion> ";
					}
					?>						  
			 	</select></td> 
            <td><select id="user_salida" name="user_salida">
                <option value=0>Usuario Salida</option>
                 <?php 
					$sql="SELECT DISTINCT user_salida FROM ctregistro ORDER BY id";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						if ($dades['user_salida'] != NULL) echo "<option value='".$dades['user_salida']."'>".$dades['user_salida']."</opcion> ";
					}
					?>						  
			 	</select></td>
        </tr>
        <tr> <td colspan="2" align="center"> <input type="submit" value="Buscar" class="boton" /> <input value="Imprimir" type="button" class="boton" onClick="window.print()"/> </td></tr>
        </table>
        </form>
       
         <table border="1" class="tabla">
  
        <tr>
            <td>ID</td>
            <td>Contenedor</td>
            <td>Estado</td> 
            <td>Subestado</td> 
            <td>Sector</td>
            <td>entrada</td> 
            <td>User Entrada</td>
            <td>Salida</td> 
            <td>User Salida</td>
        </tr>
        <?php
		$sqlselect="SELECT * FROM ctregistro ORDER by id";
		//var_dump($_POST);
		$tamaño = count($_POST);
		//echo "<br> $tamaño";
		if ($tamaño>0)
		{
//			echo "<br> Filtro --> ";
			$letra = $_POST['letra'];
			$num1 = $_POST['num1'];
			$num2 = $_POST['num2'];
			$estado = $_POST['estado'];
			$subestado = $_POST['subestado'];
			$sector = $_POST['sector'];
			$fechaent = $_POST['fecha_entrada'];
			$userent = $_POST['user_entrada'];
			$fechasal = $_POST['fecha_salida'];
			$usersal = $_POST['user_salida'];
			$consulta="0";
			$contenedor="";
			
			if($letra!="0"){$contenedor=$letra."%";}
			if($num1!=""){$contenedor.="%$num1%";}
			if($num2!=""){$contenedor.="%$num2";}
						
			if ($contenedor!=""){$consulta="WHERE contenedor LIKE '$contenedor' ";}
//				echo " Contenedor = ".$contenedor." / ";
			
			if($estado!="0")
			{
//				echo "estado = ".$estado." / ";
				if ($consulta!="0"){$consulta.="AND estado='$estado' ";
				}else{$consulta="WHERE estado='$estado' ";}
			}
			if($subestado!="0")
			{
//				echo "subestado = ".$subestado." / ";
				if ($consulta!="0"){$consulta.="AND subestado='$subestado' ";
				}else{$consulta="WHERE subestado='$subestado' ";}
			}
			if($sector!="0")
			{
//				echo "sector = ".$sector." / ";
				if ($consulta!="0"){$consulta.="AND sector='$sector' ";
				}else{$consulta="WHERE sector='$sector' ";}
			}
			if($fechaent!="0")
			{
//				echo "fecha_entrada = ".$fechaent." / ";
				if ($consulta!="0"){$consulta.="AND fecha_entrada='$fechaent' ";}
				else {$consulta="WHERE fecha_entrada='$fechaent' ";}
			}
			if($userent!="0")
			{
//				echo "user_entrada = ".$userent." / ";
				if ($consulta!="0"){$consulta.="AND user_entrada='$userent' ";
				}else{$consulta="WHERE user_entrada='$userent' ";}
			}
			if($fechasal!="0")
			{
//				echo "fecha_salida = ".$fechasal." / ";
				if ($consulta!="0") {$consulta.="AND fecha_salida='$fechasal' ";
				}else{$consulta="WHERE fecha_salida='$fechasal' ";}
			}
			
			if($usersal!="0")
			{
//				echo "user_salida = ".$usersal;
				if ($consulta!="0"){$consulta.="AND user_salida='$usersal' ";
				}else{$consulta="WHERE user_salida='$usersal' ";}
			}

//			echo "<br>consulta >> ".$consulta;
			if ($consulta!="0") $sqlselect="SELECT * FROM ctregistro $consulta ORDER by id";
//			echo "<br>select >> ".$sqlselect; 
		}
        $result=mysql_query($sqlselect, $conexion);
		
		$num_rows = mysql_num_rows($result);
		if ($num_rows==0){
			echo "<tr><td colspan='9' align='center'><h1>Esta combinación no ha dado ningún resultado</h1></td></tr>";

		}else{
			while($row=mysql_fetch_row($result)){
				echo "<tr><td class='lf'>$row[0]</td>";
				echo "<td class='lf'>$row[1]</td>";
				echo "<td class='lf'>$row[2]</td>";
				echo "<td class='lf'>$row[3]</td>";
				echo "<td class='lf'>$row[4]</td>";
				echo "<td class='lf'>$row[5]</td>";
				echo "<td class='lf'>$row[6]</td>";
				echo "<td class='lf'>$row[7]</td>";
				echo "<td class='lf'>$row[8]</td></tr>";
			}
		}
		?>
    </table>
    </div>
    <div class="separador"></div>
    
    <div id="salir">
         <?php include("binicio.inc"); ?>
    </div>

</div><!-- cierre div principal -->
</body>
</html>