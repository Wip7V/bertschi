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
<script type="text/javascript" src="js/ng_all.js"></script>
<script type="text/javascript" src="js/components/calendar.js"></script>
</head>

<body>
<div id="principal">
	<div class="titulo">
    	ENTRADA DE CONTENEDORES
    </div>
    <div class="separador"></div>
    <div class="formulario">
    	 <form method="post" id="form" action="formentra.php" enctype="multipart/form-data">
        	 <table class="tabla">
        <tr>
            <td >Contenedor: </td>
            <td ><select id="letra" name="letra" onchange="cod()">
                <option value=0>Selecciona letra</option>
                 <?php 
					$sql="SELECT * FROM ctletra ORDER BY id";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						echo "<option value='".$dades['letra']."'>".$dades['letra']."</opcion> ";
					}
					?>						  
			 	</select>
                <input id="num1" name="num1" placeholder="000000" size="6" type="text" maxlength="6" onchange="cod()"/>-
				<select id="num2" name="num2" onchange="cod()">
                    <?php 
					for ( $i = 0 ; $i < 10 ; $i ++) {
						echo "<option value='".$i."'>".$i."</opcion> ";
					}
					?>						  
			 	</select></td>
        </tr>
  		
        <tr>
            <td>Codigo:</td>
            <td  class="lf"><input id="codigo" name="codigo" type="text" disabled="disabled"></td>
        </tr><tr>
            <td>Estado:</td>
            <td><select id="estado" name="estado" onchange="cambiarsub()" >
                <option value=0>Selecciona Estado</option>
                <option value="cargado">Cargado</option>
                <option value="vacio">vacio</option></select></td>
        </tr>
      
        <tr>
            <td>
                <!-- si estado = vacio visible subestado-->
                Subestado:</td>
            <td><select id="subest" name="subest" >
                <option value=0>Selecciona Subestado</option>
                <option value="limpio">Limpio</option>
                <option value="sucio">Sucio</option></select></td>
        </tr>
        <tr>
            <td>Sector:</td>
            <td><select id="sector" name="sector" >
                <option value=0>Selecciona Sector</option>
                 <?php 
		$sql="SELECT * FROM ctsector ORDER BY id";
		$result=mysql_query($sql) or die("error: ".mysql_error() );
		while($dades=mysql_fetch_array($result))
		{
			echo "<option value='".$dades['numero']."'>".$dades['numero']."</opcion> ";
		}
		?>	
               </select></td>
        </tr><tr>
            <td>Fecha de entrada:</td>
            <td><input type="text" id="fechaent" name="fechaent" value="<?php echo date("m/d/Y"); ?>"/></td>
            <script type="text/javascript">
				ng.ready(function(){
					var my_cal = new ng.Calendar({
						input: 'fechaent',            // the input field id
						date_format:'d/m/Y',
        				months_text:'short',
						start_date: 'last year',   // the start date (default is today)
						end_date: 'year + 5',      // the end date (related to start_date, 4 years from today)
						display_date: new Date()   // the display date (default is start_date)
					});
												
				});
</script>
          </tr><tr>
            <td colspan="2" align="center">    
            <input type="hidden" id="useract" name="useract" value="<?php echo $useract ?>"/>
            <input type="hidden" id="codigo" name="codigo" value="aaaa000000-0"/>
          	<input value="Guardar" type="button" id="enviarentra" name="enviarentra" class="boton" onClick="confirma()">
            </td>
          </tr></table>
        </form>
    </div>
    <div class="separador"></div>
    
    <div id="salir">
         <?php include("binicio.inc"); ?>
    </div>


</div><!-- cierre div principal -->
</body>
</html>
