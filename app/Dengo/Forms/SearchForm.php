<?php 
namespace Dengo\Forms;

use Laracasts\Validation\FormValidator;

class SearchForm extends FormValidator{
	
	protected $rules = [
		'search' => 'required',
	];
}