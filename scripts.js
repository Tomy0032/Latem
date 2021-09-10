var cambiarLogin = document.getElementById('btn-iniciar'),
	cambiarRegistro = document.getElementById('btn-registrar'),
	login = document.getElementById('login'),
	registro = document.getElementById('registro'),
	
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
function abrirPopup(){
	if (contador == 0) {
		overlay.addClass('active');
		contador = 1;
	}
}

cambiarLogin.addEventListener('click', cambioLogin, true);
cambiarRegistro.addEventListener('click', cambioRegistro, true);
