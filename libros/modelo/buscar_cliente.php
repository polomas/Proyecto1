<?php
require_once('ModCon.php');
$modelo=new ModCon();
$conexion=$modelo->conectar();
$aux=$_POST['dato'];

session_start();
$nivel=$_SESSION["nivel"];


$sql=$conexion->query("SELECT t1.id_cliente ,t1.cedula,t1.nombre,t1.apellido,count(t2.id_cliente)as cant_fact, DATE_FORMAT(max(t2.fecha_venta), '%d/%m/%Y'),max(t2.hora_venta),t1.fecha_nac,t3.telefono
FROM clientes t1
INNER JOIN facturas t2 ON t2.id_cliente = t1.id_cliente
INNER JOIN tlf_cliente t3 ON t3.id_cliente = t1.id_cliente
where   t1.nombre like '%$aux%'   AND t1.status<>'eliminado' OR 
        t1.apellido like '%$aux%'  AND t1.status<>'eliminado'OR
        t1.cedula like '%$aux%'     AND t1.status<>'eliminado'OR
          t3.telefono like '%$aux%'     AND t1.status<>'eliminado'OR
        t2.fecha_venta like '%$aux%'  AND t1.status<>'eliminado'
        GROUP by t1.id_cliente ");

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
  <table  class="table table-striped table-condensed table-hover">
    <tr>
    
    <th class="headerT">CEDULA</th>
    <th class="headerT">NOMBRES Y APELLIDOS</th>
   <th class="headerT">CANT_FACTURACION</th>
      <th class="headerT">ULTIMA COMPRA</th>
      <th class="headerT">HORA</th>
      <th class="headerT">TELEFONO</th>
     <th class="headerT">STATUS</th>
     <th class="headerT" colspan="3">OPCIONES</th>
   
    </tr>


<?php 
	while ($row=$sql->fetch_array()) {
		?>
  <td><?php echo $row[1] ?></td>
    <td><?php echo $row[2]."&nbsp;".$row[3] ?></td>
    <td><?php echo $row[4] ?></td>
     <td><?php echo $row[5] ?></td>
      <td><?php echo $row[6] ?></td>
      <td><?php echo $row[8] ?></td>

 <td id="table_operaciones"><?php echo '  <a href="ver_cliente.php?id='.$row[0].'" id="bold" class="btn btn-default btn-xs"> <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Ver</a>';?></td>
  <td id="table_operaciones"><?php echo '  <a href="modificar_cliente.php?id='.$row[0].'" id="bold" class="btn btn-info btn-xs"> <span class="glyphicon glyphicon-edit"></span>&nbsp;Editar</a>';?></td>
 <td id="table_operaciones"><?php echo ' <a href="../controlador/Controlador.php?id='.$row[0].'&status=eliminado&Eliminar_emp" id="bold" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-edit"></span>&nbsp;Eliminar</a>';?></td>
</tr>
  <?php 
	
}
?>
</table>
	</center>
	</body>
	</html>
<?php
}else
{
	?>
	<h4>No se ha encontrado nada Relacionado con "<?php echo $aux ?>" En la base de datos</h4>
	<?php 

}