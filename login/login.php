<?php
session_start();
$_SESSION['ci'] = $_REQUEST['ci'];
$_SESSION['clave'] = $_REQUEST['clave'];

require("conexion.php");
$conexion = retornarConexion();

$buscar = mysqli_query($conexion, "select ci, contraseña, permiso from usuario where ci='$_SESSION[ci]'");
$datos = mysqli_fetch_assoc($buscar);

if ($datos == null) {
	
	include('login.html');
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

	if ($_SESSION['ci'] == $ci && $_SESSION['clave'] == $clave) {

		if ($permiso == 1) {

			header('location: ingresar.html');
		}else{
			header('location: ingresar.html');
		}

	}else {

		include('login.html');
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
