<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeachersAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teachers_addresses', function(Blueprint $table)
		{
			$table->integer('id_teacher_address', true);
			$table->integer('address_id')->index('id_address_idx');
			$table->string('teacher_registration', 20)->index('registration_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('teachers_addresses');
	}

}
