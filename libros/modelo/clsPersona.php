<?php require_once("ModCon.php");

class clsPersona{
private $cedula;
private $nombre;
private $apellido;
private $genero;
private $fecha_nac;
private $fecha_ing;
private $nacionalidad;
private $telefono;
private $direccion;
private $id_cliente;
private $id_empleado;	


	
	public function getCedula(){
		return $this->cedula;
	}
	
	public function getnombre(){
		return $this->nombre;
	}
	
	public function getapellido(){
		return $this->apellido;
	}
	
	public function getgenero(){
		return $this->genero;
	}
	
	public function getfecha_nac(){
		return $this->fecha_nac;
	}

	public function getfecha_ing(){
		return $this->fecha_ing;
	}
	
	public function gettelefono(){
		return $this->telefono;
	}
	
	public function getnacionalidad(){
		return $this->nacionalidad;
	}
	
	public function getdireccion(){
		return $this->direccion;
	}
public function getId_cliente(){
		return $this->id_cliente;
	}
	public function getId_empleado(){
		return $this->id_empleado;
	}
	
public function buscarcliente($dato){
	$encontro=false;
	$sql=mysql_query("SELECT t1.cedula,t1.nombre,t1.apellido,t1.nacionalidad,t2.telefono,t3.direccion
from clientes t1
INNER JOIN tlf_cliente t2 on t2.id_cliente=t1.id_cliente
INNER JOIN direccion_cliente t3 on t3.id_cliente=t1.id_cliente where t1.status=1 AND  t2.status=1 AND  t3.status=1 And t1.cedula='$dato' ");
	$num=mysql_num_rows($sql);
	if ($num>0) {
    $row=mysql_fetch_array($sql);
$this->cedula=$row['cedula'];
$this->nombre=$row['nombre'];
$this->apellido=$row['apellido'];
$this->nacionalidad=$row['nacionalidad'];
$this->telefono=$row['telefono'];
$this->direccion=$row['direccion'];
 $encontro=true;
	}
return $encontro;
}

public function buscarcliente_venta($dato){
$encontro=false;
    $modelo=new ModCon();
    $conexion=$modelo->conectar();
    $sql=("SELECT id_cliente FROM clientes WHERE status=1 AND cedula='$dato' ");
  $resultado= $conexion->query($sql);
	$num=$resultado->num_rows;

	if ($num>0) {
    $row=$resultado->fetch_array();

$this->id_cliente=$row[0];
$encontro=true;
	}
return $encontro;
}

public function registrarCliente($cedula,$nombre,$apellido,$fecha_nac,$genero,$tlf,$nacionalidad,$direccion){
$exito=false;
 $modelo=new ModCon();
    $conexion=$modelo->conectar();
    $sql=$conexion->query("SELECT id_cliente FROM clientes WHERE cedula='$cedula'");
    $num=$sql->num_rows;
    if ($num==0) {
    	
$hora=date(" g:i:s a");
$fecha_ing=date("Y-m-d");

if ($sql=$conexion->query("INSERT INTO clientes(cedula, nombre, apellido, genero, nacionalidad, fecha_nac, fecha_ing,hora_registro)VALUES ('$cedula', '$nombre', '$apellido', '$genero', '$nacionalidad', '$fecha_nac', '$fecha_ing','$hora') ")) {
   	$sql=$conexion->query("SELECT id_cliente FROM clientes WHERE cedula='$cedula'");
   	$fila=$sql->fetch_array();
   	$id=$fila[0];
   	$sql=$conexion->query("INSERT INTO direccion_cliente(id_cliente, direccion)VALUES('$id','$direccion')");
	if ($tlf!="+") { 
	$sql=$conexion->query("INSERT INTO tlf_cliente(id_cliente, telefono )VALUES ('$id','$tlf')");}
	$exito=true;
}
}
   return $exito;

}


public function registrar_emp($cedula_emp,$nombres_emp,$fecha_nac_emp,$apellidos_emp,$cargo_emp,$email_emp,$tlf_empleado,$direccion_emp,$nacionalidad,$clave,$ocupacion,$grado_inst,$estado_civil,$genero){

$modelo=new ModCon();
$conexion=$modelo->conectar();
$fecha_registro=date("d/m/Y");
$fecha_ing=date("Y/m/d");
$hora=date(" g:i:s a");
$sql=$conexion->query("SELECT id_empleado from empleados where cedula='$cedula_emp'");
$num=$sql->num_rows;
$_SESSION["temporal_id"]=0;
if ($num>0) {
$exito=false;

}else{

//____________nivel de usuario_____________
	if ($cargo_emp=="VENDEDOR") {
	$nivel=2;
}else if ($cargo_emp=="ADMINISTRADOR") {
	$nivel=1;
}else if ($cargo_emp=="INVITADO") {
	$nivel=3;
}
//____________FIN nivel de usuario_____________

	if ($conexion->query("INSERT INTO empleados(cedula, nombres, apellidos, fecha_nac, fecha_registro, cargo, edo_civil, grado_formacion, ocupacion, genero, nacionalidad)values ('$cedula_emp','$nombres_emp','$apellidos_emp','$fecha_nac_emp','$fecha_registro','$cargo_emp','$estado_civil',
'$grado_inst','$ocupacion','$genero','$nacionalidad')")) {
	$sql=$conexion->query("SELECT id_empleado from empleados where cedula='$cedula_emp'");
    $fila=$sql->fetch_array();
   	$id=$fila[0];
$exito=true;
   	
$conexion->query("INSERT INTO direccion_empleado(id_empleado, direccion_empleado)VALUES('$id','$direccion_emp')");
$conexion->query("INSERT INTO usuarios(id_empleado, usuario, clave, nivel) VALUES('$id','$cedula_emp','$clave','$nivel')");
$conexion->query("INSERT INTO tlf_empleado(id_empleado, telefono_empleado)VALUES('$id','$tlf_empleado')");

$sql=$conexion->query("SELECT id_empleado from email_empleado where email_empleado='$email_emp'");
$num_email=$sql->num_rows;
if ($num>0) {
$_SESSION["temporal_id"]=$id;
}else{
	$conexion->query("INSERT INTO email_empleado (id_empleado, email_empleado)VALUES('$id','$email_emp')");
}
//_____REGISTRAR EMPLEADO COMO CLIENTE AL ISNTANTE DE REGISTRAR COMO EMPLEADO_
 	$clt=$conexion->query("SELECT id_cliente FROM clientes WHERE cedula='$cedula_emp'");
$cliente=$clt->num_rows;
$arra=$clt->fetch_array();
if ($cliente==0) {
	$sql=$conexion->query("INSERT INTO clientes(cedula, nombre, apellido, genero, nacionalidad, fecha_nac, fecha_ing,hora_registro)VALUES ('$cedula_emp', '$nombres_emp', '$apellidos_emp', '$genero', '$nacionalidad', '$fecha_nac_emp', '$fecha_ing','$hora') ");
   	$sql=$conexion->query("SELECT id_cliente FROM clientes WHERE cedula='$cedula_emp'");
   	$fila=$sql->fetch_array();
   	$id=$fila[0];
   	$sql=$conexion->query("INSERT INTO direccion_cliente(id_cliente, direccion)VALUES('$id','$direccion_emp')");
	$sql=$conexion->query("INSERT INTO tlf_cliente(id_cliente, telefono )VALUES ('$id','$tlf_empleado')");

}else{

	$conexion->query("UPDATE clientes SET nombre='$nombre_emp',apellido='$apellido_emp',genero='$genero_emp',nacionalidad='$nacionalidad_emp',fecha_nac='$fecha_nac_emp' WHERE id_cliente='$id_emp'");
$conexion->query("UPDATE direccion_cliente SET direccion='$direccion_emp' WHERE id_cliente='$arra[0]'");

$conexion->query("UPDATE tlf_cliente set telefono='$tlf_emp' WHERE id_cliente='$arra[0]' ");


}



	}
}//fin num
return $exito;
}
/////////////////////////////////////////////////////////////////////////////////


public function registrar_admin($cedula_emp,$nombres_emp,$fecha_nac_emp,$apellidos_emp,$cargo_emp,$email_emp,$tlf_empleado,$direccion_emp,$nacionalidad,$clave,$ocupacion,$grado_inst,$estado_civil,$genero,$usuario)
{

$modelo=new ModCon();
$conexion=$modelo->conectar();
$fecha_registro=date("d/m/Y");
$fecha_ing=date("Y/m/d");
$hora=date(" g:i:s a");
//__nivel de usuario_____________
	if ($cargo_emp=="VENDEDOR") {
	$nivel=2;
}else if ($cargo_emp=="ADMINISTRADOR") {
	$nivel=1;
}else if ($cargo_emp=="INVITADO") {
	$nivel=3;
}
//____________FIN nivel de usuario_____________

	if ($conexion->query("INSERT INTO empleados(cedula, nombres, apellidos, fecha_nac, fecha_registro, cargo, edo_civil, grado_formacion, ocupacion, genero, nacionalidad)values ('$cedula_emp','$nombres_emp','$apellidos_emp','$fecha_nac_emp','$fecha_registro','$cargo_emp','$estado_civil',
'$grado_inst','$ocupacion','$genero','$nacionalidad')")) {
	$sql=$conexion->query("SELECT id_empleado from empleados where cedula='$cedula_emp'");
    $fila=$sql->fetch_array();
   	$id=$fila[0];
$exito=true;
   	
$conexion->query("INSERT INTO direccion_empleado(id_empleado, direccion_empleado)VALUES('$id','$direccion_emp')");
$conexion->query("INSERT INTO usuarios(id_empleado, usuario, clave, nivel) VALUES('$id','$usuario','$clave','$nivel')");
$conexion->query("INSERT INTO tlf_empleado(id_empleado, telefono_empleado)VALUES('$id','$tlf_empleado')");
$conexion->query("INSERT INTO email_empleado (id_empleado, email_empleado)VALUES('$id','$email_emp')");
$conexion->query("INSERT INTO clientes(cedula, nombre, apellido, genero, nacionalidad, fecha_nac, fecha_ing,hora_registro)VALUES ('$cedula_emp', '$nombres_emp', '$apellidos_emp', '$genero', '$nacionalidad', '$fecha_nac_emp', '$fecha_ing','$hora') ");
   	$sql=$conexion->query("SELECT id_cliente FROM clientes WHERE cedula='$cedula_emp'");
   	$fila=$sql->fetch_array();
   	$id=$fila[0];
   	$sql=$conexion->query("INSERT INTO direccion_cliente(id_cliente, direccion)VALUES('$id','$direccion_emp')");
	$sql=$conexion->query("INSERT INTO tlf_cliente(id_cliente, telefono )VALUES ('$id','$tlf_empleado')");





	
}//fin num
return $exito;
}



/////////////////////////////////////////////////////////////////////////////


public function mod_empleado($id_emp,$cedula_emp,$nombre_emp,$fecha_nac_emp,$apellido_emp,$cargo_emp,$email_emp,$tlf_emp,$direccion_emp,$nacionalidad_emp,$ocupacion_emp,$grado_emp,$edo_civil_emp,$genero_emp){
$verificar=false;
$modelo=new ModCon();

$conexion=$modelo->conectar();
$sql=$conexion->query("SELECT id_empleado FROM empleados WHERE cedula='$cedula_emp' AND id_empleado<>'$id_emp'");
$num=$sql->num_rows;
if ($num==0) {
if ($conexion->query("UPDATE empleados SET cedula='$cedula_emp',nombres='$nombre_emp',apellidos='$apellido_emp',fecha_nac='$fecha_nac_emp',cargo='$cargo_emp',edo_civil='$edo_civil_emp',grado_formacion='$grado_emp',ocupacion='$ocupacion_emp',genero='$genero_emp',nacionalidad='$nacionalidad_emp' WHERE id_empleado='$id_emp'")){
	$verificar=true;
$conexion->query("UPDATE direccion_empleado SET direccion_empleado='$direccion_emp' WHERE id_empleado='$id_emp'");
$conexion->query("UPDATE tlf_empleado SET telefono_empleado='$tlf_emp' WHERE id_empleado='$id_emp'");
if ($cargo_emp=="VENDEDOR") {
	$nivel=2;
}else if ($cargo_emp=="ADMINISTRADOR") {
	$nivel=1;
}else if ($cargo_emp=="INVITADO") {
	$nivel=3;
}
$conexion->query("UPDATE usuarios SET nivel='$nivel' where id_empleado='$id_emp'");

 	$ant=$conexion->query("SELECT id_empleado from email_empleado where email_empleado='$email_emp' and id_empleado<>'$id_emp'");
 	$num=$ant->num_rows;
  
if ($num>0) {//si hay un emil registrado con diferente id
 	$_SESSION["email_id"]=$id_emp;
   }// si no hay registros 
   else{
   	$_SESSION["email_id"]=0;
   	$aux=$conexion->query("SELECT id_empleado from email_empleado where id_empleado='$id_emp'");
 	$num2=$aux->num_rows;
      if ($num2>0) {
      $conexion->query("UPDATE email_empleado SET email_empleado='$email_emp' WHERE id_empleado='$id_emp'");
      }else{
      	$conexion->query("INSERT INTO email_empleado(id_empleado,email_empleado) VALUES ('$id_emp','$email_emp')");
      }
}
   	


}
}
return  $verificar;
}

public function estatus_emp($id,$status){
	$exito=false;
	$modelo=new ModCon();
	$conexion=$modelo->conectar();
if ($status=="activarEmp") {
 $conexion->query("UPDATE empleados SET status='activo' WHERE id_empleado='$id'");
 	$exito=true;
}else if($status=="desactivarEmp"){
	 $conexion->query("UPDATE empleados SET status='desactivado' WHERE id_empleado='$id'");
	 	$exito=true;
}

	return $exito;
}

public function eliminar_estatus_emp($id,$status){
	$exito=false;
	$modelo=new ModCon();
	$conexion=$modelo->conectar();

	 if($conexion->query("UPDATE empleados SET status='eliminado' WHERE id_empleado='$id'")){
	 	$exito=true;
}

	return $exito;
}

public function editar_cliente($id_clt,$cedula_clt,$nombre_clt,$apellido_clt,$fecha_nac_clt,$nacionalidad_clt,$tlf_clt,$genero_clt,$direccion_clt){
$exito=false;
$modelo=new ModCon();
$conexion=$modelo->conectar();
$sql=$conexion->query("SELECT id_cliente FROM clientes WHERE cedula='$cedula_clt' and id_cliente <> '$id_clt'");	
$num=$sql->num_rows;
if ($num==0) {
	$conexion->query("UPDATE clientes SET cedula='$cedula_clt',nombre='$nombre_clt',apellido='$apellido_clt',genero='$genero_clt',nacionalidad='$nacionalidad_clt',fecha_nac='$fecha_nac_clt' WHERE id_cliente='$id_clt'");
$conexion->query("UPDATE direccion_cliente SET direccion='$direccion_clt' WHERE id_cliente='$id_clt'");

$sql=$conexion->query("SELECT * FROM tlf_cliente WHERE id_cliente= '$id_clt'");	
$tlf=$sql->num_rows;
if ($tlf==0) {
$conexion->query("INSERT INTO tlf_cliente (id_cliente,telefono)values('$id_clt','$tlf_clt')");
}else{
$conexion->query("UPDATE tlf_cliente set telefono='$tlf_clt' WHERE id_cliente='$id_clt' ");
}
$exito=true;
}
return $exito;
}


}


 
