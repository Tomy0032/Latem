<?php 
session_start();

require_once('conexion.php');

$db=Db::conectar();

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

header('location: /catalogo/facturacion.php');
 ?>