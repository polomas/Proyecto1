<?php include("../modelo/clsPersona.php");
include("../modelo/clsProducto.php");
	$persona=new clsPersona();
	$producto=new clsProducto();
	session_start();
$var=extract($_GET);

if ($operacion=="BC") {
if($persona->buscarcliente($cedula)){
$cedula2=$persona->getCedula();
$nombre=$persona->getnombre();
$apellido=$persona->getapellido();
$telefono=$persona->gettelefono();
$direccion=$persona->getdireccion();
	
	header("location:../vista/venta.php?cedula=$cedula2&nombre=$nombre&apellido=$apellido&telefono=$telefono&direccion=$direccion&lst=1");
}else{header("location:../vista/venta.php");}
	
}


if ($operacion=="BCV") {
if($persona->buscarcliente_venta($cedula)){

$_SESSION["id_cliente"]=$persona->getId_cliente();

	header("location:../vista/venta.php?clt_n=sf&lst=1&sql_newTokens");}else{header("location:../vista/venta.php?clt_nf");
}
	
}
//__________BUSCAR PRODUCTO______________
if ($operacion=="BCP") {
	if ($producto->buscarPro_agotado($codigo_pro)) {
		header("location:../vista/venta.php?pro=agotado&clt_n=sf&lst=1");
		}else if($producto->buscarPro_venta($codigo_pro)){

$_SESSION["id_producto"]=$producto->getId_codigo();

	header("location:../vista/venta.php?pro=sf&clt_n=sf&lst=1");

}else{header("location:../vista/venta.php?pro=nf&clt_n=sf&lst=1");}}
	

//__________REGISTRAR CLIENTE______________
if (isset($_GET['registrarCliente'])) {
	$tlf="+".$codigoTlf.$telefono;
	if ($persona->registrarCliente($cedula,$nombre,$apellido,$fecha_nac,$genero,$tlf,$nacionalidad,$direccion)) {
	header("location:Controlador.php?operacion=BCV&cedula=$cedula");
	}else{ header("location:../vista/venta.php?Error_AL_REGISTRAR");}
	
}
/////_______________CARRITO DE COMPRAS____________---
/*
*
*
**/
if (isset($_GET['agregar_carrito'])) {
	if($producto->facturaAux($id_producto,$codigo_pro,$articulo,$cantidad,$precio)){
header("location:../vista/venta.php?clt_n=sf&lst=1");}else{header("location:../vista/venta.php?msj_fallo");
}
}
//__________SUMAR AL INVENTARIO______________

if (isset($_GET['SumarInventario'])) {
	if($producto->SumarInventario($codigo,$cant)){
header("location:../vista/venta.php?clt_n=sf&lst=1");}else{header("location:../vista/venta.php?msj_fallo");
}
}
//__________FACTURAR______________

if (isset($_GET['Facturacion'])) {
	if ($producto->Facturacion($id_cliente,$id_empleado)) {
		$_SESSION["cod_fact"]=$producto->getId_factura();
		header("location:../vista/venta.php?fact=sf&Tokes_fact");
	}else {
		header("location:../vista/venta.php?fact=nf");
	}
}
//___________________REGISTRAR PRODUCTO_________________
if (isset($_GET['Registrar_producto'])) {
	if ($producto->registrar_producto($categoria, $codigo_pro, $nombre_producto, $cant, $costo_pro, $precio_pro)) {
		header("location:../vista/Buscar_producto.php?Registro_Exitoso");
	}else{header("location:../vista/registro_producto.php?Rgt=nf");}
	
}
//___________________REGISTRAR EMPLEADOS______________________________
if (isset($_GET['Registrar_emp'])) {
 $nombres_emp=$nombre_emp." ".$snombre_emp;
 $apellidos_emp=$apellido_emp." ".$sapellido_emp;
 $tlf_empleado="+".$codigoTlf."-".$tlf_emp;
 $fecha=date("dmY");
 $clave=".".$fecha;

 $id=$_SESSION["temporal_id"];

if ($persona->registrar_emp($cedula_emp,$nombres_emp,$fecha_nac_emp,$apellidos_emp,$cargo_emp,$email_emp,$tlf_empleado,$direccion_emp,$nacionalidad,$clave,$ocupacion,$grado_inst,$estado_civil,$genero)) {
	if ($id>0) { header("location:../vista/modificar_empleado.php?id=$id&msj_fallo");}else{header("location:../vista/buscar_usuario.php?Registro_Exitoso");}	
	}else{
		header("location:../vista/buscar_usuario.php?CI=nf");}
	
}

if (isset($_GET['Mod_emp'])) {
	if ($persona->mod_empleado($id_emp,$cedula_emp,$nombre_emp,$fecha_nac_emp,$apellido_emp,$cargo_emp,$email_emp,$tlf_emp,$direccion_emp,$nacionalidad_emp,$ocupacion_emp,$grado_emp,$edo_civil_emp,$genero_emp)) {
	$session=$_SESSION["email_id"];
if ($session>0) {
		header("location:../vista/modificar_empleado.php?id=$session&msj_email_dpt");
	}else{
		header("location:../vista/buscar_usuario.php?MOD_sf");
	}

	}else {
		header("location:../vista/buscar_usuario.php?error");
	}
}

if (isset($_GET['StatusOperation_emp'])) {

	if ($persona->estatus_emp($id,$status)) {
	header("location:../vista/buscar_usuario.php?MOD_status");
	}else{
		header("location:../vista/buscar_usuario.php?ERROR_STATUS");
	}
}

if (isset($_GET['Eliminar_emp'])) {

	if ($persona->eliminar_estatus_emp($id,$status)) {
	header("location:../vista/buscar_usuario.php?DELETE_sf");
	}else{
		header("location:../vista/buscar_usuario.php?ERROR_DELETE");
	}
}

if (isset($_GET['Mod_clt'])) {
if ($persona->editar_cliente($id_clt,$cedula_clt,$nombre_clt,$apellido_clt,$fecha_nac_clt,$nacionalidad_clt,$tlf_clt,$genero_clt,$direccion_clt)) {
	header("location:../vista/Buscar_cliente.php?MOD_sf");
}else{
	header("location:../vista/Buscar_cliente.php?MOD_nf");
	}}

if (isset($_GET['Registrar_admin'])) {
 $nombres_emp=$nombre_emp." ".$snombre_emp;
 $apellidos_emp=$apellido_emp." ".$sapellido_emp;
 $tlf_empleado="+".$codigoTlf."-".$tlf_emp;
 
if ($persona->registrar_admin($cedula_emp,$nombres_emp,$fecha_nac_emp,$apellidos_emp,$cargo_emp,$email_emp,$tlf_empleado,$direccion_emp,$nacionalidad,$clave,$ocupacion,$grado_inst,$estado_civil,$genero,$usuario)) {
	header("location:../index.php?new_administrador");
}else{header("location:../vista/new.php?error");
}
	
}
