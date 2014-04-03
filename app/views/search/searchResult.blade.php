@section('content')

<div class="well span12 trendingNewsContainer">
	<div class="row-fluid">
		<ul class="nav nav-tabs nav-stacked">
			<li class="nav-header"><h4>Noticias Encontradas:</h4></li>
  			<li class="dengoDelDiaList">
    	       	@foreach ($search as $result)
        	      <a href="#">
            	  <img class='img-circle newsImage' src="{{ $result->image }}" />
              	   {{ $result->title }}
               	 </a>
         		   @endforeach
  			</li>
		</ul>
	</div>
</div>

@stop