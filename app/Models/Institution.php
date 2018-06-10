<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Institution
 * 
 * @property int $id_institution
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $cell_phone
 * @property string $site
 * @property string $passport
 * @property int $administrator_id
 * 
 * @property \App\Models\Administrator $administrator
 * @property \Illuminate\Database\Eloquent\Collection $classes
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 * @property \Illuminate\Database\Eloquent\Collection $teachers
 *
 * @package App\Models
 */
class Institution extends Eloquent
{
	protected $primaryKey = 'id_institution';
	public $timestamps = false;

	protected $casts = [
		'administrator_id' => 'int'
	];

	protected $fillable = [
		'name',
		'email',
		'phone',
		'cell_phone',
		'site',
		'passport',
		'administrator_id'
	];

	public function administrator()
	{
		return $this->belongsTo(\App\Models\Administrator::class);
	}

	public function classes()
	{
		return $this->hasMany(\App\Models\Class::class);
	}

	public function addresses()
	{
		return $this->belongsToMany(\App\Models\Address::class, 'institutions_addresses')
					->withPivot('id_institution_address');
	}

	public function teachers()
	{
		return $this->belongsToMany(\App\Models\Teacher::class, 'teachers_institutions', 'institution_id', 'teacher_registration')
					->withPivot('id_teacher_institution');
	}
}
