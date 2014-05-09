@section('content')

<div class="well span12 searchContainer">

  <h2 class="searchListTitle">Noticias Encontradas:</h2>
  <div class="acordeon">
      @foreach ($search as $result)

        <div class="media">

          <div class="media-body">

            <h4 class="media-heading"><img class="img-rounded newsImage sourceLogo" src="images/logos/{{ $result->source }}.png" /><div class="newsDate">{{ $result->pubdate }}</div><span class="searchListNewsTitles">{{ $result->title }}</span></h4>
            <p class="searchListResume">
            <a class="pull-left" href="#">
             <img class='"media-object img-circle newsImage' src="{{ $result->image }}" />
            </a class="searchListResume"> {{ $result->resume }}
              <span class="searchNewsOptions">
               <a class='fancybox fancybox.iframe newsToolsFont' href="{{ $result->link }}"><img src='images/leerNoticia.png' style='border:none; width: 51px;' title='Leer Noticia'/></a> 
               <a href='https://twitter.com/intent/tweet?screen_name=dengoweb&text=%23{{ $result->source }}:%20{{ $result->title }}&tw_p=tweetbutton'><img src='images/twitter.png' style='border:none;' title='Twittear'/></a> 
               <a href='http://www.facebook.com/sharer.php?u={{ $result->link }}' target='_blank'><img src='images/facebook.png' style='border:none;' title='Compartir en Facebook'/></a>
              </span>
           </p>

          </div>

        </div> 

      @endforeach
    </div>
</div>

@stop