<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfilesPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles_permissions', function(Blueprint $table)
		{
			$table->integer('id_profile_permission', true);
			$table->integer('profile_id')->index('id_profile_idx');
			$table->integer('permission_id')->index('id_permission_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profiles_permissions');
	}

}
