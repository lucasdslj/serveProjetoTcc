<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('players', function(Blueprint $table)
		{
			$table->string('student_registration', 45)->primary();
			$table->string('user_name', 15);
			$table->double('latitude');
			$table->double('longitude');
			$table->string('patent', 20);
			$table->integer('amount_victories_as_challenger');
			$table->integer('amount_victories_as_challenged');
			$table->integer('amount_defeats_as_challenger');
			$table->integer('amount_defeats_as_challenged');
			$table->integer('amount_xp');
			$table->integer('defence_force');
			$table->integer('attack_force');
			$table->integer('amount_life');
			$table->string('ship', 45);
			$table->integer('level_id')->index('level_defense_id_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('players');
	}

}
