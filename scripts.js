const slider = document.querySelector("#slider");
let sliderSection = document.querySelectorAll(".slider__section");
let sliderSectionLast = sliderSection[sliderSection.length -1];

const btnLeft = document.querySelector("#btn--left");
const btnRight = document.querySelector("#btn--right");

if(slider){
	slider.insertAdjacentElement('afterbegin', sliderSectionLast);
}

const destacados = document.querySelector("#destacados");
let destacadosSection = document.querySelectorAll(".destacados__section");
let destacadosSectionLast = destacadosSection[destacadosSection.length -1];

const destacadosBtnLeft = document.querySelector("#destacados--btn--left");
const destacadosBtnRight = document.querySelector("#destacados--btn--right");

if (destacados) {
	destacados.insertAdjacentElement('afterbegin', destacadosSectionLast);

}

var cambiarLogin = document.getElementById('btn-iniciar'),
	cambiarRegistro = document.getElementById('btn-registrar'),
	login = document.getElementById('login'),
	registro = document.getElementById('registro'),
	contador = 0;

var	abrirProductos = document.getElementById('btn-productos'),
	menuProductos = document.getElementById('menu-productos'),
	abrirUsuario = document.getElementById('btn-usuario'),
	menuUsuario = document.getElementById('menu-usuario');

var lblradio1 = document.getElementById('lblradio1'),
	lblradio2 = document.getElementById('lblradio2'),
	lblradio3 = document.getElementById('lblradio3');

var primeraMin = document.getElementById('primeramin'),
	segundaMin = document.getElementById('segundamin'),
	terceraMin = document.getElementById('terceramin'),
	primera = document.getElementById('primera'),
	segunda = document.getElementById('segunda'),
	tercera = document.getElementById('tercera');

var agregarUbicacion = document.getElementById('agregar-ubicacion'),
	formUbicacion = document.getElementById('form-ubicacion');

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

function hoverUsuario(){
	abrirUsuario.classList.remove('noEncima');
	abrirUsuario.classList.add('encima');
}

function noHoverUsuario(){
	abrirUsuario.classList.remove('encima');
	abrirUsuario.classList.add('noEncima');
}

function siguiente(){
	if (lblradio1.classList.contains('active')) {
		lblradio1.classList.remove('active');
		lblradio2.classList.add('active');
		lblradio3.classList.remove('active');
	}
	else if (lblradio2.classList.contains('active')) {
		lblradio1.classList.remove('active');
		lblradio2.classList.remove('active');
		lblradio3.classList.add('active');
	}
	else if (lblradio3.classList.contains('active')) {
		lblradio1.classList.add('active');
		lblradio2.classList.remove('active');
		lblradio3.classList.remove('active');
	}
	let sliderSectionFirst = document.querySelectorAll(".slider__section")[0];
	slider.style.marginLeft = "-200%";
	slider.style.transition = "all 0.5s";
	setTimeout(function(){
		slider.style.transition = "none";
		slider.insertAdjacentElement('beforeend', sliderSectionFirst);
		slider.style.marginLeft = "-100%";
	}, 500);
}

setInterval(function(){
	siguiente();
}, 10000);

function anterior(){
	if (lblradio3.classList.contains('active')) {
		lblradio1.classList.remove('active');
		lblradio2.classList.add('active');
		lblradio3.classList.remove('active');
	}
	else if (lblradio1.classList.contains('active')) {
		lblradio1.classList.remove('active');
		lblradio2.classList.remove('active');
		lblradio3.classList.add('active');
	}
	else if (lblradio2.classList.contains('active')) {
		lblradio1.classList.add('active');
		lblradio2.classList.remove('active');
		lblradio3.classList.remove('active');
	}
	let sliderSection = document.querySelectorAll(".slider__section");
	let sliderSectionLast = sliderSection[sliderSection.length -1];
	slider.style.marginLeft = "0";
	slider.style.transition = "all 0.5s";
	setTimeout(function(){
		slider.style.transition = "none";
		slider.insertAdjacentElement('afterbegin', sliderSectionLast);
		slider.style.marginLeft = "-100%";
	}, 500);
}

function siguienteDestacado(){
	let destacadosSectionFirst = document.querySelectorAll(".destacados__section")[0];
	destacados.style.marginLeft = "-50%";
	destacados.style.transition = "all 0.5s";
	setTimeout(function(){
		destacados.style.transition = "none";
		destacados.insertAdjacentElement('beforeend', destacadosSectionFirst);
		destacados.style.marginLeft = "-25%";
	}, 500);
};

function anteriorDestacado(){
	let destacadosSection = document.querySelectorAll(".destacados__section");
	let destacadosSectionLast = destacadosSection[destacadosSection.length -1];
	destacados.style.marginLeft = "0";
	destacados.style.transition = "all 0.5s";
	setTimeout(function(){
		destacados.style.transition = "none";
		destacados.insertAdjacentElement('afterbegin', destacadosSectionLast);
		destacados.style.marginLeft = "-25%";
	}, 500);
}

function comprobar1(){
	if (lblradio3.classList.contains('active')){
		siguiente();
	}
	else if(lblradio2.classList.contains('active')){
		anterior();
	}
}

function comprobar2(){
	if (lblradio1.classList.contains('active')){
		siguiente();
	}
	else if(lblradio3.classList.contains('active')){
		anterior();
	}
}

function comprobar3(){
	if (lblradio2.classList.contains('active')){
		siguiente();
	}
	else if(lblradio1.classList.contains('active')){
		anterior();
	}
}

function hoverPrimera(){
	primeraMin.classList.add('active');
	segundaMin.classList.remove('active');
	terceraMin.classList.remove('active');

	primera.classList.remove('hidden');
	segunda.classList.add('hidden');
	tercera.classList.add('hidden');
}

function hoverSegunda(){
	primeraMin.classList.remove('active');
	segundaMin.classList.add('active');
	terceraMin.classList.remove('active');

	primera.classList.add('hidden');
	segunda.classList.remove('hidden');
	tercera.classList.add('hidden');
}

function hoverTercera(){
	primeraMin.classList.remove('active');
	segundaMin.classList.remove('active');
	terceraMin.classList.add('active');

	primera.classList.add('hidden');
	segunda.classList.add('hidden');
	tercera.classList.remove('hidden');
}

function mostrarForm(){
	formUbicacion.classList.remove('noVisible');
	formUbicacion.classList.add('visible');
	agregarUbicacion.classList.add('noVisible')
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

if (menuUsuario) {
	menuUsuario.addEventListener('mouseover', hoverUsuario, true);
	menuUsuario.addEventListener('mouseout', noHoverUsuario, true);
}

if (btnRight){
	btnRight.addEventListener('click', function(){
		siguiente();
	});
}

if (btnLeft) {
	btnLeft.addEventListener('click', function(){
		anterior();
	});
}

if (lblradio1){
	lblradio1.addEventListener('click', comprobar1, true);
}

if (lblradio2){
	lblradio2.addEventListener('click', comprobar2, true);
}

if (lblradio3){
	lblradio3.addEventListener('click', comprobar3, true);
}

if (destacadosBtnRight){
	destacadosBtnRight.addEventListener('click', function(){
		siguienteDestacado();
	});
}

if (destacadosBtnLeft) {
	destacadosBtnLeft.addEventListener('click', function(){
		anteriorDestacado();
	});
}

if (primeraMin) {
	primeraMin.addEventListener('mouseover', hoverPrimera, true);
}

if (segundaMin) {
	segundaMin.addEventListener('mouseover', hoverSegunda, true);
}

if (terceraMin) {
	terceraMin.addEventListener('mouseover', hoverTercera, true);
}

if (agregarUbicacion) {
	agregarUbicacion.addEventListener('click', mostrarForm, true);
}