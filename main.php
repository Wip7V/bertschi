<?php

session_start();
include("config.php");
include("conexion.php");

	function js_alert($string) //para poder hacer alert de javascript con ' comillas simples y dobles "
	{	

		print("alert('".mysql_real_escape_string($string)."');" );
	}

	function js_console_error($string)
	{

		echo "console.log(\"".mysql_real_escape_string($string)."\");";	
	}
	
	
foreach($_POST as $n => $v){
	if(!is_array($v)) $$n = mysql_real_escape_string($v);//$$n = $mysqli->real_escape_string($v);
	else $$n = $v;
}

foreach($_FILES as $n => $v) $$n = $v;

/* debug */
ob_start();
var_dump($_POST);
var_dump($_FILES);
//var_dump($_SESSION);
echo " console.log('".mysql_real_escape_string(strip_tags(ob_get_clean()))."'); ";


	
if($funcion=='ver_contenedor') ver_contenedor();

function ver_contenedor(){
	global $id;
	$sql = "SELECT * FROM ctcontenedor WHERE id=$id";
	$result = mysql_query($sql) or js_alert(mysql_error());
	$linia=mysql_fetch_array($result);
	foreach($linia as $n => $v) echo " $('#$n').val('".mysql_real_escape_string($v)."');";
	
}

if($funcion=='Guardar_contenedor') Guardar_contenedor();

function Guardar_contenedor()
{
	global $presente, $estado, $subestado,$sector,$fecha_entrada,$carril,$posicio,$pis,$adjunt,$aduana,$adr,$clase,$onu,$arancel,$antidumping,$iva,$total,$iiee,$duae,$duas, $id;

		$fecha_partida1=explode("/",$fecha_entrada );
		$dia= $fecha_partida1[0];
		$mes= $fecha_partida1[1];
		$anio= $fecha_partida1[2];
		$fechaent=$anio."-".$mes."-".$dia;

	
		$sql = "UPDATE ctcontenedor SET presente='$presente',estado='$estado', subestado='$subestado', sector='$sector', fecha_entrada='$fecha_entrada', carril='$carril', posicio='$posicio', pis='$pis', aduana='$aduana', adr='$adr', clase='$clase', onu='$onu', arancel='$arancel', antidumping='$antidumping', iva='$iva', total='$total', iiee='$iiee', duae='$duae', duas='$duas' WHERE id = $id;";
		//js_alert($sql);
		mysql_query($sql) or js_alert(mysql_error());

		
		$sqlreg = "UPDATE ctregistro SET estado='$estado', subestado='$subestado', sector='$sector', fecha_entrada='$fechaent', carril='$carril', posicio='$posicio', pis='$pis', aduana='$aduana', adr='$adr', clase='$clase', onu='$onu',  arancel='$arancel', antidumping='$antidumping', iva='$iva', total='$total', iiee='$iiee', duae='$duae', duas='$duas' WHERE id_contenedor = '$id';";
		
		mysql_query($sqlreg) or js_alert(mysql_error());

	js_alert("Datos guardados");
	echo "document.location = 'editcont.php';";
	
}

if($funcion=='ver_partida') ver_partida();

function ver_partida(){
	global $id;
	$sql = "SELECT * FROM ctpartida WHERE id=$id";
	$result = mysql_query($sql) or js_alert(mysql_error());
	$linia=mysql_fetch_array($result);
	foreach($linia as $n => $v) echo " $('#$n').val('".mysql_real_escape_string($v)."');";
}

if($funcion=='Guardar_partida') Guardar_partida();
function Guardar_partida()
{
		global $des_mercaderia,$codi_taric,$regim_aduaner,$peso,$valor_esta,$referencia,$coste,$manipulaciones,$granel,$bultos,$id, $partida;
		
		$sql = "UPDATE ctpartida SET partida='$partida', des_mercaderia='$des_mercaderia', codi_taric='$codi_taric', regim_aduaner='$regim_aduaner', peso='$peso', valor_esta='$valor_esta' , referencia='$referencia', coste='".str_replace(",",".",$coste)."', manipulaciones='$manipulaciones', granel='$granel', bultos=$bultos WHERE id = $id;";
		
	mysql_query($sql)  or js_alert(mysql_error());
	//js_alert($sql);
	js_alert("Datos guardados");
	echo "document.location = 'buscardua.php';";
	
}

if($funcion=='ver_dua') ver_dua();

function ver_dua(){
	global $id;
	$sql = "SELECT * FROM ctdua WHERE id_dua=$id";
	$result = mysql_query($sql) or js_alert(mysql_error());
	$linia=mysql_fetch_array($result);
	foreach($linia as $n => $v) echo " $('#$n').val('".mysql_real_escape_string($v)."');";
}

if($funcion=='Guardar_dua') Guardar_dua();

function Guardar_dua()
{
	global 	$numero,$tipo,$fecha,$fecha_prevista,$tipo_aduana,$tipo_declaracio,$num_formulari,$destinatario,$estatuto_aduanero,$id_dua;
	
	$sql = "UPDATE ctdua SET numero='$numero', tipo='$tipo', fecha='$fecha', fecha_prevista='$fecha_prevista',  tipo_aduana='$tipo_aduana', tipo_declaracio='$tipo_declaracio', num_formulari='$num_formulari', destinatario='$destinatario', estatuto_aduanero='$estatuto_aduanero' WHERE id_dua = $id_dua;";
		
	mysql_query($sql) or js_alert(mysql_error());
	//js_alert($sql);
	js_alert("Datos guardados");
	echo "document.location = 'buscardua.php?ndua_entrada=$numero';";
	
}

if($funcion=='comprobar_dua') comprobar_dua();

function comprobar_dua(){
	global $id;
	$sql = "SELECT count(*) as cont FROM ctdua WHERE numero='$id'";
	$result = mysql_query($sql) or js_alert(mysql_error());
	$linia=mysql_fetch_array($result);
	if($linia['cont']>0) js_alert("!!Este dua ya a sido introducido anteriormente!!");
	else js_alert("Este dua no existe en la base de datos.");	
}

if($funcion=='comprobar_partida') comprobar_partida();

function comprobar_partida(){
	global $id;
	$sql = "SELECT count(*) as cont FROM ctpartida WHERE partida='$id'";
	$result = mysql_query($sql) or js_alert(mysql_error());
	$linia=mysql_fetch_array($result);
	if($linia['cont']>0) js_alert("!!Esta partida ya a sido introducido anteriormente!!");
	else js_alert("Esta partida no existe en la base de datos.");	
}
	
?>