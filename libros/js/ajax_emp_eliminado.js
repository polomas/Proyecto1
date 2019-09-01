$(function(){
$('#filtrar').on('keyup',function(){
     var datos= $('#filtrar').val();
     var header='../modelo/empleado_eliminado.php';
   $.ajax({
       type:'POST',
       url:header,
       data:'dato='+datos,
       success:function(envio){
       	$('#llenar_usuarios').html(envio);
       }
});
});
});
