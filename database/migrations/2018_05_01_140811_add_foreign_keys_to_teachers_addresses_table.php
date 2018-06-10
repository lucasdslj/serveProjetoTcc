<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTeachersAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('teachers_addresses', function(Blueprint $table)
		{
			$table->foreign('address_id', 'id_address')->references('id_address')->on('addresses')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('teacher_registration', 'registrations_teachers')->references('registration')->on('teachers')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('teachers_addresses', function(Blueprint $table)
		{
			$table->dropForeign('id_address');
			$table->dropForeign('registrations_teachers');
		});
	}

}
