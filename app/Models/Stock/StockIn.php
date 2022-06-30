<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Supplier;

class StockIn extends Model
{
    use HasFactory;
    protected $table = 'stock_in';
    protected $fillable = [
        'invoice',
        'supplier_id',
        'date',
        'description',
        'product_origin',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function stockInDt ()
    {
        return $this->hasMany(StockInDt::class);
    }

    public function supplier ()
    {
        return $this->belongsTo(Supplier::class);
    }
}
