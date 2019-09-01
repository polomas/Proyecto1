<?php require_once'../seguridad/seguridad.php';
require_once("../modelo/ModCon.php");
extract($_GET);
$modelo=new ModCon();
$conexion=$modelo->conectar();
 $nivel=$_SESSION["nivel"];

if ($nivel==1) {
 if (isset($_GET['rss_cat'])) {
  $variable=$_GET['rss_cat'];
   $conexion->query("INSERT INTO categorias(categoria) VALUES ('$variable')");
}
 
 }


if (isset($_GET['sql_newTokens'])) {
require_once('../seguridad/Seguro_inventario.php');
}
if (isset($_GET["lst"])) {
//______DATOS DEL CLIENTE_________
  $id_cliente=$_SESSION["id_cliente"]; 
$sql=$conexion->query("SELECT t1.id_cliente,t1.cedula,t1.nombre,t1.apellido,t1.nacionalidad,t2.telefono,t3.direccion
from clientes t1
Left JOIN tlf_cliente t2 on t2.id_cliente=t1.id_cliente
Left JOIN direccion_cliente t3 on t3.id_cliente=t1.id_cliente where t1.status=1 AND t3.status=1 And t1.id_cliente='$id_cliente' ");
$num=$sql->num_rows;
  if ($num>0) {
    $cliente=$sql->fetch_array();}}
//________DATOS PRODUCTOS__________
if (isset($_GET["pro"])) {
  $sfpro=$_GET["pro"];
  if ( $sfpro=="sf") {
  $id_codigo=$_SESSION["id_producto"]; 
  $sql=$conexion->query("SELECT t1.id_producto, t1.codigo_pro as codigo,t1.nombre_pro ,t1.existencia_pro as stock,t1.precioxU as precio,t2.categoria
from productos t1
Left JOIN categorias t2 on t1.id_categoria=t2.id_categoria
where t1.status='activo' AND  t2.status=1 AND t1.id_producto='$id_codigo' ");

  $num=$sql->num_rows;
  if ($num>0) {
    $producto=$sql->fetch_array();
$stock=$producto['stock'];
  }
}

}
/*AQUI EVITO QUE SE PIERDA EL INVENTARIO*/
//_________AQUI IMPIMO LA FACTURA________
if (isset($_GET['fact']) && isset($_GET['Tokes_fact'])) {

header('location:venta.php?urldecode');
}  
if (isset($_GET['urldecode'])) {

header('location:../reportes/factura.php');
}  

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Anthony Araujo">
    <link rel="icon" href="../../favicon.ico">

    <title>.:Venta:.</title>

    <!-- Bootstrap core CSS -->
    <link href="../Bootstrap/css/bootstrap.css" rel="stylesheet">
     <link href="../css/MyStyle.css" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="../css/calendario.css">
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/calendario.js"></script>
   <script type="text/javascript" src="../js/ajax.js"></script>
  <script type="text/javascript">
    $(function(){
      $("#fecha1").datepicker();
      $("#fecha2").datepicker({
        changeMonth:true,
        changeYear:true,
      });
      $("#fecha3").datepicker({
        changeMonth:true,
        changeYear:true,
        showOn: "button",
        buttonImage: "css/images/ico.png",
        buttonImageOnly: true,
        showButtonPanel: true,
      })
    })
  </script>

  </head>
 <body onload="mueveReloj()">

      <nav class="navbar navbar-inverse navbar-fixed-top" id="contenedornavbar">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php include_once "menu.php"; ?>
          </ul>
          
<div class="btn-group navbar-form navbar-right" >
<?php 
$log=$_SESSION['id'];
$user=$conexion->query("SELECT id_empleado,nombres,apellidos
FROM empleados
WHERE id_empleado='$log'");
$empleado=$user->fetch_array();

 ?>
<label  id="log" class="navbar-left"><b><?php echo "<span class='glyphicon glyphicon-user' aria-hidden='true'></span>&nbsp;".$empleado['nombres']."&nbsp;".$empleado['apellidos']; ?></b></label>

  <button id="btnConfi" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
   <img src="../img/confi2.png" width="30" alt="">
  </button>
  <ul class="dropdown-menu" role="menu">
  <!--/.tipo de usuario -->
      <li id="tipo"><aid="tipo" ><span class="glyphicon glyphicon-tent" aria-hidden="true"></span>
       <?php
 if ($nivel==1) {
   echo "Administrador";
 }else echo "Empleado";
?>

      </a></li>
    <li><a id="HoverSubmenus" href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp;Perfil</a></li>
    <li><a id="HoverSubmenus" id="HoverSubmenus" href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> &nbsp;Configuracion</a></li>
    <li><a id="HoverSubmenus" href="#"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> &nbsp;Reporte Personal</a></li>
    <li class="divider"></li>
    <li><a id="HoverSubmenus"href="../index.php?Sc"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> &nbsp;Salir del sistema</a></li>
  </ul>
</div>

        </div><!--/.nav-collapse -->
      </div>
     
<!--       <article id="navbar3">
       <button type="button" class="btn btn-default btn2" id="btn0"aria-label="Left Align">
 <img src="../img/fact.png" width="40" alt="">

<button type="button" class="btn btn-default btn2" id="btn1"aria-label="Left Align">
  <span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span>
</button>
<button type="button" class="btn btn-default btn2" id="btn2"aria-label="Left Align">
  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
</button>
<button type="button" class="btn btn-default btn2" id="btn2"aria-label="Left Align">
  <span class="glyphicon glyphicon glyphicon-usd" aria-hidden="true"></span>
</button>

<button type="button" class="btn btn-default btn2 btn3" id="btn3"aria-label="Left Align">
  <span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span>
</button>



</article> -->
  
    </nav>
 <div id="panel" class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
<table border="0" width="100%" align="center">
  <tr>
   
   <td><b>FACTURA:</b><?php require '../require/numFactura.php'; ?>&nbsp;&nbsp;&nbsp;Atendido por&nbsp;
 <button type="button" disabled class="btn btn-default"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>&nbsp;<?php echo $empleado['nombres']."&nbsp;".$empleado['apellidos']; ?></button>
   </td>
 
    <td width="235"> <div class="btn-group" role="group" aria-label="...">
  <button type="button" id="btnAzulCielo" disabled class="btn btn-info"><b><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;
  <?php $fecha=date("d/m/Y");
echo $fecha;
  ?></b></button>
  <button type="button" id="btnAzulCielo"disabled class="btn btn-info">
  <form name="form_reloj">
  &nbsp;<span class="glyphicon glyphicon-dashboard"></span>
<input type="text"disabled class="tamano"  id="reloj"name="reloj" size="10">
</form></button>

</div>
</td>
       <th width="105">
      <div class="btn-group">
  <button type="button" disabled class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      <span class="glyphicon glyphicon-cog"></span>&nbsp;Opciones
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li class="divider"></li>
    <li><a href="#">Separated link</a></li>
  </ul>
</div>
 
        </th>
     <td width="150"> <button type="button"data-toggle="modal" data-target="#FinalizarVenta"  id="btnFinVenta"disabled class="btn btn-primary"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Finalizar Venta</button></td>
  </tr>
</table>
  </div>
  <div class="panel-body">
  <div class="container-fuid">
  <div class="row">
<div class="col-xs-9 ">

  <!-- Contenedor de ventas  -->
  <table border="0" width="100%">
    <tr>
   <td id="aj"><button type="button" disabled class="btn btn-default"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Cliente</button></td>
  <td id="mejor"> <button type="button" class="btn btn-primary btn-sm"data-toggle="modal" data-target="#NuevoCliente"> <span class="glyphicon glyphicon-plus"></span>&nbsp;Nuevo Cliente</button></td>
   <td id="aj"><button type="button" disabled class="btn btn-default"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>&nbsp;Articulo</button></td>
         <td> <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ListarPro"> <span class="glyphicon glyphicon-th-list"></span>&nbsp;Listar Articulos</button></td>
    </tr>
    <tr>
    <td id="mejor" colspan="2"><?php 
    if (isset($_GET["clt_nf"])) {
        echo "  <div  id='alerta2' class='alert alert-danger' role='alert'>.:cliente no Registrado:. <span class='glyphicon glyphicon-arrow-up'></span></div>
";
      } else {
           echo "  <div  id='alerta2' class='alert alert-success' role='alert'>.:Ingrese Cedula:.</div>
";
      }
      ?></td>
      <td  colspan="2">

      <?php if (isset($_GET["clt_n"])) {
        $aux2=$_GET["pro"];
        if ($aux2=="nf") {
           echo "  <div  id='alerta2' class='alert alert-danger' role='alert'>.:producto no encontrado:.</div>";
        }else if ($aux2=="agotado") {
        echo "  <div  id='alerta2' class='alert alert-danger' role='alert'>.:Articulo Agotado:.</div>";
        }else {echo "  <div  id='alerta2' class='alert alert-success' role='alert'>.:Ingrese codigo del Producto:.</div>";
      } 
    } else {
           echo "  <div  id='alerta2' class='alert alert-warning' role='alert'>.:Valida el cliente:.</div>";

      }
      ?>
    
      </td>
    </tr>

    <tr>
      <table border="0" id="tablaVenta"width="100%">
        <tr>
         <th >Cedula:</th>
           <td>
            <form class="form-inline" id="Buscar_X_Cedula" action="../controlador/Controlador.php">
  <div class="form-group">
 <select name="Nacionalidad" id="nacionV" >
   <option value="Venezolano">V-</option>
    <option value="Colombiano">C-</option>
        <option value="Extranjero">E-</option>
  
 </select>
      <input type="hidden" name="operacion"value="BCV">
    <input type="text" class="form-control" name="cedula" id="TxtCedula"  onkeypress="return pulsar(event)" placeholder="<?php echo $cliente['cedula'] ?>" maxlength="11" >
  </div>
  <button type="button" id="buscarbtn" onclick="buscarCedulaCliente()" class="btn btn-default"> <span class="glyphicon glyphicon-search"></span></button>

</form>
</td>
          <th>CodProducto:</th>
             <td>  <form class="form-inline" id="Buscar_X_Codigo" action="../controlador/Controlador.php">
  <div class="form-group">
  <input type="hidden" name="operacion"value="BCP">
    <input type="text" class="form-control" name="codigo_pro" id="TxtCodPro" disabled onkeypress="return pulsar(event)" placeholder="<?php echo $producto['codigo'] ?>" maxlength="9" >
  </div>
  <button type="button" id="buscarbtnpro" disabled onclick="buscarCodigoProducto()" class="btn btn-default"> <span class="glyphicon glyphicon-search"></span></button>

</form></td>


              <th>Precio:</th>
               <td><input type="text"disabled value="<?php echo $producto['precio'] ?>" id="TxtPrecio" class="form-control"></td>
        </tr>

                               <tr>
                                <th >Nombres:</th>
                                  
                        <td><input type="text"disabled value="<?php echo $cliente['nombre']."&nbsp;".$cliente['apellido']; ?>" class="form-control" id="Txtcliente"></td>
                                  
                                 <th>&nbsp;Articulo:</th>
                                    <td><input type="text"disabled value="<?php echo $producto['nombre_pro'] ?>" class="form-control" id="TxtArticulo"></td>
                                     <th>Stock:</th>
                                      <td><input type="text"disabled  id="TxtStock" value="<?php echo $producto['stock'] ?>" class="form-control"></td>
                                   </tr>


                               <tr>
                                <th >Telefono:</th>
                                  <td><input type="text"disabled value="<?php echo $cliente['telefono'] ?>" id="Txtlf" class="form-control"></td>
                                 <th>&nbsp;Categoria</th>

                                    <td><input type="text"disabled value="<?php echo $producto['categoria'] ?>"  class="form-control" id="TxtCategoria"></td>
                                     <th>Cantidad:</th>
                                      <td><select disabled="" name="nacionalidad" id="TxtCant">
                                       <option value=""></option>
                                      <?php for ($i=1; $i <=$producto['stock'] ; $i++) { 
                                 
                                 echo " <option>$i</option>";
                                      } ?>
        </select></td>                </select>
                                   </tr>


                                    <tr>
                                <th  >Direccion:</th>
                                  <td colspan="3"><input type="text"disabled value="<?php echo $cliente['direccion'] ?>" id="txtDireccion" class="form-control" ></td>

 <td><button type="button" id="colorbtn" disabled class="btn btn-warning "><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</button></td>
<td>
<form action="../controlador/Controlador.php" id="form_carrito">
<input type="hidden" name ="id_producto"  value="<?php echo $producto['id_producto'] ?>">
<input type="hidden" name ="codigo_pro" value="<?php echo $producto['codigo'] ?>">
<input type="hidden" name ="articulo"  value="<?php echo $producto['nombre_pro'] ?>">
<input type="hidden" name ="cantidad" id="kcantidad" value="">
<input type="hidden" name ="precio"  value="<?php echo $producto['precio'] ?>">
<input type="hidden" name ="agregar_carrito" >
<button type="button" id="btnAgregar" onclick="agregarCarrito()" disabled class="btn btn-info"><b><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
Agregar</button></form></td>
                                   </tr>
                                   <tr>
                                     <th>Ultima Compra:</th>
                                     <td><input type="text"disabled  id="TxtCompra" class="form-control"></td>
                                   </tr>
      </table>
    </tr>

  </table>
</div>

</div>
<div class="row">
<div class="col-xs-9 ">
<?php  $sql=$conexion->query("SELECT cod ,nombre_pro,sum(cant) as cantidad,precio,sum(total)as total FROM carrito_compras  GROUP BY nombre_pro");
       $num=$sql->num_rows;
       if ($num>0) {
          ?>
          <input type="hidden" id="act_FinalizarVenta" value="Activation">
 <table class="table"  width="80%"  id="table"> 
   
<tr id="carrito">
  <th id="thCodigo"class="tablaHeader">IdPro</th>
    <th id="thNombre"class="tablaHeader">Descripcion</th>
      <th id="thCant"class="tablaHeader">Cant</th>
        <th id="thPrecio"class="tablaHeader">Precio C/U</th>
    
            <th id=""class="tablaHeader">Total</th>
            <th id="tablaHeader2" >Quitar</th>
</tr>
   </table>
          <div id="scroll" overflow="auto" width="80%">
        <table class="table table-striped table-hover" border="0" >

        <?php 
     while($compra=$sql->fetch_array()) { 
         ?>
          <tr>
  <th id="thCodigo"><?php echo $compra['cod'] ?></th>
    <th id="thNombre"><?php echo $compra['nombre_pro'] ?></th>
      <th id="thCant"><?php echo $compra['cantidad'] ?></th>
        <th id="thPrecio"><?php echo $compra['precio'] ?></th>
        
            <th><?php echo $compra['total']; ?></th>
<th id="operaciones"><?php  echo"<a href='../controlador/Controlador.php?codigo=$compra[0]&cant=$compra[cantidad]&SumarInventario' > <img src='../img/papelera.png' width='20px;' ></a>"?></th>
</tr>
        <?php } ?>
      
            </table>
     </div>

<?php } ?>
  
 </div>

  <div class="col-xs-3 ">
    <table width="90%;" class="table">
    <?php $sql=$conexion->query("SELECT sum(total)as subtotal from carrito_compras") ;
       $fila=$sql->fetch_array();
       $total=$fila['subtotal'];
       $Iva=($total*12)/100;
       $SubTotal=$total-$Iva;
    ?>
      <tr>
        <th>Iva:</th>
        <td><?php echo $Iva ?></td>
      </tr>

        <tr>
        <th>SubTotal:</th>
        <td> <?php echo $SubTotal; ?></td>
      </tr>

        <tr>
        <th class="Total">Total:</th>
        <td class="Total"><?php echo $total; ?></td>
      </tr>
    </table>
  </div>
</div>
</div>

  </div>


  <!-- Table -->
  <input type="hidden" id="cantidad" value="<?php echo $stock; ?>">
  <input type="hidden" id="activacion_pro" value="<?php echo $pro; ?>">
  <input type="hidden" id="active" value="<?php echo $lst; ?>">
 <script type="text/javascript">
 var FinalizarV=document.getElementById('act_FinalizarVenta');
var productoEncontrado=document.getElementById("activacion_pro");
var cedulaEncontrada=document.getElementById("active");
var finVenta=document.getElementById('btnFinVenta');
if (cedulaEncontrada.value==1) {
  document.getElementById("TxtCodPro").disabled=false;
   document.getElementById("buscarbtnpro").disabled=false;
    document.getElementById("TxtCodPro").focus();
}
if (productoEncontrado.value=="sf") {
  document.getElementById("TxtCant").disabled=false;
   document.getElementById("btnAgregar").disabled=false;
    document.getElementById("TxtCant").focus();
    document.getElementById("TxtCant").value="01";
}
if (FinalizarV.value=="Activation") {
finVenta.disabled=false;
};

 </script>
</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="../Bootstrap/js/bootstrap-transition.js"></script>
    <script src="../Bootstrap/js/bootstrap-alert.js"></script>
    <script src="../Bootstrap/js/bootstrap-modal.js"></script>
    <script src="../Bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="../Bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="../Bootstrap/js/bootstrap-tab.js"></script>
    <script src="../Bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../Bootstrap/js/bootstrap-popover.js"></script>
    <script src="../Bootstrap/js/bootstrap-button.js"></script>
    <script src="../Bootstrap/js/bootstrap-collapse.js"></script>
    <script src="../Bootstrap/js/bootstrap-carousel.js"></script>
    <script src="../Bootstrap/js/bootstrap-typeahead.js"></script>
    <script src="../js/validaciones.js"></script>
<!--/.Modal listar Producto 
*
*
*
*
*-->
<div class="modal fade" id="NuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <center> <h4 class="modal-title" id="myModalLabel"> <img id="newuser"src="../img/nuevo_usuario.jpg" width="80px;"> <b id="titulo_r"> Registro De Clientes</b></h4></center>
      </div>
      <div class="modal-body">
    <form action="../controlador/Controlador.php" id="form_modal"class="form-inline">

    <table id="tabla_modal">

     <tr>
        <th><label for="Mcedula"><b id="asterisco">(*)</b>Tipo:</label>  </th>
        <td><select id="tipoN" name="tipo">
          <option value="">SELECCIONE</option>
            <option value="V-">N- NATURAL</option>
              <option value="J-">J- JURIDICO</option>
                <option value="E-">E- EXTRANJERO</option>
        </select>
        </td>
      </tr>

      <tr>
        <th><label for="Mcedula"><b id="asterisco">(*)</b>CI/RUC:</label>  </th>
        <td><input type="text" name="cedula" maxlength="10" class="form-control" id="Mcedula" placeholder="123456789"></td>
      </tr>

      <tr>
        <th><label for="Mnombre"><b id="asterisco">(*)</b>Nombre:</label></th>
        <td><input type="text" name="nombre" maxlength="45" class="form-control" id="Mnombre" placeholder="example: Nombre Alguien" onkeyup="this.value=this.value.toUpperCase()"></td>
      </tr>

            <tr>
        <th><label for="Mapellido"><b id="asterisco">(*)</b>Apellido:</label></th>
        <td><input type="text" name="apellido" maxlength="45" class="form-control" id="Mapellido" placeholder="example Apellido Alguien" onkeyup="this.value=this.value.toUpperCase()"></td>
      </tr>
      <tr>
         <th><label for="Mapellido"><b id="asterisco">(*)</b>Nacionalidad:</label></th>
        <td><select name="nacionalidad" id="nacion">
        <option value="">SELECCIONE</option>
          <option >ECUATORIANA</option>
          <option >EXTRANJERO</option>
        </select>

      </tr>

            <tr>
        <th><label for="Mfecha"><b id="asterisco">(*)</b>Fecha_nac:</label></th>
        <td><input type="date" name="fecha_nac" class="form-control"  id="fecha1" placeholder="2010-09-30"></td>
      </tr>

            <tr>
        <th><label for="genero"><b id="asterisco">(*)</b> Genero:</label></th>
        <td><select name="genero" id="genero">
        <option value="">SELECCIONE</option>
          <option value="M">MASCULINO</option>
          <option value="F">FEMENINO</option>
        </select></td>
      </tr>
      
         <tr>
        <th><label for="Mtelefono">telefono</label></th>
        <td>
        <select name="codigoTlf" id="Stele">
          <option value="">SELECCIONE</option>
          <option value="593">ECUADOR +593</option>
          <option value="00">OTROS</option>
        </select> 
    <input type="text" name="telefono" class="form-control" id="Mtelefono">
  
  </div></td>
      </tr>

           <tr>
        <th><label for="Mdireccion"><b id="asterisco">(*)</b> Direccion:</label></th>
        <td> <textarea rows="3" name="direccion" span="70" id="Mdireccion" maxlength="120" class="form-control" onkeyup="this.value=this.value.toUpperCase()"placeholder="::Maximo 150 Caracteres:."></textarea></td>
      </tr>
    </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="registra_cliente()">Registrar Cliente</button>
        <input type="hidden" name="registrarCliente">
        </form>
      </div>
    </div>
  </div>
</div>

</div>
<!--/.FIN modal Registrar nuevo cliente -->

<!--/.Modal Finalizar venta
*
*
*
*
*-->



<!-- Modal -->
<div class="modal fade" id="FinalizarVenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <center> <h4 class="modal-title" id="myModalLabel"> <img id="newuser"src="../img/fact.png" width="60px;"> <b id="titulo_fact"> .:FACTURA VIRTUAL:.</b></h4></center>
      </div>
      <div class="modal-body">
      <center>
       <table width="80%" border="0" align="center">
         <tr>
           <th colspan="4"id="fact_aling"><h4>Fundación Vida Nueva</h4></th>
         </tr>
         <tr>
         <th colspan="4"id="fact_aling">Guamani</th>
            </tr>

            <tr>
              <td ><b>Fecha:</b><?php echo  "&nbsp;&nbsp;".$fecha; ?></td>
               <td colspan="2"> <b>Factura:</b> 001-<?php require '../require/numFactura.php'; ?></td>
            </tr>

             <tr>
              <td colspan="4"><b>Vendedor:</b><?php echo  "&nbsp;&nbsp;".$empleado['nombres']."&nbsp;".$empleado['apellidos']; ?></td>
            </tr>



             <tr>
              <td ><b>Cliente:</b><?php echo "&nbsp;&nbsp;".$cliente['nombre']."&nbsp;".$cliente['apellido']; ?></td>
               <td><b>Rif/CI:</b><?php echo "&nbsp;&nbsp;".$cliente['cedula'] ?></td>
            </tr>

            <tr>
              <td id="fact_aling" colspan="4"><b>FACTURA</b></td>
            </tr>
               <tr>

              <td><b>Articulo</b></td>
                <td><b>Cant</b></td>
                <td><b>PrecioU</b></td>
                  <td><b>Precio</b></td>
               </tr>
               <?php  
 $stm=$conexion->query("SELECT nombre_pro,sum(cant) as cantidad,precio,sum(total)as total FROM carrito_compras where cant >0 GROUP BY nombre_pro");
while($fact=$stm->fetch_array()) {  ?>
               <tr>

                

              <td><?php  echo $fact['nombre_pro']?></td>
                <td><?php  echo "X&nbsp;".$fact['cantidad']?></td>
                 <td><?php  echo "$&nbsp;&nbsp;".$fact['precio']?></td>
                  <td><?php echo "$&nbsp;&nbsp;".$fact['total']  ?></td>
               </tr>
        <?php  }  ?>
                <tr>
                 <td colspan="4"><center><b>-----------------------------------------------------------------------------------------------</b></center></td>
                 
               </tr>
                 <tr>
              <td><b>SUBT</b></td>
                <td colspan="3"id="aling_right" >  <?php echo "$&nbsp;&nbsp;".$SubTotal; ?></td>
              


               </tr>

                <tr>
              <td><b>IVA</b> (12%)</td>
                <td colspan="3" id="aling_right"><b></b>  <?php echo "$&nbsp;&nbsp;".$Iva ?></td>
               </tr>


                <tr>
              <td colspan="4"><center><b>-----------------------------------------------------------------------------------------------</b></center></td>
                
               </tr>
               <tr>
              <td><h4>TOTAL</h4></td>
                <td colspan="3" id="aling_right"><h4>$<?php echo "&nbsp;&nbsp;".$total; ?> </h4></td>
               </tr>


       </table>
       </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button"data-toggle="modal" id="Btnfacturar" data-target="#ModoPago"  class="btn btn-primary">Facturar</button>
      </div>
    </div>
  </div>
</div>

<!--/.mode de pago -->

<div class="modal fade" id="ModoPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <center> <h4 class="modal-title" id="myModalLabel"> <img id="newuser"src="../img/venta.jpg" width="80px;"> <b id="titulo_fact"> .:VENTA:.</b></h4></center>
     </div>
      <div class="modal-body">
       <form action="../controlador/Controlador.php" id="form_fin">
       <table>
          <tr>
        <th colspan="2" id="fact_aling"><label ><h4>Confirme La venta A</h4></label></th>
       </tr>
           <tr>
        <th><label >Cliente:</label></th>
        <td><input type="text" maxlength="45" class="form-control" id="campo"value="<?php echo $cliente['cedula']."&nbsp;&nbsp;".$cliente['nombre']."&nbsp;".$cliente['apellido']; ?>" ></td>
      </tr>

         <tr>
        <th><label >Por $:</label></th>
        <td><input type="text" maxlength="45" class="form-control" id="campo"value="<?php echo "&nbsp;".$total; ?>" ></td>
      </tr>
     
       </table>
      </div>
<input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']?>">
<input type="hidden" name="id_empleado" value="<?php echo $empleado['id_empleado']?>">
<input type="hidden" name="Facturacion" >


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="finalizarV()" id="btnFinalizarvta" class="btn btn-info"><span class="glyphicon glyphicon-saved"></span> Finalizar</button>
    </form>
      </div>
    </div>
  </div>
</div>
<?php //_______________LISTAR PRODUCTOS_________ ?>
<!-- Button trigger modal -->


<div class="modal fade" id="ListarPro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog"id="tamano_modal">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center> <h4 class="modal-title" id="myModalLabel"> <img id="newuser"src="../img/buscar.jpg" width="80px;"> <b id="titulo_t"> Busqueda De Producto por Filtro</b></h4></center>
     
      </div>

      <div class="modal-body">
      <div class="form-group-lg ">
<input type="text"class= "form-control" maxlength="40" placeholder="Busqueda Por Filtro" id="filtrar"/>
 </div>
<div id="listar_productos">
  

    <?php 
$sql=$conexion->query("SELECT t1.codigo_pro,t1.nombre_pro,t2.categoria,t1.fecha_registro,t1.existencia_pro,t1.precioXu,t1.status,t1.id_producto
from  productos t1
inner join categorias t2 on t1.id_categoria=t2.id_categoria ORDER BY t1.nombre_pro asc limit 10");
$num=$sql->num_rows;
if ($num>0) {?>
<table  class="table table-striped table-condensed table-hover">
    <tr>
    <th class="headerT">CÓDIGO</th>
    <th class="headerT">ARTICULO</th>
    <th class="headerT">CATEGORIA</th>
    <th class="headerT">FECHA_ING</th>
    <th class="headerT">STOCK</th>
    <th class="headerT">PERCIO</th>
    <th class="headerT">STATUS</th>

</tr>
<?php
  while ($fila=$sql->fetch_array()) {
 ?> 
 <tr>
     <td><?php echo $fila[0] ?></td>
    <td><?php echo $fila[1] ?></td>
    <td><?php echo $fila[2] ?></td>
    <td><?php echo $fila[3] ?></td>
    <td><?php echo $fila[4] ?></td>
    <td><?php echo $fila[5] ?></td>
    <td><?php $status=$fila[6];
if ($status=="activo") {
 echo '  <button type="button" class="btn btn-success btn-xs"> <span class="glyphicon glyphicon-ok"></span>&nbsp;Activo</button>' ;
}else{ echo  '<button type="button" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-remove"></span>&nbsp;Inactivo</button>';} ?></td>
</tr>
  <?php 
}}else{
  echo "<h4>No se ah registrado ningun producto</h4>";
}

     ?>

    <tr>
      
    </tr>
  </table>
  


</div>



  </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" id="cancelarBus" class="btn btn-default" data-dismiss="modal">Cerrar Busqueda</button>
      
      </div>
    </div>
  </div>
</div>
</body>
</html>


<div class="modal fade" id="categoriaMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><center><span class="glyphicon glyphicon-link" aria-hidden="true"></span> <b id="titulo_header"> Nueva categoria</b></center></h4>
      </div>
      <div class="modal-body">
 
<form class="form-horizontal" id="form_categoria">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Nombre_Categoria</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="rss_cat" required id="inputEmail3" placeholder="Defina una categoria" onkeyup="this.value=this.value.toUpperCase()">
    </div>
  </div>
 </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" onclick="categoria()" data-dismiss="modal">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
