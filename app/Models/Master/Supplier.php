<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock\StockIn;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'phone',
        'address',
        'tax_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function stockIn ()
    {
        return $this->hasMany('App\Models\Stock\StockIn');
    }
}
