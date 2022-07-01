<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutRackDt extends Model
{
    // use HasFactory;
    // use HasFactory;
    protected $table = 'stock_out_rack_dt';
    protected $fillable = [
        'stock_out_dt_id',
        'rack_dt_id',
        'updated_at',
        'created_at',
    ];

    public function item ()
    {
        return $this->belongsTo(Item::class);
    }
}
