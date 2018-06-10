<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Question
 * 
 * @property int $id_question
 * @property string $mathematics_subject
 * @property int $amount_xp
 * @property int $amount_pump
 * @property \Carbon\Carbon $time_pump
 * @property string $question
 * 
 * @property \Illuminate\Database\Eloquent\Collection $levels
 *
 * @package App\Models
 */
class Question extends Eloquent
{
	protected $primaryKey = 'id_question';
	public $timestamps = false;

	protected $casts = [
		'amount_xp' => 'int',
		'amount_pump' => 'int'
	];

	protected $dates = [
		'time_pump'
	];

	protected $fillable = [
		'mathematics_subject',
		'amount_xp',
		'amount_pump',
		'time_pump',
		'question'
	];

	public function levels()
	{
		return $this->belongsToMany(\App\Models\Level::class, 'level_questions')
					->withPivot('id_defense_level_question');
	}
}
