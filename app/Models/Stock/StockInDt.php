<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Item;

class StockInDt extends Model
{
    use HasFactory;
    protected $table = 'stock_in_dt';
    protected $fillable = [
        'stock_in_id',
        'item_id',
        'qty',
        'date',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function stockIn ()
    {
        return $this->belongsTo(StockInDt::class);
    }

    public function item ()
    {
        return $this->belongsTo(Item::class);
    }
}
