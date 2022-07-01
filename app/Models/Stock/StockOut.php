<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Distributor;

class StockOut extends Model
{
    use HasFactory;
    protected $table = 'stock_out';
    protected $fillable = [
        'invoice',
        'distributor_id',
        'date',
        'clock',
        'description',
        'product_origin',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function distributor ()
    {
        return $this->belongsTo(Distributor::class);
    }
}
