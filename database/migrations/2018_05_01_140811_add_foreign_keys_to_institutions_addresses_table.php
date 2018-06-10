<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInstitutionsAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('institutions_addresses', function(Blueprint $table)
		{
			$table->foreign('address_id', 'id_addresses')->references('id_address')->on('addresses')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('institution_id', 'id_instutions')->references('id_institution')->on('institutions')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('institutions_addresses', function(Blueprint $table)
		{
			$table->dropForeign('id_addresses');
			$table->dropForeign('id_instutions');
		});
	}

}
