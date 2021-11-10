<?php

$ingCI = $_POST['ci'];
$ingClave = $_POST['clave'];
$carrito = $_POST['carrito'];
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
		session_start();
		$_SESSION['ci'] = $_REQUEST['ci'];
		if($carrito == 1){
			header('location: /catalogo/carrito.php');
		}
		elseif ($permiso == 1) {
			header('location: /crud/mostrar.php');
		}else{
			header('location: /index.php');
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
