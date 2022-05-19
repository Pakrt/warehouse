<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'category_id',
        'unit_id',
        'capacity',
        'description',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];
}
