<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Address
 * 
 * @property int $id_address
 * @property int $postal_code
 * @property string $street
 * @property string $destrict
 * @property int $numb
 * @property string $city
 * @property string $state
 * @property string $country
 * 
 * @property \Illuminate\Database\Eloquent\Collection $institutions
 * @property \Illuminate\Database\Eloquent\Collection $students
 * @property \Illuminate\Database\Eloquent\Collection $teachers
 *
 * @package App\Models
 */
class Address extends Eloquent
{
	protected $primaryKey = 'id_address';
	public $timestamps = false;

	protected $casts = [
		'postal_code' => 'int',
		'numb' => 'int'
	];

	protected $fillable = [
		'postal_code',
		'street',
		'destrict',
		'numb',
		'city',
		'state',
		'country'
	];

	public function institutions()
	{
		return $this->belongsToMany(\App\Models\Institution::class, 'institutions_addresses')
					->withPivot('id_institution_address');
	}

	public function students()
	{
		return $this->belongsToMany(\App\Models\Student::class, 'students_addresses', 'address_id', 'student_registration')
					->withPivot('id_student_address');
	}

	public function teachers()
	{
		return $this->belongsToMany(\App\Models\Teacher::class, 'teachers_addresses', 'address_id', 'teacher_registration')
					->withPivot('id_teacher_address');
	}
}
