<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWeaponsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('weapons', function(Blueprint $table)
		{
			$table->integer('id_weapon', true);
			$table->string('name', 45);
			$table->integer('amount_xp');
			$table->integer('damage');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('weapons');
	}

}
