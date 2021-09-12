<?php

//incluye la clase producto y CrudProducto
require_once('crud_producto.php');
require_once('producto.php');
require_once('conexion.php');
require_once('categoria.php');
$db=Db::conectar();
$crud=new CrudProducto();
$producto= new producto();

//obtiene todos los libros con el método mostrar de la clase crud
$listaProductos=$crud->mostrar();
?>
 


<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mostrar Productos</title>
	<link rel="stylesheet" href="/utu/Latem/estilos.css">
	<link rel="stylesheet" href="/utu/Latem/scripts.js">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/utu/Latem/recursos/iconos/css/all.min.css">
</head>
<body>

	<header>	
			<!--=====================================
			=          Barra de navegación          =
			======================================-->
			
			<div id="menu">
				<a href="">
					<img src="/utu/Latem/recursos/RoboTech logo.png" alt="">
				</a>
				<form action="">
					<div id="buscador">
						<input type="text" placeholder="Buscar" required>
						<button type="submit" id="btn-buscar">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</form>
				<nav>
					<ul>
						<li>
							<a href="">Productos</a>
						</li>
						<li>
							<a href="">Cursos</a>
						</li>
						<li>
							<a href="">Sobre nosotros</a>
						</li>
						<li>
							<a href="" class="icon">
								<i class="fas fa-sign-in-alt"></i>
							</a>
						</li>
						<li>
							<a href="ingresar.php" class="icon">
								<i class="fas fa-plus"></i>
							</a>
						</li>
					</ul>
				</nav>
			</div>
			
			<!--====  End of Barra de navegación  ====-->
	</header>

	<!--=====================================
	=            Mostrar productos            =
	======================================-->

	<table id="mostrar">
		<thead>
			<td>ID</td>
			<td>Categoría</td>
			<td>IVA</td>
			<td>Proveedor</td>
			<td>Nombre</td>
			<td>Descripción</td>
			<td>Precio</td>
			<td>Stock</td>
			<td>Modificar</td>
			<td>Eliminar</td>
		</thead>
		<tbody>
			<?php foreach ($listaProductos as $producto) {?>
			<tr>
				<td><?php echo $producto->getId() ?></td>
				<td><?php echo $producto->getId_categoria() ?></td>
				<td><?php echo $producto->getId_iva() ?></td>
				<td><?php echo $producto->getId_proveedor() ?></td>
				<td><?php echo $producto->getNombre() ?></td>
				<td><?php echo $producto->getDescripcion() ?></td>
				<td><?php echo $producto->getPrecio()?> </td>
				<td><?php echo $producto->getStock() ?></td>
				<td  class="icon"><a  href="actualizar.php?id=<?php echo $producto->getId()?>&accion=a"><i class="fas fa-edit"></i></a> </td>
				<td  class="icon"><a  href="administrar_producto.php?id=<?php echo $producto->getId()?>&accion=e"><i class="fas fa-trash"></i></a>   </td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	
	
	<!--====  End of Mostrar productos  ====-->
	
</body>
</html>