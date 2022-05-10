<?php 

include("config.php");
include("conexion.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LISTADO DE DUAS <?php echo date("d-m-Y H:i:s"); ?></title>

<?php 
	include("cabecera.inc");

?>

        <style>
        body{
			font-family: arial;
			background: #fff;
		}
        	table{
				font-size: 9px !important;
				border: none;
				margin: 0 auto;
			}
			thead{
				font-weight: bold;
			}
			td{
				color:#00f;
			}
			
			
        </style>
    </head>
    <body>
        <?php

        $consulta1 = "SELECT distinct(ctdua.id_dua), ctdua.* FROM ctdua, ctpartida, ctcontenedor, partida_contenedor WHERE partida_contenedor.partida = ctpartida.id AND partida_contenedor.contenedor = ctcontenedor.id AND ctdua.id_dua = ctpartida.duae OR ctdua.id_dua = ctpartida.duas ORDER BY id_dua DESC";
        $consulta_mysql = mysql_query($consulta1) or die("mysql error: ".mysql_error() );
		
        ?>
       <div >
            <div  style=" text-align: center; ">
   
                <?php while($item=mysql_fetch_array($consulta_mysql))
                { ?>
                <div style=" display: inline-block; border:solid 1px #000;">
                
             
            <table>
            <thead>
                <tr>

                <th width="80">Numero DUA</th>
                <th width="50">Tipo DUA</th>
                
                <th width="80">Fecha</th>
                <th width="80">Fecha<br> prevista</th>
                <th width="60">Tipo</th>
                <th width="40">Tipo aduana</th>
                <th width="40">Tipo declaracion</th>
                <th width="40">Numero<br> formulario</th>

                <th width="40">Destinatario</th>
                <th width="40">Estatuto<br> aduanero</th>

                <th width="60">Adjunt</th>


				</tr>
            </thead>
            <tbody>
                 <tr>
                 
                    <td ><?php echo $item['numero']; ?> </td>
                    <td ><?php if($item['entrada_salida']=='en') echo "Entrada"; else echo "Salida"; ?> </td>
                    
                    <td ><?php echo substr($item['fecha'],0,10); ?></td>
                    <td ><?php echo substr($item['fecha_prevista'],0,10); ?></td>
					<td ><?php echo $item['tipo']; ?></td>
                    <td ><?php echo $item['tipo_aduana']?></td>
                    <td ><?php echo $item['tipo_declaracio']?></td>
                    <td ><?php echo $item['num_formulari']?></td>


                    <td ><?php echo $item['destinatario']?></td>
                    <td ><?php echo $item['estatuto_aduanero']?></td>

                     <td ><?php 
                     if ($item['adjunt']!=''){
                     $nombre =split("/",$item['adjunt']);
                     echo "<a href='".$item['adjunt']."' target='_blank'>".$nombre[2]."</a>";
                     }
                     ?></td>

                    </td>
                </tr>
                            </tbody>
        </table>
        <br>
        
        <?php
        
             if($item['entrada_salida']=='en') $sql2 = "SELECT * FROM ctpartida WHERE duae = ".$item['id_dua'];
             if($item['entrada_salida']=='sa') $sql2 = "SELECT * FROM ctpartida WHERE duas = ".$item['id_dua'];
        			$rs = mysql_query($sql2) or die("mysql error: ".mysql_error() );
					 	while($item2=mysql_fetch_array($rs)){ 
        ?>
        
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
        		<?php
        		                    

                     

					 	echo "<tr>";
					 	echo "<td>".$item2['partida']."</td>";
					 	echo "<td>".$item2['des_mercaderia']."</td>";
					 	echo "<td>".$item2['codi_taric']."</td>";
					 	
						echo "<td>".$item2['referencia']."</td>";
					 	echo "<td>".$item2['manipulaciones']."</td>";
					 	echo "<td>".$item2['coste']."€</td>";
					 	echo "<td>".$item2['valor_esta']."€</td>";
					 	echo "<td>".$item2['regim_aduaner']."</td>";
					 	
					 	echo "<td>".$item2['bultos']."</td>";
					 	echo "<td>".$item2['granel']."</td>";
					 	echo "<td>".$item2['peso']."</td>";

					 	echo "</tr>";
					 	
					 
					 ?>
        	</tbody>
        </table>
        
        
        <table >
        	<thead>

        		<th>Contenedor</th>
        		<th>Fecha</th>
        		<th>Sector</th>
        		<th>Carril</th>
        		<th>Posicion</th>
        		<th>Piso</th>
        		<th>Antidumping</th>
        		<th>Arancel</th>
        		<th>Iva</th>
        		<th>Total</th>
        	</thead>
        	<tbody>
        		<?php
        		                    
                      $sql2 = "SELECT * FROM ctcontenedor, partida_contenedor WHERE partida_contenedor.contenedor = ctcontenedor.id AND partida_contenedor.partida = ".$item2['id'];
                    // echo $sql2;
                     //if($item['entrada_salida']=='sa') $sql2 = "SELECT * FROM ctcontenedor WHERE duas = ".$item['id_dua'];
                     
					 	$rs2 = mysql_query($sql2) or die("mysql error: ".mysql_error() );
					 	while($item3=mysql_fetch_array($rs2))
					 	{ 
					 	echo "<tr>";
					 	echo "<td>".$item3['codigo']."</td>";
					 	echo "<td>".$item3['fecha_entrada']."</td>";
					 	echo "<td>".$item3['sector']."</td>";
					 	echo "<td>".$item3['carril']."</td>";
					 	echo "<td>".$item3['posicio']."</td>";
					 	echo "<td>".$item3['pis']."</td>";
					 	echo "<td>".$item3['antidumping']."€</td>";
					 	echo "<td>".$item3['arancel']."€</td>";
					 	echo "<td>".$item3['iva']."€</td>";
					 	echo "<td>".$item3['total']."€</td>";
					 	echo "</tr>";
					 	}
					 
					 ?>
        	</tbody>
        </table><br>

                <?php } ?>
                </div><br><br>
				<?php } ?>

        
     
            </div>


        </div>
    </body>
</html>
