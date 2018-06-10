<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->string('registration', 20)->primary();
			$table->string('name', 100);
			$table->date('birth_date');
			$table->string('cell_phone', 15);
			$table->string('sex', 10);
			$table->string('email', 45);
			$table->string('password', 20);
			$table->integer('class_id')->nullable()->index('id_class_idx');
			$table->integer('profile_id')->index('id_profile_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('students');
	}

}
