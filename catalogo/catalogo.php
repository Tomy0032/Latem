<?php
session_start();
require_once 'conexion.php';

$db=Db::conectar();

if (isset($_SESSION['ci'])) {
	$permiso=$db->query("select permiso from usuario where ci='$_SESSION[ci]'");
}


$categoria = $_GET['categoria'];
$listaProductos = $db->query("select primera, p.nombre, precio from producto p, categoria c, imagenes i where p.id_categoria = c.id and i.id_producto = p.id and c.nombre = '$categoria' and estado in ('activo', 'destacado')");
$listaProductos2=$db->query("select primera, p.nombre, precio from producto p, categoria c, imagenes i where p.id_categoria = c.id and i.id_producto = p.id and c.nombre = '$categoria' and estado in ('activo', 'destacado')");

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
							<a href="">Cursos</a>
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
						<?php 
						if(isset($_SESSION['ci'])){
							foreach($permiso->fetchAll() as $row){
								if ($row['permiso'] == 1) {
									?>
									<li>
										<a href="/utu/latem/crud/mostrar.php" class="icon">
											<i class="fas fa-cogs"></i>
										</a>
									</li>
									<?php
								}
							}

						}
						 ?>
						
					</ul>
				</nav>
			</div>
			
			<!--====  End of Barra de navegación  ====-->
	</header>
	
	<div class="contenedor-catalogo">
		<?php if ($categoria == 'Sonido' || $categoria == 'Temperatura' || $categoria == 'Humedad' || $categoria == 'Luminosidad'){
			?> 
			<h1><?php echo 'Sensores de ' .$categoria ?></h1>
			<?php 
		}else{
		?>
			<h1><?php echo $categoria ?></h1>
		<?php  
		}
		?>
		
		<div class="contenedor-productos">

			<?php 
			if ($listaProductos->fetchAll() == null) {
				
				?>
					<div class="noProducto">
						<h2>No se han encontrado productos :(</h2>
						<br>
						<p>Esto puede deberse a un problema de nuestro servidor</p>
						<p>Si es así, no tardaremos en solucionarlo ;)</p>
					</div>
				<?php
			}
			else{
				foreach ($listaProductos2->fetchAll() as $row) {
					?>
					<a href="">
						<div class="producto">
							<img src="data:image/jpg;base64,<?php echo base64_encode($row['primera'])?>"/>
							<span>
								<?php
								echo $row['nombre'];
								?>
							</span>
							<span style="color: #702F8A; font-weight: bold; font-size: 22px;">
								<?php
								echo "$";
								echo $row['precio'];
								?>
							</span>
						</div>
					</a>
					<?php
				}
			}			
			 ?>
		</div>
	</div>
	<footer>
		<div class="contenedor-footer">
			<div class="f-body">
				<div class="columna1">
					<h2>Nuestra ubicación</h2>
					<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit distinctio neque, sapiente totam voluptatibus asperiores id explicabo quisquam molestiae fugit et magnam dolorum aut error suscipit ratione eveniet. Ex, dicta?</p>
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
					<h2>Información Contactos</h2>
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
	<script src="/utu/Latem/scripts.js"></script>
</body>
</html>