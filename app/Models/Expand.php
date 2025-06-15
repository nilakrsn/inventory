<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expand extends Model
{
    protected $fillable = [
        'user_id',
        'desc',
        'nominal'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
