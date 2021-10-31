<?php
require_once('crud_producto.php');
require_once('producto.php');
require_once('crud_imagenes.php');
require_once('imagenes.php');
require_once('conexion.php');
 
$crud= new CrudProducto();
$producto= new Producto();
$crudI = new CrudImagenes();
$imagenes = new Imagenes();

 
if (isset($_POST['insertar'])) {
	$producto->setId_categoria($_POST['id_categoria']);
	$producto->setId_iva($_POST['id_iva']);
	$producto->setId_proveedor($_POST['id_proveedor']);
	$producto->setNombre($_POST['nombre']);
	$producto->setDescripcion($_POST['descripcion']);
	$producto->setPrecio($_POST['precio']);
	$producto->setStock($_POST['stock']);
	
	$crud->insertar($producto);

	$primera=addslashes(file_get_contents($_FILES['primera']['tmp_name']));
	$primeraMin=addslashes(file_get_contents($_FILES['primeramin']['tmp_name']));
	$segunda=addslashes(file_get_contents($_FILES['segunda']['tmp_name']));
	$segundaMin=addslashes(file_get_contents($_FILES['segundamin']['tmp_name']));
	$tercera=addslashes(file_get_contents($_FILES['tercera']['tmp_name']));
	$terceraMin=addslashes(file_get_contents($_FILES['terceramin']['tmp_name']));

	$db=Db::conectar();
	$consulta=$db->query('SELECT * FROM producto order by (id) desc limit 1');
	$result = $consulta->fetch(PDO::FETCH_ASSOC);
	$id_producto=$result['id'];
	$imagenes->setId_Producto($id_producto);
	$imagenes->setPrimera($primera);
	$imagenes->setPrimeraMin($primeraMin);
	$imagenes->setSegunda($segunda);
	$imagenes->setSegundaMin($segundaMin);
	$imagenes->setTercera($tercera);
	$imagenes->setTerceraMin($terceraMin);
	
	$crudI->insertar($imagenes);

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