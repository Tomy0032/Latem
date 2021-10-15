<?php
require_once('crud_producto.php');
require_once('producto.php');
 
$crud= new CrudProducto();
$producto= new Producto();
 
if (isset($_POST['insertar'])) {
	$producto->setId_categoria($_POST['id_categoria']);
	$producto->setId_iva($_POST['id_iva']);
	$producto->setId_proveedor($_POST['id_proveedor']);
	$producto->setNombre($_POST['nombre']);
	$producto->setDescripcion($_POST['descripcion']);
	$producto->setPrecio($_POST['precio']);
	$producto->setStock($_POST['stock']);
	
	$crud->insertar($producto);
	header('Location: mostrar.php');

}elseif(isset($_POST['actualizar'])){
	$producto->setId($_POST['id']);
	$producto->setId_categoria($_POST['id_categoria']);
	$producto->setId_iva($_POST['id_iva']);
	$producto->setId_proveedor($_POST['id_proveedor']);
	$producto->setNombre($_POST['nombre']);
	$producto->setDescripcion($_POST['descripcion']);
	$producto->setPrecio($_POST['precio']);
	$producto->setStock($_POST['stock']);
	$crud->actualizar($producto);
	header('Location: mostrar.php');

}elseif ($_GET['accion']=='e') {
	$crud->eliminar($_GET['id']);
	header('Location: mostrar.php');

}
?>