<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sources', function(Blueprint $table) {
			$table->increments('id');
			$table->string('Name');
			$table->string('ShortName');
			$table->enum('Type', array('internacional','diario','portal','provicial'));
			$table->string('Genre');
			$table->string('Country');
			$table->timestamps();
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
