<?php require_once'../seguridad/seguridad.php';
$nivel=$_SESSION["nivel"];
if ($nivel!=1) {
header("location:Buscar_cliente.php?errno_User");
}
require_once("../modelo/ModCon.php");
extract($_GET);
$modelo=new ModCon();
$conexion=$modelo->conectar();
 if (isset($_GET['rss_cat'])) {
  $variable=$_GET['rss_cat'];
   $conexion->query("INSERT INTO categorias(categoria) VALUES ('$variable')");
 }

 
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Anthony Araujo">
    <link rel="icon" href="../../favicon.ico">

    <title>.:Cliente:.</title>

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
          <a class="navbar-brand" href=""><img id="logotipo"src="../img/logo.png" alt=""></a>
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
     
      <article id="navbar3">
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



</article>
  
    </nav>
 <div id="panel" class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
<table border="0" width="100%" align="center">
  <tr>
   
   <td><center> <b id="titulo_header">  VISUALIZACION DE CLIENTES</b></center>
   </td>
 
     <td width="240"> <div class="btn-group" role="group" aria-label="...">
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
       <th width="175" colspan="1">
    <a href="Buscar_cliente.php"class="btn btn-danger"> <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>&nbsp;&nbsp; Regresar a Clientes</a>
 
        </th>
        <th width="110"> <a type="button"  id="btnFinVenta" class="btn btn-warning"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Descargar</a> </th>
        <th width="120"> <?php echo '<a  href="modificar_cliente.php?id='.$id.'" class="btn btn-success"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Modificar</a> ' ?></th>
     
  </tr>
</table>

<?php $sql=$conexion->query("SELECT t1.*,t2.*,t3.direccion,date_format(t1.fecha_ing, '%d/%m/%Y') as fecha_registro,date_format(t1.fecha_nac, '%d/%m/%Y') as fecha_nac
FROM clientes t1 
LEFT JOIN tlf_cliente t2 ON t2.id_cliente=t1.id_cliente
LEFT JOIN direccion_cliente t3 ON t3.id_cliente=t1.id_cliente
WHERE t1.id_cliente='$id'");
$fila=$sql->fetch_array();?>
  </div>
  <div class="panel-body">
  <div class="container-fuid">
  <div class="row">

<div class="col-xs-5 ">
 <table class="table table-striped table-condensed table-bordered">
   <tr>
     <td id="titulo_pro" class="bold texto_center">CEDULA:</td>
      <td ><input type="text" disabled="" id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['cedula'] ?>"></td>
   </tr>
   <tr>
     <td id="titulo_pro" class="bold texto_center">NACIONALIDAD:</td>
      <td ><input type="text" disabled="" id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['nacionalidad'] ?>"></td>
   </tr>

    <tr>
     <td id="titulo_pro" class="bold texto_center">NOMBRE:</td>
      <td ><input type="text" disabled id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['nombre'] ?>"></td>
   </tr>


    <tr>
     <td id="titulo_pro" class="bold texto_center">APELLLIDO:</td>
      <td ><input type="text" disabled id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['apellido'] ?>"></td>
   </tr>

   <tr>
     <td id="titulo_pro" class="bold texto_center">GENERO:</td>
     <?php if ($fila['genero']=="M") {
      $genero="MASCULINO";
     }else{
      $genero="FEMENINO";
      } ?>
      <td ><input type="text" disabled id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $genero ?>"></td>
   </tr>


 </table>
  </div>
   
  <div class="col-xs-5 ">








  <table class="table table-striped table-condensed table-bordered">
  <tr>
     <td id="titulo_pro" class="bold texto_center">FECHA_NACIMIENTO</td>
      <td ><input type="text" disabled="" id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['fecha_nac'] ?>"></td>
   </tr>
   <tr>
     <td id="titulo_pro" class="bold texto_center">FECHA_REGISTRO</td>
      <td ><input type="text" disabled="" id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['fecha_registro'] ?>"></td>
   </tr>
    <tr>
     <td id="titulo_pro" class="bold texto_center">HORA_REGISTRO</td>
      <td ><input type="text" disabled="" id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['hora_registro'] ?>"></td>
   </tr>

    <tr>
     <td id="titulo_pro" class="bold texto_center">TELEFONO:</td>
      <td ><input type="text" disabled="" id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['telefono'] ?>"></td>
   </tr>

   <tr>
     <td id="titulo_pro" class="bold texto_center">DIRECCION:</td>
     
      <td ><textarea name="direccion_emp" rows="5" disabled i maxlength="150" class="form-control"> <?php echo $fila['direccion'];?></textarea></td>
   </tr>


 </table>
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
