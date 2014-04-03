$(document).ready(function() {

	$("#carouselLogos").carouFredSel({
		height: 40,
		width: 900,
		items: {
			start: "random"
		},
		scroll: {
			items: 1,
			duration: 250,
			pauseOnHover: true
		},
		mousewheel: true,
		swipe: true
	});

	// Preload workaround.
	// Esta funcion no esta disponible en jquery 1.9, y se reemplazo por la de la linea 21.
//	document.getElementById('carouselContainer').style.visibility='visible';
	$("#carouselContainer").attr("style","visibility:visible");

});

