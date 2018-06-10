<?php


namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;


class Rematch extends Eloquent
{
    protected $primaryKey = 'id_rematch';
	public $timestamps = false;

	protected $casts = [
        'amount_victories' => 'int',
    ];
   // protected $dates = [
	//	'date'
	//];


	protected $fillable = [
		'amount_victories',
		'player_adversary',
		'user_name_player',
        'date',
	];

    public function players()
	{
		return $this->hasMany(\App\Models\Player::class);
	}
}