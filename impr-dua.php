<?php 

include("config.php");
include("conexion.php");

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

       $consulta1 = "SELECT distinct(ctdua.id_dua), ctdua.* FROM ctdua, ctpartida, ctregistro, partida_contenedor WHERE partida_contenedor.partida = ctpartida.id AND partida_contenedor.contenedor = ctregistro.id_contenedor AND ctdua.id_dua = ctpartida.duae OR ctdua.id_dua = ctpartida.duas ORDER BY id_dua DESC";
        $consulta_mysql = mysql_query($consulta1) or die("mysql error: ".mysql_error() );

$html = file_get_contents("plantilla_cab.html");		
$html.="<h3>REGISTRO DE DUA / PARTIDA</H3>";
$html.="<div style='background-color: #000; height: 3px;'></div><br>";
                while($item=mysql_fetch_array($consulta_mysql))
                { 
                
            $html.="
            <strong>".$item['numero']."</strong></br>
            <table class='dua' >
            <thead>
                <tr>

                <th >Tipo DUA</th>
                
                <th >Fecha</th>
                <th >Fecha<br> prevista</th>
                <th >Tipo</th>
                <th >Tipo aduana</th>
                <th >Tipo declaracion</th>
                <th >Numero<br> formulario</th>

                <th >Destinatario</th>
                <th >Estatuto<br> aduanero</th>



				</tr>
            </thead>
            <tbody>
                 <tr>
                 
                     
                    <td >";
                     if($item['entrada_salida']=='en') $html.="Entrada"; else $html.="Salida";
                    $html.=" </td>
                    
                    <td >".substr($item['fecha'],0,10)."</td>
                    <td >".substr($item['fecha_prevista'],0,10)."</td>
					<td >".$item['tipo']."</td>
                    <td >".$item['tipo_aduana']."</td>
                    <td >".$item['tipo_declaracio']."</td>
                    <td >".$item['num_formulari']."</td>


                    <td >".$item['destinatario']."</td>
                    <td >".$item['estatuto_aduanero']."</td>

    
                </tr>
                            </tbody>
        </table>

        
        ";

             if($item['entrada_salida']=='en') $sql2 = "SELECT ctpartida.*, ctdua.numero FROM ctpartida, ctdua WHERE duae = id_dua AND duae = ".$item['id_dua'];
             if($item['entrada_salida']=='sa') $sql2 = "SELECT ctpartida.*, ctdua.numero FROM ctpartida, ctdua WHERE duae = id_dua AND duas = ".$item['id_dua'];
        			$rs = mysql_query($sql2) or die("mysql error: ".mysql_error() );
					 	while($item2=mysql_fetch_array($rs)){ 
        $html.="
        
        <table >
        	<thead>
        		<th>Partida</th>
        		<th>Descripción</th>
        		<th>Codigo Taric</th>

				<th>Referencia</th>
				<th>Manipulaciones</th>
        		<th>Coste Manipulaciones</th>
        		<th>Valor Estadistico</th>
        		<th>Regimen Aduanero</th>
        		
        		<th>Bultos</th>
        		<th>Granel</th>
        		<th>Peso</th>

        	</thead>
        	<tbody>
        		
        		                    

                     

					 	<tr>
					 	<td>".$item2['numero']." - ".$item2['partida']."</td>
					 	<td>".$item2['des_mercaderia']."</td>
					 	<td>".$item2['codi_taric']."</td>
					 
						<td>".$item2['referencia']."</td>
					 	<td>".$item2['manipulaciones']."</td>
					 	<td>".$item2['coste']."€</td>
					 	<td>".$item2['valor_esta']."€</td>
					 	<td>".$item2['regim_aduaner']."</td>
					 	
					 	<td>".$item2['bultos']."</td>
					 	<td>".$item2['granel']."</td>
					 	<td>".$item2['peso']."</td>

					 	</tr>
					 	
					 
					
        	</tbody>
        </table>
        
        
        <table  >
        	<thead>
        		<th>Contenedor</th>
        		<th>Fecha</th>
        		<th>Sector</th>
        		<th>Antidumping</th>
        		<th>Arancel</th>
        		<th>Iva</th>
        		<th>Total</th>
        		<th>Fecha Salida</th>
        	</thead>
        	<tbody>
        		";
	                   
                      $sql2 = "SELECT ctregistro.* FROM ctregistro, partida_contenedor WHERE partida_contenedor.contenedor = ctregistro.id_contenedor AND partida_contenedor.partida = ".$item2['id'];
                    // echo $sql2;
                     //if($item['entrada_salida']=='sa') $sql2 = "SELECT * FROM ctcontenedor WHERE duas = ".$item['id_dua'];
                     
					 	$rs2 = mysql_query($sql2) or die("mysql error: ".mysql_error() );
					 	while($item3=mysql_fetch_array($rs2))
					 	{ 
					 	$html.="<tr>";
					 	$html.="<td>".$item3['contenedor']."</td>";
					 	$html.="<td>".$item3['fecha_entrada']."</td>";
					 	$html.="<td>".$item3['sector']."</td>";
					 	$html.="<td>".$item3['antidumping']."€</td>";
					 	$html.="<td>".$item3['arancel']."€</td>";
					 	$html.="<td>".$item3['iva']."€</td>";
					 	$html.="<td>".$item3['total']."€</td>";
					 	$html.="<td>".$item3['fecha_salida']."</td>";
					 	$html.="</tr>";
					 	}
					 
					 
        	$html.="</tbody>  </table><br>";

               }
                $html.="<div style='background-color: #000; height: 3px;'></div><br>";
				 } 
       // echo $html;
                 $html."</tbody></table><span class='page-number'>Page </span></body></html>";
          
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

/*$_dompdf_show_warnings = true;
$_dompdf_debug = false;
$_DOMPDF_DEBUG_TYPES = [
   'page-break' => false
];*/
$dompdf = new Dompdf($dompdf_options);

	$dompdf->loadHtml($html);
	$dompdf->setPaper('A4', 'landscape'); // (Opcional) Configurar papel y orientación
	$dompdf->render(); // Generar el PDF desde contenido HTML
	$pdf = $dompdf->output(); // Obtener el PDF generado
	//$dompdf->stream(); // Enviar el PDF generado al navegador
	$dompdf->stream("ListadoDuas.pdf", array("Attachment" => false));
	//echo $html;
 ?>


