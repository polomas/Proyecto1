<?php 
require_once("../modelo/ModCon.php");
$modelo=new ModCon();
$conexion=$modelo->conectar();

     $sql=$conexion->query("SELECT max(id_factura) as codi from facturas");
            $codfac=$sql->fetch_array();
                  $max=$codfac['codi']+1;
                    if ($max<10) {
                    $codigo="000000000".$max;
                   }else  if ($max<100) {
                    $codigo="00000000".$max;
                   }else if ($max<1000) {
                    $codigo="0000000".$max;
                   }else if ($max<10000) {
                    $codigo="000000".$max;
                   }else if ($max<100000) {
                    $codigo="00000".$max;
                   }else  if ($max<1000000) {
                    $codigo="0000".$max;
                   }else if ($max<10000000) {
                    $codigo="000".$max;
                   }else if ($max<100000000) {
                    $codigo="00".$max;
                   }else  if ($max<1000000000) {
                    $codigo="0".$max;
                   }else  if ($max<10000000000) {
                    $codigo="0".$max;
                   }
echo $codigo;


 ?>