<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('classes', function(Blueprint $table)
		{
			$table->foreign('institution_id', 'id_institution')->references('id_institution')->on('institutions')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('teacher_registration', 'registration_teacher')->references('registration')->on('teachers')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('classes', function(Blueprint $table)
		{
			$table->dropForeign('id_institution');
			$table->dropForeign('registration_teacher');
		});
	}

}
