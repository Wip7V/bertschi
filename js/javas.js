// JavaScript Documentfunction mostrardiv() {div = document.getElementById('salida');div.style.display ='';}function ocultardiv() {div = document.getElementById('salida');div.style.display='none';}function validarEntero(valor){      valor = parseInt(valor);      if (isNaN(valor)) {            return ""      }else{            return valor      }}function cod(){    letra = $("#letra").val();	num1 = $("#num1").val(); 	num2 = $("#num2").val();	codi = letra+num1+"-"+num2;	$("#codigo").val(codi);	document.form.codi.value=codi;}function confirmaSalida(){		fechasal = $("#fechasalida").val();		if (fechasal == ""){		   alert("Tiene que escoger una fecha");		   $("#fechasalida").focus();				   return false;		}		alert("Datos guardados");	$('#guarsal').submit();}function confirma(){	    //$('#form').submit(); return 0;	//	letra = $("#letra").val();//	num1 = $("#num1").val(); //	num2 = $("#num2").val();	estado = $("#estado").val(); 	subest = $("#subest").val(); 	sector = $("#sector").val();	fechaent = $("#fechaent").val();	codigo = $("#codigo").val();	comprobar = $("#comprobar").val(); // 	vnum1 = validarEntero(num1);//    vnum2 = validarEntero(num2);		if (comprobar != "COMPROBADO"){		   alert("Tiene que comprobar si existe el contenedor");		   $("#contenedor").focus();				   return false;		}	     		if (codigo == ""){		   alert("Tiene que introducir un codigo");		   $("#contenedor").focus();				   return false;		}		if (estado == 0){		   alert("Tiene que escoger un estado");		   $("#estado").focus();				   return false;		}		if (estado == "vacio"){		   if (subest == 0){			   alert("Tiene que escoger un subestado");		   	   $("#subest").focus();			   		return false;		   }		}						if (fechaent == ""){		   alert("Tiene que escoger una fecha");		   $("#fechaent").focus();				   return false;		}/*		if (sector == 0){		   alert("Tiene que escoger un sector");		   $("#sector").focus();				   return false;		}			if (num1 == "" || num1 != vnum1 || num1.length!=6){		   alert("Tiene que escribir un numero contenedor valido");		   $("#num1").focus();				   return false;		}		if (num2 == "" || num2 != vnum2 || num2.length!=1){		   alert("Tiene que escribir un numero contenedor valido");		   $("#num2").focus();				   return false;		}		*/		alert("Datos guardados");	$('#form').submit();}function confirmadua(){		ndentra = $("#ndua_entrada").val();		fecha_dua = $("#fecha_dua").val();		tipo_salida= $("#tipo_salida").val();				if(!document.querySelector('#cont1')){			alert("No hay partida seleccionada");			return 0;		}			if (ndentra == ""){		   alert("Tiene que introducir un numero de DUA");		   $("#ndua_entrada").focus();		   return false;		}		if (fecha_dua == ""){		   alert("Tiene que escoger una fecha");		   $("#fecha_dua").focus();		   return false;		}		if (tipo_salida == ""){		   alert("Tiene que escoger un tipo de salida");		   $("#tipo_salida").focus();		   return false;		}			alert("Datos guardados");	$('#form').submit();}function confirmaSalDua(){		ndentra = $("#ndua_salida").val();		fecha_dua = $("#fecha_salida").val();		tipo_salida= $("#tipo_salida").val();				if(!document.querySelector('#cont1')){			alert("No hay partida seleccionada");			return 0;		}				if (ndentra == ""){		   alert("Tiene que introducir un numero de DUA");		   $("#ndua_salida").focus();		   return false;		}		if (fecha_dua == ""){		   alert("Tiene que escoger una fecha");		   $("#fecha_salida").focus();			   return false;		}	alert("Datos guardados");	$('#form').submit();}function confirmaExport(){		nexport1 = $("#nexport1").val();		fecha_export = $("#fecha_export").val();		if (nexport1 == ""){		   alert("Tiene que introducir un numero de Dispo");		   $("#nexport1").focus();			   return false;		}		if (fecha_export == ""){		   alert("Tiene que escoger una fecha");		   $("#fecha_export").focus();				   return false;		}	alert("Datos guardados");	$('#form').submit();}function confirmaiiee(){		arc = $("#arc").val();		fecha_entrada = $("#fecha_entrada").val();		tipo_salida= $("#tipo_salida").val();		epifiscal= $("#epifiscal").val();		ncont= $("#ncont").val();		codigonc = $("#codigonc").val();		caeprovee = $("#caeprovee").val();		comprobar = $("#comprobar").val();		producto = $("#producto").val();		if (arc == ""){		   alert("Tiene que introducir un numero de ARC");		   $("#arc1").focus();				   return false;		}		if (comprobar != "COMPROBADO"){		   alert("Tiene que comprobar si existe el contenedor");		   $("#contenedor").focus();				   return false;		}		if (codigonc == ""){		   alert("Tiene que introducir un codigo NC");		   $("#codigonc").focus();				   return false;		}		if (caeprovee == ""){		   alert("Tiene que introducir un CAE proveedor");		   $("#caeprovee").focus();				   return false;		}		if (fecha_entrada == ""){		   alert("Tiene que escoger una fecha");		   $("#fecha_entrada").focus();				   return false;		}		if (epifiscal == "0"){		   alert("Tiene que escoger un epigrafe fiscal");		   $("#epifiscal").focus();				   return false;		}		if (ncont == "0"){		   alert("Tiene que escoger un contenedor");		   $("#ncont").focus();				   return false;		}		if (producto == "0"){		   alert("Tiene que escoger un producto");		   $("#producto").focus();				   return false;		}	alert("Datos guardados");	$('#form').submit();}function confirmaSaliiee(){		regimen = $("#regimen").val();		fecha_salida = $("#fecha_salida").val();		nif_destino= $("#nif_destino").val();		nom_destino= $("#nom_destino").val();		num_dispo= $("#num_dispo").val();		documento= $("#documento").val();						if (documento == "0"){		   alert("Tiene que escoger una clase de documento");		   $("#documento").focus();				   return false;		}		if (regimen == "0"){		   alert("Tiene que escoger un regimen fiscal");		   $("#regimen").focus();				   return false;		}		if (fecha_salida == ""){		   alert("Tiene que escoger una fecha");		   $("#fecha_salida").focus();				   return false;		}		if (nif_destino == ""){		   alert("Tiene que introducir el NIF del destinatario");		   $("#nif_destino").focus();				   return false;		}		if (nom_destino == ""){		   alert("Tiene que introducir el nombre del destinatario");		   $("#nom_destino").focus();				   return false;		}		if (num_dispo == ""){		   alert("Tiene que introducir el numero de dispo");		   $("#num_dispo").focus();				   return false;		}	alert("Datos guardados");	$('#form').submit();}function carga(){	$('#formsal').submit();}function add_fields() {   var d = document.getElementById("content");   d.innerHTML += "<br><select id='cont1' name='cont1'> <option value=0>Selecciona contenedor</option> <?php muestra_contenedor();	?> </select>";}function gcont(){	var d = document.getElementById("content");	cant++;	ncont=$('#ncont').val();	ref=cant;	if (ncont != ""){		//codcont=<?php carga_contenedor(ncont);?>;		$(document).css('cursor','progress');//		d.innerHTML += "<br><input id='" + ref + "' name='" + ref + "' type='hidden' value='" + ncont + "'><input type='text' placeholder='" + codcont + "' disabled='disabled'>" + ref;		d.innerHTML += "<br><input id='cont" + ref + "' name='cont" + ref + "' type='text' value='" + ncont + "'  readonly>" + ref;		$('#newcont').hide();	}else{		alert("has de escribir un nombre de club");		}}function cancela(){	$('#newcont').hide();}function aduanacomp(){	aduana = $("#aduana").val();	if (aduana == 1){ 		$('#aduan').show();	}else{		$('#aduan').hide();	}}function imprSelec(muestra){	var ficha=document.getElementById(muestra);	var ventimp=window.open(' ','popimpr');	ventimp.document.write(ficha.innerHTML);	ventimp.document.close();	ventimp.print();	ventimp.close();} function datenow(){	var f = new Date();	var dn = (f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());	document.write(dn);}function cambiarsub() {	cargas = $("#estado").val();	if (cargas == "vacio"){			$('#subesta').show();		}else{			$('#subesta').hide();		}}function adrshow() {	cargas = $("#adr").val();	if (cargas == 1){			$('#adrplus').show();		}else{			$('#adrplus').hide();		}}