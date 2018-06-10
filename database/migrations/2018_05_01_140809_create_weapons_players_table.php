<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWeaponsPlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('weapons_players', function(Blueprint $table)
		{
			$table->integer('id_weapon_player', true);
			$table->integer('weapon_id')->index('id_weapon_idx');
			$table->string('player_registration', 45)->index('id_player_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('weapons_players');
	}

}
