<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLevelQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('level_questions', function(Blueprint $table)
		{
			$table->integer('id_defense_level_question', true);
			$table->integer('level_id')->index('level_defense_idx');
			$table->integer('question_id')->index('id_question_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('level_questions');
	}

}
