<?php

session_start();

require_once('crud_producto.php');
require_once('producto.php');
require_once('conexion.php');
require_once('crud_imagenes.php');
require_once('imagenes.php');
$db=Db::conectar();
$crudP=new CrudProducto();
$producto= new producto();
$crudI=new CrudImagenes();
$imagenes= new Imagenes();

$usuario=$db->query("select permiso from usuario where ci='$_SESSION[ci]'");
foreach ($usuario->fetchAll() as $row) {
	if ($row['permiso'] == 0) {
		header('location: /utu/latem/index.php');
	}
}
$categorias=$db->query('select * from categoria');
$proveedores=$db->query('select * from proveedor');
$categorias2=$db->query('select * from categoria');
$proveedores2=$db->query('select * from proveedor');
$pagina=$_GET['pagina'];


if ($pagina <= 0) {
	header('Location: mostrar.php?pagina=1');
}
if ($crudP->mostrar($pagina-1) == null) {
	while ($crudP->mostrar($pagina - 1) == null && $pagina > 1) {
		$pagina = $pagina - 1;
	}
}

if (isset($_POST['busqueda'])) {
	if ($_POST['tipo-busqueda'] == 1) {
		$producto=$crudP->obtenerProducto($_POST['busqueda']);
	}elseif ($_POST['tipo-busqueda'] == 2) {
		$listaProductos=$crudP->buscarNombre($_POST['busqueda'].'%');
	}
	
}else{
	$listaProductos=$crudP->mostrar($pagina-1);
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
	<title>Robotech</title>
	<link rel="stylesheet" href="/utu/Latem/estilos.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/utu/Latem/recursos/iconos/css/all.min.css">
	<link rel="shortcut icon" href="/utu/Latem/recursos/favicon.png">
</head>
<body>
	<header>	
			<!--=====================================
			=          Barra de navegación          =
			======================================-->
			
			<div id="menu">
				<a href="/utu/Latem/index.php">
					<img src="/utu/Latem/recursos/RoboTech logo.png" alt="">
				</a>
				<form action="" id="buscador">
					<input type="text" placeholder="Buscar" required>
					<button type="submit" id="btn-buscar">
						<i class="fas fa-search"></i>
					</button>
				</form>
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
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Tarjetas de desarrollo">Tarjetas de desarrollo</a>
											</li>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Módulos">Módulos</a>
											</li>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Acessorios">Accesorios</a>
											</li>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Fuentes de alimentación">Fuentes de alimentación</a>
											</li>
										</ul>
									</div>
									<div>
										<h4>Componentes</h4>
										<ul>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Diodos y Transistores">Diodos y Tristores</a>
											</li>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Cables y Conectores">Cables y Conectores</a>
											</li>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Transistores">Transistores</a>
											</li>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Interruptores y Reles">Interruptores y Reles</a>
											</li>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Resistivos">Resistivos</a>
											</li>
										</ul>
									</div>
									<div>
										<h4>Instrumentos</h4>
										<ul>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Soldadores y desoldadores">Soldadores y Desoldadores</a>
											</li>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Equipamiento antiestático">Equipamiento antiestático</a>
											</li>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Medidores">Medidores</a>
											</li>
										</ul>
									</div>
									<div>
										<h4>Sensores</h4>
										<ul>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Sonido">Sonido</a>
											</li>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Humedad">Humedad</a>
											</li>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Luminosidad">Luminosidad</a>
											</li>
											<li>
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Temperatura">Temperatura</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</li>
						<li>
							<a href="/utu/latem/cursos.php">Cursos</a>
						</li>
						<li>
							<a href="">Sobre nosotros</a>
						</li>
						<?php if (isset($_SESSION['ci'])) {
							?>
							<li id="usuario">
								<button id="btn-usuario" class="noEncima">
									<i class="fas fa-user"></i>
								</button>
								<div id="menu-usuario" >
									<ul>
										<li>
											<a href="">Mi perfil</a>
										</li>
										<li>
											<a href="">Mis compras</a>
										</li>
										<li class="last">
											<a href="/utu/latem/login/cerrarSesion.php">Cerrar sesión</a>
										</li>
									</ul>
								</div>
							</li>
							<?php
						}else{
							?>
							<li>
								<a href="/utu/latem/login/login.php" class="icon">
									<i class="fas fa-user"></i>
								</a>
							</li>
					<?php } ?>
						<li>
							<a href="" class="icon">
								<i class="fas fa-shopping-cart"></i>
							</a>
						</li>	
						<li>
							<a href="/utu/latem/crud/mostrar.php" class="icon">
								<i class="fas fa-cogs"></i>
							</a>
						</li>					
					</ul>
				</nav>
			</div>
			
			<!--====  End of Barra de navegación  ====-->
	</header>

	<div id="crud">
		<div id="ingProd">
			<h2>Ingresar producto</h2>

			<!--=========================================
			=            Formulario ingresar            =
			==========================================-->
			<table id="ingresar">
				<form action='administrar_producto.php' method='post' enctype="multipart/form-data">
					<input type='hidden' name='insertar' value='insertar'>	
					<input type="hidden" name="id">
					<tr>
						<td>Nombre:</td>
						<td class="inp"><input type='text' name='nombre' required></td>
					</tr>
					<tr>
						<td>Categoría:</td>
						<td class="inp">
							<select name="id_categoria" required>
								<option value="">Selecione una categoría</option>
							    <?php 

							    foreach ($categorias->fetchAll() as $row) {
								 $id = $row['id'];

								 ?>
								 <option value="<?php echo $id ?>"><?php echo $row['nombre']; ?></option><?php
								}

							    ?> 	
							</select>
						</td>
					</tr>	
					<tr>
						<td>Descripción:</td>
						<td class="inp"><textarea name="descripcion" required></textarea ></td>
					</tr>
					<tr>
						<td>Precio:</td>
						<td class="inp"><input type="number" name="precio" required></td>
					</tr>
					<input type="hidden" name="id_iva" value="1">
					<tr>
						<td>Proveedor:</td>
						<td class="inp">
							<select name="id_proveedor" required>
								<option value="">Seleccione un proveedor</option>
							    <?php 

							    foreach ($proveedores->fetchAll() as $row) {

								 ?>
								 <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre']; ?></option><?php
								}

							    ?> 	
							</select>
						</td>
					</tr>
					<tr>
						<td>Cantidad:</td>
						<td class="inp"><input type="number" name="stock" required></td>
					</tr>
					<tr>
						<td>Estado:</td>
						<td class="inp">
							<select name="estado" id="estado" required>
								<option value="">Seleccione un estado</option>
								<option value="activo">Activo</option>
								<option value="inactivo">Inactivo</option>
								<option value="destacado">Destacado</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Primera imágen:</td>						
						<td class="inp">
							<label class="file">
						        <input type="file" id="file" name="primera" onchange="fileChoose(event,this)" required/>
						        <span class="seleccion" data-after="Cargar imágen"></span>
						    </label>
						</td>
					</tr>
					<tr>
						<td>Primera imágen - Miniatura:</td>
						<td class="inp">
							<label class="file">
						        <input type="file" id="file" name="primeramin" onchange="fileChoose(event,this)" required/>
						        <span class="seleccion" data-after="Cargar imágen"></span>
						    </label>
						</td>
					</tr>
					<tr>
						<td>Segunda imágen:</td>
						<td class="inp">
							<label class="file">
						        <input type="file" id="file" name="segunda" onchange="fileChoose(event,this)" required/>
						        <span class="seleccion" data-after="Cargar imágen"></span>
						    </label>
						</td>
					</tr>
					<tr>
						<td>Segunda imágen - Minuatura:</td>
						<td class="inp">
							<label class="file">
						        <input type="file" id="file" name="segundamin" onchange="fileChoose(event,this)" required/>
						        <span class="seleccion" data-after="Cargar imágen"></span>
						    </label>
						</td>
					</tr>
					<tr>
						<td>Tercera imágen:</td>
						<td class="inp">
							<label class="file">
						        <input type="file" id="file" name="tercera" onchange="fileChoose(event,this)" required/>
						        <span class="seleccion" data-after="Cargar imágen"></span>
						    </label>
						</td>
					</tr>
					<tr>
						<td>Tercera imágen - Miniatura:</td>
						<td class="inp">
							<label class="file">
						        <input type="file" id="file" name="terceramin" onchange="fileChoose(event,this)" required/>
						        <span class="seleccion" data-after="Cargar imágen"></span>
						    </label>
						</td>
					</tr>
					<tr>
						<td class="btn" colspan="2">
						 	<button type="submit" id="btn-ingProd">
								<i class="fas fa-save"></i>
							</button>
						</td>
					</tr>

				</form> 
			</table>

			<!--====  End of Formulario ingresar  ====-->
			
		</div>

		<div id="actProd">
			<h2>Actualizar producto</h2>

			<!--==========================================
			=            Formulario modificar            =
			===========================================-->

			<table id="actualizar">
				<form action='administrar_producto.php' method='post'>
					<input type='hidden' name='actualizar' value='actualizar'>
					<input type="hidden" name="id" value="<?php echo $producto->getId(); ?>">
					<tr>
						<td>Nombre:</td>
						<td class="inp"><input type='text' name='nombre' value="<?php echo $producto->getNombre(); ?>" required></td>
					</tr>
					<tr>
						<td>Categoría:</td>
						<td class="inp">
							<select name="id_categoria" required>
								<option value="<?php echo $producto->getId_categoria()?>">Mantener categoría</option>
							    <?php 

							    foreach ($categorias2->fetchAll() as $row) {
								 $id = $row['id'];
								 echo "hola";

								 ?>
								 <option value="<?php echo $id ?>"><?php echo $row['nombre']; ?></option><?php
								}

							    ?> 	
							</select>
						</td>
					</tr>	
					<tr>
						<td>Descripción:</td>
						<td class="inp"><textarea name="descripcion" required><?php echo $producto->getDescripcion(); ?></textarea ></td>
					</tr>
					<tr>
						<td>Precio:</td>
						<td class="inp"><input type="number" name="precio" value="<?php echo $producto->getPrecio(); ?>" required></td>
					</tr>
					<input type="hidden" name="id_iva" value="1">
					<tr>
						<td>Proveedor:</td>
						<td class="inp">
							<select name="id_proveedor" required>
								<option value="<?php echo $producto->getId_proveedor()?>">Mantener proveedor</option>
							    <?php 

							    foreach ($proveedores2->fetchAll() as $row) {
								 $id = $row['id'];
								 echo "hola";

								 ?>
								 <option value="<?php echo $id ?>"><?php echo $row['nombre']; ?></option><?php
								}

							    ?> 	
							</select>

						</td>
					</tr>
					<tr>
						<td>Cantidad:</td>
						<td class="inp"><input type="number" name="stock" value="<?php echo $producto->getStock(); ?>" required></td>
					</tr>
					<tr>
						<td>Estado:</td>
						<td class="inp">
							<select name="estado" id="estado" required>
								<option value="<?php echo $producto->getEstado() ?>">Mantener estado</option>
								<option value="activo">Activo</option>
								<option value="inactivo">Inactivo</option>
								<option value="destacado">Destacado</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="btn" colspan="2">
						 	<button type="submit" id="btn-ingProd">
								<i class="fas fa-save"></i>
							</button>
							<button>
								<a href="mostrar.php">
									<i class="fas fa-times"></i>
								</a>
							</button>
						</td>
					</tr>

				</form> 
			</table>

				<!--====  End of Formulario modificar  ====-->
		
			</div>

			<div id="mostProd">
			<!--=====================================
			=            Mostrar productos            =
			======================================-->
				<div id="buscar-producto">
					<form action="mostrar.php?pagina=1" id="buscador-crud" method="POST">
						<section id="barra">
							<button type="submit" id="btn-buscar">
								<i class="fas fa-search"></i>
							</button>
							<input type="text" name="busqueda" placeholder="Buscar" value="<?php if(isset($_POST['busqueda'])){ echo $_POST['busqueda'];} ?>" required>
						</section>
						<section id="selectores">							
							<?php if (isset($_POST['busqueda']) && $_POST['tipo-busqueda'] == 2){ ?>
								<input type="radio" id="porId" name="tipo-busqueda" value="1">
								<label for="porId">Buscar por Nombre</label>
								<input type="radio" id="porNombre" name="tipo-busqueda" value="2" checked>
								<label for="porNombre">Buscar por Nombre</label>
							<?php }
							else{?>
								<input type="radio" id="porId" name="tipo-busqueda" value="1" checked>
								<label for="porId">Buscar por Nombre</label>
								<input type="radio" id="porNombre" 	name="tipo-busqueda" value="2">
								<label for="porNombre">Buscar por Nombre</label>
							<?php }?>
						</section>
					</form>
					<?php if (isset($_POST['busqueda'])){ ?>
						<a href="mostrar.php?pagina=1">Eliminar busqueda</a>
					<?php } ?>
				</div>		
			<?php 
			if (!isset($_POST['busqueda'])) {
				?>
				<div class="cambiarPágina">
					<?php if ($pagina > 1){
					 ?>
						<a class="left" href="mostrar.php?pagina=<?php echo $pagina - 1 ?>">
							<i class="fas fa-chevron-left"></i>
						</a>
					<?php 
					}
					 ?>
					<form action="mostrar.php" method=get name="formPagina">
						<input name="pagina" onkeypress="if (event.keyCode == 13) enviar_formulario()" value="<?php echo $pagina ?>" />
					</form>
					<?php 
					if($crudP->mostrar($pagina) != null){
					 ?>
						<a class="right" href="mostrar.php?pagina=<?php echo $pagina + 1 ?>">
							<i class="fas fa-chevron-right"></i>
						</a>
					<?php 
					}
					 ?>					
				</div>

				<?php
			}
			 ?>
			
			<table id="mostrar">
				<thead>
					<td>ID</td>
					<td>Categoría</td>
					<td>IVA</td>
					<td>Proveedor</td>
					<td>Imágenes</td>
					<td>Nombre</td>
					<td>Precio</td>
					<td>Stock</td>
					<td>Estado</td>
					<td>Modificar</td>
					<td>Eliminar</td>
				</thead>
				<tbody>
					<?php
					if (isset($_POST['busqueda']) && $producto->getId() == 0 && $_POST['tipo-busqueda'] == 1){ ?>
						
						<tr>
							<td colspan="11">No se ha encontrado el producto</td>
						</tr>

					<?php
					}elseif (isset($_POST['busqueda']) && isset($listaProductos) && $listaProductos == null && $_POST['tipo-busqueda'] == 2) {
						?>
						
						<tr>
							<td colspan="11">No se ha encontrado el producto</td>
						</tr>

					<?php
					}
					if ($pagina == 1 && $crudP->mostrar($pagina - 1) == null){ ?>
						
						<tr>
							<td colspan="11">No se ha cargado ningún producto</td>
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
						<td><?php echo $producto->getPrecio()?> </td>
						<td><?php echo $producto->getStock() ?></td>
						<td  class="icon"><a  href="mostrar.php?id=<?php echo $producto->getId()?>&accion=a"><i class="fas fa-edit"></i></a></td>
						<td  class="icon"><a  href="mostrar.php?id=<?php echo $producto->getId()?>&accion=e"><i class="fas fa-trash"></i></a></td>
					</tr>
					<?php }
					else{ 
					?>
					<?php 
					foreach ($listaProductos as $producto) {
						$id_categoria = $producto->getId_categoria();
						$selCategoria = $db->query("select * from categoria where id='$id_categoria'");
						?>
						
					<tr>
						<td><?php echo $producto->getId() ?></td>
						<td>
							<?php  
							foreach ($selCategoria->fetchAll() as $cate) {
								echo $cate['nombre'];
							}
							?>
								
							</td>
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
										<tr>
											<td>Primera imágen</td>
											<td>
												<img height="70px" src="data:image/jpg;base64,<?php echo base64_encode($imagenes->getPrimera())?>"/>
											</td>
											<td class="inp">
												<form action="administrar_imagenes.php" method="POST" enctype="multipart/form-data">
													<label class="file">
												        <input type="file" id="file" name="imagen" onchange="fileChoose(event,this)" required/>
												        <span class="seleccion" data-after="Cargar imágen"></span>
												    </label>
												    <br>
													<input type='hidden' name='actualizar' value='primera'>
													<input type="hidden" name="id" value="<?php echo $producto->getId() ?>">
													<input type="submit">
												</form>
											</td>
										</tr>
										<tr>
											<td>Miniatura primera imágen</td>
											<td><img height="70px" src="data:image/jpg;base64,<?php echo base64_encode($imagenes->getPrimeraMin())?>"/></td>
											<td class="inp">
												<form action="administrar_imagenes.php" method="POST" enctype="multipart/form-data">
													<label class="file">
												        <input type="file" id="file" name="imagen" onchange="fileChoose(event,this)" required/>
												        <span class="seleccion" data-after="Cargar imágen"></span>
												    </label>
												    <br>
													<input type='hidden' name='actualizar' value='primeramin'>
													<input type="hidden" name="id" value="<?php echo $producto->getId() ?>">
													<input type="submit">
												</form>
											</td>
										</tr>
										<tr>
											<td>Segunda imágen</td>
											<td><img height="70px" src="data:image/jpg;base64,<?php echo base64_encode($imagenes->getSegunda())?>"/></td>
											<td class="inp">
												<form action="administrar_imagenes.php" method="POST" enctype="multipart/form-data">
													<label class="file">
												        <input type="file" id="file" name="imagen" onchange="fileChoose(event,this)" required/>
												        <span class="seleccion" data-after="Cargar imágen"></span>
												    </label>
												    <br>
													<input type='hidden' name='actualizar' value='segunda'>
													<input type="hidden" name="id" value="<?php echo $producto->getId() ?>">
													<input type="submit">
												</form>
											</td>
										</tr>
										<tr>
											<td>Minuatura segunda imágen</td>
											<td><img height="70px" src="data:image/jpg;base64,<?php echo base64_encode($imagenes->getSegundaMin())?>"/></td>
											<td class="inp">
												<form action="administrar_imagenes.php" method="POST" enctype="multipart/form-data">
													<label class="file">
												        <input type="file" id="file" name="imagen" onchange="fileChoose(event,this)" required/>
												        <span class="seleccion" data-after="Cargar imágen"></span>
												    </label>
												    <br>
													<input type='hidden' name='actualizar' value='segundamin'>
													<input type="hidden" name="id" value="<?php echo $producto->getId() ?>">
													<input type="submit">
												</form>
											</td>
										</tr>
										<tr>
											<td>Tercera imágen</td>
											<td><img height="70px" src="data:image/jpg;base64,<?php echo base64_encode($imagenes->getTercera())?>"/></td>
											<td class="inp">
												<form action="administrar_imagenes.php" method="POST" enctype="multipart/form-data">
													<label class="file">
												        <input type="file" id="file" name="imagen" onchange="fileChoose(event,this)" required/>
												        <span class="seleccion" data-after="Cargar imágen"></span>
												    </label>
												    <br>
													<input type='hidden' name='actualizar' value='tercera'>
													<input type="hidden" name="id" value="<?php echo $producto->getId() ?>">
													<input type="submit">
												</form>
											</td>
										</tr>
										<tr>
											<td>Minuatura tercera imágen</td>
											<td><img height="70px" src="data:image/jpg;base64,<?php echo base64_encode($imagenes->getTerceraMin())?>"/></td>
											<td class="inp">
												<form action="administrar_imagenes.php" method="POST" enctype="multipart/form-data">
													<label class="file">
												        <input type="file" id="file" name="imagen" onchange="fileChoose(event,this)" required/>
												        <span class="seleccion" data-after="Cargar imágen"></span>
												    </label>
												    <br>
													<input type='hidden' name='actualizar' value='terceramin'>
													<input type="hidden" name="id" value="<?php echo $producto->getId() ?>">
													<input type="submit">
												</form>
											</td>
										</tr>				
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
						<td><?php echo $producto->getPrecio()?> </td>
						<td><?php echo $producto->getStock() ?></td>
						<td><?php echo $producto->getEstado() ?></td>
						<td  class="icon"><a  href="mostrar.php?id=<?php echo $producto->getId()?>&accion=a&pagina=<?php echo $pagina ?>"><i class="fas fa-edit"></i></a></td>
						<td  class="icon">
							<label for="btnEliminar<?php echo $producto->getId() ?>">
								<i class="fas fa-trash"></i>
							</label>
							<input type="checkbox" id="btnEliminar<?php echo $producto->getId() ?>">
							
							<div class="eliminar">
								<div class="contenido">
									
									<div class="cerrarEliminar">
										<p>¿Seguro que desea eliminar el producto  <b><?php echo $producto->getNombre(); ?></b>?</p>
										<label for="btnEliminar<?php echo $producto->getId() ?>">
											<i class="fas fa-times"></i>
										</label>
										<a  href="administrar_producto.php?id=<?php echo $producto->getId()?>&accion=e">
											<i class="fas fa-trash"></i>
										</a>
									</div>
								</div>
							</div>
							<style>
								#btnEliminar<?php echo $producto->getId() ?>:checked ~ .eliminar{
									display: flex;
	 							}
	 						</style>
						</td>
					</tr>
					<?php }
					}?>
				</tbody>

			</table>
			<!--====  End of Mostrar productos  ====-->
		</div>
	</div>
	<footer>
		<div class="contenedor-footer">
			<div class="f-body">
				<div class="columna1">
					<h2>Nuestra ubicación</h2>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3277.8187681297272!2d-56.234990184249!3d-34.760157873300294!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a1d2e23830071f%3A0x8a40b54c632f0f11!2sEscuela%20T%C3%A9cnica%20La%20Paz%20UTU!5e0!3m2!1ses-419!2suy!4v1636122441146!5m2!1ses-419!2suy" width="480" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				</div>
				<div class="columna2">
					<h2>Redes sociales</h2>
					<div class="fila">
						<a href="https://www.facebook.com/Robotech-Uruguay-100867842415629">
							<i class="fab fa-facebook"></i>
						</a>
						<label>
							<a href="https://www.facebook.com/Robotech-Uruguay-100867842415629">Siguenos en Facebook</a>
						</label>
					</div>
					<div class="fila">
						<a href="https://www.instagram.com/robotech.uy/">
							<i class="fab fa-instagram"></i>
						</a>
						<label>
							<a href="https://www.instagram.com/robotech.uy/">Siguenos en Instagram</a>
						</label>
					</div>
				</div>
				<div class="columna3">
					<h2>Información de contacto</h2>
					<div class="fila">
						<i class="fas fa-phone-square-alt"></i>
						<label>+598 93 456 789</label>
					</div>
					<div class="fila">
						<i class="fas fa-envelope"></i>
						<label>online.robotech@gmail.com</label>
					</div>
				</div>
			</div>
		</div>	
		<div class="f-footer">
			<div class="copyright">
				Copyright &copy; 2021 | <a href="https://www.latem-uy.com">www.latem-uy.com</a> Latem S.R.L.
			</div>
			<div class="informacion">
				<a href="">Información de la empresa</a> | <a href="">Privación y Política</a> | <a href="">Términos y Condiciones</a>
			</div>
		</div>	
	</footer>
	<script>
		function fileChoose(event, element) {
    		if (event.target.files.length > 0) {
       			element.nextElementSibling.setAttribute('data-after', event.target.files[0].name);
    		}
		}
	
	function enviar_formulario(){
		document.formPagina.submit()
	}	
	</script>
	<link rel="stylesheet" href="/utu/latem/scripts.js">
</body>
</html>