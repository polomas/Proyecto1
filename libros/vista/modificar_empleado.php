<?php require_once'../seguridad/seguridad.php';
require_once("../modelo/ModCon.php");
$nivel=$_SESSION["nivel"];
if ($nivel!=1) {
header("location:buscar_usuario.php?errno_User");
}

if ($nivel==1) {
 if (isset($_GET['rss_cat'])) {
  $variable=$_GET['rss_cat'];
   $conexion->query("INSERT INTO categorias(categoria) VALUES ('$variable')");
}
}
extract($_GET);
$modelo=new ModCon();
$conexion=$modelo->conectar();

$sql=$conexion->query("SELECT t1.cedula, t1.nombres, t1.apellidos, t1.fecha_nac, t1.cargo,
  t1.genero,t1.nacionalidad,t1.grado_formacion,t1.ocupacion ,t2.email_empleado,t3.telefono_empleado ,
  t4.direccion_empleado,t1.edo_civil
FROM empleados t1
Left JOIN email_empleado t2 on t1.id_empleado=t2.id_empleado
Left JOIN tlf_empleado t3 on t1.id_empleado=t3.id_empleado
Left JOIN direccion_empleado t4 on t1.id_empleado=t4.id_empleado
where t1.id_empleado='$id'");
$datos=$sql->fetch_array();
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Anthony Araujo">
    <link rel="icon" href="../../favicon.ico">

    <title>.:Modificar Empleado:.</title>

    <!-- Bootstrap core CSS -->
    <link href="../Bootstrap/css/bootstrap.css" rel="stylesheet">
     <link href="../css/MyStyle.css" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="../css/calendario.css">
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/calendario.js"></script>
   <script type="text/javascript" src="../js/ajax.js"></script>
  <script type="text/javascript">
    $(function(){
      $("#fecha_nac_emp").datepicker();
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
<!--           <a class="navbar-brand" href=""><img id="logotipo"src="../img/logo.png" alt=""></a> -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">

            <?php include_once "menu.php"; ?>
           
          </ul>
<div class="btn-group navbar-form navbar-right" >
<?php 
$log=$_SESSION['id'];
$user=$conexion->query("SELECT t1.id_usuario,t2.id_empleado, t2.nombres ,t2.apellidos
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
       <?php  if ($nivel==1) {
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
<table border="0" width="101%" align="center">
  <tr>
   
   <td><center> <b id="titulo_header"> MODIFICACION DE EMPLEADOS</b></center>
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
</td>    <td width="107"> <a href="buscar_usuario.php"class="btn btn-danger"> <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>&nbsp;&nbsp; Cancelar</a></td> 

     <td width="150"> <button type="button"  id="btnRegistarEmp" onclick="modificar_emp()" class="btn btn-primary"> <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;&nbsp;Guardar Modificacion</button></td>
  </tr>
</table>
  </div>
  <div class="panel-body">
  <div class="container-fuid">
  <div class="row">
  <div class="col-xs-12 ">
   <?php if (isset($_GET['msj_email_dpt'])) { ?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>¡Error!</strong> El Correo Ya Se encuentra Registrado!...</div>
<?php } ?> 
 <?php if (isset($_GET['msj_fallo'])) { ?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>¡Error Ingrese el Email nuevamente!</strong>  NOTA: El Email  ingresado anteriormente ya se Encuentra Registrado en la Base de datos!...</div>
<?php } ?> 
  </div>
<div class="col-xs-11">
 <!-- Contenedor de BODY PANEL  -->

<center>
<fieldset>
  <legend id="titulo_pro"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Datos del Empleado</legend>

<table class="table table-striped table-condensed">
 <!-- columna 1  -->
  <tr>
  <th id="titulo_pro" width="180"><b id="asterisco">(*)</b> Cedula:</th>
  <th id="titulo_pro"  class="texto_center"><b id="asterisco">(*)</b> Nombres:</th>
   <th id="titulo_pro" class="texto_center"><b id="asterisco">(*)</b> Apellidos:</th>
   </tr>
   <!-- columna 1  -->
<tr>
<form action="../controlador/Controlador.php" id="form_modificar_emp" >
<input type="hidden" name="Mod_emp">
<input type="hidden" name="id_emp" value="<?php echo $id ?>" >

  <td><input type="text"  maxlength="11" name="cedula_emp"  id="cedula_emp"  value="<?php echo $datos[0] ?>"  placeholder="V-00 000 000" class="form-control input-personalizado"></td>
  <td ><input type="text"  maxlength="30"  name="nombre_emp" id="nombre_emp"  value="<?php echo $datos[1] ?>" onkeyup="this.value=this.value.toUpperCase()" placeholder=" Nombre" class="form-control input-personalizado texto_center"></td>
  <td ><input type="text"  maxlength="30" name="apellido_emp" id="apellido_emp"  value="<?php echo $datos[2] ?>"  onkeyup="this.value=this.value.toUpperCase()"placeholder="Apellidos" class="form-control input-personalizado texto_center"></td>
 
 </tr>

 <!-- columna 2  -->
  <tr>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Fecha de Nacimiento:</th>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Email:</th>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Genero:</th>
 
  
  </tr>
   <!-- columna 2  -->
<tr>
  <td><input type="text"  maxlength="10" name="fecha_nac_emp"   id="fecha_nac_emp"  value="<?php echo $datos[3] ?>"  placeholder="DD/MM/AAAA" class="form-control input-personalizado"></td>
 <td><input type="text" name="email_emp" maxlength="30" id="email_emp"  value="<?php echo $datos[9] ?>"  class="form-control input-personalizado"></td>
  <td> <select name="genero_emp" id="genero_emp">
<?php if ($datos[5]=="F") {?>
   <option value="F">FEMENINO</option>
          <option value="M">MASCULINO</option>
 <?php
} else{?>
<option value="M">MASCULINO</option>
<option value="F">FEMENINO</option>
<?php
}
?>
          
        </select></td>
  </tr>

 <!-- columna  3 -->
 
<tr>
  <td colspan="3">
    <table width="100%" >
      <tr>
  <th  width="20%" class="texto_center" id="titulo_pro"><b id="asterisco">(*)</b> Cargo:</th>
  <th  width="20%" class="texto_center" id="titulo_pro"><b id="asterisco">(*)</b> Estado Civil:</th>
  <th width="20%" class="texto_center"  id="titulo_pro"><b id="asterisco">(*)</b> Nacionalidad:</th>
   <th width="20%" class="texto_center" id="titulo_pro"><b id="asterisco">(*)</b> Grado de Instrucción</th>
  <th  width="20%" class="texto_center" id="titulo_pro"><b id="asterisco">(*)</b> Ocupación:</th>
  
      </tr>
    </table>
  </td>

</tr>

<tr>
  <td colspan="3">
     <table width="100%">
      <tr>
  <th  width="20%" class="texto_center" >
    <select name="cargo_emp" id="cargo_emp">
        <option ><?php echo $datos[4] ?></option>
            <option  >ADMINISTRADOR</option>
            <option >VENDEDOR</option>
            <option >INVITADO</option>
    </select>
  </th>
  <th  width="20%" class="texto_center" >
     <select name="edo_civil_emp" id="edo_civil_emp">
    <option ><?php echo $datos['edo_civil'] ?></option>
          <option >SOLTERO(A)</option>
          <option >CASADO(A)</option>
           <option>DIVORCIADO(A)</option>
          <option >VIUDO(A)</option>
    </select>
  </th>
  <th width="20%" class="texto_center"  >
     <select name="nacionalidad_emp" id="nacionalidad_emp">
     <option ><?php echo $datos[6] ?></option>
        <option >VENEZOLANO</option>
          <option >COLOMBIANO</option>
    </select>
    
  </th>
  
   <th width="20%" class="texto_center" >
        <select name="grado_emp" id="grado_emp">
        <option ><?php echo $datos[7] ?></option>
          <option >PRIMARIA</option>
          <option >BACHILLER</option>
         
          <option >TSU UNIVERSITARIO</option>
            <option >CARRERA UNIVERSITARIA</option>
            <option >CARRERA A FIN</option>
    </select>
   </th>
   
  <th  width="20%" class="texto_center" >
       <select name="ocupacion_emp" id="ocupacion_emp">
      <option ><?php echo $datos[8] ?></option>
     <option >ESTUDIANTE</option>
          <option >AMA DE CASA</option>
           <option >DOMÉSTICO</option>
            <option >AMA DE CASA</option>
             <option >NINGUNO</option>
    </select>
  </th>
  </tr>
    </table>
  </td>
</tr>

<tr>
  <th colspan="2" id="titulo_pro" class="texto_center"><b id="asterisco">(*)</b> direccion:</th>
    <th id="titulo_pro" class="texto_center"><b id="asterisco">(*)</b> Telefono:</th>
  
  </tr>
   <!-- columna 4  -->
<tr>
  <td colspan="2" ><textarea name="direccion_emp" rows="2" onkeyup="this.value=this.value.toUpperCase()" id="direccion_emp" maxlength="150" class="form-control"> <?php echo $datos[11];?></textarea></td>
 <td><input type="text" name="tlf_emp" maxlength="30" id="tlf_emp"  value="<?php echo $datos[10] ?>"  placeholder="example: alguien@mail.com" class="form-control input-personalizado"></td>
 
</tr>
     

</table>
</form>
</fieldset>


</center>



  <!-- FIN BODY PANEL  -->
  </div>
  <div class="col-xs-2 ">
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
<!--/.Modal nueva categoria
*
*
*
*
*-->

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

