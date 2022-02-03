<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuppliersAddresses extends Model
{
    use HasFactory, SoftDeletes;

	protected $dates = [
		'deleted_at', 'created_at', 'updated_at'
	];

	protected $fillable = ['id', 'name', 'suppliers_id', 'addresses_id'];

	protected $visible = ['id', 'name', 'suppliers_id', 'addresses_id'];

	protected $table = 'suppliers_addresses';

	public function suppliers()
	{
		return $this->belongsTo('App\Models\Suppliers');
	}

	public function addresses()
	{
		return $this->belongsTo('App\Models\Addresses');
	}
}
