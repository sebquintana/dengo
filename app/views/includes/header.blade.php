<div class="navbar  navbar-fixed-top">
	<div class="navbar-inner headerContainer">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" type="button"> 
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="/">
				<img class="dengoLogo" style="border:none;" src="images/logo.png"/>
			</a>

			<div class="nav-collapse headerMenus">
				{{ Form::open(array('route' => 'store', 'class' => 'form form-search navbar-search pull-right ')) }}
					<div class="input-append"> 
						{{ Form::text('search', null, ['class' => 'search-query']) }}
						{{ Form::submit('Buscar', ['class' => 'btn btn-buscar']) }}
					 </div> 
				{{ Form::close() }}
				
				<ul class="nav pull-right">
					<li ><a href="#about">Ultimas Noticias</a></li>
					<li ><a href="#about">Denguealas</a></li>
					<li ><a href="#about">Quienes Somos</a></li>
					<li ><a href="#contact">Contacto</a></li>
					<li ><a href="#contact">Secciones</a></li>
				</ul>
				
			</div>
		</div>
	</div>
</div>
<br>