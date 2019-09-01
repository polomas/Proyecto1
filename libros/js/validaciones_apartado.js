function buscar(){
	var verificar=true;
	var cedula=document.getElementById('apartado_cedula');
	if (!cedula.value) {
		alert("Debes especificar la cedula del cliente");
		verificar=false;
		cedula.focus();
	}else if(isNaN(cedula.value)){
alert("La cedula debe ser numerica sin espacios en blanco");
		verificar=false;
		cedula.focus();
		cedula.value="";
	}
	if (verificar) {
		document.getElementById('buscar_cliente').submit();
	};
}