<?php
class Producto{

	private $id;
	private $id_categoria;
	private $id_iva;
	private $id_proveedor;
	private $imagen;
	private $nombre;
	private $descripcion;
	private $precio;
	private $stock;

 
	function __construct(){}
	
	public function getId(){
		return $this->id;
	}
 
	public function setId($id){
		$this->id = $id;
	}

	public function getId_categoria(){
		return $this->id_categoria;
	}
 
	public function setId_categoria($id_categoria){
		$this->id_categoria = $id_categoria;
	}

	public function getId_iva(){
		return $this->id_iva;
	}
 
	public function setId_iva($id_iva){
		$this->id_iva = $id_iva;
	}

	public function getId_proveedor(){
		return $this->id_proveedor;
	}
 
	public function setId_proveedor($id_proveedor){
		$this->id_proveedor = $id_proveedor;
	}

	public function getImagen(){
		return $this->imagen;

	}
	
	public function setImagen($imagen){
		$this->imagen = $imagen;
	}

	public function getNombre(){
		return $this->nombre;
	}
	
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}
	
	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	public function getPrecio(){
		return $this->precio;
	}
 
	public function setPrecio($precio){
		$this->precio = $precio;
	}

	public function getStock(){
		return $this->stock;
	}
 
	public function setStock($stock){
		$this->stock = $stock;
	}
}
?>