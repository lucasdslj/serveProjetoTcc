<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLevelQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('level_questions', function(Blueprint $table)
		{
			$table->foreign('level_id', 'id_level')->references('id_level')->on('level')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('question_id', 'id_question')->references('id_question')->on('questions')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('level_questions', function(Blueprint $table)
		{
			$table->dropForeign('id_level');
			$table->dropForeign('id_question');
		});
	}

}
