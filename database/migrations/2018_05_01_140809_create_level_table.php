<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLevelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('level', function(Blueprint $table)
		{
			$table->integer('id_level', true);
			$table->integer('level');
			$table->time('time', 4);
			$table->integer('amount_level_down');
			$table->integer('amunt_level_up');
			$table->integer('amount_questions');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('level');
	}

}
