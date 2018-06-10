<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Profile
 * 
 * @property int $id_profile
 * @property string $type
 * @property string $description
 * 
 * @property \Illuminate\Database\Eloquent\Collection $administrators
 * @property \Illuminate\Database\Eloquent\Collection $permissions
 * @property \Illuminate\Database\Eloquent\Collection $students
 * @property \Illuminate\Database\Eloquent\Collection $teachers
 *
 * @package App\Models
 */
class Profile extends Eloquent
{
	protected $primaryKey = 'id_profile';
	public $timestamps = false;

	protected $fillable = [
		'type',
		'description'
	];

	public function administrators()
	{
		return $this->hasMany(\App\Models\Administrator::class);
	}

	public function permissions()
	{
		return $this->belongsToMany(\App\Models\Permission::class, 'profiles_permissions')
					->withPivot('id_profile_permission');
	}

	public function students()
	{
		return $this->hasMany(\App\Models\Student::class);
	}

	public function teachers()
	{
		return $this->hasMany(\App\Models\Teacher::class);
	}
}
