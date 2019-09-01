<?php require_once'../seguridad/seguridad.php';
$nivel=$_SESSION["nivel"];
if ($nivel!=1) {
header("location:buscar_usuario.php?errno_User");
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

    <title>.:Empleado:.</title>

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
   
   <td><center> <b id="titulo_header">  VISUALIZACION DE USUARIOS</b></center>
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
    <a href="buscar_usuario.php"class="btn btn-danger"> <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>&nbsp;&nbsp; Regresar a Usuarios</a>
 
        </th>
        <th width="110"> <a type="button"  id="btnFinVenta" class="btn btn-warning"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Descargar</a> </th>
        <th width="120"> <?php echo '<a  href="modificar_empleado.php?id='.$id.'" class="btn btn-success"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Modificar</a> ' ?></th>
     
  </tr>
</table>

<?php $sql=$conexion->query("SELECT t1.*,t1.status as estado,t2.*,t3.*,t4.usuario,t5.direccion_empleado
FROM empleados t1 
LEFT JOIN email_empleado t2 ON t2.id_empleado=t1.id_empleado
LEFT JOIN tlf_empleado t3 ON t3.id_empleado=t1.id_empleado
LEFT JOIN usuarios t4 ON t4.id_empleado=t1.id_empleado
LEFT JOIN direccion_empleado t5 ON t5.id_empleado=t1.id_empleado
WHERE t1.id_empleado='$id'");
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
     <td id="titulo_pro" class="bold texto_center">NOMBRES:</td>
      <td ><input type="text" disabled id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['nombres'] ?>"></td>
   </tr>


    <tr>
     <td id="titulo_pro" class="bold texto_center">APELLLIDOS:</td>
      <td ><input type="text" disabled id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['apellidos'] ?>"></td>
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


     <tr>
     <td id="titulo_pro" class="bold texto_center">FECHA_REG:</td>
      <td ><input type="text" disabled id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['fecha_registro'] ?>"></td>
   </tr>

     <tr>
     <td id="titulo_pro" class="bold texto_center">ESTADO CIVIL:</td>
      <td ><input type="text" disabled id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['edo_civil'] ?>"></td>
   </tr>

   <tr>
     <td id="titulo_pro" class="bold texto_center">GRADO_INSTRUCCION:</td>
      <td ><input type="text" disabled id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['grado_formacion'] ?>"></td>
   </tr>

    <tr>
     <td id="titulo_pro" class="bold texto_center">OCUPACION:</td>
      <td ><input type="text" disabled id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['ocupacion'] ?>"></td>
   </tr>
   <tr>
     <td id="titulo_pro" class="bold texto_center">STATUS:</td>
     <td>
     <?php if ($fila['estado']=="activo") {
     echo '  <span class="btn btn-success btn-sm btn-block bold"> <span class="glyphicon glyphicon-ok" ></span>&nbsp;Activo</span>'; 
    }else if ($fila['estado']=="desactivado"){
   echo  '<span   class="btn btn-danger btn-sm btn-block bold"> <span class="glyphicon glyphicon-remove"></span>&nbsp;Inactivo</span>'; 
 }else{ echo  '<span   class="btn btn-danger btn-sm btn-block bold"> <span class="glyphicon glyphicon-remove"></span>&nbsp;Eliminado</span>'; }

    ?>
     </td>
   </tr>


 </table>
  </div>
   
  <div class="col-xs-5 ">








  <table class="table table-striped table-condensed table-bordered">
  <tr>
     <td id="titulo_pro" class="bold texto_center">FECHA_NAC</td>
      <td ><input type="text" disabled="" id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['fecha_nac'] ?>"></td>
   </tr>
   <tr>
     <td id="titulo_pro" class="bold texto_center">TIPO DE USUARIO:</td>
      <td ><input type="text" disabled="" id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['cargo'] ?>"></td>
   </tr>
    <tr>
     <td id="titulo_pro" class="bold texto_center">USUARIO:</td>
      <td ><input type="text" disabled="" id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['usuario'] ?>"></td>
   </tr>


    <tr>
     <td id="titulo_pro" class="bold texto_center">EMAIL:</td>
      <td ><input type="text" disabled id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['email_empleado'] ?>"></td>
   </tr>


    <tr>
     <td id="titulo_pro" class="bold texto_center">TELEFONO:</td>
      <td ><input type="text" disabled id="apellido_emp" class="form-control input-personalizado texto_center"  value="<?php echo $fila['telefono_empleado'] ?>"></td>
   </tr>

   <tr>
     <td id="titulo_pro" class="bold texto_center">DIRECCION:</td>
     
      <td ><textarea name="direccion_emp" rows="5" disabled i maxlength="150" class="form-control"> <?php echo $fila['direccion_empleado'];?></textarea></td>
   </tr>


 <tr>
     <td id="titulo_pro" class="bold texto_center">HAGA CLICK SI DESEA :</td>
     
      <td > <?php if ($fila['estado']!="activo") {
     echo '  <a href="../controlador/Controlador.php?id='.$id.'&status=activarEmp&StatusOperation_emp"class="btn btn-success btn-sm btn-block bold"> <span class="glyphicon glyphicon-ok" ></span>&nbsp;ACTIVAR</button>'; 
    }else {
   echo  '<a  href="../controlador/Controlador.php?id='.$id.'&status=desactivarEmp&StatusOperation_emp" class="btn btn-danger btn-sm btn-block bold"> <span class="glyphicon glyphicon-remove"></span>&nbsp;DESACTIVAR</a>'; } ?></td>
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
        <td>
          <input type="text" name="hola" id="tipoN" class="form-control">
        </td>
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
