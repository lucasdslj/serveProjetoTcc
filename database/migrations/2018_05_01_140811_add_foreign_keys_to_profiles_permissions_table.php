<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProfilesPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('profiles_permissions', function(Blueprint $table)
		{
			$table->foreign('permission_id', 'id_permissions')->references('id_permission')->on('permissions')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('profile_id', 'id_profiles')->references('id_profile')->on('profiles')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('profiles_permissions', function(Blueprint $table)
		{
			$table->dropForeign('id_permissions');
			$table->dropForeign('id_profiles');
		});
	}

}
