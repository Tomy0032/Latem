<?php

//incluye la clase Producto y CrudProducto
require_once('crud_producto.php');
require_once('producto.php');
$crud= new CrudProducto();
$producto=new producto();

//busca el producto utilizando el id, que es enviado por GET desde la vista mostrar.php
$producto=$crud->obtenerProducto($_GET['id']);
?>

<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Actualizar producto</title>
	<link rel="stylesheet" href="/utu/Latem/estilos.css">
	<link rel="stylesheet" href="/utu/Latem/scripts.js">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/utu/Latem/recursos/iconos/css/all.min.css">
</head>
<body>
	<div id="ingProd">
		<h2>Actualizar los datos del producto</h2>

		<!--==========================================
		=            Formulario modificar            =
		===========================================-->

		<form action='administrar_producto.php' method='post'>
			<table>
				<input type='hidden' name='id' value='<?php echo $producto->getId()?>'>
				<tr>
					<td>Nombre Producto:</td>
					<td>
						<input type='text' name='nombre' value='<?php echo $producto->getNombre()?>' required>
					</td>
				</tr>
				<tr>
					<td>Categoria:</td>
					<td>
						<select name="id_categoria" required>
			                <option value="1">Robótica</option>
			                <option value="2">Instrumentos</option>
			                <option value="3">Componentes</option>
	                	</select>
					</td>
				</tr>
				<tr>
					<td>Descricpión:</td>
					<td>
						<textarea name="descripcion" required><?php echo $producto->getDescripcion()?></textarea >
					</td>
				</tr>
				<tr>
					<td>Precio:</td>
					<td>
						<input type="number" name="precio" value='<?php echo $producto->getPrecio()?>' required>
					</td>
				</tr>
				<tr>
					<td>IVA:</td>
					<td>
						<select name="id_iva" required>
							<option value="1">Tipo 1</option>
							<option value="2">Tipo 2</option>
							<option value="3">Tipo 3</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Proveedor:</td>
					<td>
						<select name="id_proveedor" required>
							<option value="1">Proveedor A</option>
							<option value="2">Proveedor B</option>
							<option value="3">Proveedor C</option>
							<option value="4">Proveedor D</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Stock:</td>
					<td>
						<input type="number" name="stock" value='<?php echo $producto->getStock()?>' required>
					</td>
				</tr>			
				<input type='hidden' name='actualizar' value'actualizar'>
			</table>
			<input type='submit' value='Guardar'>
			<p>
				<a href="mostrar.php">Volver</a>
			</p>			
		</form>

		<!--====  End of Formulario modificar  ====-->
		
	</div>
</body>
</html>