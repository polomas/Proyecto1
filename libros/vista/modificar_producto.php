<?php require_once'../seguridad/seguridad.php';
$nivel=$_SESSION["nivel"];
if ($nivel!=1) {
header("location:Buscar_producto.php?errno_User");
}
require_once("../modelo/ModCon.php");
extract($_GET);
$modelo=new ModCon();
$conexion=$modelo->conectar();
 if (isset($_GET['rss_cat'])) {
  $variable=$_GET['rss_cat'];
   $conexion->query("INSERT INTO categorias(categoria) VALUES ('$variable')");
 }

if (isset($_GET['update_pro'])) {


 $sql=  $conexion->query("select id_categoria from categorias WHERE categoria='$categoria'");
 $row=$sql->fetch_array();
$categoria= $conexion->query("select existencia_pro from productos WHERE id_producto='$id'");
$producto=$categoria->fetch_array();
 if ($tipo_operacion=="suma") {
  $tmp=$producto[0]+$cant;
 }else{
$tmp=$producto[0]-$cant;
}
 
if ($tmp>0) {
  
  if ($conexion->query("UPDATE productos SET id_categoria='$row[0]',nombre_pro='$nombre',existencia_pro='$tmp',precioxU='$precio', status='activo' WHERE id_producto='$id'")) {
    header("location:Buscar_producto.php?Producto_modificado");
  }else{  header("location:Buscar_producto.php?Duplicate");}
 }else if ($tmp==0) {

if ($conexion->query("UPDATE productos SET id_categoria='$row[0]',nombre_pro='$nombre',existencia_pro='$tmp',precioxU='$precio', status='agotado' WHERE id_producto='$id'")) {
  header("location:Buscar_producto.php?Producto_modificado");
}else{header("location:Buscar_producto.php?Duplicate");}


}else if ($tmp<0) {
  header("location:Buscar_producto.php?warning");}
   
}
 
 
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Anthony Araujo">
    <link rel="icon" href="../../favicon.ico">

    <title>.:Registro Producto:.</title>

    <!-- Bootstrap core CSS -->
    <link href="../Bootstrap/css/bootstrap.css" rel="stylesheet">
     <link href="../css/MyStyle.css" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="../css/calendario.css">
  <script type="text/javascript" src="../js/jquery.js"></script>
  


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
$user=$conexion->query("SELECT t1.id_usuario,t2.id_empleado, t2.nombres,t2.apellidos as apellidos
FROM usuarios t1
RIGHT Join empleados t2  ON t1.id_empleado=t2.id_empleado
WHERE t1.id_empleado='$log'");
$usr=$user->fetch_array();

 ?>
<label  id="log" class="navbar-left"><b><?php echo "<span class='glyphicon glyphicon-user' aria-hidden='true'></span>&nbsp;". $usr['nombres']."&nbsp;".$usr['apellidos']."&nbsp;";?></b></label>

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
     

  
    </nav>
 <div id="panel" class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
<table border="0" width="100%" align="center">
  <tr>
   
   <td><center> <b id="titulo_header"> EDITAR PRODUCTO</b></center>
   </td>
 
     <td width="230"> <div class="btn-group" role="group" aria-label="...">
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
       <th width="185px" colspan="1">
    <a href="Buscar_producto.php"class="btn btn-danger"> <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>&nbsp;&nbsp; Regresar a Productos</a>
 
        </th>
        <th width="150px"> <button type="button" data-toggle="modal" data-target="#nuevaCategoria"  id="btnFinVenta" class="btn btn-default"> <span class="glyphicon glyphicon-link" aria-hidden="true"></span>&nbsp;Nueva Categoria</button> </th>
     
  </tr>
</table>
  </div>
  <div class="panel-body">
  <div class="container-fuid">
  <div class="row">
<div class="col-xs-5 ">

<table width="30%" class="table table-bordered">
  <tr><td>
<?php
//_______EDITAR PRODUCTO__________
$sql=$conexion->query("SELECT t1.codigo_pro,t1.nombre_pro,t1.fecha_registro,t1.precioXu,t1.existencia_pro,t2.categoria
from productos t1
inner join categorias t2 on t1.id_categoria=t2.id_categoria where t1.id_producto='$id'");
$fila=$sql->fetch_array();

 ?>




    <form class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3"  class="col-sm-3 control-label">Código&nbsp;&nbsp;&nbsp;</label>
    <div class="col-sm-9">
      <input type="codigo" disabled class="form-control" id="inputEmail3" value="<?php echo $fila[0] ?> ">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-3 control-label">Fecha_Registro&nbsp;&nbsp;&nbsp;</label>
    <div class="col-sm-9">
      <input type="text" disabled class="form-control" value="<?php echo $fila[2] ?> " id="inputPassword3">
    </div>
  </div>
  
</form>
  </td></tr>
 
</table>
<table class="table">
<form action="" class="form-inline">
  <tr>
    <th><b>Nombre Del Articulo:</b></th>
     <td><input type="text" name="nombre" value="<?php echo $fila[1] ?> "class="form-control" onkeyup="this.value=this.value.toUpperCase()"></td>
  </tr>
<tr>

    <th><b>Categoria</b></th>
     <td> <select name="categoria" id="categoria">
        <option ><?php echo $fila[5]  ?></option>
         <?php $row=$sql=$conexion->query("SELECT categoria from categorias  "); 
        while ( $row=$sql->fetch_array()) {
         echo "<option > ".$row[0]."</option>";
        }
         ?>
        </select>
       
</td>

  </tr>

   <tr>
    <th><b>Precio $.</b></th>
     <td><input type="text" name="precio" value="<?php echo  $fila[3] ?> " class="form-control"></td>
  </tr>



   <tr>
    <th><table width="100%">
      <tr>
        <td width="90%"><b>Stock: </b></td>
        <td><input type="text"disabled value="<?php echo  $fila[4]?>" class="form-control input-personalizado texto_center" id="TxtCant" ></td>
      </tr>
    </table></th>
     <td>
<table>
  <tr>
    <td><select required name="tipo_operacion" id="categoria"  >
      <option value="suma">Sumar</option>
        <option value="resta">Restar</option>
     </select></td>
    <td><select required name="cant" id="cantidad_inv"  title="debes seleccionar una opcion con respecto al inventario" >
      <option value="">Seleccione</option>
       <?php for ($i=0; $i <=50 ; $i++) { 
         echo " <option value=".$i.">".$i."</option>";
        } ?>

     </select></td>
  </tr>
</table>



     </td>
  </tr>
   <input type="hidden" name="update_pro" >
   <input type="hidden" name="id" value="<?php echo $id ?>">
    <tr>
    <th><button type="submit" class="btn btn-primary btn-sm btn-block"> <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>&nbsp;Guardar Cambios</button></th>
     <td></td>
     </form>
  </tr>
</table>
  <!-- Contenedor de ventas  -->
  </div>
</div>
</div>

  </div>


  <!-- Table -->

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
<!--/.Modal nueva categoria
*
*
*
*
*--><div class="modal fade" id="NuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
        </select></td>
      </tr>
      <tr>
        <th><label for="Mcedula"><b id="asterisco">(*)</b>Cedula:</label>  </th>
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
          <option >VENEZOLANO</option>
          <option >COLOMBIANO</option>
        </select>

      </tr>

            <tr>
        <th><label for="Mfecha"><b id="asterisco">(*)</b>Fecha_nac:</label></th>
        <td><input type="text" name="fecha_nac" class="form-control"  id="fecha1" placeholder="2010-09-30"></td>
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
          <option value="58">Venezuela +58</option>
          <option value="43">Colombia</option>
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
        <button type="button" class="btn btn-primary" onclick="Mregistrar()">Registrar Cliente</button>
        <input type="hidden" name="registrarCliente">
        </form>
      </div>
    </div>
  </div>
</div>

</div>
<!--/.FIN modal Registrar nuevo cliente -->
<div class="modal fade" id="nuevaCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><center><span class="glyphicon glyphicon-link" aria-hidden="true"></span> <b id="titulo_header"> Nueva categoria</b></center></h4>
      </div>
      <div class="modal-body">
     

<form class="form-horizontal" id="form_categoria2">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Nombre_Categoria</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="rss_cat" required id="inputEmail32" placeholder="Defina una categoria" onkeyup="this.value=this.value.toUpperCase()">
    </div>
  </div>
 </div>
<input type="hidden" name="id" value="<?php echo $id ?>">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" onclick="categoria2()" data-dismiss="modal">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
