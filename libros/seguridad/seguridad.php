<?php 
session_start();
if ($_SESSION['autentificado']!="true") {
	header("location:../index.php?qjk_ls=trp");

}


