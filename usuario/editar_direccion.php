<?php 

session_start();

require_once('conexion.php');

$db=Db::conectar();
$ci=$_POST['ci'];
$calle=$_POST['calle'];
$numero=$_POST['numero'];
$ciudad=$_POST['ciudad'];

$db->query("update dir_cli set ciudad='$ciudad', calle='$calle', numero='$numero' where ci='$ci'");

header("location: /utu/latem/usuario/perfil.php");


 ?>