<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdministratorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('administrators', function(Blueprint $table)
		{
			$table->integer('id_administrator', true);
			$table->string('name', 100);
			$table->string('email', 45);
			$table->string('cell_phone', 15);
			$table->string('phone', 15)->nullable();
			$table->string('password', 20);
			$table->integer('profile_id')->index('id_profile');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('administrators');
	}

}
