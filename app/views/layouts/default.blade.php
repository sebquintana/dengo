<!DOCTYPE html>
<html>
<head>
	@include('includes.head')
</head>
<body>

	<header>
			@include('includes.header')
	</header>	

	<div class="container">
			@include('flash::message')
			@yield('content')	
	
	</div>

	<footer>
			@include('includes.footer')
	</footer>

		@include('includes.scripts')
</body>
</html>