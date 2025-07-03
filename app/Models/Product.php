<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'barcode',
        'image',
        'categories_id',
        'cons_price',
        'selling_price',
        'status',
        'expired'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'categories_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'products_id');
    }
    
}
