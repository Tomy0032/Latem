<?php 

session_start();

require_once('conexion.php');

$db=Db::conectar();
$ci = $_POST['ci'];
$telefono = $_POST['telefono'];

$db->query("insert into tel_cli values ('$ci', '$telefono');");

header("location: /usuario/perfil.php");


 ?>