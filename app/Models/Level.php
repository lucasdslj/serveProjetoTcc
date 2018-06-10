<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Level
 * 
 * @property int $id_level
 * @property int $level
 * @property \Carbon\Carbon $time
 * @property int $amount_level_down
 * @property int $amunt_level_up
 * @property int $amount_questions
 * 
 * @property \Illuminate\Database\Eloquent\Collection $questions
 * @property \Illuminate\Database\Eloquent\Collection $players
 *
 * @package App\Models
 */
class Level extends Eloquent
{
	protected $table = 'level';
	protected $primaryKey = 'id_level';
	public $timestamps = false;

	protected $casts = [
		'level' => 'int',
		'amount_level_down' => 'int',
		'amunt_level_up' => 'int',
		'amount_bomb' => 'int'
	];

	protected $dates = [
		'time'
	];

	protected $fillable = [
		'level',
		'time',
		'amount_level_down',
		'amunt_level_up',
		'amount_bomb'
	];

	public function questions()
	{
		return $this->belongsToMany(\App\Models\Question::class, 'level_questions')
					->withPivot('id_defense_level_question');
	}

	public function players()
	{
		return $this->hasMany(\App\Models\Player::class);
	}
}
