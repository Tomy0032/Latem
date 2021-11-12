<?php 
session_start();

require_once('conexion.php');

$db=Db::conectar();
$cantidad=$_POST['cantidad'];
$metodo=$_POST['metodo'];
$selectIdMetodo=$db->query("select id from metodo_pago where tipo = '$metodo'");
$idMetodo=$selectIdMetodo->fetch()['id'];



$envio=$_POST['agencia'];


$total=$_POST['total'];
$subtotal=$_POST['subtotal'];
$iva=$_POST['iva'];
$manejo=$_POST['manejo'];

$ci=$_SESSION['ci'];


$sesion=session_id();

date_default_timezone_set('America/Montevideo');
$date = date('Y-m-d H:i:s');


$db->query("insert into pedido (ci_cliente, id_envio, id_pago, id_sesion, fecha) values ('$ci', '$envio', '$idMetodo', '$sesion', '$date')");
$select=$db->query("select * from pedido where id_sesion='$sesion' order by id desc limit 1");
$idPedido=$select->fetch()['id'];
$db->query("update lista_productos set id_pedido = '$idPedido' where id_sesion = '$sesion' and estado = 'espera' and cantidad > 0");

$select=$db->query("select * from lista_productos where id_sesion = '$sesion' and estado = 'espera' and cantidad > 0");
foreach ($select->fetchAll() as $row) {
  $idPedido=$row['id_pedido'];
  $cantidad=$row['cantidad'];
  $db->query("update producto set stock= stock - $cantidad");
}

header('location: /catalogo/facturacion.php');
 ?>