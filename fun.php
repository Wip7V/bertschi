<?php
function muestra_contenedor($consulta)
{
	include("conexion.php");
	if ($consulta=="")
	{	
		$consulta="SELECT * FROM ctcontenedor ORDER BY codigo";
	}
	$result=mysql_query($consulta) or die("error: ".mysql_error() );
	while($dades=mysql_fetch_array($result))
	{
		if($dades['aduana']==1)
		{
			echo "<option value='".$dades['codigo']."' style='color:#F00'>".$dades['codigo']."</opcion> ";
		}else{
			echo "<option value='".$dades['codigo']."'>".$dades['codigo']."</opcion> ";
		}
	}
}
function muestra_contenedor_iiee($consulta)
{
	include("conexion.php");
	if ($consulta=="")
	{	
		$consulta="SELECT * FROM ctcontenedor ORDER BY codigo";
	}
	$result=mysql_query($consulta) or die("error: ".mysql_error() );
	while($dades=mysql_fetch_array($result))
	{
		if($dades['aduana']==2)
		{
			echo "<option value='".$dades['codigo']."' style='color:#F00'>".$dades['codigo']."</opcion> ";
		}else{
			echo "<option value='".$dades['codigo']."'>".$dades['codigo']."</opcion> ";
		}
	}
}

function carga_contenedor($id){
	$consulta="SELECT codigo FROM ctcontenedor WHERE id=$id ORDER BY codigo";
	$result=mysql_query($consulta) or die("error: ".mysql_error() );
	
	return $result;
	
}

function zerofill($entero, $largo){
    // Limpiamos por si se encontraran errores de tipo en las variables
    $entero = (int)$entero;
    $largo = (int)$largo;
     
    $relleno = '';
     
    /**
     * Determinamos la cantidad de caracteres utilizados por $entero
     * Si este valor es mayor o igual que $largo, devolvemos el $entero
     * De lo contrario, rellenamos con ceros a la izquierda del número
     **/
    if (strlen($entero) < $largo) {
        $relleno = str_repeat('0',$largo–strlen($entero));
    }
    return $relleno . $entero;
}
function fechaes($fecha) {
  return implode("-", array_reverse( preg_split("/\D/", $fecha) ) );
} 
function mostrar_fecha(){
	$fecha = new DateTime('now');
	echo $fecha->format('d/m/Y');
}

function exportar($consulta, $archivo){
	$result=mysql_query($consulta) or die("error: ".mysql_error() );
	$name="C:/Documents and Settings/User/Escritorio/exportIE/".$archivo.".txt";
	$file = fopen($name, "w");
	
	while($item=mysql_fetch_array($result)){ 
               $linia= $item['epifiscal']."\t".$item['codigonc']."\t".$item['producto']."\t".$item['fecha_entrada']."\t".$item['caeprovee']."\t".$item['arc']."\t".$item['litros15c']."\t".$item['fecha_salida']."\t".$item['documento']."\t".$item['num_dispo']."\t".$item['nif_destino']."\t".$item['nom_destino']."\t".$item['regimen']."\t - \t - \t ";
			   fwrite($file, $linia . PHP_EOL);

			   
                }

	fclose($file);
	echo '<script language="javascript">alert("Se ha generado el archivo '.$name.'");</script>';
		
}



?>