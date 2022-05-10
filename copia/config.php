<?php 
//Inicio la sesión 
session_start(); 
if (isset($_SESSION['useract'])) $useract = $_SESSION['useract'];
else header("Location: index.php"); 


?>
