<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'change_type',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
