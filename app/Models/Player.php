<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Player
 * 
 * @property string $student_registration
 * @property string $user_name
 * @property float $latitude
 * @property float $longitude
 * @property string $patent
 * @property int $amount_victories_as_challenger
 * @property int $amount_victories_as_challenged
 * @property int $amount_defeats_as_challenger
 * @property int $amount_defeats_as_challenged
 * @property int $amount_xp
 * @property int $defence_force
 * @property int $attack_force
 * @property int $amount_life
 * @property string $ship
 * @property int $level_id
 * 
 * @property \App\Models\Level $level
 * @property \App\Models\Student $student
 * @property \Illuminate\Database\Eloquent\Collection $weapons
 *
 * @package App\Models
 */
class Player extends Eloquent
{
	protected $primaryKey = 'id_player';
	public $timestamps = false;

	protected $casts = [

		'latitude' => 'float',
		'longitude' => 'float',
		'amount_xp' => 'int',
		'amount_victories_total' => 'int',
		'amount_defeats_total' => 'int',
		'level_id' => 'int'
	];


	protected $fillable = [
		'user_name',
		'latitude',
		'longitude',
		'name',
		'sex',
		'email',
		'password',
		'amount_xp',
		'amount_victories_total',
		'amount_defeats_total',
		'level_id'
	];

	public function level()
	{
		return $this->belongsTo(\App\Models\Level::class);
	}

	public function student()
	{
		return $this->belongsTo(\App\Models\Student::class, 'student_registration');
	}

	public function weapons()
	{
		return $this->belongsToMany(\App\Models\Weapon::class, 'weapons_players', 'player_registration')
					->withPivot('id_weapon_player');
	}
}
