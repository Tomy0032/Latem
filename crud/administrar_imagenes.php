<?php

require_once('crud_imagenes.php');
require_once('imagenes.php');
 
$crud= new CrudImagenes();
$imagenes= new Imagenes();

if (isset($_POST['insertar'])) {
	$primera=addslashes(file_get_contents($_FILES['primera']['tmp_name']));
	$primeraMin=addslashes(file_get_contents($_FILES['primeraMin']['tmp_name']));
	$segunda=addslashes(file_get_contents($_FILES['segunda']['tmp_name']));
	$segundaMin=addslashes(file_get_contents($_FILES['segundaMin']['tmp_name']));
	$tercera=addslashes(file_get_contents($_FILES['tercera']['tmp_name']));
	$terceraMin=addslashes(file_get_contents($_FILES['terceraMin']['tmp_name']));
	$imagenes->setId_Producto($_POST['id_producto']);
	$imagenes->setPrimera($primera);
	$imagenes->setPrimeraMin($primeraMin);
	$imagenes->setSegunda($segunda);
	$imagenes->setSegundaMin($segundaMin);
	$imagenes->setTercera($tercera);
	$imagenes->setTerceraMin($terceraMin);
	
	$crud->insertar($imagenes);
	header('Location: /crud/mostrar.php?pagina=1');

}
elseif(isset($_POST['actualizar'])){
	$imagen=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
	$nombre=$_POST['actualizar'];
	$id=$_POST['id'];
	$crud->actualizar($imagen, $nombre, $id);
	header('Location: /crud/mostrar.php?pagina=1');
}