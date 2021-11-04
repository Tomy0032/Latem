<?php
session_start();

$ingCI = $_POST['ci'];
$ingClave = $_POST['clave'];
require("conexion.php");
$conexion = retornarConexion();

$buscar = mysqli_query($conexion, "select ci, contraseña, permiso from usuario where ci='$ingCI'");
$datos = mysqli_fetch_assoc($buscar);

if ($datos == null) {
	
	include('login.php');
	?>
	<style>
		.--errorLog{
		 	visibility: visible;
		 	font-size: 14px;
		 }

	</style>
	<?php
}else{

	$ci = $datos['ci'];
	$clave = $datos['contraseña'];
	$permiso = $datos['permiso'];

	if ($ingCI == $ci && $ingClave == $clave) {

		$_SESSION['ci'] = $_REQUEST['ci'];

		if ($permiso == 1) {

			header('location: /utu/latem/crud/mostrar.php');
		}else{
			header('location: /utu/latem/index.html');
		}

	}else {

		include('login.php');
		 ?>
		 <style>
		 	.--errorLog{
		 		visibility: visible;
		 		font-size: 14px;
		 	}
		 </style>
		 <?php
	}
}
?>
