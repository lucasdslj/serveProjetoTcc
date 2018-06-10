<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Administrator
 * 
 * @property int $id_administrator
 * @property string $name
 * @property string $email
 * @property string $cell_phone
 * @property string $phone
 * @property string $password
 * @property int $profile_id
 * 
 * @property \App\Models\Profile $profile
 * @property \Illuminate\Database\Eloquent\Collection $institutions
 *
 * @package App\Models
 */
class Administrator extends Eloquent
{
	protected $primaryKey = 'id_administrator';
	public $timestamps = false;

	protected $casts = [
		'profile_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
		'cell_phone',
		'phone',
		'password',
		'profile_id'
	];

	public function profile()
	{
		return $this->belongsTo(\App\Models\Profile::class);
	}

	public function institutions()
	{
		return $this->hasMany(\App\Models\Institution::class);
	}
}
