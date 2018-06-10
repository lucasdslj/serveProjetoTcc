<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToStudentsAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students_addresses', function(Blueprint $table)
		{
			$table->foreign('address_id', 'addresses_id')->references('id_address')->on('addresses')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('student_registration', 'students_registrations')->references('registration')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('students_addresses', function(Blueprint $table)
		{
			$table->dropForeign('addresses_id');
			$table->dropForeign('students_registrations');
		});
	}

}
