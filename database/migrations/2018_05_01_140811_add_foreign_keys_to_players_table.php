<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('players', function(Blueprint $table)
		{
			$table->foreign('level_id', 'level_id')->references('id_level')->on('level')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('student_registration', 'registration_student')->references('registration')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('players', function(Blueprint $table)
		{
			$table->dropForeign('level_id');
			$table->dropForeign('registration_student');
		});
	}

}
