<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Permission
 * 
 * @property int $id_permission
 * @property string $action
 * @property string $description
 * 
 * @property \Illuminate\Database\Eloquent\Collection $profiles
 *
 * @package App\Models
 */
class Permission extends Eloquent
{
	protected $primaryKey = 'id_permission';
	public $timestamps = false;

	protected $fillable = [
		'action',
		'description'
	];

	public function profiles()
	{
		return $this->belongsToMany(\App\Models\Profile::class, 'profiles_permissions')
					->withPivot('id_profile_permission');
	}
}
