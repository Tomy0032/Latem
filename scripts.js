var cambiarLogin = document.getElementById('btn-iniciar'),
	cambiarRegistro = document.getElementById('btn-registrar'),
	login = document.getElementById('login'),
	registro = document.getElementById('registro'),
	abrirProductos = document.getElementById('btn-productos'),
	menuProductos = document.getElementById('menu-productos'),
	contador = 0;

function cambioLogin(){
	if (contador == 1) {
		registro.classList.add('click');
		login.classList.remove('click');
		cambiarLogin.classList.add('click');
		cambiarRegistro.classList.remove('click');
		contador = 0;
	}
}

function cambioRegistro(){
	if (contador == 0) {
		login.classList.add('click');
		registro.classList.remove('click');
		cambiarRegistro.classList.add('click');
		cambiarLogin.classList.remove('click');
		contador = 1;
	}
}
function hoverProductos(){
	abrirProductos.classList.remove('noEncima');
	abrirProductos.classList.add('encima');
}
function noHoverProductos(){
	abrirProductos.classList.remove('encima');
	abrirProductos.classList.add('noEncima');
}

if (cambiarLogin) {
	cambiarLogin.addEventListener('click', cambioLogin, true);
}
if (cambiarRegistro) {
	cambiarRegistro.addEventListener('click', cambioRegistro, true);
}
if (menuProductos) {
	menuProductos.addEventListener('mouseover', hoverProductos, true);
	menuProductos.addEventListener('mouseout', noHoverProductos, true);
}
