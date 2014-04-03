function showAdsense() {
	if (document.getElementsByName('news').length > 2) {
		document.getElementById('adsenseContainer').style.display='block';
	}
	if (document.getElementsByName('news').length == 0) {
		document.getElementById('cuerpoContainer').style.height= "350px";
	}
}