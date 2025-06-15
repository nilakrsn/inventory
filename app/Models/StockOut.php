<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    protected $fillable = [
        'users_id',
        'products_id',
        'quantity',
        'selling_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
