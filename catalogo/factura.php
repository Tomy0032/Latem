<?php
session_start();
require_once('conexion.php');

$db=Db::conectar();

$ci=$_SESSION['ci'];
$select=$db->query("select * from usuario where ci='$ci' ");
$select2=$db->query("select * from usuario where ci='$ci' ");
$select3=$db->query("select * from usuario where ci='$ci' ");


$cliente=$select->fetch()['nombre']." ".$select2->fetch()['apellido']." - ".$select3->fetch()['ci'];
$remitente = "Robotech";
$web = "https://robotech.com";
$mensajePie = "¡Gracias por su compra!";

$id_sesion=session_id();
$select=$db->query("select f.id as factura from factura f, pedido p where f.id_pedido = p.id and id_sesion = '$id_sesion' order by factura desc limit 1");

$numero = $select->fetch()['factura'];
$descuento = 0;
$manejo = 60;
$porcentajeImpuestos = 22;
$select=$db->query("select costo from agencia a, pedido p where p.id_envio = a.id and id_sesion = '$id_sesion' order by p.id desc limit 1");
$envio=$select->fetch()['costo'];

$idPedido=$db->query("select id from pedido where ci_cliente = '$ci' and id_sesion = '$id_sesion' order by id desc limit 1")->fetch()['id'];
$select=$db->query("select l.id_producto as idProducto, pr.precio as precio, l.cantidad as cantidad, pr.nombre as nombre from pedido p, lista_productos l, producto pr where p.id = l.id_pedido and l.id_producto = pr.id and p.ci_cliente='$ci' and p.id_sesion = '$id_sesion' and l.id_pedido = '$idPedido'");

$fecha = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/html2pdf.bundle.min.js"></script>
    <script src="/script.js"></script>
    <title>Factura</title>
    <style>
        table{
            border-collapse: collapse;
            border: none;
            width: 100%;
        }
        table td, table th{
            border:  1px solid;
            padding: 5px;
        }
        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
        .row{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .col-xs-2{
            float: right;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 ">
            <h1>Factura</h1>
        </div>
        <div class="col-xs-2">
            <h2>Robotech</h2>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-3 text-center">
            <strong>Fecha</strong>
            <br>
            <?php echo $fecha ?>
            <br>
            <strong>Factura No.</strong>
            <br>
            <?php echo $numero ?>
        </div>
    </div>
    <hr>
    <div class="row text-center" style="margin-bottom: 2rem;">
        <div class="col-xs-6">
            <h2 class="h2">Cliente</h1>
            <strong><?php echo $cliente ?></strong>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $subtotal = 0;
                foreach ($select->fetchAll() as $producto) {
                    $totalProducto = $producto["cantidad"] * $producto["precio"];
                    $subtotal += $totalProducto;
                    ?>
                    <tr>
                        <td><?php echo $producto["nombre"] ?></td>
                        <td><?php echo number_format($producto["cantidad"], 2) ?></td>
                        <td>$<?php echo number_format($producto["precio"], 2) ?></td>
                        <td>$<?php echo number_format($totalProducto, 2) ?></td>
                    </tr>
                <?php }
                $subtotalConDescuento = $subtotal - $descuento;
                $impuestos = round($subtotalConDescuento * ($porcentajeImpuestos / 100));
                $total = $subtotalConDescuento + round($impuestos) + $manejo + $envio;
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" class="text-right">Subtotal</td>
                    <td>$<?php echo number_format($subtotal, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Descuento</td>
                    <td>$<?php echo number_format($descuento, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Subtotal con descuento</td>
                    <td>$<?php echo number_format($subtotalConDescuento, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Empaque y manejo</td>
                    <td>$<?php echo number_format($manejo, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">IVA</td>
                    <td>$<?php echo number_format($impuestos, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Envio</td>
                    <td>$<?php echo number_format($envio, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">
                        <h4>Total</h4></td>
                    <td>
                        <h4>$<?php echo number_format($total, 2) ?></h4>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            <p class="h5"><?php echo $mensajePie ?></p>
        </div>
    </div>
</div>
<?php /*
header('location: /catalogo/compra_terminada.php');
*/
 ?>
</body>
</html>