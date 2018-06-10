<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students', function(Blueprint $table)
		{
			$table->foreign('class_id', 'id_class')->references('id_class')->on('classes')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('profile_id', 'id_profile')->references('id_profile')->on('profiles')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('students', function(Blueprint $table)
		{
			$table->dropForeign('id_class');
			$table->dropForeign('id_profile');
		});
	}

}
