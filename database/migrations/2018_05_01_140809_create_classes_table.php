<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classes', function(Blueprint $table)
		{
			$table->integer('id_class', true);
			$table->char('serie', 1);
			$table->char('letter', 1)->nullable();
			$table->boolean('active');
			$table->string('passport', 20);
			$table->string('teacher_registration', 20)->index('teacher_registration_idx');
			$table->integer('institution_id')->index('institution_id_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('classes');
	}

}
