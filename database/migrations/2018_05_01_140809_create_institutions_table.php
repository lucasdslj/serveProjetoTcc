<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstitutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institutions', function(Blueprint $table)
		{
			$table->integer('id_institution', true);
			$table->string('name', 100);
			$table->string('email', 30);
			$table->string('phone', 15);
			$table->string('cell_phone', 15)->nullable();
			$table->string('site', 100)->nullable();
			$table->string('passport', 20);
			$table->integer('administrator_id')->index('administrator_id_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('institutions');
	}

}
