<?php
//incluye la clase producto y CrudLibro
require_once('crud_producto.php');
require_once('producto.php');
 
$crud= new CrudProducto();
$producto= new Producto();
 
// si el elemento insertar no viene nulo llama al crud e inserta un producto
if (isset($_POST['insertar'])) {
	$producto->setId_categoria($_POST['id_categoria']);
	$producto->setId_iva($_POST['id_iva']);
	$producto->setId_proveedor($_POST['id_proveedor']);
	$producto->setNombre($_POST['nombre']);
	$producto->setDescripcion($_POST['descripcion']);
	$producto->setPrecio($_POST['precio']);
	$producto->setStock($_POST['stock']);
	
	//llama a la función insertar definida en el crud
	$crud->insertar($producto);
	header('Location: mostrar.php');

// si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el producto
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

// si la variable accion enviada por GET es == 'e' llama al crud y elimina un producto
}elseif ($_GET['accion']=='e') {
	$crud->eliminar($_GET['id']);
	header('Location: mostrar.php');

// si la variable accion enviada por GET es == 'a', envía a la página actualizar.php
}elseif($_GET['accion']=='a'){
	header('Location: actualizar.php');
}
?>