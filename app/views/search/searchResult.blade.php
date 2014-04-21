@section('content')

<div class="well span12 searchContainer">

  <h3 class="searchListTitle">Noticias Encontradas:</h2>
  <div class="acordeon">
      @foreach ($search as $result)

        <div class="media">

          <div class="media-body">

            <h4 class="media-heading searchListTitle"><img class="img-rounded newsImage sourceLogo" src="images/logos/{{ $result->source }}.png" />{{ $result->title }}</h4>
            <!--<h4 class="media-heading searchListTitle" style="background-image: url('images/logos/{{ $result->source }}.png'); background-size: cover; background-repeat: round; font-size: 30px;">{{ $result->title }}</h4> -->
            <p class="searchListResume">
            <a class="pull-left" href="#">
             <img class='"media-object img-circle newsImage' src="{{ $result->image }}" />
            </a class="searchListResume"> {{ $result->resume }}</p>

          </div>

        </div> 

      @endforeach
    </div>
</div>

@stop