<?php  

class Imagenes{

	private $id_producto;
	private $primera;
	private $primeraMin;
	private $segunda;
	private $segundaMin;
	private $tercera;
	private $terceraMin;

	public function getId_Producto(){
		return $this->id_producto;
	}
 
	public function setId_Producto($id_producto){
		$this->id_producto = $id_producto;
	}

	public function getPrimera(){
		return $this->primera;
	}
 
	public function setPrimera($primera){
		$this->primera = $primera;
	}

	public function getPrimeraMin(){
		return $this->primeraMin;
	}
 
	public function setPrimeraMin($primeraMin){
		$this->primeraMin = $primeraMin;
	}

	public function getSegunda(){
		return $this->segunda;
	}
 
	public function setSegunda($segunda){
		$this->segunda = $segunda;
	}

	public function setSegundaMin($segundaMin){
		$this->segundaMin = $segundaMin;
	}

	public function getSegundaMin(){
		return $this->segundaMin;
	}
 
	public function getTercera(){
		return $this->tercera;
	}
 
	public function setTercera($tercera){
		$this->tercera = $tercera;
	}

	public function getTerceraMin(){
		return $this->terceraMin;
	}
 
	public function setTerceraMin($terceraMin){
		$this->terceraMin = $terceraMin;
	}

}

?>