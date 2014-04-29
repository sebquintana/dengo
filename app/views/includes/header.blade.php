 <div class="navbar navbar-inverse navbar-fixed-top headerBar" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle headerMobileButton" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <a class="brand" href="/">
				<img class="dengoLogo" style="border:none;" src="images/logo.png"/>
			</a>
        </div>
        <div class="collapse navbar-collapse headerBarItems">
           {{ Form::open(array('route' => 'store', 'class' => 'navbar-form')) }}
              <div class="col-lg-2 input-group navbar-right searchBoxAndButton"> 
                {{ Form::text('search', null, array('class' => 'form-control')) }}
                <div class="input-group-btn">
                   {{ Form::submit('Buscar', array('class' => 'btn btn-default searchButton')) }}
                </div>
             </div> 
           {{ Form::close() }}  
            <ul class="nav navbar-nav navbar-right index-header-list" style="margin-right: 0">
                <li class="active"><a href="/">Ultimas Noticias</a></li>
                <!--<li ><a href="#about">Denguealas</a></li> -->
                <li ><a href="about">Quienes Somos</a></li>
                <li ><a href="#contact">Contacto</a></li>
                <!--<li ><a href="#contact">Secciones</a></li> -->
                <li ></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
<br>