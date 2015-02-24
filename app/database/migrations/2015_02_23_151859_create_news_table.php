<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->engine = 'MyISAM';

		    $table->string('id', '32')->unique();
		    $table->string('title', '300');
		    $table->string('resume', '600');
		    $table->text('link');
		    $table->text('image')->nullable();
		    $table->dateTime('pubdate');
		    $table->string('source','255');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('news');
	}

}
