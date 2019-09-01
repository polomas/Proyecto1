$(function(){
$('#filtrar').on('keyup',function(){
     var datos= $('#filtrar').val();
     var header='../modelo/buscar_empleado.php';
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