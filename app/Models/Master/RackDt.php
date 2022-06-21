<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackDt extends Model
{
    use HasFactory;
    protected $table = 'rack_dt';
    protected $fillable = [
        'rack_id',
        'number',
        'is_load',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function racks()
    {
        return $this->belongsTo(Rack::class,'rack_id','id');
    }

}
