<?php

$ci = $_REQUEST['ci'];
$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$correo = $_REQUEST['correo'];
$clave = $_REQUEST['clave'];
$confirmarClave = $_REQUEST['confirmarClave'];

require("conexion.php");
$conexion = retornarConexion();

$buscar = mysqli_query($conexion, "select * from usuario where ci='$ci'");
$datos = mysqli_fetch_assoc($buscar);

if ($datos == null && $clave == $confirmarClave) {
	$respuesta = mysqli_query($conexion, "insert into usuario values ('$ci','$nombre','$apellido','$correo','$clave','0')");
        echo json_encode($respuesta);
        $respuesta2 = mysqli_query($conexion, "insert into cliente values ('$ci')");
        echo json_encode($respuesta2);
        session_start();
        $_SESSION['ci'] = $_REQUEST['ci'];
        header('location: /index.php');

}elseif ($clave != $confirmarClave) {
	
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