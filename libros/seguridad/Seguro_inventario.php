<?php 
$carro=$conexion->query("SELECT cod,sum(cant) as cantidad FROM carrito_compras  GROUP BY nombre_pro");
       $num=$carro->num_rows;
      if ($num>0) {

       while($filas=$carro->fetch_array()){
  $sql=$conexion->query("SELECT existencia_pro From productos WHERE codigo_pro='$filas[0]'");
   $array=$sql->fetch_array();
 $filas[0];
$stock=$filas[1]+$array[0];
 $cargar=$conexion->query("UPDATE productos SET existencia_pro='$stock',status='activo' where codigo_pro='$filas[0]'");
  }// fin while


}
$aux= $conexion->query("TRUNCATE carrito_compras");
