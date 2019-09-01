function buscarCedula(){
	var verificar=true;
	var cedulaBuscar=document.getElementById("cedulaBuscar");

	if (!cedulaBuscar.value) {
		alert(".::|Ingrese la Cedula Del Cliente|::.");
		cedulaBuscar.focus();
		var verificar=false;
	}else if (isNaN(cedulaBuscar.value)) {
		alert(".::|La Cedula Del Cliente Debe Ser Numerica|::.");
		cedulaBuscar.focus();
		cedulaBuscar.value="";
		var verificar=false;

	}else if (cedulaBuscar.value<10000) {
		alert(".::|Error en la Cedula Del Cliente|::.");
		
		cedulaBuscar.focus();
		var verificar=false;
	}
	

	if (verificar) {

		document.getElementById("buscar_X_cedula").submit();
	
	}
}


function buscarpro(){


	var verificar=true;
	var productoBuscar=document.getElementById("buscarPro");

	if (!productoBuscar.value) {
		alert(".::|Ingrese El Codigo del Producto|::.");
		productoBuscar.focus();
		var verificar=false;
	}else if (isNaN(productoBuscar.value)) {
		alert(".::|El Codigo  Del Producto Debe Ser Numerico|::.");
		productoBuscar.focus();
		productoBuscar.value="";
		var verificar=false;

	}else if (productoBuscar.value <100000) {
		alert(".::|Error en la Codigo Del Producto codigos a partir de=100000 6 caracteres|::.");
		productoBuscar.focus();
		var verificar=false;
	}
	

	if (verificar) {

		document.getElementById("buscar_pro").submit();
	
	}
	}

function aggClt(){
var verificar=true;
var cedula=document.getElementById("cedula");
var nombre=document.getElementById("nombre");
var apellido=document.getElementById("apellido");

var genero=document.getElementById("camposg");
var tlf=document.getElementById("campostc");
var ctlf=document.getElementById("campost");
var area=document.getElementById("direccion");
var expR=/^[A-Za-záéíóúñ]{2,}([\][A-Za-záéíóúñ]{2,})+$/;
var exptlf=/^[0-9]{7}$/;

var expctlf=/^[0]{1}[24]{1}[1-9]{1}[0-9]{1}$/;

 
if (!cedula.value) {
	alert(".::|Especifique una Cedula::.|");
	verificar=false;
	cedula.focus();
}
else if (isNaN(cedula.value)) {
	alert(".::|Error la Cedula Debe Ser Numerica|::.");
	verificar=false;
	cedula.focus();
	cedula.value="";
}
else
	if (cedula.value<10000) {

alert(".::|Error la Cedula|::.");
	verificar=false;
	cedula.focus();
	cedula.value="";
	}

else
if (!nombre.value) {
alert("|Debes Especificar un nombre");
verificar=false;
	nombre.focus();
	
}else
if (!expR.exec(nombre.value)) {

	alert(".::|El nombre no debe contener espacios en blanco|::.");
	verificar=false;
	nombre.focus();
	nombre.value="";
}else
if (!apellido.value) {
alert("|Debes Especificar un apellido");
verificar=false;
	apellido.focus();
	
}else
if (!expR.exec(apellido.value)) {

	alert(".::|El apellido no debe contener espacios en blanco ni numeros|::.");
	verificar=false;
	apellido.focus();

}else

if (genero.options[genero.selectedIndex].value == "0")

 {
   
	alert(".::|Debes elegir Un genero|::.");
	verificar=false;
	genero.focus();
	
}else if (isNaN(ctlf.value)) {
	alert(".::|Error la código Debe Ser Numerico|::.");
	verificar=false;
	ctlf.focus();
	ctlf.value="";
}else	if (ctlf.value) {

if (!expctlf.exec(ctlf.value)) {

	alert(".::|Error de Codigo de telefono|::.");
	verificar=false;
	ctlf.focus();
	ctlf.value="";
}else
if (!tlf.value) {
alert(".::|Debes ingresar Un telefono|::.");
	verificar=false;
	tlf.focus();

}
else 
	if (!exptlf.exec(tlf.value)) {

	alert(".::|Error de telefono 'Incompleto'|::.");
	verificar=false;
	tlf.focus();
	tlf.value="";

}



}else 
if (!(tlf.value) && (ctlf.value) ) {
alert(".::|Debes ingresar numero de telefono|::.");
	verificar=false;
	tlf.focus();
}else if (!(ctlf.value) && (tlf.value) ) {

	alert(".::|Debes ingresar codigo del telefono|::.");
	verificar=false;
	ctlf.focus();
}

else 

if (isNaN(tlf.value)) {
	alert(".::|Error el Telefono Debe Ser Numerico|::.");
	verificar=false;
	tlf.focus();
	tlf.value="";

}

else
if (!(area.value)) {
	alert(".::|Debes Introducir Una direccion|::.");
	verificar=false;
	area.focus();
	
}else
if ((area.value).length>150) {
	alert(".::|sobrepaso el limite de caracteres|::.");
	verificar=false;
	area.focus();
	area.value="";
}








if (verificar) {
document.getElementById("reg_pro").submit();
}

}

function search(){

document.getElementById("searchp").submit();
document.getElementById("btnsearch").submit();

}

function limpiar(){

document.getElementById("btnlinpiar").reset();

}



function ventaPro(){
var verificacion=true;
var producto=document.getElementById("nombre_pro2");
var codi=document.getElementById("codigo");
var existencia=document.getElementById("stock");
var cantidad=document.getElementById("cant");


if (!cantidad.value) {
	alert("especifique una cantidad");
	cantidad.focus();
	cantidad.value="";
	verificacion=false;
}else
if (isNaN(cantidad.value)) {
		alert(".::La cantidad Debe Ser numerica::.");
	cantidad.focus();
	cantidad.value="";
	verificacion=false;
}else 
if (cantidad.value<1) {
		alert(".::La cantidad Debe Ser mayor a 0::.");
	cantidad.focus();
	cantidad.value="";
	verificacion=false;
}else

if ((cantidad.value)>(existencia.value)) {

	alert(".::Esa cantidad no se encuentra en el inventario::.");
	cantidad.focus();
	cantidad.value=existencia.value;
	verificacion=false;
}
if (verificacion) {
var rj = confirm(".:Por Favor Confirme!:.\nDesea Ingresar a La factura.\n\n codigo: "+codi.value+"\nProducto: "+producto.value+"\ncantidad: "+cantidad.value+"\n \nVerifique la Cantidad");
    if (rj == true ) {
    document.getElementById("venta").submit();
    } 
}


}




function filtro(){
	alert("filtro");
}

function myFunction() {
    var r = confirm(".:Por Favor Confirme!:.\nDesea Borrar la venta .\n");
    if (r == true) {
      document.getElementById("borrar_venta").submit();
    } else {
        alert("Ah cancelado El restablecimiento de la venta");
    }
  
}


function final_venta() {
    var r = confirm(".:Por Favor Confirme!:.\nDesea Finalizar la venta de producto .\n");
    if (r == true) {
      document.getElementById("finalizar_venta").submit();
    } 
  
}




window.onload = function(){
var btnBuscar=document.getElementById("btnbuscar");
btnBuscar.onclick=buscarCedula;
var btnPro=document.getElementById("btnbuscarPro");
btnPro.onclick=buscarpro;
}