<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students_addresses', function(Blueprint $table)
		{
			$table->integer('id_student_address', true);
			$table->integer('address_id')->index('id_address_idx');
			$table->string('student_registration', 45)->index('students_registrations_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('students_addresses');
	}

}
