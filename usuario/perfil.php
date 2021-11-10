<?php 
session_start();

require_once('conexion.php');

$db=Db::conectar();

if (isset($_SESSION['ci'])) {
	$permiso=$db->query("select permiso from usuario where ci='$_SESSION[ci]'");
}else{
	header('location: /utu/latem/');
}
$infoUs=$db->query("select * from usuario where ci = '$_SESSION[ci]'");
$infoUs2=$db->query("select * from usuario where ci = '$_SESSION[ci]'");
$ubiUs=$db->query("select * from dir_cli where ci = '$_SESSION[ci]'");
$ubiUs2=$db->query("select * from dir_cli where ci = '$_SESSION[ci]'");
$telUs=$db->query("select * from tel_cli where ci = '$_SESSION[ci]'");
$telUs2=$db->query("select * from tel_cli where ci = '$_SESSION[ci]'");

$ci=($infoUs2->fetch())['ci'];

$listaProductos = $db->query("select p.id, primera, p.nombre, precio from producto p, imagenes i where i.id_producto = p.id and estado = 'destacado'");
$listaProductos2=$db->query("select p.id, primera, p.nombre, precio from producto p, imagenes i where i.id_producto = p.id and estado = 'destacado' limit 6");

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
<body>
	<header>	
			<!--=====================================
			=          Barra de navegación          =
			======================================-->
			
			<div id="menu">
				<a href="/index.php">
					<img src="/recursos/RoboTech logo.png" alt="">
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
												<a href="/catalogo/catalogo.php?categoria=Tarjetas de desarrollo">Tarjetas de desarrollo</a>
											</li>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Módulos">Módulos</a>
											</li>
											<li>
												<a href=/catalogo/catalogo.php?categoria=Acessorios">Accesorios</a>
											</li>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Fuentes de alimentación">Fuentes de alimentación</a>
											</li>
										</ul>
									</div>
									<div>
										<h4>Componentes</h4>
										<ul>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Diodos y Tiristores">Diodos y Tiristores</a>
											</li>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Cables y Conectores">Cables y Conectores</a>
											</li>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Tranistores">Transistores</a>
											</li>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Interruptores y Reles">Interruptores y Reles</a>
											</li>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Resistivos">Resistivos</a>
											</li>
										</ul>
									</div>
									<div>
										<h4>Instrumentos</h4>
										<ul>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Soldadores y desoldadores">Soldadores y Desoldadores</a>
											</li>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Equipamiento antiestático">Equipamiento antiestático</a>
											</li>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Medidores">Medidores</a>
											</li>
										</ul>
									</div>
									<div>
										<h4>Sensores</h4>
										<ul>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Sonido">Sonido</a>
											</li>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Humedad">Humedad</a>
											</li>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Luminosidad">Luminosidad</a>
											</li>
											<li>
												<a href="/catalogo/catalogo.php?categoria=Temperatura">Temperatura</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</li>
						<li>
							<a href="/cursos.php">Cursos</a>
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
											<a href="/usuario/perfil.php">Mi perfil</a>
										</li>
										<li>
											<a href="">Mis compras</a>
										</li>
										<li class="last">
											<a href="/login/cerrarSesion.php">Cerrar sesión</a>
										</li>
									</ul>
								</div>
							</li>
							<?php
						}else{
							?>
							<li>
								<a href="/login/login.php" class="icon">
									<i class="fas fa-user"></i>
								</a>
							</li>
					<?php } ?>
						<li>
							<a href="/catalogo/carrito.php" class="icon">
								<i class="fas fa-shopping-cart"></i>
								<?php
								$id_sesion=session_id();
								$comprobar=$db->query("select count(*) from lista_productos where id_sesion = '$id_sesion' and cantidad > 0");
								if ($comprobar->fetch()['count(*)'] > 0) {
									$comprobar=$db->query("select count(*) from lista_productos where id_sesion = '$id_sesion' and cantidad > 0");
									?>
									<span>
										<div>
											<?php 
										foreach($comprobar->fetchAll() as $row){
											echo $row['count(*)'];
										}
										?>	
										</div>
									
									</span>

									<?php
								}
								 ?>
							</a>
						</li>
						<?php 
						if(isset($_SESSION['ci'])){
							foreach($permiso->fetchAll() as $row){
								if ($row['permiso'] == 1) {
									?>
									<li>
										<a href="/crud/mostrar.php" class="icon">
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
	<div class="contenedor-perfil">
		<div class="perfil">
			<div class="info">
				<table>
					<?php foreach ($infoUs->fetchAll() as $row){
					?>
						<tr>
							<td colspan="2"><h2>Mis datos</h2></td>
						</tr>
						<tr>
							<th>Nombre:</td>
							<td><?php echo $row['nombre'] ?></td>
						</tr>
						<tr>
							<th>Apellido:</td>
							<td><?php echo $row['apellido'] ?></td>
						</tr>
						<tr>
							<th>Cédula de indentidad:</td>
							<td><?php echo $row['ci'] ?></td>
						</tr>
						<tr>
							<th>Correo:</td>
							<td><?php echo $row['correo'] ?></td>
						</tr>
						<?php 
						if ($telUs->fetch() != null) {
						 ?>
						<tr>
							<th>Teléfono</th>
							<td><?php echo "0".$telUs2->fetch()['telefono'] ?></td>
						</tr>
						<?php 
						}
						 ?>
						<tr>
							<th>Teléfono</th>
							<td>
								<button id="agregar-telefono">Agregar teléfono</button>
								<form action="agregar_telefono.php" method="POST" class="noVisible" id="form-telefono">
									<input type="hidden" name="ci" value="<?php echo $ci ?>">
									<input type="number" id="telefono" name="telefono" placeholder="Ingrese su número">
									<input type="submit" value="Agregar">
								</form>
							</td>
						</tr>
					<?php 
					}
					 ?>
				</table>
			</div>
			<div class="ubicación">
				<h2>Mi dirección</h2>
				<?php 
				if ($ubiUs->fetch() == null) {
					?>
					<button id="agregar-ubicacion">Agregar dirección</button>
					<form action="agregar_direccion.php" method="POST" class="noVisible" id="form-ubicacion">
						<input type="hidden" name="ci" value="<?php echo $ci ?>">
						<input type="text" id="calle" name="calle" placeholder="Calle">
						<input type="number" id="numero" name="numero" placeholder="Número">
						<br>
						<input type="text" id="ciudad" name="ciudad" placeholder="Ciudad">
						<br>
						<input type="submit" value="Agregar">
					</form>
					<?php
				}else{
					foreach($ubiUs2->fetchAll() as $row){
						echo $row['calle']." ".$row['numero'].", ".$row['ciudad'];
				 ?>
				 <br>
				 <br>
				 <button id="agregar-ubicacion">Editar ubicación</button>
				 <form action="editar_direccion.php" method="POST" class="noVisible" id="form-ubicacion">
					<input type="hidden" name="ci" value="<?php echo $ci ?>">
					<input type="text" id="calle" name="calle" value="<?php echo $row['calle'] ?>" required>
					<input type="number" id="numero" name="numero"  value="<?php echo $row['numero'] ?>" required>
					<br>
					<input type="text" id="ciudad" name="ciudad" value="<?php echo $row['ciudad'] ?>" required>
					<br>
					<input type="submit" value="Actualizar">
					<?php
					}

				}
				 ?>
				</form>
			</div>
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
	<script src="/scripts.js"></script>
</body>
</html>