window.onload = startup;

var cantidadDeDiarios;
var newspapersArray;
var numberOfSelected;

function startup() {
	numberOfSelected = 0;
	newspapersCookie = getCookie("newspapers");
	newspapersArray = JSON.parse(newspapersCookie);
	cantidadDeDiarios = newspapersArray.length;
	setPreferences();
	setCheckboxTodos();
}

function setPreferences() {
	for (var i = 0; i < cantidadDeDiarios; i++) {
		if (newspapersArray[i].value == "1") {
			document.getElementById('checkbox' + newspapersArray[i].shortname).checked = true;
			numberOfSelected++;
		}
	}
}

function countSelected(){
	numberOfSelected = 0;
	for (var i = 0; i < cantidadDeDiarios; i++) {
		if (newspapersArray[i].value == "1") {
			numberOfSelected++;
		}
	}
}

function savePreferences() {
	for (var i = 0; i < cantidadDeDiarios; i++) {
		if (document.getElementById('checkbox' + newspapersArray[i].shortname).checked == true) {
			newspapersArray[i].value = '1';
		} else {
			newspapersArray[i].value = '0';
		}
	}
	setCookie("newspapers", JSON.stringify(newspapersArray), 365);
}

function checkAll(status) {
	for (var i = 0; i < cantidadDeDiarios; i++) {
		document.getElementById('checkbox' + newspapersArray[i].shortname).checked = status;
	}
}

function setCheckboxTodos() {
	countSelected();
	if(numberOfSelected != cantidadDeDiarios){
		document.getElementById('checkboxTodos').checked = false;
	} else {
		document.getElementById('checkboxTodos').checked = true;
	}
}

function optionClick(){
	savePreferences();
	setCheckboxTodos();
}

/* Cookies */

function getCookie(c_name) {
	var c_value = document.cookie;
	var c_start = c_value.indexOf(" " + c_name + "=");
	if (c_start == -1) {
		c_start = c_value.indexOf(c_name + "=");
	}
	if (c_start == -1) {
		c_value = null;
	} else {
		c_start = c_value.indexOf("=", c_start) + 1;
		var c_end = c_value.indexOf(";", c_start);
		if (c_end == -1) {
			c_end = c_value.length;
		}
		c_value = unescape(c_value.substring(c_start, c_end));
	}
	return c_value;
}

function setCookie(c_name, value, exdays) {
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value = escape(value)
			+ ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
	document.cookie = c_name + "=" + c_value;
}
