<?php session_start(); session_destroy(); 
require'modelo/ModCon.php';
$modelo=new ModCon();
if (!$conexion=$modelo->conectar()) {
echo "Error database";
}
if (isset($_GET['new_administrador'])) {
  echo "<script>alert('Usuario Registrado Ya puede comenzar a Usar SIFAJ');</script>";
}

$sql=$conexion->query("SELECT id_empleado FROM empleados");
$num=$sql->num_rows;
if ($num==0) {
  header("location:vista/new.php");
}
?>

<!DOCTYPE html>
<html lang="es"><head>
    <meta charset="utf-8">
    <title>Inventarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta  content="content">

    <!-- Le styles -->
     <link href="Bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="Bootstrap/css/index.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {

        max-width: 490px;
        padding: 19px 29px 29px;
        margin: -15px auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
       #colors{color: #3DD6FF;}
    </style>

  </head>

  <body>

  <form class="form-signinp">
  LOGO
      </form>
     <form class="form-signinp2">
  <h4>Titulo Principal</h4>
      </form>
    	
                                    
    <form action="seguridad/login.php" method="post"class="form-signin">
   
       
        
        <img src="img/lock.png" id="lock" alt="">

        
       
   


 <?php 	if (isset($_GET['Sc'])) {
?>
<center><b id="colors">Ha Cerrado Sessión</b></center>
<?php 
} 
 if (isset($_GET['qjk_ls'])) {
	$msj=$_GET['qjk_ls'];

	if ($msj=="nnf") {

	?>
 <div id="alert"class="alert alert-error">

 <b> <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>&nbsp;&nbsp;Los Datos Suministrados son incorrectos</b> 
</div>
<?php 	
	
}


		if ($msj=="trp") {

	?>
 <div id="alert"class="alert alert-block">
 <b><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> &nbsp;&nbsp;.::|Error| Debes iniciar Sesión::.</b> 
</div>
<?php 	
	}

    if ($msj=="st0") {

  ?>
 <div id="alert"class="alert alert-danger">
 <b><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> &nbsp;<strong>.::¡Alerta!</strong> Usuario Desactivado::.</b> 
</div>
<?php   
  }



	
	}else{
?>
 <div id="alert"class="alert alert-success">
  <i  id="i" class="icon  icon-info" ></i>
 <b><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> &nbsp;&nbsp;Por Favor Ingrese al Sistema</b> 
</div>

<?php  

	}

	?>



 <div class="container_index">
        <input type="text" id="campo1" required name="usuario"class="input-block-level inputSuccess form-control" placeholder="Usuario" >
        <input type="password" required name="clave"id="campo1"class="input-block-level" placeholder="Password">
        <label class="checkbox">
        </label>
        <button class="btn btn-large"  id="btn"type="submit">Ingresar</button>
         </div>
      </form>
         
    

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
     <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  <?php if (isset($_GET['ars_qwl'])) {
	$msj=$_GET['ars_qwl'];

	if ($msj=="adnf") {

	?>
<script type="text/javascript">alert("Debes tener privilegios de administrador");</script>

<?php 	

	}
}
?>



</body><!-- Mirrored from twitter.github.com/bootstrap/examples/signin.html by HTTrack Website Copier/3.x [XR&CO'2010], Mon, 14 Jan 2013 02:28:55 GMT --></html>
<!DOCTYPE html>
</html>
