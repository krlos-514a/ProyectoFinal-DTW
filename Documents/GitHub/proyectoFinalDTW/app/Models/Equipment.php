<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = ['name', 'responsible', 'delivered_at', 'returned_at'];
    protected $dates = ['delivered_at', 'returned_at'];
    protected $casts = [
    'delivered_at' => 'datetime',
    'returned_at' => 'datetime',
    ];
}