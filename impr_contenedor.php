<?php 

include("config.php");
include("conexion.php");

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$fini = $_GET['fini'];
$ffin = $_GET['ffin'];

$consulta1 = "select * from ctexport  WHERE STR_TO_DATE(fecha_export, '%d/%m/%Y') >= STR_TO_DATE('$fini', '%d/%m/%Y') AND STR_TO_DATE(fecha_export, '%d/%m/%Y') <= STR_TO_DATE('$ffin', '%d/%m/%Y') ORDER BY STR_TO_DATE(ctexport asc";
        //$consulta1 = "SELECT *  FROM ctexport ORDER BY id_export DESC LIMIT 0,145";
        $consulta_mysql = mysql_query($consulta1) or die("mysql error: ".mysql_error() );


$html = file_get_contents("plantilla_cab.html");
$html.="<h3>LISTADO LAME</h3>";
$html.="

                <table >
            <thead>
                <tr>

                <th>ID</th>
                <th>Entr. Cont.</th>
                <th>Cert. Exp.(DN)</th>
                <th>CONTENEDOR</th>
                <th>DUA Salida</th>
                <th>Fecha DN</th>
                <th>Fecha Export</th>

                


				</tr>
            </thead>
            <tbody>";
            
       while($item=mysql_fetch_array($consulta_mysql)){ 
        $html.="
                 <tr>
                 
                    <td >".$item['id_export']."</td>
                    <td >".$item['entrada_contenedor']." </td>
                    <td >".$item['certif_export']." </td>
                    <td >".$item['ncontenedor']."</td>
                    <td >".$item['dua_salida']."</td>
                    <td >".$item['fecha_dn']."</td>
                    <td >".$item['fecha_export']."</td>


                </tr>";
}
          $html."</tbody></table></body></html>";
          
          //echo $html;
          	//$dompdf = new Dompdf();
$dompdf_options = array(
    'chroot' => '/',
    'logOutputFile' => __DIR__ . '/dompdf.log.html',
    'isHtml5ParserEnabled' => true,
    'debugPng' => false,
    'debugKeepTemp' => false,
    'debugCss' => false,
    'debugLayout' => false,
    'debugLayoutLines' => false,
    'debugLayoutBlocks' => false,
    'debugLayoutInline' => false,
    'debugLayoutPaddingBox' => false
);


$dompdf = new Dompdf($dompdf_options);

	$dompdf->loadHtml($html);
	$dompdf->setPaper('A4'); // (Opcional) Configurar papel y orientación
	$dompdf->render(); // Generar el PDF desde contenido HTML
	$pdf = $dompdf->output(); // Obtener el PDF generado
	//$dompdf->stream(); // Enviar el PDF generado al navegador
	$dompdf->stream("ListadoLame.pdf", array("Attachment" => false));
	//echo $html;
        
?>

