<?php

require_once('crud_producto.php');
require_once('producto.php');
require_once('conexion.php');
require_once('categoria.php');
require_once('crud_imagenes.php');
require_once('imagenes.php');
$db=Db::conectar();
$crudP=new CrudProducto();
$producto= new producto();
$crudI=new CrudImagenes();
$imagenes= new Imagenes();

if (isset($_POST['busqueda'])) {
	if ($_POST['tipo-busqueda'] == 1) {
		$producto=$crudP->obtenerProducto($_POST['busqueda']);
	}elseif ($_POST['tipo-busqueda'] == 2) {
		$listaProductos=$crudP->buscarNombre($_POST['busqueda'].'%');
	}
	
}else{
	$listaProductos=$crudP->mostrar();
}





if (isset ($_GET['accion']) && $_GET['accion'] == 'a') {

	?>
	<style>
		#ingProd{
		 	display: none;
		}
		</style>
	<?php

	$producto=$crudP->obtenerProducto($_GET['id']);

}else{
	?>
	<style>
		#actProd{
		 	display: none;
		}
	</style>
	<?php
}

?>
 


<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mostrar Productos</title>
	<link rel="stylesheet" href="/utu/Latem/estilos.css">
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

				<!---Logo--->
				<a href="">
					<img src="/utu/Latem/Recursos/RoboTech logo.png" alt="">
				</a>
				<!---Logo--->

				<!---Buscador--->
				<form action="" id="buscador">
					<input type="text" placeholder="Buscar" required>
					<button type="submit" id="btn-buscar">
						<i class="fas fa-search"></i>
					</button>
				</form>
				<!---Buscador--->

				<nav>
					<ul>
						<li id="productos">
							<button id="btn-productos" class="noEncima">
								Productos
							</button>
							<div id="menu-productos">
								<div id="categorias">
									<div >
										<h4>Robótica</h4>
										<ul>
											<li>
												<a href="">Tarjetas de desarrollo</a>
											</li>
											<li>
												<a href="">Módulos</a>
											</li>
											<li>
												<a href="">Accesorios</a>
											</li>
											<li>
												<a href="">Fuentes de alimentación</a>
											</li>
										</ul>
									</div>
									<div>
										<h4>Componentes</h4>
										<ul>
											<li>
												<a href="">Diodos y Tristores</a>
											</li>
											<li>
												<a href="">Cables y Conectores</a>
											</li>
											<li>
												<a href="">Transistores</a>
											</li>
											<li>
												<a href="">Interruptores y Reles</a>
											</li>
											<li>
												<a href="">Resistivos</a>
											</li>
										</ul>
									</div>
									<div>
										<h4>Instrumentos</h4>
										<ul>
											<li>
												<a href="">Soldadores y Desoldadores</a>
											</li>
											<li>
												<a href="">Equipamiento antiestático</a>
											</li>
											<li>
												<a href="">Medidores</a>
											</li>
										</ul>
									</div>
									<div>
										<h4>Sensores</h4>
										<ul>
											<li>
												<a href="">Sonido</a>
											</li>
											<li>
												<a href="">Humedad</a>
											</li>
											<li>
												<a href="">Luminosidad</a>
											</li>
											<li>
												<a href="">Temperatura</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</li>
						<li>
							<a href="">Cursos</a>
						</li>
						<li>
							<a href="">Sobre nosotros</a>
						</li>
						<li>
							<a href="login/login.html" class="icon">
								<i class="fas fa-user"></i>
							</a>
						</li>
						<li>
							<a href="" class="icon">
								<i class="fas fa-shopping-cart"></i>
							</a>
						</li>
					</ul>
				</nav>
			</div>
			
			<!--====  End of Barra de navegación  ====-->
	</header>

	<div id="crud">
		<div id="ingProd">
			<h2>Ingrese los datos del producto</h2>

			<!--=========================================
			=            Formulario ingresar            =
			==========================================-->

			<form action='administrar_producto.php' method='post' enctype="multipart/form-data">

				<input type="hidden" name="id">
				<p>
					<label for="nombre">
						Nombre Producto:
						<input type='text' name='nombre' required>
					</label>
				</p>
				<p>
					<label for="id_categoria">
						Categoría:
						<select name="id_categoria" required>
						    <option value="1">Robótica</option>
							<option value="2">Instrumentos</option>
							<option value="3">Componentes</option>
						</select>
					</label>
				</p>
				<p>
					<label for="descripcion">
						Descripción:
						<textarea name="descripcion" required></textarea >
					</label>	
				</p>
				<p>
					<label for="precio">
						Precio:
						<input type="number" name="precio" required>
					</label>
				</p>
				<p>
					<label for="id_iva">
						IVA:
						<select name="id_iva" required>
							<option value="1">Tipo 1</option>
							<option value="2">Tipo 2</option>
							<option value="3">Tipo 3</option>
						</select>
					</label>
				</p>
				<p>
					<label for="id_proveedor">
						Proveedor:
						<select name="id_proveedor" required>
							<option value="1">Proveedor A</option>
							<option value="2">Proveedor B</option>
							<option value="3">Proveedor C</option>
							<option value="4">Proveedor D</option>
						</select>
					</label>
				</p>
				<p>
					<label for="stock">
						Cantidad:
						<input type="number" name="stock" required>
					</label>
				</p>
				<p>
					<input type='hidden' name='insertar' value='insertar'>
					<button type="submit" id="btn-ingProd">
						<i class="fas fa-save"></i>
					</button>
				</p>				
			</form> 

			<!--====  End of Formulario ingresar  ====-->
			
		</div>

		<div id="actProd">
			<h2>Actualizar los datos del producto</h2>

			<!--==========================================
			=            Formulario modificar            =
			===========================================-->

			<form action='administrar_producto.php' method='post'>

				<input type='hidden' name='id' value='<?php echo $producto->getId()?>'>
				<p>
					<label for="nombre">
						Nombre del Producto:
						<input type='text' name='nombre' value='<?php echo $producto->getNombre()?>' required>
					</label>
				</p>
				<p>
					<label for="id_categoria">
						Categoría:
						<select name="id_categoria" required>
			                <option value="1">Robótica</option>
			                <option value="2">Instrumentos</option>
			                <option value="3">Componentes</option>
	                	</select>
					</label>
				</p>
				<p>
					<label for="descripcion">
						Descripción:
						<textarea name="descripcion" required><?php echo $producto->getDescripcion()?></textarea >
					</label>
				</p>
				<p>
					<label for="precio">
						Precio:
						<input type="number" name="precio" value='<?php echo $producto->getPrecio()?>' required>
					</label>
				</p>
				<p>
					<label for="id_iva">
						IVA:
						<select name="id_iva" required>
							<option value="1">Tipo 1</option>
							<option value="2">Tipo 2</option>
							<option value="3">Tipo 3</option>
						</select>
					</label>
				</p>
				<p>
					<label for="id_proveedor">
						Proveedor:
						<select name="id_proveedor" required>
							<option value="1">Proveedor A</option>
							<option value="2">Proveedor B</option>
							<option value="3">Proveedor C</option>
							<option value="4">Proveedor D</option>
						</select>
					</label>
				</p>
				<p>
					<label for="stock">
						Stock:
						<input type="number" name="stock" value='<?php echo $producto->getStock()?>' required>
					</label>
				</p>
					<input type='hidden' name='actualizar' value='actualizar'>
				<p>
					<button type="submit">
						<i class="fas fa-save"></i>
					</button>
					<button>
						<a href="mostrar.php">
							<i class="fas fa-times"></i>
						</a>
					</button>
					</p>			
				</form>

				<!--====  End of Formulario modificar  ====-->
		
			</div>

			<div id="mostProd">
			<!--=====================================
			=            Mostrar productos            =
			======================================-->
				<div id="buscar-producto">
					<form action="mostrar.php" id="buscador-crud" method="POST">
						<section id="barra">
							<button type="submit" id="btn-buscar">
								<i class="fas fa-search"></i>
							</button>
							<input type="text" name="busqueda" placeholder="Buscar" value="<?php if(isset($_POST['busqueda'])){ echo $_POST['busqueda'];} ?>" required>
						</section>
						<section id="selectores">							
							<?php if (isset($_POST['busqueda']) && $_POST['tipo-busqueda'] == 2){ ?>
								<input type="radio" name="tipo-busqueda" value="1">Buscar por ID
								<input type="radio" name="tipo-busqueda" value="2" checked>Buscar por Nombre
							<?php }
							else{?>
								<input type="radio" name="tipo-busqueda" value="1" checked>Buscar por ID
								<input type="radio" name="tipo-busqueda" value="2">Buscar por Nombre
							<?php }?>
						</section>
					</form>
					<?php if (isset($_POST['busqueda'])){ ?>
						<a href="mostrar.php">Eliminar busqueda</a>
					<?php } ?>
				</div>					
		
			<table id="mostrar">
				<thead>
					<td>ID</td>
					<td>Categoría</td>
					<td>IVA</td>
					<td>Proveedor</td>
					<td>Imágenes</td>
					<td>Nombre</td>
					<td>Descripción</td>
					<td>Precio</td>
					<td>Stock</td>
					<td>Modificar</td>
					<td>Eliminar</td>
				</thead>
				<tbody>
					<?php
					if (isset($_POST['busqueda']) && $producto->getId() == 0 && $_POST['tipo-busqueda'] == 1){ ?>
						
						<tr>
							<td colspan="11">No se a encontrado el producto</td>
						</tr>

					<?php
					}elseif (isset($listaProductos) && $listaProductos == null && $_POST['tipo-busqueda'] == 2) {
						?>
						
						<tr>
							<td colspan="11">No se a encontrado el producto</td>
						</tr>

					<?php
					}
					 	
			
					elseif (isset($_POST['busqueda']) && $_POST['tipo-busqueda'] == 1){ 

					?>
					<tr>
						<td><?php echo $producto->getId() ?></td>
						<td><?php echo $producto->getId_categoria() ?></td>
						<td><?php echo $producto->getId_iva() ?></td>
						<td><?php echo $producto->getId_proveedor() ?></td>
						<td class="icon">
							<label for="btnImagenes<?php echo $producto->getId() ?>">
								<i class="fas fa-images"></i>
							</label>
							<input type="checkbox" id="btnImagenes<?php echo $producto->getId() ?>">
							
							<div class="imagenes">
								<div class="contenido">
									
									<div class="cerrarImagenes">
										<label for="btnImagenes<?php echo $producto->getId() ?>">
											<i class="fas fa-times"></i>
										</label>
									</div>									
								<?php 
								echo $producto->getId();
								?>

								</div>

							</div>
							<style>
								#btnImagenes<?php echo $producto->getId() ?>:checked ~ .imagenes{
									display: flex;
	 								transform: translateY(0%);
	 							}
	 						</style>
						</td>
						<td><?php echo $producto->getNombre() ?></td>
						<td><?php echo $producto->getDescripcion() ?></td>
						<td><?php echo $producto->getPrecio()?> </td>
						<td><?php echo $producto->getStock() ?></td>
						<td  class="icon"><a  href="mostrar.php?id=<?php echo $producto->getId()?>&accion=a"><i class="fas fa-edit"></i></a></td>
						<td  class="icon"><a  href="mostrar.php?id=<?php echo $producto->getId()?>&accion=e"><i class="fas fa-trash"></i></a></td>
					</tr>
					<?php }
					else{ 
					?>
					<?php 
					foreach ($listaProductos as $producto) {?>
					<tr>
						<td><?php echo $producto->getId() ?></td>
						<td><?php echo $producto->getId_categoria() ?></td>
						<td><?php echo $producto->getId_iva() ?></td>
						<td><?php echo $producto->getId_proveedor() ?></td>
						<td class="icon">
							<label for="btnImagenes<?php echo $producto->getId() ?>">
								<i class="fas fa-images"></i>
							</label>
							<input type="checkbox" id="btnImagenes<?php echo $producto->getId() ?>">
							
							<div class="imagenes">
								<div class="contenido">
									
									<div class="cerrarImagenes">
										<label for="btnImagenes<?php echo $producto->getId() ?>">
											<i class="fas fa-times"></i>
										</label>
									</div>									
									<table>
										<?php 
										$imagenes=$crudI->obtenerImagenes($producto->getId()); ?>
										<tbody>
											<form action="administrar_imagenes.php" method="POST" enctype="multipart/form-data">
												<input type="hidden" name="id_producto" value="<?php echo $producto->getId(); ?>" required/>
												<br>
												<input type="file" name="primera" required/>
												<br>
												<input type="file" name="primeraMin" required/>
												<br>
												<input type="file" name="segunda" required/>
												<br>
												<input type="file" name="segundaMin" required/>
												<br>
												<input type="file" name="tercera" required/>
												<br>
												<input type="file" name="terceraMin" required/>
												<br>
												<input type='hidden' name='actualizar' value='actualizar'>
												<input type="submit" value="Aceptar">

											</form>
											<tr>

												<td>Primera imágen</td>
												<td><img height="50px" src="data:image/jpg;base64,<?php echo base64_encode($imagenes->getPrimera())?>"/></td>
											</tr>
											<tr>
												<td>Miniatura primera imágen</td>
												<td><img height="50px" src="data:image/jpg;base64,<?php echo base64_encode($imagenes->getPrimeraMin())?>"/></td>
											</tr>
											<tr>
												<td>Segunda imágen</td>
												<td><img height="50px" src="data:image/jpg;base64,<?php echo base64_encode($imagenes->getSegunda())?>"/></td>
											</tr>
											<tr>
												<td>Minuatura segunda imágen</td>
												<td><img height="50px" src="data:image/jpg;base64,<?php echo base64_encode($imagenes->getSegundaMin())?>"/></td>
											</tr>
											<tr>
												<td>Tercera imágen</td>
												<td><img height="50px" src="data:image/jpg;base64,<?php echo base64_encode($imagenes->getTercera())?>"/></td>
											</tr>
											<tr>
												<td>Minuatura tercera imágen</td>
												<td><img height="50px" src="data:image/jpg;base64,<?php echo base64_encode($imagenes->getTerceraMin())?>"/></td>
											</tr>				
										</tbody>
									</table>
								</div>

							</div>
							<style>
								#btnImagenes<?php echo $producto->getId() ?>:checked ~ .imagenes{
									display: flex;
	 								transform: translateY(0%);
	 							}
	 						</style>
						</td>
						<td><?php echo $producto->getNombre() ?></td>
						<td><?php echo $producto->getDescripcion() ?></td>
						<td><?php echo $producto->getPrecio()?> </td>
						<td><?php echo $producto->getStock() ?></td>
						<td  class="icon"><a  href="mostrar.php?id=<?php echo $producto->getId()?>&accion=a"><i class="fas fa-edit"></i></a></td>
						<td  class="icon"><a  href="mostrar.php?id=<?php echo $producto->getId()?>&accion=e"><i class="fas fa-trash"></i></a></td>
					</tr>
					<?php }
					}?>
				</tbody>

			</table>
			
			<!--====  End of Mostrar productos  ====-->
		</div>
	</div>
	<link rel="stylesheet" href="/scripts.js">
</body>
</html>