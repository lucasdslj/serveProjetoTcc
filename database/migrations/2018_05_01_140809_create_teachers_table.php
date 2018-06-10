<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeachersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teachers', function(Blueprint $table)
		{
			$table->string('registration', 20)->primary();
			$table->string('name', 100);
			$table->string('cell_phone', 15);
			$table->string('phone', 15)->nullable();
			$table->string('email', 45);
			$table->string('password', 20);
			$table->string('sex', 10);
			$table->integer('profile_id')->index('profile_id_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('teachers');
	}

}
