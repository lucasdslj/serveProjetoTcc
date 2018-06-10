<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Class
 * 
 * @property int $id_class
 * @property string $serie
 * @property string $letter
 * @property int $active
 * @property string $passport
 * @property string $teacher_registration
 * @property int $institution_id
 * 
 * @property \App\Models\Institution $institution
 * @property \App\Models\Teacher $teacher
 * @property \Illuminate\Database\Eloquent\Collection $students
 *
 * @package App\Models
 */
class Class extends Eloquent
{
	protected $primaryKey = 'id_class';
	public $timestamps = false;

	protected $casts = [
		'active' => 'int',
		'institution_id' => 'int'
	];

	protected $fillable = [
		'serie',
		'letter',
		'active',
		'passport',
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

	public function students()
	{
		return $this->hasMany(\App\Models\Student::class);
	}
}
