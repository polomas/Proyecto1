<?php 
include("../modelo/clsPersona.php");
include("../modelo/clsProducto.php");
	$persona=new clsPersona();
	$producto=new clsProducto();
	session_start();
$var=extract($_GET);
if (isset($_GET['buscarCliente'])) {
	if ($persona->buscarcliente_venta($cedula)) {
		
$_SESSION["id_cliente"]=$persona->getId_cliente();

	header("location:../vista/sistema_apartado.php?clt_n=sf&lst=1&sql_newTokens");}else{header("location:../vista/sistema_apartado.php?clt_nf");
}
	}
