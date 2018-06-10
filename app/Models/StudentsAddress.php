<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class StudentsAddress
 * 
 * @property int $id_student_address
 * @property int $address_id
 * @property string $student_registration
 * 
 * @property \App\Models\Address $address
 * @property \App\Models\Student $student
 *
 * @package App\Models
 */
class StudentsAddress extends Eloquent
{
	protected $primaryKey = 'id_student_address';
	public $timestamps = false;

	protected $casts = [
		'address_id' => 'int'
	];

	protected $fillable = [
		'address_id',
		'student_registration'
	];

	public function address()
	{
		return $this->belongsTo(\App\Models\Address::class);
	}

	public function student()
	{
		return $this->belongsTo(\App\Models\Student::class, 'student_registration');
	}
}
