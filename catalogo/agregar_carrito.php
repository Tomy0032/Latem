<?php 

session_start();

require_once('conexion.php');

$db=Db::conectar();
$id_producto = $_POST['id'];
$cantidad = $_POST['cantidad'];
$id_sesion = session_id();

$comprobar=$db->query("select * from lista_productos where id_sesion = '$id_sesion' and id_producto = '$id_producto'");
if ($comprobar->fetch() == null) {
	$db->query("insert into lista_productos(id_sesion, id_producto, cantidad, estado) values ('$id_sesion', '$id_producto', '$cantidad', 'espera')");
}else{
	$db->query("update lista_productos set cantidad='$cantidad' where id_sesion = '$id_sesion' and id_producto = '$id_producto' ");
}
header("location: /catalogo/vista_producto.php?id=$id_producto");


 ?>