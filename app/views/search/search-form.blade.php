{{ Form::open(['route' => 'search_path', 'class'=>'navbar-form navbar-right']) }}
  
	<div class="input-group">

		{{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Buscar en dengo ...', 'required' => 'required']) }}

		<span class="input-group-btn">
	   
		{{ Form::submit('Buscar', ['class' => 'btn btn-default']) }}
	    
		</span>

	</div>	

{{ Form::close() }}