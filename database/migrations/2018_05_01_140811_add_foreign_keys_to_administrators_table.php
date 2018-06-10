<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAdministratorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('administrators', function(Blueprint $table)
		{
			$table->foreign('profile_id', 'profiles_id')->references('id_profile')->on('profiles')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('administrators', function(Blueprint $table)
		{
			$table->dropForeign('profiles_id');
		});
	}

}
