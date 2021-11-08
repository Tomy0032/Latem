<?php 

session_start();

require_once('conexion.php');

$db=Db::conectar();
$ci=$_POST['ci'];
$calle=$_POST['calle'];
$numero=$_POST['numero'];
$ciudad=$_POST['ciudad'];

$db->query("insert into dir_cli values ('$ci', '$ciudad', '$calle', '$numero')");

header("location: /utu/latem/usuario/perfil.php");


 ?>