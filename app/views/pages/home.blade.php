@extends('layouts.default')

@section('content')

     @include('trendingNews.index', ['trendingNews' => $newsArray])
     
@stop