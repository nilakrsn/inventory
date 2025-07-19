<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'users_id',
        'stock_id',
        'quantity',
        'type',
        'total_price'
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
