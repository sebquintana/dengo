<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sources', function($table)
		{
		    $table->increments('id');
		    $table->string('name');
		    $table->string('shortname');
		    $table->enum('type', array('internacional', 'diario', 'portal', 'provincial'));
		    $table->string('genre')->default(null);
		    $table->string('country')->default(null);

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sources');
	}

}
