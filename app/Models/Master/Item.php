<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Stock\StockInDt;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'category_id',
        'unit_id',
        'rack_capacity',
        'description',
        'weight',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function category ()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit ()
    {
        return $this->belongsTo(Unit::class);
    }

    public function stockInDt ()
    {
        return $this->hasMany(StockInDt::class);
    }

    public function stock ()
    {
        return $this->hasMany(Stock::class);
    }
}
