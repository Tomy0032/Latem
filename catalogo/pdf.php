<?php 
session_start();
require_once '../vendor/autoload.php';
require_once('conexion.php');
require "factura.php";

$db=Db::conectar();

$select=$db->query("select * from usuario where ci = '$_SESSION[ci]'");
$select2=$db->query("select fecha from pedido where id_sesion = '$id_sesion' order by id desc limit 1");

$html = ob_get_clean();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);

$rutaGuardado = "../facturas/";

$nombreArchivo = "factura-tomas.pdf";

$dompdf->render();

$nombreArchivo=$select->fetch()['ci'];
$fecha=$select2->fetch()['fecha'];

$dompdf->stream('factura-'.$ci.'-'.$fecha);

header('location: compra_terminada.php');
 ?>