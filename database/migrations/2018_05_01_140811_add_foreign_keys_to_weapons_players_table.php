<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWeaponsPlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('weapons_players', function(Blueprint $table)
		{
			$table->foreign('weapon_id', 'id_weapon')->references('id_weapon')->on('weapons')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('player_registration', 'registration_player')->references('student_registration')->on('players')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('weapons_players', function(Blueprint $table)
		{
			$table->dropForeign('id_weapon');
			$table->dropForeign('registration_player');
		});
	}

}
