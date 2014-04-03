@extends('layouts.default')

@section('content')

	<h1>All sources : </h1>


	@foreach ($sources as $source)

		<li>{{ link_to("/sources/{$source->Name}", $source->Name) }} </li>

	@endforeach

@stop	