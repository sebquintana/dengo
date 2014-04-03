<div class="well span12 trendingNewsContainer">
		<div class="row-fluid">
				<ul class="nav nav-tabs nav-stacked">
					<li class="nav-header"><h4>Las Dengo del dia:</h4></li>
  				<li class="dengoDelDiaList">
            @foreach($tenTrendingNews as $trendingNews)
              <a href="#">
              <img class='img-circle newsImage' src="{{ $trendingNews->image }}" />
              {{ $trendingNews->title }}
               </a>
            @endforeach
  				</li>
				</ul>
		</div>
</div>