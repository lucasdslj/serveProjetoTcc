<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInstitutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('institutions', function(Blueprint $table)
		{
			$table->foreign('administrator_id', 'administrator_id')->references('id_administrator')->on('administrators')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('institutions', function(Blueprint $table)
		{
			$table->dropForeign('administrator_id');
		});
	}

}
