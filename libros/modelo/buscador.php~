<?php require_once('ModCon.php');
$modelo=new ModCon();
$conexion=$modelo->conectar();
$aux= $_POST['producto'];
if ($aux=="agotados") {
	$aux="agotado";
}
else if ($aux=="activos") {
		$aux="activo";
}
$sql=$conexion->query("SELECT t1.codigo_pro,t1.nombre_pro,t2.categoria,t1.fecha_registro,t1.existencia_pro,t1.precioXu,t1.status
from  productos t1
inner join categorias t2 on t1.id_categoria=t2.id_categoria
where t1.nombre_pro like '%$aux%'  OR
 t1.codigo_pro like '%$aux%'  OR
  t1.fecha_registro like '%$aux%'  OR
  t1.precioXu like '%$aux%'  OR
  t1.status like '%$aux%'  OR
   t2.categoria like '%$aux%'  ORDER BY t1.nombre_pro asc limit 15");
$num=$sql->num_rows;
if ($num>0) {
	?>
	<!DOCTYPE html>
	<html>
	<head>
		
		<link rel="stylesheet" href="../css/MyStyle.css">
		<link rel="stylesheet" href="../Bootstrap/bootstrap.css">
	</head>
	<body>
		
	
	<center>
<table width="90%"  class="table table-hover table-condensed">
	<tr>
		<th class="headerT">CÓDIGO</th>
		<th class="headerT">ARTICULO</th>
		<th class="headerT">CATEGORIA</th>
		<th class="headerT">FECHA_ING</th>
		<th class="headerT">STOCK</th>
		<th class="headerT">PERCIO</th>
		<th class="headerT">STATUS</th>

</tr>



<?php 
	while ($row=$sql->fetch_array()) {
		?>
<tr>
		<td><?php echo $row[0] ?></td>
		<td><?php echo $row[1] ?></td>
		<td><?php echo $row[2] ?></td>
		<td><?php echo $row[3] ?></td>
		<td><?php echo $row[4] ?></td>
		<td><?php echo $row[5] ?></td>
		 <td><?php $status=$row[6];
		
if ($status=='agotado') {
 echo '  <button type="button" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-remove"></span>&nbsp;Inactivo</button>';
}else{ echo '  <button type="button" class="btn btn-success btn-xs"> <span class="glyphicon glyphicon-ok"></span>&nbsp;Activo</button>
';} ?></td>
		</tr>
<?php 
	
}
?>
</table>
	</center>
	</body>
	</html>
<?php

}else{
?>
<h4>Datos no encontrados</h4>
<?php 
}

