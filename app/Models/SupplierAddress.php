<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierAddress extends Model
{
    use HasFactory, SoftDeletes;

	protected $dates = [
		'deleted_at', 'created_at', 'updated_at'
	];

	protected $fillable = ['id', 'name', 'supplier_id', 'address_id'];

	protected $visible = ['id', 'name', 'supplier_id', 'address_id'];

	protected $table = 'supplier_address';

	public function suppliers()
	{
		return $this->belongsTo('App\Models\Supplier');
	}

	public function addresses()
	{
		return $this->belongsTo('App\Models\Address');
	}
}
