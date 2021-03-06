<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

	protected $dates = [
		'deleted_at', 'created_at', 'updated_at'
	];

	protected $fillable = [
		'id',
		'street',
		'number',
		'postal_code',
		'neighborhood',
		'city',
		'state',
		'country',
		'lat',
		'long'
	];

	protected $visible = [
		'id',
		'street',
		'number',
		'postal_code',
		'neighborhood',
		'city',
		'state',
		'country',
		'lat',
		'long'
	];

	protected $table = 'address';

	public function customers()
	{
		return $this->belongsTo('App\Models\Customer');
	}

	public function suppliers()
	{
		return $this->belongsTo('App\Models\Supplier');
	}
}
