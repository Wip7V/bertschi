 <?php 
 	$_SESSION = array();
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
	<div class="titulo">PANTALLA DE ACCESO</div>
    <div class="separador"></div>
    <div class="acceso">
    	 <form action="validacio.php" method="post">
		 
        <table class="tabla">
             <?php if(isset($_GET["errorusuario"])){ ?>
                <tr>
                  <td colspan="2" align="center"><span style="color: red;">Usuario o contraseña incorrectos</span></td></tr>
          <?php } ?>
          <tr>            
                <td>Usuario:</td>
                <td><input type="text" id="user" name="user" /> </td>
            </tr>
            <tr>
                <td>Contraseña:</td>
                <td><input type="password" id="pws" name="pws" /></td>
            </tr>
        </table>
	
        <div class="separador"></div>
        <div id="salir"><input value="Acceso" type="submit"  class="boton"></div>
        </form>
    </div>
</div><!-- cierre div principal -->

</body>
</html>
