<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'barcode',
        'categories_id',
        'cons_price',
        'selling_price',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockIns()
    {
        return $this->hasMany(StockIn::class);
    }


    public function stockOuts()
    {
        return $this->hasMany(StockOut::class);
    }
}
