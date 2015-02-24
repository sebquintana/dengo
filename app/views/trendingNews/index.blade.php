@foreach($trendingNews as $news)
	
	<div class="list-group">
 	<!-- <div class="thumbnail"> -->
 		<div class="list-group-item">
 			<img class='img-rounded' src="{{ $news->image }}" style ="height: 100px;">
	 		{{-- <a href="#">{{ $news->title }}</a> --}}
	 		{{ link_to_route('trending_search_path', $news->title, $news->title) }}
  		</div>
	</div>
	
@endforeach