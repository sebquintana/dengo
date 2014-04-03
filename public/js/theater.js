function loadGET(getVariable){

	var $_GET = {};

	document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
	    function decode(s) {
		return decodeURIComponent(s.split("+").join(" "));
	    }

	    $_GET[decode(arguments[1])] = decode(arguments[2]);
	});

	return $_GET[getVariable];
}

$(document).ready(function() {

	// Load GET theater.
	url = loadGET('theater');
	if(url != undefined){
		$.fancybox({
			'width': '90%',
			'height': '90%',
			'type': 'iframe',
			'href': url
		});
	}
	
	// Settings
	$('.fancybox').fancybox({
		'width': '90%',
		'height': '90%',
	});

});

