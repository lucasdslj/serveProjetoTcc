<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 23:13:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class InstitutionsAddress
 * 
 * @property int $id_institution_address
 * @property int $institution_id
 * @property int $address_id
 * 
 * @property \App\Models\Address $address
 * @property \App\Models\Institution $institution
 *
 * @package App\Models
 */
class InstitutionsAddress extends Eloquent
{
	protected $primaryKey = 'id_institution_address';
	public $timestamps = false;

	protected $casts = [
		'institution_id' => 'int',
		'address_id' => 'int'
	];

	protected $fillable = [
		'institution_id',
		'address_id'
	];

	public function address()
	{
		return $this->belongsTo(\App\Models\Address::class);
	}

	public function institution()
	{
		return $this->belongsTo(\App\Models\Institution::class);
	}
}
