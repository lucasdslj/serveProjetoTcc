<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstitutionsAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institutions_addresses', function(Blueprint $table)
		{
			$table->integer('id_institution_address', true);
			$table->integer('institution_id')->index('id_institution_idx');
			$table->integer('address_id')->index('id_address_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('institutions_addresses');
	}

}
