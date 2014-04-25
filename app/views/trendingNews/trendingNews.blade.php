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