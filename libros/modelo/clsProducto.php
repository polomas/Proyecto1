<?php 

class clsProducto{
private $id_codigo;

private $agotado;
private $id_factura;
	public function getAgotado(){
		return $this->agotado;
	}
public function getId_codigo(){
		return $this->id_codigo;
	}

	public function getId_factura(){
		return $this->id_factura;
	}



public function buscarPro_agotado($dato){
	$encontro=false;
	$modelo=new ModCon();
	$conexion=$modelo->conectar();
    $sql=$conexion->query("SELECT id_producto from productos where status='agotado' And codigo_pro='$dato'");
$num=$sql->num_rows;
	if ($num>0) {
    $row=$sql->fetch_array();
  $this->id_codigo=$row[0];
 $encontro=true;
	}
return $encontro;
}

public function buscarPro_venta($dato){
	$encontro=false;
	$modelo=new ModCon();
	$conexion=$modelo->conectar();
    $sql=$conexion->query("SELECT id_producto from productos where status='activo' And codigo_pro='$dato'");

	$num=$sql->num_rows;
	if ($num>0) {
    $row=$sql->fetch_array();

$this->id_codigo=$row[0];
 $encontro=true;
	}
return $encontro;
}

public function facturaAux($id_producto,$codigo_pro,$articulo,$cantidad,$precio){
$exito=false;
	$modelo=new ModCon();
	$conexion=$modelo->conectar();
$total=$precio*$cantidad;
	if ($sql=$conexion->query("INSERT INTO carrito_compras(id_producto,cod, nombre_pro, cant, precio,total) VALUES('$id_producto','$codigo_pro', '$articulo', '$cantidad', '$precio','$total')")) {
		$sql=$conexion->query("SELECT existencia_pro From productos where codigo_pro='$codigo_pro'");
       $row=$sql->fetch_array();
       $temp=$row[0]-$cantidad;
       $sql=$conexion->query("UPDATE productos SET existencia_pro='$temp' where codigo_pro='$codigo_pro'");
       if ($temp==0) {
     $sql=$conexion->query("UPDATE productos SET status='agotado' where codigo_pro='$codigo_pro'");
       }
		$exito=true;
	}
return $exito;
}

public function sumarInventario($id,$cant){
	$exito=false;

	$modelo=new ModCon();
	$conexion=$modelo->conectar();
	$sql=$conexion->query("SELECT existencia_pro From productos where codigo_pro='$id'");
	 $row=$sql->fetch_array();
       $auxiliar=$row[0]+$cant;
       if ($sql=$conexion->query("UPDATE productos SET existencia_pro='$auxiliar',status='activo' where codigo_pro='$id'")) {
       	$sql=$conexion->query(" DELETE FROM carrito_compras where cod='$id'");
       		$exito=true;
       }
       return $exito;
}
	public function Facturacion($id_cliente,$id_empleado){
		$operacion =false;
		$hora=date(" g:i:s a");
        $fecha=date("Y-m-d");

		$modelo=new ModCon();
		$conexion=$modelo->conectar();
		if ($sql=$conexion->query("INSERT INTO facturas( id_cliente, id_empleado, fecha_venta, hora_venta) 
			                   VALUES('$id_cliente', '$id_empleado', '$fecha', '$hora')")){
			$aux=$conexion->query("SELECT max(id_factura)as fact FROM facturas");
    $array=$aux->fetch_array();
    $sql=$conexion->query("SELECT id_producto,sum(cant)as cant,precio,sum(total)as total FROM carrito_compras GROUP BY id_producto");
			 while ($filas=$sql->fetch_array()) {
		
			$factura=$array['fact'];
	      $this->id_factura=$factura;
				$conexion->query("INSERT INTO detalles_facturas( id_producto, id_factura, precioXu, cant, total)VALUES('$filas[id_producto]', '$this->id_factura', '$filas[precio]', '$filas[cant]', '$filas[total]')");
					$operacion =true;
				}

				$conexion->query("TRUNCATE carrito_compras");

		}
		return $operacion;
		}

	public function registrar_producto($categoria, $codigo_pro, $nombre_pro, $existencia_pro, $costoxU, $precioxU){
		$exito=false;
		$modelo=new ModCon();
		$conexion=$modelo->conectar();
		$categoria=$conexion->query("SELECT id_categoria FROM categorias where categoria='$categoria'");
		$fila=$categoria->fetch_array();
		$id_categoria=$fila[0];
		 $fecha=date("d/m/Y");
		if ($conexion->query("INSERT INTO productos(id_categoria, codigo_pro, nombre_pro, existencia_pro, fecha_registro, costoxU, precioxU) VALUES ('$id_categoria', '$codigo_pro', '$nombre_pro', '$existencia_pro', '$fecha', '$costoxU', '$precioxU')")) {
			$exito=true;
		}



return $exito;
	}

}


 ?>
