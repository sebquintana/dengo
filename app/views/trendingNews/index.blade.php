<div class="row">
	<div class="trending-news-container">
		<div class="jumbotron ">
		    <h1>Las Dengo del día:</h1>
		</div>

		@foreach($trendingNews as $news)
			
			<div class="list-group col-md-6">
		 	<!-- <div class="thumbnail"> -->
		 		<div class="list-group-item trending-news">
		 			<img class='img-rounded trending-news-img' src="{{ $news->image }}">
			 		{{-- <a href="#">{{ $news->title }}</a> --}}
			 		{{ link_to_route('trending_search_path', $news->title, $news->title) }}
		  		</div>
			</div>
		@endforeach
	</div>
</div>