<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expand extends Model
{
    protected $fillable = [
        'users_id',
        'desc',
        'nominal'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
