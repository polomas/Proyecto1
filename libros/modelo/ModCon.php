<?php 

class ModCon{
	private $conexion;
public function conectar(){
$servidor="localhost";
 $usuario="root";
 $clave="SuremandaS492";
 $database="sifaj2";
$conexion= new mysqli($servidor,$usuario,$clave,$database);
if ($conexion->connect_errno){
 echo	" <center><h3><br><br><img src='img/DBError.jpg' width='60'>&nbsp;&nbsp;NOTA: Hay Errores En la Conexion a La Base de datos, No es Posible Acceder al Sistema</h3> </center>";}
return $conexion;
 	}
}

?>
