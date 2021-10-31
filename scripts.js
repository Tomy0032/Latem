const slider = document.querySelector("#slider");
let sliderSection = document.querySelectorAll(".slider__section");
let sliderSectionLast = sliderSection[sliderSection.length -1];

const btnLeft = document.querySelector("#btn--left");
const btnRight = document.querySelector("#btn--right");

if(slider){
	slider.insertAdjacentElement('afterbegin', sliderSectionLast);
}

var cambiarLogin = document.getElementById('btn-iniciar'),
	cambiarRegistro = document.getElementById('btn-registrar'),
	login = document.getElementById('login'),
	registro = document.getElementById('registro'),
	contador = 0;

var	abrirProductos = document.getElementById('btn-productos'),
	menuProductos = document.getElementById('menu-productos');

var lblradio1 = document.getElementById('lblradio1'),
	lblradio2 = document.getElementById('lblradio2'),
	lblradio3 = document.getElementById('lblradio3');
	

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
/*if (lblradio1) {
	if (lblradio2.classList.contains('active')) {
		lblradio1.addEventListener('click', function(){
			anterior();
		});
	}
	else if (lblradio3.classList.contains('active')) {
		lblradio1.addEventListener('click', function(){
			suguiente();
		});
	}
}*/
if (lblradio1){
	lblradio1.addEventListener('click', comprobar1, true);
}
if (lblradio2){
	lblradio2.addEventListener('click', comprobar2, true);
}
if (lblradio3){
	lblradio3.addEventListener('click', comprobar3, true);
}