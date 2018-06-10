<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TeachersInstitution
 * 
 * @property int $id_teacher_institution
 * @property string $teacher_registration
 * @property int $institution_id
 * 
 * @property \App\Models\Institution $institution
 * @property \App\Models\Teacher $teacher
 *
 * @package App\Models
 */
class TeachersInstitution extends Eloquent
{
	protected $primaryKey = 'id_teacher_institution';
	public $timestamps = false;

	protected $casts = [
		'institution_id' => 'int'
	];

	protected $fillable = [
		'teacher_registration',
		'institution_id'
	];

	public function institution()
	{
		return $this->belongsTo(\App\Models\Institution::class);
	}

	public function teacher()
	{
		return $this->belongsTo(\App\Models\Teacher::class, 'teacher_registration');
	}
}
