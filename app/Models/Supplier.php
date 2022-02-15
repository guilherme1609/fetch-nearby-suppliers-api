<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

	protected $dates = [
        'deleted_at', 'created_at', 'updated_at'
    ];

	protected $fillable = ['id', 'name', 'range'];

    protected $visible = ['id', 'name', 'range'];

	protected $table = 'supplier';
}
