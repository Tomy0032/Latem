<?php 

session_start();

require_once('conexion.php');
$db=Db::conectar();
$id_sesion=session_id();


$db->query("update lista_productos set estado ='terminado' where id_sesion = '$id_sesion'");

$pedido=$db->query("select * from pedido where id_sesion='$id_sesion' order by id desc limit 1")->fetch()['id'];
$fecha=$db->query("select * from pedido where id_sesion='$id_sesion' order by id desc limit 1")->fetch()['fecha'];

$db->query("insert into factura (id_pedido, id_garantia, fecha) values ('$pedido', '1', '$fecha')");

header('location: /catalogo/compra_terminada.php')
 ?>