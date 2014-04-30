<!-- Placed at the end of the document so the pages load faster -->

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>-->
	{{ HTML::style('css/jquery-ui-1.10.4.min.css'); }}
	{{ HTML::style('js/fancybox/jquery.fancybox.css'); }}
	{{ HTML::script('js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js') }}
	{{ HTML::script('js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	{{ HTML::script('js/acordeon.js') }}
	{{ HTML::script('js/fancybox/jquery.fancybox.js') }}
	{{ HTML::script('js/theater.js') }}
	{{ HTML::script('js/googleAnalytics.js') }}


    <!-- UserVoice JavaScript SDK (only needed once on a page) -->
	<script>
	(function(){var uv=document.createElement('script');
		uv.type='text/javascript';
		uv.async=true;
		uv.src='//widget.uservoice.com/IvwVq5VIASZdnTlulHzcGQ.js';
		var s=document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(uv,s)})()
	</script>
	<script>
		UserVoice = window.UserVoice || [];
		UserVoice.push(['showTab', 'classic_widget', {
		  mode: 'full',
		  primary_color: '#2c516e',
		  link_color: '#000000',
		  default_mode: 'feedback',
		  forum_id: 208205,
		  tab_label: 'Comentarios y soporte',
		  tab_color: '#2c516e',
		  tab_position: 'middle-right',
		  tab_inverted: false
		}]);
	</script>	
	<!-- End Of UserVoice JavaScript SDK (only needed once on a page) -->
