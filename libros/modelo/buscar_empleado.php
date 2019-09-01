<?php
 require_once('ModCon.php');
$modelo=new ModCon();
$conexion=$modelo->conectar();
$aux=$_POST['dato'];
if ($aux=="desactivados" || $aux=="inactivos" || $aux=="inactivo") {
	$aux="desactivado";
}
else if ($aux=="activos") {
		$aux="activo";
}else if ($aux=="vendedores" || $aux=="vendedore") {
		$aux="vendedor";
}
session_start();
$nivel=$_SESSION["nivel"];


$sql=$conexion->query("SELECT t1.id_empleado,t1.cedula,t1.nombres,t1.apellidos,t1.fecha_nac,t2.email_empleado,t3.telefono_empleado,t1.cargo,t1.status
FROM empleados t1 
LEFT JOIN email_empleado t2 ON t2.id_empleado=t1.id_empleado
LEFT JOIN tlf_empleado t3 ON t3.id_empleado=t1.id_empleado
where   t1.nombres like '%$aux%'   AND t1.status<>'eliminado' OR 
        t1.apellidos like '%$aux%'  AND t1.status<>'eliminado'OR
        t1.cedula like '%$aux%'     AND t1.status<>'eliminado'OR
        t1.cargo like '%$aux%'      AND t1.status<>'eliminado'OR
        t1.fecha_nac like '%$aux%'  AND t1.status<>'eliminado'OR
          t1.status like '%$aux%'  AND t1.status<>'eliminado'OR
        t2.email_empleado like '%$aux%'   AND t1.status<>'eliminado'      OR
        t3.telefono_empleado like '%$aux%'  AND t1.status<>'eliminado'
        ORDER BY t1.nombres asc ");

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
      <th class="headerT">ID</th>
    <th class="headerT">CEDULA</th>
    <th class="headerT">NOMBRES Y APELLIDOS</th>
   <th class="headerT">FECHA_NAC</th>
      <th class="headerT">EMAIL</th>
      <th class="headerT">TELEFONO</th>
    <th class="headerT">TIPO</th>
    <th class="headerT">STATUS</th>
     <th class="headerT" colspan="3">OPCIONES</th>
   
   
    </tr>



<?php 
	while ($row=$sql->fetch_array()) {
		?>
	 <tr>
    <td><?php echo $row[0] ?></td>
    <td><?php echo $row[1] ?></td>
    <td><?php echo $row[2]."&nbsp;".$row[3] ?></td>
    <td><?php echo $row[4] ?></td>
    <td><?php echo $row[5] ?></td>
    <td><?php echo $row[6] ?></td>
     <td><?php echo $row[7] ?></td>
    
    <td><?php $status=$row[8];
if ($status=="activo") {
 echo '  <button type="button" class="btn btn-success btn-xs"> <span class="glyphicon glyphicon-ok"></span>&nbsp;Activo</button>' ;
}else{ echo  '<button type="button" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-remove"></span>&nbsp;Desactivado</button>';

} ?></td>
 <td id="table_operaciones"><?php echo '  <a href="ver_empleado.php?id='.$row[0].'" class="btn btn-default btn-xs bold"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;Ver</a>';?></td>
  <td id="table_operaciones"><?php echo '  <a href="modificar_empleado.php?id='.$row[0].'" class="btn btn-info btn-xs bold"><span class="glyphicon glyphicon-edit"></span>&nbsp;Editar</a>';?></td>
 <td id="table_operaciones"><?php echo ' <a href="../controlador/Controlador.php?id='.$fila[0].'&status=eliminado&Eliminar_emp" id="bold" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-edit"></span>&nbsp;Eliminar</a>';?></td>
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
