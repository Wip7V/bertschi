<?php 	include("config.php");	include("conexion.php");	 ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>GESTIÓN OPERACIONES CON CONTENEDORES</title>	<?php include("cabecera.inc"); ?><script type="text/javascript">		$(function () {			$.datepicker.setDefaults($.datepicker.regional["es"]);			$("#fecha_export").datepicker({firstDay: 1 });			$( "#fecha_export" ).datepicker( "option", "dateFormat", "dd/mm/yy" );			$("#fecha_dn").datepicker({firstDay: 1 });			$( "#fecha_dn" ).datepicker( "option", "dateFormat", "dd/mm/yy" );		});				</script>        </head><body><div id="principal">	<div class="titulo">    	Lame    </div>    <div class="separador"></div>    <div class="formulario">    	<div id="newcont">            <div style="padding:30px; color:#000; text-align:center">Seleciona contenedor </br>                <select id="ncont" name="ncont">                <option value=0>Selecciona contenedor</option>                       <?php 					   $consulta="SELECT codigo,aduana FROM ctcontenedor ORDER BY codigo";//					   $consulta="SELECT codigo,aduana FROM ctcontenedor WHERE codigo NOT IN (SELECT  ncontenedor as codigo FROM ctdua) AND codigo NOT IN (SELECT ncontenedor as codigo FROM ctexport)";					  muestra_contenedor($consulta);	?>	                 </select>           	</div>            <div align="center">            	<input type="button" value="Guardar" onclick="gcont(); $('#more_fields').hide();" />                 <input type="button" value="Cancelar" onclick="cancela()" />            </div>        </div>    	 <form method="post" id="form" action="formexpo.php" enctype="multipart/form-data">        	 <table class="tabla">                      <tr>            <td>Dispo Shipment:</td>            <td  class="lf"><input id="entrada_contenedor" name="entrada_contenedor" type="text" maxlength="21"></td>        </tr>         <tr>            <td>Certificado Exportación (DN):</td>            <td  class="lf"><input id="certif_export" name="certif_export" type="text" maxlength="21"></td>        </tr>         		        <tr>        	<td >Contenedor: <input type="button" id="more_fields" onclick="$('#newcont').show();$('#ncont').focus(); " value="Añadir contenedor" /> </td>                         <td  class="lf"><div id="content"><script>var cant = 0;</script>             </div></td>                   	        </tr>  		           <tr>            <td>Dua de Salida:</td>            <td><input type="text" id="dua_salida" name="dua_salida"/></td>          </tr>        <tr>            <td>Fecha Delivery Note:</td>            <td><input type="text" id="fecha_dn" name="fecha_dn"/></td>          </tr>          <tr>            <td>Fecha Export:</td>            <td><input type="text" id="fecha_export" name="fecha_export"/></td>          </tr>             <tr>        	<td>Archivo adjunto 1: </td>            <td class="archi"><input id="adjunto1" name="adjunto1" type="file" title="Seleccionar archivo"></td>        </tr>            	<tr>        	<td>Archivo adjunto 2: </td>            <td class="archi"><input id="adjunto2" name="adjunto2" type="file" title="Seleccionar archivo"></td>        </tr>         <tr>            <td>Tipo de aduana:</td>            <td class="lf">LAME<input id="tipo_aduana" name="tipo_aduana" type="hidden" value="LAME"></td>        </tr>                 <!--tr>            <td></td>            <td class="lf"><input value="Completar" type="button" id="mostra" name="mostra" class="boton" onClick="$('#ocult').show();"></td>        </tr-->       </table>  <div id="ocult">        <table class="tabla">        <tr>            <td>Tipo de salida:</td>            <td><select id="tipo_salida" name="tipo_salida">                <option value=0>Selecciona tipo de salida</option>                <option value="dua">DUA</option>                <option value="dvd">DVD</option>                <option value="t1">T-1</option>                <option value="otros">OTROS</option>                </select></td>        </tr>             <tr>            <td>Tipo de declaración(01):</td>            <td><select id="tipo_declaracio" name="tipo_declaracio">                <option value=0>Selecciona tipo de declaración</option>                <option value="EU">EU</option>                <option value="EX">EX</option>                                </select></td>        </tr>             <tr>            <td>Numero de formularios(Paginas DUA)(03):</td>            <td  class="lf"><input id="num_formulari" name="num_formulari" type="text" placeholder="000" maxlength="3"></td>        </tr>         <tr>            <td>Codigo TARIC(33):</td>            <td  class="lf"><input id="codi_taric" name="codi_taric" type="text" placeholder="0000000000" maxlength="10"></td>        </tr>         <tr>            <td>Regimen aduanero(37):</td>            <td  class="lf"><input id="regim_aduaner" name="regim_aduaner" type="text" placeholder="0000" maxlength="4"></td>        </tr>     	<tr>            <td>Peso total(35):</td>            <td  class="lf"><input id="pes_export" name="pes_export" type="text">Kg</td>        </tr>        <tr>            <td>Destinatario(08):</td>            <td  class="lf"><input id="destinatario" name="destinatario" type="text"></td>        </tr>        <tr>            <td>Valor Estadistico(46):</td>            <td  class="lf"><input id="valor_esta" name="valor_esta" type="text">€</td>        </tr>        <tr>            <td>Descripción de mercancia(31):</td>            <td  class="lf"><input id="des_mercaderia" name="des_mercaderia" type="text" maxlength="25"></td>        </tr>        </table>      </div>      <table class="tabla">          <tr>            <td align="center">                <input type="hidden" id="useract" name="useract" value="<?php echo $useract ?>"/>          	<input value="Guardar" type="button" id="enviarentra" name="enviarentra" class="boton" onClick="confirmaExport()">            </td>          </tr></table>        </form>        <script>$('#newcont').hide();$('#ocult').hide();</script>    </div>    <div class="separador"></div>        <div id="salir">         <?php include("binicio.inc"); ?>    </div></div><!-- cierre div principal --></body></html>