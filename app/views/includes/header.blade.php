<nav class="navbar navbar-default navbar-fixed-top navbar-inverse	">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed collapsed-button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="{{ route('home') }}">
        <img class="dengo-logo" src="images/logo.png">
      </a>
    </div>

  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        {{-- <li class="header-option">{{ link_to_route('about_path', 'Quienes Somos' ) }}</li> --}}
      </ul>

      @include('search.search-form')
      
  </div>
</nav>