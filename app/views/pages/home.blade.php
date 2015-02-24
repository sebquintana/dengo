@extends('layouts.default')

@section('content')
	
	 <div class="jumbotron">
        <h1>Las Dengo del día:</h1>
     </div>

     @include('trendingNews.index', ['trendingNews' => $newsArray])
@stop