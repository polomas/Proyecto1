function mueveReloj(){
    momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()
horaImprimible = hora + ":" + minuto + ":" + segundo
 document.form_reloj.reloj.value = horaImprimible
setTimeout("mueveReloj()",1000)}

function registra_cliente(){
  document.getElementById('form_modal').submit();
}


function buscarCedulaCliente(){
var cedulaBuscar=document.getElementById("TxtCedula");
var verificar=true;
	if (!cedulaBuscar.value) {
		
		alert(".::|Ingrese la Cedula Del Cliente|::.");
		cedulaBuscar.focus();
		verificar=false;
	}else if (isNaN(cedulaBuscar.value)) {
		alert(".::|La cedula Debe Ser Númerica|::.");
		cedulaBuscar.focus();
		cedulaBuscar.value="";
		 verificar=false;
	}
	else if (cedulaBuscar.value<999999) {
		alert(".::|Error en la cedula|::.");
		cedulaBuscar.focus();
		verificar=false;}
		if (verificar) {
			document.getElementById("Buscar_X_Cedula").submit();
		};

}

function pulsar(e) {
  tecla = (document.all) ? e.keyCode :e.which;
  return (tecla!=13);
} 
function buscarCodigoProducto(){
var codigo=document.getElementById("TxtCodPro");
var verificar=true;
	if (!codigo.value) {
		
		alert(".::|Ingrese el codigo Del Producto|::.");
		codigo.focus();
		verificar=false;
	}else if (isNaN(codigo.value)) {
		alert(".::|El Codigo Debe Ser Númerico|::.");
		codigo.focus();
		codigo.value="";
		 verificar=false;
	}
	else if (codigo.value<1) {
		alert(".::|Error en el codigo|::.");
		codigo.focus();
		verificar=false;}
		if (verificar) {
			document.getElementById("Buscar_X_Codigo").submit();
		};

}

function agregarCarrito(){
	var verificar=true;
var stock=document.getElementById("TxtStock");
var cantidad=document.getElementById("TxtCant");
var cant=document.getElementById("kcantidad");

 if (!cantidad.value) {
	alert("|Debes Seleccionar La Cantidad|");
	TxtCant.focus();

	verificar=false;
}else if (cantidad.value>0) {
	cant.value=cantidad.value;
		
};

if (verificar) { document.getElementById('form_carrito').submit();}

}

function Mregistrar(){
	var verificar=true;
	var expR=/([A-Z][A-Z-Ñ]{2,})([A-Z-Ñ]{0,})+$/;
	var tipo= document.getElementById('tipoN').val();
	var cedula= document.getElementById('Mcedula');
	var nombre= document.getElementById('Mnombre');
	var apellido= document.getElementById('Mapellido');
	var fecha_nac= document.getElementById('fecha1');
	var genero= document.getElementById('genero');
	var direccion= document.getElementById('Mdireccion');
var telefono= document.getElementById('Mtelefono');
var Ctlf= document.getElementById('Stele');
var nacionalidad= document.getElementById('nacion');


	if (!cedula.value) {
		alert("Debes especificar la cedula");
		cedula.focus();
		verificar=false;
	}else if (isNaN(cedula.value)) {
		alert("|la cedula debe Ser Numerica|");
		cedula.focus();
			cedula.value="";
		verificar=false;
	}else if(!nombre.value){
alert("Debes especificar el nombre");
		nombre.focus();
		verificar=false;
	}else if (!expR.exec(nombre.value)) {
		alert("|el Nombre debe Contener solo letras| \n .:Y En Mayuscula.:");
		nombre.focus();
		verificar=false;
	}else if(!apellido.value){
alert("Debes especificar el Apellido");
		apellido.focus();
		verificar=false;
	}else  if (!expR.exec(apellido.value)) {
		alert("|el Apellido debe Contener solo letras| \n .:Y Debe Comenzar Por letra Mayuscula.:");
		apellido.focus();
		verificar=false;
	}else  if (!nacionalidad.value) {
alert("Debes Elegir una nacionalidad");
		nacionalida.focus();
		verificar=false;
	}else if (!fecha_nac.value) {
		alert("Debes especificar el la fecha de Nacimiento");
		fecha_nac.focus();
		verificar=false;
	}else if (!genero.value) {
		alert("Debes Elegir un Genero");
		genero.focus();
		verificar=false;
	}else if (!direccion.value) {
		alert(".:Debes ingresar Una direccion:.");
		direccion.focus();
		verificar=false;
	}else if (telefono.value && !Ctlf.value) {
			alert(".:Debes Seleccionar Codigo Telefonico de acuerdo a tu pais:.");
			Ctlf.focus();
	verificar=false;
		}else if (Ctlf.value && !telefono.value) {
			alert(".:Tienes Seleccionado un Codigo Telefonico y el campo numero esta vacio:.");
	verificar=false;};

		if (verificar) {
      // document.getElementById('form_modal').submit();
		}

	
}

function finalizarV(){
document.getElementById('btnFinalizarvta').disabled=true;
document.getElementById('Btnfacturar').disabled=true;
alert('.:Facturacion Realizada Con Exito:.\n Elija si desea guardar la factura o cancelar\n...:LUEGO:...\n\n PRESIONE CANCELAR');
document.getElementById('form_fin').submit();

}
function validar_producto(){
	var verificar = true; 
	var nombre=document.getElementById('nombre_producto');
	var categoria=document.getElementById('categoria');
	var stock=document.getElementById('cantidad');
	var costo=document.getElementById('costo_pro');
	var precio=document.getElementById('precio_pro');
	var expR=/([A-Z-0-9]{1,})+$/;
	if(!nombre.value){
		alert("|.:Debes Especificar un nombre:.|");
		verificar=false;
		nombre.focus();

}else if (!expR.exec(nombre.value)) {
alert("|El Nombre del Producto debe Ser En Mayuscula.:");
		verificar=false;
		nombre.focus();
}else if (!categoria.value) {
	alert("|.:Debes Seleccionar Una Categoria");
		verificar=false;
		categoria.focus();
}else if (!stock.value) {
	alert("|.:Debes Seleccionar la cantidad de Productos\n que se van a ingresar \n al inventario");
		verificar=false;
		stock.focus();
}else if(!costo.value){
		alert("|.:Debes Especificar un costo:.|");
		verificar=false;
		costo.focus();

}else if (isNaN(costo.value)) {
	alert("|.:Error:El costo solo puede contener numeros");
		verificar=false;
		costo.focus();
		costo.value="";
}else if(!precio.value){
		alert("|.:Debes Especificar un precio:.|");
		verificar=false;
		precio.focus();

}else if (isNaN(precio.value)) {
	alert("|.:Error:El costo solo puede contener numeros");
		verificar=false;
		precio.focus();
		precio.value="";
}
if (verificar) {
	alert('El producto ha sido Comprobado Satisfactoriamente\n Proceda a Registrar en el boton |Registrar Producto| ');
	document.getElementById('btnRegistarPro').disabled=false;
}

}//____FIN validar_producto_______
function registrar_pro(){
	var verificar=true;
	var codigo=document.getElementById('codigo_pro');
	var nombre=document.getElementById('nombre_producto');
	var categoria=document.getElementById('categoria');
	var stock=document.getElementById('cantidad');
	var costo=document.getElementById('costo_pro');
	var precio=document.getElementById('precio_pro');
	var expR=/([A-Z-0-9]{1,})+$/;
	if(!nombre.value){
		alert("|.:Debes Especificar un nombre:.|");
		verificar=false;
		nombre.focus();

}else if (!expR.exec(nombre.value)) {
alert("|El Nombre del Producto debe Ser En Mayuscula.:");
		verificar=false;
		nombre.focus();
}else if (!categoria.value) {
	alert("|.:Debes Seleccionar Una Categoria");
		verificar=false;
		categoria.focus();
}else if (!stock.value) {
	alert("|.:Debes Seleccionar la cantidad de Productos\n que se van a ingresar \n al inventario");
		verificar=false;
		stock.focus();
}else if(!costo.value){
		alert("|.:Debes Especificar un costo:.|");
		verificar=false;
		costo.focus();

}else if (isNaN(costo.value)) {
	alert("|.:Error:El costo solo puede contener numeros");
		verificar=false;
		costo.focus();
		costo.value="";
}else if(!precio.value){
		alert("|.:Debes Especificar un precio:.|");
		verificar=false;
		precio.focus();

}else if (isNaN(precio.value)) {
	alert("|.:Error:El costo solo puede contener numeros");
		verificar=false;
		precio.focus();
		precio.value="";
}
if (verificar) {
var rj = confirm("\t.:Por Favor Confirme!:.\nDesea Registrar el Siguiente Producto.\n\n codigo:\t"+codigo.value+"\nArticulo:\t"+nombre.value+"\ncategoria:\t"+categoria.value+"\nStock:\t"+stock.value+"\nCosto:\t"+costo.value+"\nPrecio:\t"+precio.value);
    if (rj == true ) {
   document.getElementById('form_registro_pro').submit();
    } 
}
}

function categoria(){

var categoria =document.getElementById('inputEmail3');
var verificar=true;
var expR=/([A-Z]{3,})+$/;

if (!categoria.value) {
alert("|.:Error Al Registrar Categoria");
		verificar=false;
			categoria.focus();
}else if (!expR.exec(categoria.value)) {
verificar=false;
categoria.value="";
	categoria.focus();
alert("|.:Error Al Registrar Categoria\n No puede Contener Numeros");

	
}

if (verificar) {
	var rp=confirm("\tPorfavor Confirme\n Desea Registrar La Siguiente Categoria\n\nCategoria:\t"+categoria.value);
	if (rp) {document.getElementById('form_categoria').submit();}
	
}
}
/*-------------------------------------------------------------*/
function categoria2(){

var categoria =document.getElementById('inputEmail32');
var verificar=true;
var expR=/([A-Z]{3,})+$/;

if (!categoria.value) {
alert("|.:Error Al Registrar Categoria");
		verificar=false;
			categoria.focus();
}else if (!expR.exec(categoria.value)) {
verificar=false;
categoria.value="";
	categoria.focus();
alert("|.:Error Al Registrar Categoria\n No puede Contener Numeros");

	
}

if (verificar) {
	var rp=confirm("\tPorfavor Confirme\n Desea Registrar La Siguiente Categoria\n\nCategoria:\t"+categoria.value);
	if (rp) {document.getElementById('form_categoria2').submit();}
	
}
}

function validar_empleado(){

var verificar=true;
var cedula=document.getElementById('cedula_emp');
var nombre=document.getElementById('nombre_emp');
var apellido=document.getElementById('apellido_emp');
var apellido2=document.getElementById('sapellido_emp');
var nombre2=document.getElementById('snombre_emp');
var cargo=document.getElementById('cargo_emp');
var fecha=document.getElementById('fecha_nac_emp');
var email=document.getElementById('email_emp');
var email2=document.getElementById('email_emp2');
var cod=document.getElementById('codigoTlf_emp');
var tlf=document.getElementById('tlf_emp');
var direccion=document.getElementById('direccion_emp');
var nacionalidad=document.getElementById('nacionalidad_emp');
var genero=document.getElementById('genero_emp');
var estado_civil=document.getElementById('estado_civil');
var titulo=document.getElementById('grado_inst');
var ocupacion=document.getElementById('ocupacion');


var valEmail=/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/
	var expR=/([aA-zZ-])+$/;
	
if (!cedula.value) {
alert('Debes Especificar la cedula');
verificar=false;
cedula.focus();
}else if (isNaN(cedula.value)) {
	alert('La Cedula Debe Ser Numerica, Sin Letras Ni Espacios En balnco');
cedula.focus();
verificar=false;
cedula.value="";
}else if (cedula.value<1000000) {
	alert('Error en la cedula');
verificar=false;
cedula.focus();
}else if (!nombre.value) {
alert('Debes Especificar el nombre');
verificar=false;
nombre.focus();
}else if (!expR.exec(nombre.value)) {
alert('el nombre solo debe contener letras');
nombre.focus();
verificar=false;
nombre.value="";
}else if (nombre2.value && !expR.exec(nombre2.value)) {
      
alert('el nombre solo debe contener letras');
nombre2.focus();
nombre2.value="";
verificar=false;

}else if (!fecha.value) {
alert('Debes Elegir una fecha de nacimiento');
fecha.focus();
verificar=false;
fecha.value="";
}else if (!apellido.value) {
alert('Debes Especificar el Primer Apellido');
verificar=false;
apellido.focus();
}else if (apellido2.value && !expR.exec(apellido2.value)) {
      
alert('el segundo apellido solo debe contener letras');
apellido2.focus();
apellido2.value="";
verificar=false;
}else if (!cargo.value) {
alert('Debes Elegir un Cargo');
cargo.focus();
verificar=false;
}else if (!email.value) {
alert('Debes especificar un Email');
verificar=false;
email.focus();
}else if (!valEmail.exec(email.value)) {
alert('El Email que ha introducido es Incorrecto');
email.focus();
email.value="";
verificar=false;
}else if (!cod.value) {
alert('Debes Elegir un codigo de pais');
verificar=false;
cod.focus();
}else if(!tlf.value){
alert('Debes Especidicar un numero Telefonico');
verificar=false;
tlf.focus();
}else if (isNaN(tlf.value)) {
alert('El Número Telefonico debe ser Numerico');
tlf.focus();
verificar=false;
tlf.value="";	
}else if (!genero.value) {
alert('|..:Debes Seleccionar un Genero:..|');
genero.focus();
verificar=false;
}else if (!email2.value) {
alert('Debes Repetir el email');
email2.focus();
verificar=false;
}else if (!valEmail.exec(email2.value)) {
alert('El Email que ha introducido es Incorrecto');
email2.focus();
verificar=false;
}else if (email.value!=email2.value ) {
alert('Los email Son diferentes');
email2.focus();
email2.value="";
verificar=false;
}else if (!estado_civil.value) {
alert('|..:Debes Seleccionar un Estado Civil:..|');
estado_civil.focus();
verificar=false;
}else if (!titulo.value) {
alert('|..:Debes Seleccionar un Grado de Instruccion:..|');
titulo.focus();
verificar=false;
}
else if (!ocupacion.value) {
alert('|..:Debes Seleccionar Una ocupación :..|');
ocupacion.focus();
verificar=false;
}
else if (!direccion.value) {
alert('Debes Especidicar Una Direccion');
verificar=false;
direccion.focus();
}else if (!nacionalidad.value) {
	alert('Debes Elegir una nacionalidad');
nacionalidad.focus();
verificar=false;
}else 
if (verificar) {
	var rp=confirm("\t Confirme...\n Esta Seguro(a) de Registrar\n\n NOTA: si acepta no podra modificarlo");
	if (rp) {	document.getElementById('btnRegistarEmp').disabled=false;

alert('..::LOS DATOS SON CORRECTOS::..');

}
}
}

function registrar_emp(){

var verificar=true;
var cedula=document.getElementById('cedula_emp');
var nombre=document.getElementById('nombre_emp');
var apellido=document.getElementById('apellido_emp');
var apellido2=document.getElementById('sapellido_emp');
var nombre2=document.getElementById('snombre_emp');
var cargo=document.getElementById('cargo_emp');
var fecha=document.getElementById('fecha_nac_emp');
var email=document.getElementById('email_emp');
var email2=document.getElementById('email_emp2');
var cod=document.getElementById('codigoTlf_emp');
var tlf=document.getElementById('tlf_emp');
var direccion=document.getElementById('direccion_emp');
var nacionalidad=document.getElementById('nacionalidad_emp');
var genero=document.getElementById('genero_emp');
var estado_civil=document.getElementById('estado_civil');
var titulo=document.getElementById('grado_inst');
var ocupacion=document.getElementById('ocupacion');


var valEmail=/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/
	var expR=/([aA-zZ-])+$/;
	
if (!cedula.value) {
alert('Debes Especificar la cedula');
verificar=false;
cedula.focus();
}else if (isNaN(cedula.value)) {
	alert('La Cedula Debe Ser Numerica, Sin Letras Ni Espacios En balnco');
cedula.focus();
verificar=false;
cedula.value="";
}else if (cedula.value<1000000) {
	alert('Error en la cedula');
verificar=false;
cedula.focus();
}else if (!nombre.value) {
alert('Debes Especificar el nombre');
verificar=false;
nombre.focus();
}else if (!expR.exec(nombre.value)) {
alert('el nombre solo debe contener letras');
nombre.focus();
verificar=false;
nombre.value="";
}else if (nombre2.value && !expR.exec(nombre2.value)) {
      
alert('el nombre solo debe contener letras');
nombre2.focus();
nombre2.value="";
verificar=false;

}else if (!fecha.value) {
alert('Debes Elegir una fecha de nacimiento');
fecha.focus();
verificar=false;
fecha.value="";
}else if (!apellido.value) {
alert('Debes Especificar el Primer Apellido');
verificar=false;
apellido.focus();
}else if (apellido2.value && !expR.exec(apellido2.value)) {
      
alert('el segundo apellido solo debe contener letras');
apellido2.focus();
apellido2.value="";
verificar=false;
}else if (!cargo.value) {
alert('Debes Elegir un Cargo');
cargo.focus();
verificar=false;
}else if (!email.value) {
alert('Debes especificar un Email');
verificar=false;
email.focus();
}else if (!valEmail.exec(email.value)) {
alert('El Email que ha introducido es Incorrecto');
email.focus();
email.value="";
verificar=false;
}else if (!cod.value) {
alert('Debes Elegir un codigo de pais');
verificar=false;
cod.focus();
}else if(!tlf.value){
alert('Debes Especidicar un numero Telefonico');
verificar=false;
tlf.focus();
}else if (isNaN(tlf.value)) {
alert('El Número Telefonico debe ser Numerico');
tlf.focus();
verificar=false;
tlf.value="";	
}else if (!genero.value) {
alert('|..:Debes Seleccionar un Genero:..|');
genero.focus();
verificar=false;
}else if (!email2.value) {
alert('Debes Repetir el email');
email2.focus();
verificar=false;
}else if (!valEmail.exec(email2.value)) {
alert('El Email que ha introducido es Incorrecto');
email2.focus();
verificar=false;
}else if (email.value!=email2.value ) {
alert('Los email Son diferentes');
email2.focus();
email2.value="";
verificar=false;
}else if (!estado_civil.value) {
alert('|..:Debes Seleccionar un Estado Civil:..|');
estado_civil.focus();
verificar=false;
}else if (!titulo.value) {
alert('|..:Debes Seleccionar un Grado de Instruccion:..|');
titulo.focus();
verificar=false;
}
else if (!ocupacion.value) {
alert('|..:Debes Seleccionar Una ocupación :..|');
ocupacion.focus();
verificar=false;
}
else if (!direccion.value) {
alert('Debes Especidicar Una Direccion');
verificar=false;
direccion.focus();
}else if (!nacionalidad.value) {
	alert('Debes Elegir una nacionalidad');
nacionalidad.focus();
verificar=false;
}else if (verificar) {
document.getElementById('form_registro_emp').submit();


}

}

function modificar_emp(){

var verificar=true;
var cedula=document.getElementById('cedula_emp');
var nombre=document.getElementById('nombre_emp');
var apellido=document.getElementById('apellido_emp');
var cargo=document.getElementById('cargo_emp');
var fecha=document.getElementById('fecha_nac_emp');
var email=document.getElementById('email_emp');
var tlf=document.getElementById('tlf_emp');
var direccion=document.getElementById('direccion_emp');
var nacionalidad=document.getElementById('nacionalidad_emp');
var genero=document.getElementById('genero_emp');
var estado_civil=document.getElementById('edo_civil_emp');
var titulo=document.getElementById('grado_emp');
var ocupacion=document.getElementById('ocupacion_emp');


var valEmail=/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/
	var expR=/([aA-zZ-])+$/;
	
if (!cedula.value) {
alert('Debes Especificar la cedula');
verificar=false;
cedula.focus();
}else if (isNaN(cedula.value)) {
	alert('La Cedula Debe Ser Numerica, Sin Letras Ni Espacios En balnco');
cedula.focus();
verificar=false;
cedula.value="";
}else if (cedula.value<1000000) {
	alert('Error en la cedula');
verificar=false;
cedula.focus();
}else if (!nombre.value) {
alert('Debes Especificar los nombre');
verificar=false;
nombre.focus();
}else if (!expR.exec(nombre.value)) {
alert('el nombre solo debe contener letras');
nombre.focus();
verificar=false;
nombre.value="";
}else  if (!fecha.value) {
alert('Debes Elegir una fecha de nacimiento');
fecha.focus();
verificar=false;
fecha.value="";
}else if (!apellido.value) {
alert('Debes Especificar los Apellido');
verificar=false;
apellido.focus();
}else if (!cargo.value) {
alert('Debes Elegir un Cargo');
cargo.focus();
verificar=false;
}else if (!email.value) {
alert('Debes especificar un Email');
verificar=false;
email.focus();
}else if (!valEmail.exec(email.value)) {
alert('El Email que ha introducido es Incorrecto');
email.focus();
email.value="";
verificar=false;
}else  if(!tlf.value){
alert('Debes Especidicar un numero Telefonico');
verificar=false;
tlf.focus();
}else if (direccion.value=="") {
alert('Debes Especidicar Una Direccion');
verificar=false;
direccion.focus();
}else if (verificar) {
	alert('\t¡Exito!.. Procesando Datos ..');
document.getElementById('form_modificar_emp').submit();


}

}		

function modificar_cliente(){

var verificar=true;
var cedula=document.getElementById('cedula_clt');
var nombre=document.getElementById('nombre_clt');
var apellido=document.getElementById('apellido_clt');
var fecha=document.getElementById('fecha_nac_clt');
var tlf=document.getElementById('tlf_clt');
var direccion=document.getElementById('direccion_clt');

var valEmail=/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/
	var expR=/([aA-zZ])+$/;
	if (isNaN(cedula.value)) {
		alert('La cedula debe ser numerica,sin letras,ni espacios en blanco');
		cedula.value="";
		cedula.focus();
		verificar=false;
	}else if (!nombre.value) {
alert('Debes Especificar un nombre!');
	nombre.focus();
		verificar=false;
	}else if (!expR.exec(nombre.value)) {
alert('Hay errores en el nombre!');
	nombre.focus();
		verificar=false;
	}else if (!apellido.value) {
alert('Debes Especificar un apellido!');
	apellido.focus();
		verificar=false;
	}else if (!expR.exec(apellido.value)) {
alert('Hay errores en el apellido!');
	apellido.focus();
		verificar=false;
	}else if (!fecha_nac_clt.value) {
		alert('Debes Especificar una Fecha de Nacimiento!');
	fecha_nac_clt.focus();
		verificar=false;
	}else if (!tlf.value) {
		alert('Debes Especificar un telefono de contacto!');
	tlf.focus();
		verificar=false;
	}else if (!direccion.value) {
		alert('Debes Especificar una direccion!');
	direccion.focus();
		verificar=false;
	}
	if (verificar) {
		document.getElementById('form_modificar_clt').submit();
	}
}

function new_administrador(){

var verificar=true;
var cedula=document.getElementById('cedula_emp');
var nombre=document.getElementById('nombre_emp');
var apellido=document.getElementById('apellido_emp');
var apellido2=document.getElementById('sapellido_emp');
var nombre2=document.getElementById('snombre_emp');
var cargo=document.getElementById('cargo_emp');
var fecha=document.getElementById('fecha_nac_emp');
var email=document.getElementById('email_emp');
var email2=document.getElementById('email_emp2');
var cod=document.getElementById('codigoTlf_emp');
var tlf=document.getElementById('tlf_emp');
var direccion=document.getElementById('direccion_emp');
var nacionalidad=document.getElementById('nacionalidad_emp');
var genero=document.getElementById('genero_emp');
var estado_civil=document.getElementById('estado_civil');
var titulo=document.getElementById('grado_inst');
var ocupacion=document.getElementById('ocupacion');
var usr=document.getElementById('usuario');
var clave=document.getElementById('clave');
var clave2=document.getElementById('clave2');


var valEmail=/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
	var expR=/([aA-zZ])+$/;
	
var ex=/([aA0-zZ9]{7,})+$/;

if (!cedula.value) {
alert('Debes Especificar la cedula');
verificar=false;
cedula.focus();
}else if (isNaN(cedula.value)) {
	alert('La Cedula Debe Ser Numerica, Sin Letras Ni Espacios En balnco');
cedula.focus();
verificar=false;
cedula.value="";
}else if (cedula.value<1000000) {
	alert('Error en la cedula');
verificar=false;
cedula.focus();
}else if (!nombre.value) {
alert('Debes Especificar el nombre');
verificar=false;
nombre.focus();
}else if (!expR.exec(nombre.value)) {
alert('el nombre solo debe contener letras');
nombre.focus();
verificar=false;
nombre.value="";
}else if (nombre2.value && !expR.exec(nombre2.value)) {
      
alert('el nombre solo debe contener letras');
nombre2.focus();
nombre2.value="";
verificar=false;

}else if (!fecha.value) {
alert('Debes Elegir una fecha de nacimiento');
fecha.focus();
verificar=false;
fecha.value="";
}else if (!apellido.value) {
alert('Debes Especificar el Primer Apellido');
verificar=false;
apellido.focus();
}else if (apellido2.value && !expR.exec(apellido2.value)) {
      
alert('el segundo apellido solo debe contener letras');
apellido2.focus();
apellido2.value="";
verificar=false;
}else if (!usr.value) {
		alert('Debes Especificar un Usuario');
usr=false;
usr.focus();
	}else if (!ex.exec(usr.value)) {
		alert('el usuario debe contener almenos 7 caracteres');
usr=false;
usr.focus();
	}else if (!clave.value) {
		alert('Debes Introducir una Contraseña');
verificar=false;
clave.focus();
	}else if (clave.value!=clave2.value) {
		alert('Las contraseñas no coinciden');
verificar=false;
clave2.focus();
clave2.value="";
	}else if (!cargo.value) {
alert('Debes Elegir un Cargo');
cargo.focus();
verificar=false;
}else if (!email.value) {
alert('Debes especificar un Email');
verificar=false;
email.focus();
}else if (!valEmail.exec(email.value)) {
alert('El Email que ha introducido es Incorrecto');
email.focus();
email.value="";
verificar=false;
}else if (!cod.value) {
alert('Debes Elegir un codigo de pais');
verificar=false;
cod.focus();
}else if(!tlf.value){
alert('Debes Especidicar un numero Telefonico');
verificar=false;
tlf.focus();
}else if (isNaN(tlf.value)) {
alert('El Número Telefonico debe ser Numerico');
tlf.focus();
verificar=false;
tlf.value="";	
}else if (!genero.value) {
alert('|..:Debes Seleccionar un Genero:..|');
genero.focus();
verificar=false;
}else if (!email2.value) {
alert('Debes Repetir el email');
email2.focus();
verificar=false;
}else if (!valEmail.exec(email2.value)) {
alert('El Email que ha introducido es Incorrecto');
email2.focus();
verificar=false;
}else if (email.value!=email2.value ) {
alert('Los email Son diferentes');
email2.focus();
email2.value="";
verificar=false;
}else if (!estado_civil.value) {
alert('|..:Debes Seleccionar un Estado Civil:..|');
estado_civil.focus();
verificar=false;
}else if (!titulo.value) {
alert('|..:Debes Seleccionar un Grado de Instruccion:..|');
titulo.focus();
verificar=false;
}
else if (!ocupacion.value) {
alert('|..:Debes Seleccionar Una ocupación :..|');
ocupacion.focus();
verificar=false;
}
else if (!direccion.value) {
alert('Debes Especidicar Una Direccion');
verificar=false;
direccion.focus();
}else if (!nacionalidad.value) {
	alert('Debes Elegir una nacionalidad');
nacionalidad.focus();
verificar=false;
}else if (verificar) {
document.getElementById('form_registro_emp').submit();


}

}