@extends('layouts.default')

@section('content')
	
	<div class="well">
		Resultados para : {{ $searchInput }}
	</div>

	@foreach($searchedNews as $news)
	
	<div class="list-group">
 	
 		<div class="list-group-item">
 			<img class='img-rounded' src="{{ $news->image }}" style ="height: 100px;">
	 		<a class="list-group-item-heading fancybox fancybox.iframe" href="{{ $news->link }}">{{ $news->title }}</a>
	 		<p class="list-group-item-text">{{ $news->resume }}</p>
  		</div>
	
	</div>
	
	@endforeach

@stop