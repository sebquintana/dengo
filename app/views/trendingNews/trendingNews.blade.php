<div class="well span12 trendingNewsContainer">
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