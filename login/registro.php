<?php
session_start();
$_SESSION['ci'] = $_REQUEST['ci'];
$_SESSION['nombre'] = $_REQUEST['nombre'];
$_SESSION['apellido'] = $_REQUEST['apellido'];
$_SESSION['correo'] = $_REQUEST['correo'];
$_SESSION['clave'] = $_REQUEST['clave'];
$_SESSION['confirmarClave'] = $_REQUEST['confirmarClave'];

require("conexion.php");
$conexion = retornarConexion();

$buscar = mysqli_query($conexion, "select * from usuario where ci='$_SESSION[ci]'");
$datos = mysqli_fetch_assoc($buscar);

if ($datos == null && $_SESSION['clave'] == $_SESSION['confirmarClave']) {
	$respuesta = mysqli_query($conexion, "insert into usuario values ('$_SESSION[ci]','$_SESSION[nombre]','$_SESSION[apellido]','$_SESSION[correo]','$_SESSION[clave]','0')");
        echo json_encode($respuesta);
        header('location: /index.php');

}elseif ($_SESSION['clave'] != $_SESSION['confirmarClave']) {
	
	include('login.php');
	?>
	<style>
		.--errorCon{
		 	visibility: visible;
		 	font-size: 14px;
		 }

	</style>
	<?php	
}
else{
 
	include('login.php');
	?>
	<style>
		.--errorCI{
		 	visibility: visible;
		 	font-size: 14px;
		 }

	</style>
	<?php	
}

?>