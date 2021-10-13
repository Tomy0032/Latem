<?php
// incluye la clase Db
require_once('conexion.php');
 
class CrudProducto{

// constructor de la clase
public function __construct(){}
 
// método para insertar, recibe como parámetro un objeto de tipo producto
public function insertar($producto){
	$db=Db::conectar();
	$insert=$db->prepare("insert into producto(id_categoria, id_iva, id_proveedor, nombre, descripcion,precio, stock) values(:id_categoria,:id_iva,:id_proveedor,:nombre,:descripcion,:precio,:stock)");
	$insert->bindValue('id_categoria',$producto->getId_categoria());
	$insert->bindValue('id_iva',$producto->getId_iva());
	$insert->bindValue('id_proveedor',$producto->getId_proveedor());
	$insert->bindValue('nombre',$producto->getNombre());
	$insert->bindValue('descripcion',$producto->getDescripcion());
	$insert->bindValue('precio',$producto->getPrecio());
	$insert->bindValue('stock',$producto->getStock());
	$insert->execute();
 
}
 
// método para mostrar todos los productos
public function mostrar(){
	$db=Db::conectar();
	$listaProductos=[];
	$select=$db->query('SELECT * FROM producto');
	 
	foreach($select->fetchAll() as $producto){
	$myProducto= new producto();
	$myProducto->setId($producto['id']);
	$myProducto->setId_categoria($producto['id_categoria']);
	$myProducto->setId_iva($producto['id_iva']);
	$myProducto->setId_proveedor($producto['id_proveedor']);
	$myProducto->setNombre($producto['nombre']);
	$myProducto->setDescripcion($producto['descripcion']);
	$myProducto->setPrecio($producto['precio']);
	$myProducto->setStock($producto['stock']);
	$listaProductos[]=$myProducto;
	}
	return $listaProductos;
}
 
// método para eliminar un producto, recibe como parámetro el id del producto
public function eliminar($id){
	$db=Db::conectar();
	$eliminar=$db->prepare('DELETE FROM producto WHERE ID=:id');
	$eliminar->bindValue('id',$id);
	$eliminar->execute();
}
 
// método para buscar un producto, recibe como parámetro el id del producto
public function obtenerProducto($id){
	$db=Db::conectar();
	$select=$db->prepare('SELECT * FROM producto WHERE ID=:id');
	$select->bindValue('id',$id);
	$select->execute();
	$producto=$select->fetch();
	if ($producto == null) {
		$miProducto= new producto();
		$miProducto->setId('0');
		return $miProducto;
	}	
	$myProducto= new producto();
	$myProducto->setId($producto['id']);
	$myProducto->setId_categoria($producto['id_categoria']);
	$myProducto->setId_iva($producto['id_iva']);
	$myProducto->setId_proveedor($producto['id_proveedor']);
	$myProducto->setNombre($producto['nombre']);
	$myProducto->setDescripcion($producto['descripcion']);
	$myProducto->setPrecio($producto['precio']);
	$myProducto->setStock($producto['stock']);
	return $myProducto;
	
}
 
// método para actualizar un producto, recibe como parámetro el producto
public function actualizar($producto){
	$db=Db::conectar();
	$actualizar=$db->prepare('UPDATE producto SET id_categoria=:id_categoria,id_iva=:id_iva,id_proveedor=:id_proveedor,nombre=:nombre, descripcion=:descripcion,precio=:precio,stock=:stock  WHERE ID=:id');
	$actualizar->bindValue('id',$producto->getId());
	$actualizar->bindValue('id_categoria',$producto->getId_categoria());
	$actualizar->bindValue('id_iva',$producto->getId_iva());
	$actualizar->bindValue('id_proveedor',$producto->getId_proveedor());
	$actualizar->bindValue('nombre',$producto->getNombre());
	$actualizar->bindValue('descripcion',$producto->getDescripcion());
	$actualizar->bindValue('precio',$producto->getPrecio());
	$actualizar->bindValue('stock',$producto->getStock());
	$actualizar->execute();
}

public function buscarNombre($nombre){
	$name=$nombre;
	$db=Db::conectar();
	$listaProductos=[];
	$select=$db->query("SELECT * FROM producto where nombre like '$name'");
	foreach($select->fetchAll() as $producto){
	$myProducto= new producto();
	$myProducto->setId($producto['id']);
	$myProducto->setId_categoria($producto['id_categoria']);
	$myProducto->setId_iva($producto['id_iva']);
	$myProducto->setId_proveedor($producto['id_proveedor']);
	$myProducto->setNombre($producto['nombre']);
	$myProducto->setDescripcion($producto['descripcion']);
	$myProducto->setPrecio($producto['precio']);
	$myProducto->setStock($producto['stock']);
	$listaProductos[]=$myProducto;

	}
	return $listaProductos;
}
}
?>