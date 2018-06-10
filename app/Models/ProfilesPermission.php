<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProfilesPermission
 * 
 * @property int $id_profile_permission
 * @property int $profile_id
 * @property int $permission_id
 * 
 * @property \App\Models\Permission $permission
 * @property \App\Models\Profile $profile
 *
 * @package App\Models
 */
class ProfilesPermission extends Eloquent
{
	protected $primaryKey = 'id_profile_permission';
	public $timestamps = false;

	protected $casts = [
		'profile_id' => 'int',
		'permission_id' => 'int'
	];

	protected $fillable = [
		'profile_id',
		'permission_id'
	];

	public function permission()
	{
		return $this->belongsTo(\App\Models\Permission::class);
	}

	public function profile()
	{
		return $this->belongsTo(\App\Models\Profile::class);
	}
}
