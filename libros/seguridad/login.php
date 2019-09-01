<?php include("../modelo/ModCon.php");
$var=extract($_POST);
$modelo=new ModCon();
$conexion=$modelo->conectar();

$error=$conexion->query("SELECT t1.id_usuario,t2.nombres FROM usuarios t1 
LEFT JOIN empleados t2 ON t2.id_empleado=t1.id_empleado
WHERE t1.usuario='$usuario' AND t1.clave='$clave' AND t2.status<>'activo'");
$act=$error->num_rows;

if ($act>0) {
header("location:../index.php?qjk_ls=st0");
}else{

$sql=$conexion->query("SELECT id_empleado,nivel FROM usuarios WHERE usuario='$usuario' AND clave='$clave'");
$num=$sql->num_rows;
if ($num==1) {
$row=$sql->fetch_array();
/*____VACIO DE CARRITO DE COMPRAS PARA EVITAR DESAJUSTE EN EL INVENTARIO*/

session_start();
$_SESSION["id"]=$row[0];
$_SESSION["autentificado"]="true";
 $_SESSION["nivel"]=$row[1];
require('Seguro_inventario.php');

header("location:../vista/venta.php");

}else{
	
header("location:../index.php?qjk_ls=nnf");
}

}

 ?>
