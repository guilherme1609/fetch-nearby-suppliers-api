<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAddress extends Model
{
	use HasFactory, SoftDeletes;

	protected $dates = [
		'deleted_at', 'created_at', 'updated_at'
	];

	protected $fillable = ['id', 'name', 'main_address','customer_id', 'address_id'];

	protected $visible = ['id', 'name', 'main_address','customer_id', 'address_id'];

	protected $table = 'customer_address';

	public function customers()
	{
		return $this->belongsTo('App\Models\Customer');
	}

	public function addresses()
	{
		return $this->belongsTo('App\Models\Address');
	}
}
