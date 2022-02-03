<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use HasFactory, SoftDeletes;

	protected $dates = [
        'deleted_at', 'created_at', 'updated_at'
    ];

	protected $fillable = ['id', 'name'];

    protected $visible = ['id', 'name'];

	protected $table = 'customers';

}
