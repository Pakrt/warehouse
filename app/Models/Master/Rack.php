<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use HasFactory;
    protected $fillable = [
        'area',
        'row',
        'name',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
