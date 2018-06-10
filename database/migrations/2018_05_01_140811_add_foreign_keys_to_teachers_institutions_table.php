<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTeachersInstitutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('teachers_institutions', function(Blueprint $table)
		{
			$table->foreign('institution_id', 'institution_id')->references('id_institution')->on('institutions')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('teacher_registration', 'teacher_registration')->references('registration')->on('teachers')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('teachers_institutions', function(Blueprint $table)
		{
			$table->dropForeign('institution_id');
			$table->dropForeign('teacher_registration');
		});
	}

}
