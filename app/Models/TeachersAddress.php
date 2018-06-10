<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TeachersAddress
 * 
 * @property int $id_teacher_address
 * @property int $address_id
 * @property string $teacher_registration
 * 
 * @property \App\Models\Address $address
 * @property \App\Models\Teacher $teacher
 *
 * @package App\Models
 */
class TeachersAddress extends Eloquent
{
	protected $primaryKey = 'id_teacher_address';
	public $timestamps = false;

	protected $casts = [
		'address_id' => 'int'
	];

	protected $fillable = [
		'address_id',
		'teacher_registration'
	];

	public function address()
	{
		return $this->belongsTo(\App\Models\Address::class);
	}

	public function teacher()
	{
		return $this->belongsTo(\App\Models\Teacher::class, 'teacher_registration');
	}
}
