// JavaScript Document
function mostrardiv() {

div = document.getElementById('salida');

div.style.display ='';

}

function ocultardiv() {

div = document.getElementById('salida');

div.style.display='none';

}

function cambiarsub() {
	carga = $("estado").val();
	if (carga == "cargado"){
		document.form.subest.hidden.true();
		}
	
	}
function validarEntero(valor){
      valor = parseInt(valor)
      if (isNaN(valor)) {
            return ""
      }else{
            return valor
      }
}
function validarNumero(c_numero)
	{
		//chequeo la longitud de c_numero:
		// Si (c_numero.length es igual a Cero) quiere decir que c_numero es una cadena Vacía.
		// Si (c_numero.length es distinto(mayor) de Cero) podemos asegurar que c_numero contiene por lo menos una letra
		//a la cual se le puede hacer la validación
		if (c_numero.length == 0)
		{
			return "NaN";
		}
		else
		{
			//Se recorre c_numero por todos sus caracteres chequeando que todos sean dígitos
			//la condición >="0" y <="9" es basada en el valor ascii que tienen los números en la tabla ascii.
			//Si alguno de los caracteres no es un número la función retornará un NaN
			//Si no retornará el Número
			for (i = 0; i < c_numero.length; i++)
			{
				if (!((c_numero.charAt(i) >= "0") && (c_numero.charAt(i) <= "9")))
					return "NaN";
			}
			return c_numero;
		}
	}

function cod(){
    letra = $("#letra").val();
	num1 = $("#num1").val(); 
	num2 = $("#num2").val();
	codi = letra+num1+"-"+num2;
	$("#codigo").val(codi);
	document.form.codi.value=codi;
}

function confirmaSalida()
{
		fechasal = $("#fechasalida").val();
		if (fechasal == ""){
		   alert("Tiene que escoger una fecha")
		   $("#fechasalida").focus();
		
		   return false;
		}
	
	alert("Datos guardados")
	$('#guarsal').submit();

}
function confirma()
{
	
    //$('#form').submit(); return 0;
	
	letra = $("#letra").val();
	num1 = $("#num1").val(); 
	num2 = $("#num2").val();
	estado = $("#estado").val(); 
	subest = $("#subest").val(); 
	sector = $("#sector").val();
	fechaent = $("#fechaent").val();
	codigo = $("#codigo").val();
  	vnum1 = validarNumero(num1);
    vnum2 = validarNumero(num2);
	     
		if (letra == 0){
		   alert("Tiene que escoger un grupo de letras del codigo")
		   $("#letra").focus();
		
		   return false;
		}
		
		if (estado == 0){
		   alert("Tiene que escoger un estado")
		   $("#estado").focus();
		
		   return false;
		}
		if (sector == 0){
		   alert("Tiene que escoger un sector")
		   $("#sector").focus();
		
		   return false;
		}
		if (estado == "vacio"){
		   if (subest == 0){
			   alert("Tiene que escoger un subestado")
		   	   $("#subest").focus();	
		   		return false;
		   }
		}
				
		if (num1 == "" || num1 != vnum1 || num1.length!=6){
		   alert("Tiene que escribir un numero contenedor valido")
		   $("#num1").focus();
		
		   return false;
		}
		if (num2 == "" || num2 != vnum2 || num2.length!=1){
		   alert("Tiene que escribir un numero contenedor valido")
		   $("#num2").focus();
		
		   return false;
		}
		if (fechaent == ""){
		   alert("Tiene que escoger una fecha")
		   $("#fechaent").focus();
		
		   return false;
		}
	
	alert("Datos guardados")
	$('#form').submit();

}

function carga(){
	$('#formsal').submit();
}
