<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\RackDt;
use App\Models\Master\Item;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'rack_dt_id',
        'item_qty',
        'description',
        'date',
        'production_date',
        'expired_date',
        'clock',
        'product_origin',
        'item_weight',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function rackDt()
    {
        return $this->hasMany(RackDt::class, 'id', 'rack_dt_id'); // id target, foreign id
    }

    public function item()
    {
        return $this->hasMany(Item::class, 'id', 'item_id'); // id target, foreign id
    }
}
