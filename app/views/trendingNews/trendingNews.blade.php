<div class="well span12 trendingNewsContainer">
		<div class="row-fluid">
				<ul class="nav nav-tabs nav-stacked">
					<li class="nav-header"><h2 class="dengoDelDiaTitle">Las Dengo del dia:</h2></li>
  				<li class="dengoDelDiaList">
            @foreach($tenTrendingNews as $trendingNews)
              <a href="/search/{{{ $trendingNews->title }}}">
                <div class="dengoDelDiaNews">
                  <img class='img-circle newsImage' src="{{ $trendingNews->image }}" />
                  {{ $trendingNews->title }}
                </div> 
               </a>
            @endforeach
  				</li>
				</ul>
		</div>
</div>