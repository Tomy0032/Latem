<?php 
session_start();

if (isset($_SESSION['ci'])) {
	header('location: /utu/latem/');
}
 ?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
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
				<a href="/utu/Latem/index.html">
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
						<li>
							<a href="/utu/latem/login/login.html" class="icon">
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
		
		<form action="iniciar.php" id="login" class="" method="post">
			<p>
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
	<script src="/utu/Latem/scripts.js"></script>
</body>
</html>