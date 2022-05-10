<?php include("config.php");
include("conexion.php");
$login=$_POST['user'];
$pass=$_POST['pws'];
$pass_enc=md5($pass);


//Sentencia SQL para buscar un usuario con esos datos 
$ssql = "SELECT * FROM ctuser WHERE nombre='$login' and pws='$pass'"; 

//Ejecuto la sentencia 
$rs = mysql_query($ssql,$conexion); 

//vemos si el usuario y contraseña es váildo 
//si la ejecución de la sentencia SQL nos da algún resultado 
//es que si que existe esa conbinación usuario/contraseña 
if (mysql_num_rows($rs)!=0){ 
   	//usuario y contraseña válidos 
   	//defino una sesion y guardo datos 
   	session_start();
	 
   	$_SESSION["autentificado"] = "SI"; 
	$_SESSION["useract"] = $login;
	
   	header ("Location: principal.php");	
}else { 
   	//si no existe le mando otra vez a la portada 
   	header("Location: index.php?errorusuario=si");
  	//header ("Location: principal.php"); 
} 
mysql_free_result($rs); 
mysql_close($conexion); 
?>