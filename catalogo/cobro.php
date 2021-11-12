<?php
session_start();
require_once('conexion.php');

require_once("lib/Conekta.php");
\Conekta\Conekta::setApiKey("key_Ax9YM8UMUQQUxHAeehKv9g");
\Conekta\Conekta::setApiVersion("2.0.0");

$token_id=$_POST["conektaTokenId"];

try {
  $customer = \Conekta\Customer::create(
    array(
      "name" => "Fulanito Pérez",
      "email" => "fulanito@conekta.com",
      "phone" => "+52181818181",
      "payment_sources" => array(
        array(
            "type" => "card",
            "token_id" => $token_id
        )
      )
    )
  );
} catch (\Conekta\ProccessingError $error){
  echo $error->getMesage();
} catch (\Conekta\ParameterValidationError $error){
  echo $error->getMessage();
} catch (\Conekta\Handler $error){
  echo $error->getMessage();
}


try{
  $order = \Conekta\Order::create(
    array(
      "line_items" => array(
        array(
          "name" => "Tacos",
          "unit_price" => 1000,
          "quantity" => 12
        )
      ),
      "shipping_lines" => array(
        array(
          "amount" => 1500,
           "carrier" => "FEDEX"
        )
      ),
      "currency" => "MXN",
      "customer_info" => array(
        "customer_id" => $customer->id
      ),
      "shipping_contact" => array(
        "address" => array(
          "street1" => "Calle 123, int 2",
          "postal_code" => "06100",
          "country" => "MX"
        )
      ),
      "metadata" => array("reference" => "12987324097", "more_info" => "lalalalala"),
      "charges" => array(
          array(
              "payment_method" => array(
                      "type" => "default"
              )
                
          ) 
      )
    )
  );
} catch (\Conekta\ProcessingError $error){
  echo $error->getMessage();
} catch (\Conekta\ParameterValidationError $error){
  echo $error->getMessage();
} catch (\Conekta\Handler $error){
  echo $error->getMessage();
}

/*
echo "<br>Payment info";
echo "<br>CODE:". $order->charges[0]->payment_method->auth_code;
echo "<br>Card info:" .
      "- ". $order->charges[0]->payment_method->name .
      "- ". $order->charges[0]->payment_method->last4 .
      "- ". $order->charges[0]->payment_method->brand .
      "- ". $order->charges[0]->payment_method->type;
*/

$db=Db::conectar();

$cantidad=$_POST['cantidad'];

$metodo=$order->charges[0]->payment_method->brand;
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
$select=$db->query("select * from pedido where id_sesion = '$sesion' order by id desc limit 1");
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