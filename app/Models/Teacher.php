<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Teacher
 * 
 * @property string $registration
 * @property string $name
 * @property string $cell_phone
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property string $sex
 * @property int $profile_id
 * 
 * @property \App\Models\Profile $profile
 * @property \Illuminate\Database\Eloquent\Collection $classes
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 * @property \Illuminate\Database\Eloquent\Collection $institutions
 *
 * @package App\Models
 */
class Teacher extends Eloquent
{
	protected $primaryKey = 'registration';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'profile_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'cell_phone',
		'phone',
		'email',
		'password',
		'sex',
		'profile_id'
	];

	public function profile()
	{
		return $this->belongsTo(\App\Models\Profile::class);
	}

	public function classes()
	{
		return $this->hasMany(\App\Models\Class::class, 'teacher_registration');
	}

	public function addresses()
	{
		return $this->belongsToMany(\App\Models\Address::class, 'teachers_addresses', 'teacher_registration')
					->withPivot('id_teacher_address');
	}

	public function institutions()
	{
		return $this->belongsToMany(\App\Models\Institution::class, 'teachers_institutions', 'teacher_registration')
					->withPivot('id_teacher_institution');
	}
}
