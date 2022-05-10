<?php 
	require_once('xajax_core/xajax.inc.php');
	include("config.php");
	include("conexion.php");
$xajax = new xajax();

$xajax->register(XAJAX_FUNCTION, 'Modifica');
$xajax->register(XAJAX_FUNCTION, 'Elimina');

function Modifica($camp, $id)
	{
		ob_start(); //per a retornar un string amb tots els errors
		$respuesta = new xajaxResponse();
		
		
		$sql="SELECT * FROM ctregistro WHERE id=$id";
		//echo $sql;
		$result=mysql_query($sql) or die("error: ".mysql_error() );
		$linia=mysql_fetch_array($result);
		
		if($linia[$camp]==0) $valor=1;
		else $valor=0;
		
		//echo $linia[$camp];
		
		$sql="UPDATE ctregistro SET ".$camp."=".$valor." WHERE id=".$id."";
		mysql_query($sql);
		
		$respuesta->Replace($camp.$id,"innerHTML",$camp.$linia[$camp], $camp.$valor);
			
		$phperror ="<pre>".ob_get_clean()."</pre>";
		$respuesta->Assign("error_php","innerHTML",$phperror);
		
		return $respuesta;
	}
	
function Elimina($id)
	{
		ob_start(); //per a retornar un string amb tots els errors
		$respuesta = new xajaxResponse();
		
		$sql="DELETE FROM ctregistro WHERE id=".$id."";
		mysql_query($sql);
		$respuesta->Script("document.location = document.URL;");
		//echo $sql;
		

		$phperror ="<pre>".ob_get_clean()."</pre>";
		$respuesta->Assign("error_php","innerHTML",$phperror);
		
		return $respuesta;
	}
$xajax->processRequest();

	$sql="SELECT * FROM ctuser WHERE nombre='".$useract."'";
	$result=mysql_query($sql, $conexion) or die("error: ".mysql_error() );
	$row=mysql_fetch_row($result);
	$privilegios=$row[3];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GESTIÓN OPERACIONES CON CONTENEDORES</title>
	<?php include("cabecera.inc"); ?>
        <script type="text/javascript" charset="utf-8">
            var oTable;

            $(document).ready(function() {
				
				$('#example tbody tr').hover( function() {
				var iCol = $('tr').index(this) % 5;
				var nTrs = oTable.fnGetNodes();
				$('tr:nth-child('+(iCol+1)+')', nTrs).addClass( 'highlighted' );
				}, function() {
					var nTrs = oTable.fnGetNodes();
					$('tr.highlighted', nTrs).removeClass('highlighted');
				} );
				oTable = $('#example').dataTable( {
				"aLengthMenu": [[25, 50, 100, 500, -1], [25, 50, 100, 500, "Todos"]],
				"aaSorting": [[ 0, "desc" ]],
				//"sPaginationType": "full_numbers",
				"bSortClasses": false,
				"iDisplayLength": 25
				} );
            } );

            
			function Modifica(camp, id)
			{
				$('#'+camp+id).src()
				xajax_Modifica(camp,id);	
			}
			
			function Eliminar($id)
			{
				if(confirm('Desitja esborrar aquestes dades?'))
				{
					xajax_Elimina($id);
    	            //setTimeout("window.location=document.URL;",500);
            	}	
			}
			function imprSelec(muestra)
			{
				var ficha=document.getElementById(muestra);
				var ventimp=window.open(' ','popimpr');
				ventimp.document.write(ficha.innerHTML);
				ventimp.document.close();
				ventimp.print();
				ventimp.close();
			}

        </script>

</head>

<body>
<div id="principal2">
	<div class="titulo">
    	REGISTRO DE CONTENEDORES
    </div>
    <div class="separador"></div>
   

    <div id="entrada">
    <form method="post" id="form" action="registro.php" enctype="multipart/form-data">
    <table  class="tabla">
    <tr>    
            <td><select id="letra" name="letra">
                <option value=0>Letras</option>
                 <?php 
					$sql="SELECT * FROM ctletra ORDER BY id";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						echo "<option value='".$dades['letra']."'>".$dades['letra']."</opcion> ";
					}
					?>						  
			 	</select>
                <input id="num1" name="num1" placeholder="000000" size="6" type="text" maxlength="6"/>-<input id="num2" name="num2" placeholder="0"type="text" size="1" maxlength="1"/></td>
            <td><select id="sector" name="sector">
                <option value=0>Selecciona sector</option>
                 <?php 
					$sql="SELECT * FROM ctsector ORDER BY id";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						if ($dades['numero'] != NULL) echo "<option value='".$dades['numero']."'>".$dades['numero']."</opcion> ";
					}
					?>						  
			 	</select></td>
                 <td><select id="aduana" name="aduana">
                <option value="">Selecciona aduana</option>
                <option value=0>NO</option>
                <option value=1>SI</option>
                <option value=2>IIEE</option>
                </td>
     </tr>
    <tr>
            <td><select id="estado" name="estado">
                <option value=0>Selecciona Estado</option>
                <option value="cargado">Cargado</option>
                <option value="vacio">vacio</option></select></td>

            <td><select id="subestado" name="subestado">
                <option value=0>Selecciona Subestado</option>
                <option value="limpio">Limpio</option>
                <option value="sucio">Sucio</option></select></td>
            
<!--            <td><select id="dua_id" name="dua_id">
                <option value=0>Selecciona dua_id</option>
                 <?php 
					/*$sql="SELECT DISTINCT ndua_entrada FROM ctdua ORDER BY ndua_entrada";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						if ($dades['ndua_entrada'] != NULL) echo "<option value='".$dades['ndua_entrada']."'>".$dades['ndua_entrada']."</opcion> ";
					}*/
					?>						  
			 	</select></td> -->
            
    </tr>
    <tr>
            <td><select id="fecha_entrada" name="fecha_entrada">
                <option value=0>Fecha Entrada</option>
                 <?php 
					$sql="SELECT DISTINCT fecha_entrada FROM ctregistro ORDER BY fecha_entrada";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						if ($dades['fecha_entrada'] != NULL) echo "<option value='".$dades['fecha_entrada']."'>".$dades['fecha_entrada']."</opcion> ";
					}
					?>						  
			 	</select></td> 
            <td><select id="user_entrada" name="user_entrada">
                <option value=0>Usuario Entrada</option>
                 <?php 
					$sql="SELECT DISTINCT user_entrada FROM ctregistro ORDER BY id";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						if ($dades['user_entrada'] != NULL) echo "<option value='".$dades['user_entrada']."'>".$dades['user_entrada']."</opcion> ";
					}
					?>						  
			 	</select></td>
    </tr>
    <tr>
            <td><select id="fecha_salida" name="fecha_salida">
                <option value=0>Fecha Salida</option>
                 <?php 
					$sql="SELECT DISTINCT fecha_salida FROM ctregistro ORDER BY fecha_salida";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						if ($dades['fecha_salida'] != NULL) echo "<option value='".$dades['fecha_salida']."'>".$dades['fecha_salida']."</opcion> ";
					}
					?>						  
			 	</select></td> 
            <td><select id="user_salida" name="user_salida">
                <option value=0>Usuario Salida</option>
                 <?php 
					$sql="SELECT DISTINCT user_salida FROM ctregistro ORDER BY id";
					$result=mysql_query($sql) or die("error: ".mysql_error() );
					while($dades=mysql_fetch_array($result))
					{
						if ($dades['user_salida'] != NULL) echo "<option value='".$dades['user_salida']."'>".$dades['user_salida']."</opcion> ";
					}
					?>						  
			 	</select></td>
        </tr>
        <tr> <td colspan="2" align="center"> 
        	<input type="submit" value="Buscar" class="boton" /> 
<!--            
			   	<input value="Imprimir" type="button" class="boton" onClick="window.print()"/> 
-->            
				<input value="Imprimir" type="button" class="boton" onClick="imprSelec('impres')"/>
            </td></tr>
        </table>
        </form>
           
            <div class="separador"></div>

           <div id="impres">
        <table  id="example">
            <thead>
                <tr>
                <th ></th>
                <th width="20">ID</th>
                <th width="180">contenedor</th>
                <th width="180">Estado</th>
                <th width="180">Subestado</th>
                <th width="180">Sector</th>
                <th width="180">Fecha Entrada</th>
                <th width="180">User Entrada</th>
                <th width="180">Fecha Salida</th> 
                <th width="180">User Salida</th>
                <th width="180">Carril</th> 
                <th width="180">Posicion</th>
                <th width="180">Piso</th>
                <th width="180">Adjunto</th>
                <th width="180">Aduana</th>
<!--
                <th width="180">ID DUA</th>
-->                <th ></th>
			</tr>
            </thead>
            <tbody>
        <?php
		$sqlselect="SELECT * FROM ctregistro WHERE 0";
		//$sqlselect="";
		//var_dump($_POST);
		$tamaño = count($_POST);
		//echo "<br> $tamaño";
		if ($tamaño>0)
		{
			$sqlselect="";
			foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);
//			echo "<br> Filtro --> ";
/*
			$letra = $_POST['letra'];
			$num1 = $_POST['num1'];
			$num2 = $_POST['num2'];
			$estado = $_POST['estado'];
			$subestado = $_POST['subestado'];
			$sector = $_POST['sector'];
			$fechaent = $_POST['fecha_entrada'];
			$userent = $_POST['user_entrada'];
			$fechasal = $_POST['fecha_salida'];
			$usersal = $_POST['user_salida'];
*/
			$consulta="0";
			$contenedor="";
			
			if($letra!="0"){$contenedor=$letra."%";}
			if($num1!=""){$contenedor.="%$num1%";}
			if($num2!=""){$contenedor.="%$num2";}
						
			if ($contenedor!=""){$consulta="WHERE contenedor LIKE '$contenedor' ";}
//				echo " Contenedor = ".$contenedor." / ";
			
			if($estado!="0")
			{
//				echo "estado = ".$estado." / ";
				if ($consulta!="0"){$consulta.="AND estado='$estado' ";
				}else{$consulta="WHERE estado='$estado' ";}
			}
			if($subestado!="0")
			{
//				echo "subestado = ".$subestado." / ";
				if ($consulta!="0"){$consulta.="AND subestado='$subestado' ";
				}else{$consulta="WHERE subestado='$subestado' ";}
			}
			if($sector!="0")
			{
//				echo "sector = ".$sector." / ";
				if ($consulta!="0"){$consulta.="AND sector='$sector' ";
				}else{$consulta="WHERE sector='$sector' ";}
			}
			if($fecha_entrada!="0")
			{
//				echo "fecha_entrada = ".$fechaent." / ";
				if ($consulta!="0"){$consulta.="AND fecha_entrada='$fecha_entrada' ";}
				else {$consulta="WHERE fecha_entrada='$fecha_entrada' ";}
			}
			if($user_entrada!="0")
			{
//				echo "user_entrada = ".$userent." / ";
				if ($consulta!="0"){$consulta.="AND user_entrada='$user_entrada' ";
				}else{$consulta="WHERE user_entrada='$user_entrada' ";}
			}
			if($fecha_salida!="0")
			{
//				echo "fecha_salida = ".$fechasal." / ";
				if ($consulta!="0") {$consulta.="AND fecha_salida='$fecha_salida' ";
				}else{$consulta="WHERE fecha_salida='$fecha_salida' ";}
			}
			
			if($user_salida!="0")
			{
//				echo "user_salida = ".$usersal;
				if ($consulta!="0"){$consulta.="AND user_salida='$user_salida' ";
				}else{$consulta="WHERE user_salida='$user_salida' ";}
			}
			if($aduana!="")
			{
//				echo "user_salida = ".$usersal;
				if ($consulta!="0"){$consulta.="AND aduana='$aduana' ";
				}else{$consulta="WHERE aduana='$aduana' ";}
			}
/*			if($dua_id!="")
			{
//				echo "user_salida = ".$usersal;
				if ($consulta!="0"){$consulta.="AND aduana='$aduana' ";
				}else{$consulta="WHERE aduana='$aduana' ";}
			}
*/
//			echo "<br>consulta >> ".$consulta;
			if ($consulta!="0") $sqlselect="SELECT * FROM ctregistro $consulta ORDER by id";
//			echo "<br>select >> ".$sqlselect; 
		}
        $result=mysql_query($sqlselect, $conexion);
		
		$num_rows = mysql_num_rows($result);
		if ($num_rows==0){
			echo "<tr><td colspan='9' align='center'><h1>Esta combinación no ha dado ningún resultado</h1></td></tr>";

		}else{
			 while($item=mysql_fetch_array($result)){ ?>
                 <tr>
                    <?php
						if ($privilegios!=2) {
							?>
					<td align="center"><a href="formregis.php?id=<?php echo $item['id']; ?>" title="Editar" ><img src="img/editar.png" border="0" /></a></td>
                    <?php
						}else{
					
					?>
                    <td align="center" valign="top" ></td>

 					 <?php	}?>
<!--                    <td align="center"><img src="img/eliminar.png" title="Borrar" onclick="javascript:Eliminar(<?php echo $item['id']; ?>);" />
                    </td>
 -->                   <td align="center" valign="top"><?php echo $item['id']; ?></td>
                    <td align="center" valign="top"><?php if($item['aduana']==1){echo '<span style="color:#F00">'.$item['contenedor'].'</span>';}else{echo $item['contenedor'];} ?> </td>
					<td align="center" valign="top"><?php echo $item['estado']; ?></td>
                    <td align="center" valign="top"><?php echo $item['subestado']; ?></td>
                    <td align="center" valign="top"><?php echo $item['sector']; ?></td>
                    <td align="center" valign="top"><?php echo $item['fecha_entrada']; ?></td>
                    <td align="center" valign="top"><?php echo $item['user_entrada']; ?></td>
                    <td align="center" valign="top"><?php echo $item['fecha_salida']; ?></td>
                    <td align="center" valign="top"><?php echo $item['user_salida']; ?></td>
                    <td align="center" valign="top"><?php echo $item['carril']; ?></td>
					<td align="center" valign="top"><?php echo $item['posicio']; ?></td>
                    <td align="center" valign="top"><?php echo $item['pis']; ?></td>
                    <td align="center" valign="top"><a href="/contenedor/archivos/contenedor/<?php echo $item['adjunt']; ?>"><?php echo $item['adjunt']; ?></a></td>
                    <td align="center" valign="top"><?php echo $item['aduana']; ?></td>
<!--
                    <td align="center" valign="top"><?php echo $item['dua_id']; ?></td>
-->
                    <?php
						if ($privilegios!=2) {
							?>
					<td align="center"><a href="formregis.php?id=<?php echo $item['id']; ?>" title="Editar" ><img src="img/editar.png" border="0" /></a></td>
                    <?php
						}else{
					
					?>
                    <td align="center" valign="top" ></td>

 					 <?php	}?>
					
<!--                     <td align="center"><img src="img/eliminar.png" title="Borrar" onclick="javascript:Eliminar(<?php echo $item['id']; ?>);" /></td>
 -->                </tr>
                    
		  <?php } }?>
        </tbody>
    </table>
    	</div>
    </div>
    <div class="separador"></div>
    
    <div id="salir">
         <?php include("binicio.inc"); ?>
    </div>

</div><!-- cierre div principal -->
</body>
</html>