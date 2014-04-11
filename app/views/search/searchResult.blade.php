@section('content')

<div class="well span12 searchContainer">

  <h3 class="searchListTitle">Noticias Encontradas:</h2>
  <div class="acordeon">
      @foreach ($search as $result)

        <div class="media">

          <div class="media-body">

            <h4 class="media-heading searchListTitle">{{ $result->title }}</h4>
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