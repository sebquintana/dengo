<!--<div class="well span12 trendingNewsContainer">
    <div class="row-fluid">
        <ul class="nav nav-tabs nav-stacked">
          <li class="nav-header"><h2 class="dengoDelDiaTitle">Las Dengo del dia:</h2></li>
          <li class="dengoDelDiaList">
            @foreach($tenTrendingNews as $trendingNews)
            <a class="dengoDelDiaNews" href="/{{{ $trendingNews->title }}}">
                  <img class='img-rounded newsImage' src="{{ $trendingNews->image }}" />
                  {{ $trendingNews->title }}
               </a>
            @endforeach
          </li>
        </ul>
    </div>
</div>
-->

<div class="row">
 @foreach($tenTrendingNews as $trendingNews) 
  <div class="col-sm-6 col-md-6">
    <div class="thumbnail">
        <a class="dengoDelDiaNews" href="/{{{ $trendingNews->title }}}">
         @if ($trendingNews->image == null)
              <img class='img-rounded newsImage' src="images/icono.ico">
         @else 
              <img class='img-rounded newsImage' src="{{ $trendingNews->image }}">
         @endif 
       </a>
      <div class="caption">
        <h3><a class="dengoDelDiaNews" href="/{{{ $trendingNews->title }}}">{{ $trendingNews->title }}</a></h3>
      </div>
    </div>
  </div>
 @endforeach
</div>