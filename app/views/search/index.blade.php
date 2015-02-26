@extends('layouts.default')

@section('content')
	
	<div class="well search-title">
		Resultados para : {{ $searchInput }}
	</div>

	@foreach($searchedNews as $news)
	
	<div class="list-group">
 	
 		<div class="list-group-item search-result-item">
 			<div class="news-date">{{ $news->pubdate }}</div>
 			<img class="img-rounded source-logo" src="images/logos/{{ $news->source }}.png" />
	 		<a class="list-group-item-heading fancybox fancybox.iframe" href="{{ $news->link }}">{{ $news->title }}</a>
	 		<p class="list-group-item-text">{{ $news->resume }}</p>
			<img class='img-rounded search-item-img' src="{{ $news->image }}">
  		</div>
	
	</div>
	
	@endforeach

@stop