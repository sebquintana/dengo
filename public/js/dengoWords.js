function prepareWords(totalWords) {
	for(i = 0; i < totalWords; i++) {
		
		if (i < 6) {
			document.getElementById("word" + i).style.display = "block";
		}else{
			document.getElementById("word" + i).style.display = "none";
		}
		
	}
}

function changeWords(bullet) {
	if (bullet == "bullet1") {
		document.getElementById('bullet1').src = "img/bullet4.png";
		document.getElementById('bullet2').src = "img/bullet3.png";
		document.getElementById('bullet3').src = "img/bullet3.png";
		
		for(i = 0; i < 18; i++) {
			if (i < 6) {
				$("#word" + i).fadeIn('slow');
			}else{
				document.getElementById("word" + i).style.display = "none";
			}	
		}
	}
	
	if (bullet == "bullet2") {
		document.getElementById('bullet1').src = "img/bullet3.png";
		document.getElementById('bullet2').src = "img/bullet4.png";
		document.getElementById('bullet3').src = "img/bullet3.png";
		for(i = 0; i < 18; i++) {
			if (i < 12 && i > 5) {
					$("#word" + i).fadeIn('slow');
			}else{
				document.getElementById("word" + i ).style.display = "none";
			}	
		}
	}
	
	if (bullet == "bullet3") {
		document.getElementById('bullet1').src = "img/bullet3.png";
		document.getElementById('bullet2').src = "img/bullet3.png";
		document.getElementById('bullet3').src = "img/bullet4.png";
		for(i = 0; i < 18; i++) {
			if (i > 11) {
					$("#word" + i).fadeIn('slow');
			}else{
				document.getElementById("word" + i).style.display = "none";
			}	
		}
	}
	
}

