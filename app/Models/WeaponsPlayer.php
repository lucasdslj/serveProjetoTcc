<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:04 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class WeaponsPlayer
 * 
 * @property int $id_weapon_player
 * @property int $weapon_id
 * @property string $player_registration
 * 
 * @property \App\Models\Weapon $weapon
 * @property \App\Models\Player $player
 *
 * @package App\Models
 */
class WeaponsPlayer extends Eloquent
{
	protected $primaryKey = 'id_weapon_player';
	public $timestamps = false;

	protected $casts = [
		'weapon_id' => 'int'
	];

	protected $fillable = [
		'weapon_id',
		'player_registration'
	];

	public function weapon()
	{
		return $this->belongsTo(\App\Models\Weapon::class);
	}

	public function player()
	{
		return $this->belongsTo(\App\Models\Player::class, 'player_registration');
	}
}
