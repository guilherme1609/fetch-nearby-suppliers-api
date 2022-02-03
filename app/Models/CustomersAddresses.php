<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomersAddresses extends Model
{
	use HasFactory, SoftDeletes;

	protected $dates = [
		'deleted_at', 'created_at', 'updated_at'
	];

	protected $fillable = ['id', 'name', 'customers_id', 'addresses_id'];

	protected $visible = ['id', 'name', 'customers_id', 'addresses_id'];

	protected $table = 'customers_addresses';

	public function customers()
	{
		return $this->belongsTo('App\Models\Customers');
	}

	public function addresses()
	{
		return $this->belongsTo('App\Models\Addresses');
	}
}
