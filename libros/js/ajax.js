$(function(){
	$('#filtrar').on('keyup',function(){
		var dato = $('#filtrar').val();
		var url = '../modelo/buscador.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'producto='+dato,
		success: function(datos){
			$('#listar_productos').html(datos);
		}
	});
	return false;
	});
	
});












