function prepareNewsWords(totalWords) {
	for(i = 0; i < totalWords; i++) {
		
		if (i < 6) {
			document.getElementById("word" + i).style.display = "block";
		}else{
			document.getElementById("word" + i).style.display = "none";
		}
		
	}
}

function changeNews(bullet) {
	if (bullet == "newsBullet1") {
		document.getElementById('newsBullet1').src = "img/bullet4.png";
		document.getElementById('newsBullet2').src = "img/bullet3.png";
		document.getElementById('newsBullet3').src = "img/bullet3.png";
		
		for(i = 0; i < 30; i++) {
			if (i < 10) {
				$("#news" + i).fadeIn('slow');
			}else{
				document.getElementById("news" + i).style.display = "none";
			}	
		}
	}
	
	if (bullet == "newsBullet2") {
		document.getElementById('newsBullet1').src = "img/bullet3.png";
		document.getElementById('newsBullet2').src = "img/bullet4.png";
		document.getElementById('newsBullet3').src = "img/bullet3.png";
		for(i = 0; i < 30; i++) {
			if (i < 20 && i > 9) {
					$("#news" + i).fadeIn('slow');
			}else{
				document.getElementById("news" + i ).style.display = "none";
			}	
		}
	}
	
	if (bullet == "newsBullet3") {
		document.getElementById('newsBullet1').src = "img/bullet3.png";
		document.getElementById('newsBullet2').src = "img/bullet3.png";
		document.getElementById('newsBullet3').src = "img/bullet4.png";
		for(i = 0; i < 30; i++) {
			if (i > 19) {
					$("#news" + i).fadeIn('slow');
			}else{
				document.getElementById("news" + i).style.display = "none";
			}	
		}
	}
	
}

