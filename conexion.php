<?php

$direccion="mysql.hostinger.es";  // host del MySQL (generalmente localhost)
$direccion="localhost"; 
$usuario="u833435652_jordi"; // aqui debes ingresar el nombre de usuario
$usuario="root";
                      // para acceder a la base

$password="jordi0987654321"; //1234 password de acceso para el usuario de la
$password="root";
                      // linea anterior

$base_datos="u833435652_web";        // Seleccionamos la base con la cual trabajar
$base_datos="contenedor"; 

$direccion = 'localhost';
//$usuario = 'id7251713_wip7v';
//$password = 'a09876543';
//$base_datos = "id7251713_principal";

$conexion = mysql_connect($direccion, $usuario, $password);

mysql_select_db($base_datos, $conexion);

?>