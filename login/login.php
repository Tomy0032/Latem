<?php 
session_start();

if (isset($_SESSION['ci'])) {
	header('location: /index.php');
}

if (isset($_GET['carrito'])) {
	$carrito = 1;
}else{
	$carrito = 0;
}

 ?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Robotech</title>
	<link rel="stylesheet" href="/estilos.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/recursos/iconos/css/all.min.css">
	<link rel="shortcut icon" href="/recursos/favicon.png">
</head>
<body>
	<header>	
			<!--=====================================
			=          Barra de navegación          =
			======================================-->
			
			<div id="menu">
				<a href="/index.php">
					<img src="/recursos/RoboTech logo.png" alt="">
				</a>
				<form action="/busqueda.php" id="buscador" method="post">
					<input type="text" name="busqueda" placeholder="Buscar" required>
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
												<a href="/catalogo/catalogo.php?categoria=Tarjetas de desarrollo">Tarjetas de desarrollo</a>
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
												<a href="/utu/Latem/catalogo/catalogo.php?categoria=Diodos y Tiristores">Diodos y Tiristores</a>
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
							<a href="/nosotros.php">Sobre nosotros</a>
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
											<a href="/usuario/perfil.php">Mi perfil</a>
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
	
	<section class="login">
		
	
	<div id="contenedor-login">

		<!--=====================================
		=    Navegación Iniciar/Registrar       =
		======================================-->
		
		<nav id="nav_login">
			<ul>
				<li id="btn-iniciar" class="click">Iniciar Sesión</li>
				<li id="btn-registrar" class="">Registrarse</li>
			</ul>
		</nav>		
		
		<!--====  End of Navegación Iniciar/Registrar  ====-->
		
		<!--=====================================
		=                 Login                 =
		======================================-->
		
		<form action="iniciar.php" id="login" method="post">
			<p>
				<input type="hidden" name='carrito' value="<?php echo $carrito ?>">
			<label for="ci">
				<i class="fas fa-address-card"></i>
				<input type="int" name="ci" placeholder="Cédula de identidad" required>
			</label>
			</p>
			<p>
			<label for="clave">
				<i class="fas fa-key"></i>
				<input type="password" name="clave" placeholder="Contraseña" required>
			</label>
			</p>
			<p class="error --errorLog">Error de autentificación</p>	
			<p>
				<input type="submit" value="Ingresar">
			</p>
		</form>
		
		<!--====  End of Login  ====-->
		
		
		<!--==============================
		=            Registro            =
		===============================-->
		
		<form action="registro.php" id="registro" class="click" method="post">
			<p>
			<label for="ci">
				<i class="fas fa-address-card"></i>
				<input type="int" name="ci" placeholder="Cédula de identidad" required>
			</label>
			</p>
			<p>
			<label for="nombre">
				<i class="fas fa-user"></i>
				<input type="text" name="nombre" placeholder="Nombre" required>
			</label>
			</p>
			<p>
			<label for="apellido">
				<i class="fas fa-user"></i>
				<input type="text" name="apellido" placeholder="Apellido" required>
			</label>
			</p>
			<p>
			<label for="correo">
				<i class="fas fa-at"></i>
				<input type="email" name="correo" placeholder="Correo electrónico" required>
			</label>
			</p>
			<p>
			<label for="clave">
				<i class="fas fa-key"></i>
				<input type="password" name="clave" placeholder="Contraseña" required>
			</label>
			</p>
			<p>
			<label for="confirmarClave">
				<i class="fas fa-key"></i>
				<input type="password" name="confirmarClave" placeholder="Confirmar contraseña" required>
			</label>
			<p class="error --errorCon">Las contraseñas no coinciden</p>
			<p class="error --errorCI">Ya hay un usuario registrado con esa Cédula de Identidad</p>
			</p>
			<p>
				<input type="submit" value="Registrarse">
			</p>
		</form>
		
		<!--====  End of Registro  ====-->
		
	</div>
	</section>
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
	<script src="/scripts.js"></script>
</body>
</html>