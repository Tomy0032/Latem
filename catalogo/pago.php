<?php 
session_start();

require_once('conexion.php');

$db=Db::conectar();

$subtotal=$_POST['subtotal'];
$iva=$_POST['iva'];
$manejo=60;
$cantidad=$_POST['cantidad'];

if (isset($_SESSION['ci'])) {
	$permiso=$db->query("select permiso from usuario where ci='$_SESSION[ci]'");
}else{
	header('location: /index.php');
}

$id_Sesion=session_id();
$agencia=$db->query("select * from agencia where id='$_POST[agencia]'");
$envio=$agencia->fetch()['costo'];
$metodo=$db->query("select * from metodo_pago");
$metodo2=$db->query("select * from metodo_pago");
$total=($subtotal + $iva + $manejo + $envio);


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
	<script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
												<a href="/catalogo/catalogo.php?categoria=Transistores">Transistores</a>
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
								$comprobar=$db->query("select count(*) from lista_productos where id_sesion = '$id_sesion' and cantidad > 0 and estado='espera'");
								if ($comprobar->fetch()['count(*)'] > 0) {
									$comprobar=$db->query("select count(*) from lista_productos where id_sesion = '$id_sesion' and cantidad > 0 and estado='espera'");
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
	<div class="contenedor-pago">
		<div class="pago">
			<div class="contenedor-metodo">
				<label>
					<input type="radio" name="metodo" class="efectivo" checked>
					<span class="seleccionar-metodo">
						<h4>Pagar en efectivo</h4>
						Pagar en local o al recibir el paquete
					</span>
					<form action="cobro_efectivo.php" class="completar-efectivo" method="post">
						<input type="hidden" name="cantidad" value="<?php echo $cantidad ?>">
						<input type="hidden" name="total" value="<?php echo round($total) ?>">
						<input type="hidden" name="subtotal" value="<?php echo $subtotal ?>">
						<input type="hidden" name="iva" value="<?php echo round($iva) ?>">
						<input type="hidden" name="metodo" value="efectivo">
						<input type="hidden" name="agencia" value="<?php echo $_POST['agencia'] ?>">						<br>
						<br>
						<button type="submit">Completar pago</button>
					</form>
					
				</label>
				<label>
					<input type="radio" name="metodo" class="tarjeta">
					<span class="seleccionar-metodo"><h4>Pagar con tarjeta</h4><br><br><br></span>
					<div class="container">
						<form action="cobro.php" method="POST" id="card-form">
							<input type="hidden" name="cantidad" value="<?php echo $cantidad ?>">
							<input type="hidden" name="total" value="<?php echo round($total) ?>">
						<input type="hidden" name="subtotal" value="<?php echo $subtotal ?>">
						<input type="hidden" name="iva" value="<?php echo round($iva) ?>">
						<input type="hidden" name="agencia" value="<?php echo $_POST['agencia'] ?>">
							<b>Ingrese los datos de la tarjeta</b>
							<br>
							<br>
							<span class="card-errors"></span>
							<br>
							<table>
								<tr>
									<td class="derecha">
										<label for="card[name]">
											<span>Nombre del propietario</span>
										</label>
									</td>
									<td><input class="form-control" size="20" id="card[name]" data-conekta="card[name]" type="text"></td>
								</tr>
								<tr>
									<td class="derecha">
										<label for="card[number]">
											<span>Número de tarjeta de crédito</span>
										</label>
									</td>
									<td><input class="form-control" size="20" id="card[number]" data-conekta="card[number]" type="text"></td>
								</tr>
								<tr>
									<td class="derecha">
										<label for="card[cvc]">
											<span>CVC</span>
										</label>
									</td>
									<td><input class="form-control" size="4" id="card[cvc]" data-conekta="card[cvc]" type="text"></td>
								</tr>
								<tr>
									<td class="derecha">
										<label for="card[exp_month]">
											<span>Fecha de expiración (MM/AAAA)</span>
										</label>
										
									</td>
									<td>
										<input size="2" id="card[exp_month]" data-conekta="card[exp_month]" type="text">
										<label>
											<span>/</span>
											<input  size="4" data-conekta="card[exp_year]" type="text">
										</label>
									</td>
								</tr>
							</table>
							<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
							<br>
							<button class="btn btn-primary" type="submit">Completar pago</button>
						</form>
					</div>
				</label>
			</div>
			<div class="contenedor-resumen">
				<div class="resumen">
					<table>
						<tr>
							<th>Subtotal</th>
							<td><?php echo "$ ".$subtotal ?></td>
						</tr>
						<tr>
							<th>IVA</th>
							<td><?php echo "$ ".round($iva) ?></td>
						</tr>
						<tr>
							<th>Empaque y manejo</th>
							<td><?php echo "$ ".$manejo ?></td>
						</tr>
						<tr>
							<th>Envío</th>
							<td><?php echo "$ ".$envio ?></td>
						</tr>
						<tr>
							<th>Total</th>
							<td><b><?php echo "$ ".round($total) ?></b></td>
						</tr>
					</table>
				</div>
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

<script type="text/javascript" >
  Conekta.setPublicKey('key_Cf6xwVgweFHiqVvzixk5VEQ');

  var conektaSuccessResponseHandler = function(token) {
    var $form = $("#card-form");

     $form.append($('<input name="conektaTokenId" id="conektaTokenId" type="hidden">').val(token.id));
    $form.get(0).submit();
  };
  var conektaErrorResponseHandler = function(response) {
    var $form = $("#card-form");
    $form.find(".card-errors").text(response.message_to_purchaser);
    $form.find("button").prop("disabled", false);
  };


  $(function () {
    $("#card-form").submit(function(event) {
      var $form = $(this);

      $form.find("button").prop("disabled", true);
      Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
      return false;
    });
  });
</script>
	<script src="/scripts.js"></script>
</body>
</html>