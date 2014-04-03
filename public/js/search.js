function buscar() {
	if (document.getElementById('buscar').value != "" && document.getElementById('buscar').value != "Buscá un tema") {
		//if (document.getElementById('porDiario').checked) {
		//	location.href= "buscar.php?keyword=" + document.getElementById('buscar').value + "&ordenamiento=" + document.getElementById('porDiario').value;
		//}else{
			location.href= "buscar.php?keyword=" + document.getElementById('buscar').value + "&ordenamiento=peso";
		//}
		return false;
	}
}
