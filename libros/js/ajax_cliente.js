$(function(){
	$('#filtrar').on('keyup',function(){
		var dato = $('#filtrar').val();
		var url = '../modelo/buscar_cliente.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato,
		success: function(datos){
			$('#llenar_usuarios').html(datos);
		}
	});

	});
	
});