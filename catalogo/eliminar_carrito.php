<?php 

session_start();

require_once('conexion.php');

$db=Db::conectar();
$id_producto = $_POST['id_producto'];
$id_sesion = session_id();

$db->query("update lista_productos set cantidad='0' where id_sesion = '$id_sesion' and id_producto = '$id_producto' ");

header("location: /utu/latem/catalogo/carrito.php");


 ?>