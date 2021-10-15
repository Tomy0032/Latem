<?php
require_once('conexion.php');
 
class CrudImagenes{

public function __construct(){}
 
public function insertar($imagenes){
	$db=Db::conectar();
	$primera=$imagenes->getPrimera();
	$primeramin=$imagenes->getPrimeraMin();
	$segunda=$imagenes->getSegunda();
	$segundamin=$imagenes->getSegundaMin();
	$tercera=$imagenes->getTercera();
	$terceramin=$imagenes->getTerceraMin();
	$insert=$db->prepare("insert into imagenes values(:id_producto, '$primera', '$primeramin', '$segunda', '$segundamin', '$tercera', '$terceramin')");
	$insert->bindValue('id_producto',$imagenes->getId_Producto());
	$insert->execute();
 
}

public function mostrar(){
	$db=Db::conectar();
	$listaImagenes=[];
	$select=$db->query('SELECT * FROM imagenes');
	 
	foreach($select->fetchAll() as $imagenes){
	$myImagenes= new imagenes();
	$myImagenes->setId_Producto($imagenes['id_producto']);
	$myImagenes->setPrimera($imagenes['primera']);
	$myImagenes->setPrimeraMin($imagenes['primeramin']);
	$myImagenes->setSegunda($imagenes['segunda']);
	$myImagenes->setSegundaMin($imagenes['segundamin']);
	$myImagenes->setTercera($imagenes['tercera']);
	$myImagenes->setTerceraMin($imagenes['terceramin']);
	$listaImagenes[]=$myImagenes;
	}
	return $listaImagenes;
}

public function eliminar($id_producto){
	$db=Db::conectar();
	$eliminar=$db->prepare('DELETE FROM imagenes WHERE id_producto=:id_producto');
	$eliminar->bindValue('id_producto',$id_producto);
	$eliminar->execute();
}

public function obtenerImagenes($id_producto){
	$db=Db::conectar();
	$select=$db->prepare('SELECT * FROM imagenes WHERE id_producto=:id_producto');
	$select->bindValue('id_producto',$id_producto);
	$select->execute();
	$imagenes=$select->fetch();
	$myImagenes= new imagenes();
	$myImagenes->setId_Producto($imagenes['id_producto']);
	$myImagenes->setPrimera($imagenes['primera']);
	$myImagenes->setPrimeraMin($imagenes['primeramin']);
	$myImagenes->setSegunda($imagenes['segunda']);
	$myImagenes->setSegundaMin($imagenes['segundamin']);
	$myImagenes->setTercera($imagenes['tercera']);
	$myImagenes->setTerceraMin($imagenes['terceramin']);
	return $myImagenes;
}

public function actualizar($imagenes){
	$db=Db::conectar();
	$primera=$imagenes->getPrimera();
	$primeramin=$imagenes->getPrimeraMin();
	$segunda=$imagenes->getSegunda();
	$segundamin=$imagenes->getSegundaMin();
	$tercera=$imagenes->getTercera();
	$terceramin=$imagenes->getTerceraMin();
	$actualizar=$db->prepare("UPDATE imagenes SET id_producto=:id_producto, primera='$primera', primeramin='$primeramin', segunda='$segunda', segundamin='$segundamin', tercera='$tercera', terceramin='$terceramin'  WHERE id_producto=:id_producto");
	$actualizar->bindValue('id_producto',$imagenes->getId_Producto());
		$actualizar->execute();
}
}
?>