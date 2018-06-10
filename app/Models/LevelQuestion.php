<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LevelQuestion
 * 
 * @property int $id_defense_level_question
 * @property int $level_id
 * @property int $question_id
 * 
 * @property \App\Models\Level $level
 * @property \App\Models\Question $question
 *
 * @package App\Models
 */
class LevelQuestion extends Eloquent
{
	protected $primaryKey = 'id_defense_level_question';
	public $timestamps = false;

	protected $casts = [
		'level_id' => 'int',
		'question_id' => 'int'
	];

	protected $fillable = [
		'level_id',
		'question_id'
	];

	public function level()
	{
		return $this->belongsTo(\App\Models\Level::class);
	}

	public function question()
	{
		return $this->belongsTo(\App\Models\Question::class);
	}
}
