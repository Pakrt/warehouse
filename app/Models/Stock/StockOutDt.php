<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Item;

class StockOutDt extends Model
{
    use HasFactory;
    protected $table = 'stock_out_dt';
    protected $fillable = [
        'stock_out_id',
        'item_id',
        'qty',
        'date',
        'production_date',
        'expired_date',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function item ()
    {
        return $this->belongsTo(Item::class);
    }
}
