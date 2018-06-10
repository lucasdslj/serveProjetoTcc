<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table)
		{
			$table->integer('id_address', true);
			$table->integer('postal_code');
			$table->string('street', 100);
			$table->string('destrict', 45);
			$table->integer('numb')->nullable();
			$table->string('city', 45);
			$table->string('state', 45);
			$table->string('country', 45);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('addresses');
	}

}
