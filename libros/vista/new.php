<?php 
require'../modelo/ModCon.php';
$modelo=new ModCon();
if (!$conexion=$modelo->conectar()) {
echo "Error database";
}
$sql=$conexion->query("SELECT id_empleado FROM empleados");
$num=$sql->num_rows;
if ($num>0) {
  header("location:../");
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Anthony Araujo">
    <link rel="icon" href="../../favicon.ico">

    <title>.:Bienvenido :.</title>

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
        
        
<div class="btn-group navbar-form navbar-right" >

<label  id="log" class="navbar-left"><b><?php 
echo ".:BIENVENIDO AL SISTEMA DE INVENTARIO Y FACTURACION !";
?></b></label>

  <button id="btnConfi" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
   <img src="../img/confi2.png" width="30" alt="">
  </button>
 
</div>

        </div><!--/.nav-collapse -->
      </div>
     

  
    </nav>
 <div id="panel" class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
<table border="0" width="101%" align="center">
  <tr>
   
   <td><center> <b id="titulo_header"> FUNDACION VN</b></center>
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
     <td width="150"> <button type="button"  id="btnRegistarEmp" onclick="new_administrador()" class="btn btn-success"> <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;&nbsp;ADMINISTRAR</button></td>
  </tr>
</table>
  </div>
  <div class="panel-body">
  <div class="container-fuid">
  <div class="row">
  <div class="col-xs-12 ">
  
<center>
<fieldset>
  <legend id="titulo_pro"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Datos del Nuevo Administrador del Sistema</legend>

<table class="table table-striped table-condensed " >
 <!-- columna 1  -->
  <tr>
  <th id="titulo_pro" width="180"><b id="asterisco">(*)</b> Cedula:</th>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Primer Nombre:</th>
  <th id="titulo_pro">Segundo Nombre:</th>
  </tr>
   <!-- columna 1  -->
<tr>
<form action="../controlador/Controlador.php" id="form_registro_emp" >
<input type="hidden" name="Registrar_admin" value="des">

  <td><input type="text"  maxlength="11" name="cedula_emp"  id="cedula_emp"    placeholder="V-00 000 000" class="form-control input-personalizado"></td>
  <td><input type="text"  maxlength="30"  name="nombre_emp" id="nombre_emp"  onkeyup="this.value=this.value.toUpperCase()" placeholder="Primer Nombre" class="form-control input-personalizado"></td>
  <td><input type="text"  maxlength="30"  name="snombre_emp"  id="snombre_emp" onkeyup="this.value=this.value.toUpperCase()" placeholder="Segundo Nombre (opcional)" class="form-control input-personalizado"></td>
</tr>

 <!-- columna 2  -->
  <tr>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Fecha de Nacimiento:</th>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Primer Apellido:</th>
  <th id="titulo_pro">Segundo Apellido:</th>
  </tr>
   <!-- columna 2  -->
<tr>
  <td><input type="date"  maxlength="10" name="fecha_nac_emp"   id="fecha_nac_emp"   placeholder="DD/MM/AAAA" class="form-control input-personalizado"></td>
  <td><input type="text"  maxlength="30" name="apellido_emp" id="apellido_emp"   onkeyup="this.value=this.value.toUpperCase()"placeholder="Apellido Paterno" class="form-control input-personalizado"></td>
  <td><input type="text"  maxlength="30" name="sapellido_emp" id="sapellido_emp" onkeyup="this.value=this.value.toUpperCase()" placeholder=" Apellido Materno(opcional)" class="form-control input-personalizado"></td>
</tr>


 <tr>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Usuario:</th>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Contaseña:</th>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Repita la Contrasena:</th>
  </tr>

<tr> <td><input type="text"  maxlength="30" name="usuario" placeholder="Usuario" id="usuario"  class="form-control input-personalizado"></td>
  <td><input type="password"  name="clave" id="clave" placeholder="Password"class="form-control input-personalizado"></td>
  <td><input type="password"   id="clave2" placeholder="Repeat Password" class="form-control input-personalizado"></td></tr>
 <!-- columna  3 -->
  <tr>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Tipo:</th>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Email:</th>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Telefono:</th>
  </tr>
   <!-- columna  3 -->
<tr>
<td><select name="cargo_emp" id="cargo_emp" >
            <option  >ADMINISTRADOR</option>
          
  </select></td>
  <td><input type="text" name="email_emp" maxlength="30" id="email_emp"   placeholder="example: alguien@mail.com" class="form-control input-personalizado"></td>
  <td>
  <table>
    <tr>
      <td> <select name="codigoTlf" id="codigoTlf_emp">
          <option value="">SELECCIONE</option>
          <option value="593">Ecuador +593</option>
          <option value="43">Colombia</option>
        </select></td>
      <td>  <input type="text" name="tlf_emp" maxlength="30" id="tlf_emp" placeholder="example: 4163481152" class="form-control input-personalizado"></td>
    </tr>
  </table>
</td>
</tr>
 <tr>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Genero:</th>
  <th id="titulo_pro"><b id="asterisco">(*)</b> Repita Email:</th>
  <th id="titulo_pro"  class="texto_center">
    <table width="100%"  >
    <tr>
      <td><b id="asterisco">(*)</b> Estado_civil:</td>
      <td><b id="asterisco">(*)</b> Grado De Instruccion:</td>
      <td><b id="asterisco">(*)</b> Ocupación:</td>
    </tr> </table>
  </th>
 
  </tr>
   <tr>
  <th><select name="genero" id="genero_emp">
          <option value="">SELECCIONE</option>
          <option >MASCULINO</option>
          <option >FEMENINO</option>
          
        </select></th>
         <td><input type="text"  maxlength="30" id="email_emp2"   placeholder="example: elMismo@mail.com" class="form-control input-personalizado"></td>
 
  <th  class="texto_center"><table width="100%" >
    <tr>
      <td><select name="estado_civil" id="estado_civil">
          <option value="">SELECCIONE</option>
          <option >SOLTERO(A)</option>
          <option >CASADO(A)</option>
           <option>DIVORCIADO(A)</option>
          <option >VIUDO(A)</option>
        </select></td>
      <td><select name="grado_inst" id="grado_inst">
          <option value="">SELECCIONE</option>
          <option >PRIMARIA</option>
          <option >BACHILLER</option>
         
          <option >TSU UNIVERSITARIO</option>
            <option >CARRERA UNIVERSITARIA</option>
            <option >CARRERA A FIN</option>

        </select></td>
      <td><select name="ocupacion" id="ocupacion">
          <option value="">SELECCIONE</option>
          <option >ESTUDIANTE</option>
          <option >AMA DE CASA</option>
           <option >DOMÉSTICO</option>
            <option >AMA DE CASA</option>
            <option >NINGUNO</option>
        </select></td>
    </tr> </table></th>
  
  </tr>
 <!-- columna 4  -->
  <tr>
  <th colspan="2" id="titulo_pro" class="texto_center"><b id="asterisco">(*)</b> direccion:</th>
  
  </tr>
   <!-- columna 4  -->
<tr>
  <td colspan="2" ><textarea name="direccion_emp" onkeyup="this.value=this.value.toUpperCase()" rows="2" id="direccion_emp" maxlength="150" placeholder="        .:MAX 150 CARACTERES:." class="form-control"></textarea></td>
 
  <td>
<table  width="60%">
  <tr>
    <td>
      <select name="nacionalidad" id="nacionalidad_emp">
        <option value="">NACIONALIDAD</option>
         <option >ECUATORIANA</option>

      </select>
    </td>
    

  </tr>
</table>

</td>
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