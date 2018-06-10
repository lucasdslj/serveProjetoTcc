<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Student
 * 
 * @property string $registration
 * @property string $name
 * @property \Carbon\Carbon $birth_date
 * @property string $cell_phone
 * @property string $sex
 * @property string $email
 * @property string $password
 * @property int $class_id
 * @property int $profile_id
 * 
 * @property \App\Models\Class $class
 * @property \App\Models\Profile $profile
 * @property \App\Models\Player $player
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 *
 * @package App\Models
 */
class Student extends Eloquent
{
	protected $primaryKey = 'registration';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'class_id' => 'int',
		'profile_id' => 'int'
	];

	protected $dates = [
		'birth_date'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'birth_date',
		'cell_phone',
		'sex',
		'email',
		'password',
		'class_id',
		'profile_id'
	];

	public function class()
	{
		return $this->belongsTo(\App\Models\Class::class);
	}

	public function profile()
	{
		return $this->belongsTo(\App\Models\Profile::class);
	}

	public function player()
	{
		return $this->hasOne(\App\Models\Player::class, 'student_registration');
	}

	public function addresses()
	{
		return $this->belongsToMany(\App\Models\Address::class, 'students_addresses', 'student_registration')
					->withPivot('id_student_address');
	}
}
