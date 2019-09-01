<?php 
require 'FPDF/fpdf.php';
require_once("../modelo/ModCon.php");
 class PDF extends FPDF
{


// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
session_start();
extract($_GET);
if(isset($_GET['codigo_facturacion'])){
$id_factura=$id;}else{
$id_factura=$_SESSION['cod_fact'];
}
$modelo=new ModCon();
$conexion=$modelo->conectar();
$sql=$conexion->query("SELECT t1.id_factura,t2.cedula,t2.nombre,t2.apellido,t3.direccion
FROM  facturas t1
INNER JOIN clientes t2 ON t1.id_cliente=t2.id_cliente
INNER JOIN direccion_cliente t3 ON t1.id_cliente=t3.id_cliente
WHERE t1.id_factura='$id_factura'");

$DATOS=$sql->fetch_array();
$fecha=$conexion->query("SELECT date_format(fecha_venta, '%d/%m/%Y') as fecha_venta FROM facturas
WHERE id_factura='$id_factura'");
$tmp=$fecha->fetch_array();
// Creación del objeto de la clase heredada
$pdf = new PDF("P","mm","Letter");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',22);
$a=$pdf->Image('../img/logo.png',10,5,-200);
 $pdf->Cell(30);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(80,10,"R.I.F:5842621452",0,0,"C");

$pdf->Cell(80,10,"FECHA:  ".$tmp['fecha_venta'],1,1,"L");
$pdf->SetFont('Arial','i',12);
$pdf->Cell(30,7,"",0,0,"C");
 $pdf->Cell(80,7,"Av. Raul Leonis",0,0,"C");

$pdf->SetFont('Arial','B',13);
 $pdf->Cell(30,8,"FACTURA N:",1,0,"C");
 $pdf->SetTextColor(255,0,0);
 $pdf->SetFont('Helvetica','b',18);
 $max=$DATOS['id_factura'];
  
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
  $pdf->Cell(50,8," SB-".$codigo,1,1,"C");
$pdf->SetFont('Arial','i',12);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(30,7,"",0,0,"C");
 $pdf->Cell(80,7,"El amparo",0,1,"C");
 $pdf->Cell(30,7,"",0,0,"C");
 $pdf->Cell(80,7,"Edo-Apure",0,1,"C");

  $pdf->Cell(190,7,"	DATOS DEL CLIENTE",1,1,"C");

$pdf->SetFont('Arial','B',13);
  $pdf->Cell(31,6,"RIF/CI:",1,0,"C");
  $pdf->SetFont('Helvetica','',12);
 $pdf->Cell(30,6,"".$DATOS['cedula'],0,0,"L");

$pdf->SetFont('Arial','B',13);
  $pdf->Cell(31,6,"CLIENTE:",1,0,"C");
  $pdf->SetFont('Helvetica','',12);
  $cliente=$DATOS['nombre']."  ".$DATOS['apellido'];
 $pdf->Cell(150,6,$cliente,0,1,"L");

 $pdf->SetFont('Arial','B',13);
   $pdf->Cell(31,8,"DOMICILIO:",1,0,"C");
   $pdf->SetFont('Helvetica','',12);
 $pdf->Cell(165,6,"".$DATOS['direccion'],0,1,"L");
 $pdf->SetFont('Arial','B',13);

$pdf->Cell(0,2,"",0,1,"C");

  $pdf->Cell(20,8,"CANT",1,0,"C");
    $pdf->Cell(100,8,"DESCRIPCION",1,0,"C");
      $pdf->Cell(35,8,"PRECIO X/U",1,0,"C");
        $pdf->Cell(35,8,"PRE-TOTAL",1,1,"C");
         $pdf->SetFont('Helvetica','',13);

$vaciar=$conexion->query("SELECT t1.precioXu,t1.cant,t1.total,t2.nombre_pro
FROM  detalles_facturas t1
INNER JOIN productos t2 ON t1.id_producto=t2.id_producto
WHERE t1.id_factura='$id_factura'");

while ($pro=$vaciar->fetch_array()) {
  $pdf->Cell(20,8,$pro['cant'],1,0,"C");
     $pdf->Cell(100,8,$pro['nombre_pro'],1,0,"C");
      $pdf->Cell(35,8,$pro['precioXu'],1,0,"C");
        $pdf->Cell(35,8,$pro['total'],1,1,"C");
}


for ($i=0; $i < 4; $i++) { 

	$pdf->Cell(20,8,"",1,0,"C");
    $pdf->Cell(100,8,"",1,0,"C");
      $pdf->Cell(35,8,"",1,0,"C");
        $pdf->Cell(35,8,"",1,1,"C");
}


$aux=$conexion->query("SELECT SUM(total)as total
FROM  detalles_facturas 

WHERE id_factura='$id_factura'");
 $precio=$aux->fetch_array();
$total=$precio['total'];
$iva=($total*12)/100;
$subtotal=$total-$iva;
$pdf->SetFont('Helvetica','i',10);
$pdf->Cell(120,24,"Esta Factura No es Valida Sin El Sello y la Firma Autorizada",1,0,"C");
$pdf->SetFont('Helvetica','B',13);
    $pdf->Cell(35,8,"SubTotal Bs:",1,0,"C");
$pdf->SetFont('Helvetica','',13);
      $pdf->Cell(35,8,$subtotal,1,1,"C");

      $pdf->Cell(120,8,"",0,0,"C");
     $pdf->SetFont('Helvetica','B',13);
    $pdf->Cell(35,8,"Iva 12% Bs:",1,0,"C");
$pdf->SetFont('Helvetica','',13);

      $pdf->Cell(35,8,$iva,1,1,"C");

      $pdf->Cell(120,8,"",0,0,"C");
    $pdf->SetFont('Helvetica','B',13);
    $pdf->Cell(35,8,"Total Bs:",1,0,"C");
$pdf->SetFont('Helvetica','',13);

      $pdf->Cell(35,8,$total,1,1,"C");
      $pdf->Cell(190,15,"",0,1,"L");
       $pdf->SetFont('Helvetica','B',13);
       $pdf->Cell(190,8,"__________________",0,1,"C");
        $pdf->Cell(190,5," FIRMA AUTORIZADA",0,1,"C");


$pdf->Output('Factura:'.$codigo.'.pdf','D');

header("location:../index.php");
 ?>
