<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:04 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Weapon
 * 
 * @property int $id_weapon
 * @property string $name
 * @property int $amount_xp
 * @property int $damage
 * 
 * @property \Illuminate\Database\Eloquent\Collection $players
 *
 * @package App\Models
 */
class Weapon extends Eloquent
{
	protected $primaryKey = 'id_weapon';
	public $timestamps = false;

	protected $casts = [
		'amount_xp' => 'int',
		'damage' => 'int'
	];

	protected $fillable = [
		'name',
		'amount_xp',
		'damage'
	];

	public function players()
	{
		return $this->belongsToMany(\App\Models\Player::class, 'weapons_players', 'weapon_id', 'player_registration')
					->withPivot('id_weapon_player');
	}
}
