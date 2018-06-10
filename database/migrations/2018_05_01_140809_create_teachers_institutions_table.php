<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeachersInstitutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teachers_institutions', function(Blueprint $table)
		{
			$table->integer('id_teacher_institution', true);
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
		Schema::drop('teachers_institutions');
	}

}
