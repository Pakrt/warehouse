<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
