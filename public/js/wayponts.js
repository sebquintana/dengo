$(document).ready(function () {


          var opts = {
                offset: '100%'
            };

            // definimos el elemento con id="end" como waypoint
            $('#end').waypoint(function(event, direction) {
			   if (document.getElementsByName('news').length > 6) {				 
					 var news = document.getElementsByName('news');
					if (direction == 'down' && news[document.getElementsByName('news').length - 1].style.display == "none") {					
						var end = $(this);
						document.getElementById('end').style.visibility = "visible";
						end.waypoint('remove');
						var cnt = 0;
						
						setTimeout(function() {
						for (i = 0; i < document.getElementsByName('news').length; i++) {
							if (news[i].style.display == "none" && cnt < 3) {
								//news[i].style.display = "block";
								$(news[i]).fadeIn('slow');	
								cnt++;
							}else{
								if (cnt >= 3){
									break;
								}
							}
								
						} 
						document.getElementById('end').style.visibility = "hidden";
						end.waypoint(opts);
						}, 1500);
					
					}
			   }
			}, opts);
				// definimos el elemento con id="end" como waypoint
            $('#begining').waypoint(function(event, direction) {	 
					if (direction == 'up') {				
						$("#topArrow").fadeOut('fast');
						$("#bottomArrow").fadeIn('slow');
					}
					if (direction == 'down') {	
						$("#topArrow").fadeIn('slow');	
						$("#bottomArrow").fadeOut('fast');
					}
			}, opts);
});

